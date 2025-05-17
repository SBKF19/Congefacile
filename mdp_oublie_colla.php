<?php
include 'includes/database.php';

$erreurs = [];
$data = [];
$redirige = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;
    $mail = $_SESSION['utilisateur']['email'];

    // Suppression des espaces avant/après pour les différentes données.
    $data['password'] = trim($data['password'] ?? '');
    $data['newpass'] = trim($data['newpass'] ?? '');
    $data['confirmpass'] = trim($data['confirmpass'] ?? '');


    if (empty($data['password'])) {
        $erreurs['password'] = 'Veuillez saisir votre mot de passe.';
    } else {
        $requete = $connexion->prepare('
            SELECT password
            FROM user
           WHERE person_id = :id');

        $requete->bindParam('id', $_SESSION['utilisateur']['person_id']);
        $requete->execute();
        $motdepasseExistant = $requete->fetch(\PDO::FETCH_ASSOC);

        if ($motdepasseExistant && password_verify($data['password'], $motdepasseExistant['password'])) {
            $erreurs['password'] = '';
        } else {
            $erreurs['password'] = 'le mot de passe actuel ne correspond pas';
        }

    }



    if ($data['newpass'] !== $data['confirmpass']) {
        $erreurs['confirmpass'] = "Les mots de passe ne sont pas identiques.";

    }
    if (empty($data['confirmpass'])) {
        $erreurs['confirmpass'] = 'Veuillez saisir votre nouveau mot de passe.';
    }

    if (empty($data['newpass'])) {
        $erreurs['confirmpass'] = 'Veuillez saisir un nouveau mot de passe.';
    }

    if ($erreurs['password'] === '' && !isset($erreurs['confirmpass'])) {
        $motDePasseHashe = password_hash($data['newpass'], PASSWORD_DEFAULT);

        $requeteInsertion = $connexion->prepare('
        	UPDATE user
			SET password = :password
			WHERE person_id = :id;
        ');
        $requeteInsertion->bindParam('password', $motDePasseHashe);
        $requeteInsertion->bindParam('id', $_SESSION['utilisateur']['person_id']);
        $requeteInsertion->execute();

        // On redirige l'utilisateur vers la connexion.

        header("Location: includes/deco.php"); // Fonctionne !
        ob_end_flush();
    }
}


function afficheErreur(string $nomDuChamp, array $erreurs): string
{

    if (isset($erreurs[$nomDuChamp]) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        return '<span class="error" style="color:red;">' . $erreurs[$nomDuChamp] . '</span>';
    }
    return "";

}
function verifierMotDePasse(string $pass): string
{
    // Vérification de la présence d'une majuscule
    if (
        (
            !preg_match('/[A-Z]/', $pass)
            || !preg_match('/[a-z]/', $pass)
            || !preg_match('/[0-9]/', $pass)
            || !preg_match('/[\W]/', $pass)
            || strlen($pass) < 12)
        && $_SERVER['REQUEST_METHOD'] === 'POST'
    ) {
        return '<span class="error" style="color:red;">Le mot de passe doit contenir au moins 12 caractères dont 1 lettre  majuscule,une lettre minuscule, 1 caractère spécial et 1 chiffre</span> ';
    }
    return "";
}

?>

<h2>Réinitialiser mon mot de passe</h2>
<form action="<?php echo $redirige ?>" method="POST">

    <div>
        <label for="password" class="label-input">Mot de passe actuel</label>
        <input type="password" id="password" name="password" class="small-password-input"><br>
        <?php echo afficheErreur('password', $erreurs); ?>
        <br>
    </div>
    <div class="direction-column">
        <div class="date">
            <div>
                <label for="newpass" class="label-input">Nouveau mot de passe</label>
                <input type="password" id="newpass" name="newpass" class="small-password-input">
                <?php echo afficheErreur('newpass', $erreurs);
                ?>
            </div>

            <div>
                <label for="confirmpass" class="label-input">Confirmation du mot de passe</label>
                <input type="password" id="confirmpass" name="confirmpass" class="small-password-input">
                <?php echo afficheErreur('confirmpass', $erreurs);
                ?>
            </div>
        </div>
        <?php echo verifierMotDePasse($data['newpass'] ?? ''); ?>
    </div>

    <br>
    <button type="submit" class="dark-button" >Réinitialiser le mot de passe</button>
    </div>
</form>