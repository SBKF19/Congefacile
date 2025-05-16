<?php
$erreurs = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    $data['password'] = trim($data['password'] ?? '');
    $data['newpass'] = trim($data['newpass'] ?? '');
    $data['confirmpass'] = trim($data['confirmpass'] ?? '');


    if (empty($data['password'])) {
        $erreurs['password'] = 'Veuillez saisir votre mot de passe.';
    } else {
        $requete = $connexion->prepare('
            SELECT COUNT(*)
            FROM user
            WHERE password = :password
        ');

        $requete->bindParam('password', $data['password']);
        $requete->execute();
        $motdepasseExistant = $requete->fetchColumn();

        if ($motdepasseExistant == 0) {
            $erreurs['password'] = 'le mot de passe actuel ne correspond pas';

        }

    }



    if ($data['newpass'] !== $data['confirmpass']) {
        $erreurs['confirmpass'] = "Les mots de passe ne sont pas identiques.";

    }
    if (empty($data['confirmpass'])) {
        $erreurs['confirmpass'] = 'Veuillez saisir votre nouveau mot de passe.';
    }


    if (empty($erreurs)) {
        $motDePasseHashe = password_hash($data['password'], PASSWORD_DEFAULT);


        $requeteInsertion = $connexion->prepare('
        	UPDATE user
			SET password = :password
			WHERE email = :email;
        ');
        $mail = $_SESSION['utilisateur']['email'];
        $requeteInsertion->bindParam('password', $motDePasseHashe);
        $requeteInsertion->bindParam('password', $data['newpass']);
        $requeteInsertion->bindParam('email', $mail);
        $requeteInsertion->execute();
        try {
            $requeteInsertion->execute();

            // On redirige l'utilisateur vers la connexion.
            header('Location: index.php');
            exit();
        } catch (\Exception $exception) {
            $erreurs['global'] = 'Une erreur s\'est produite lors de votre inscription. Veuillez réessayer.';

        }
        $data['password'] = '';
        $data['confirmpass'] = '';
    }
}


function afficheErreur(string $nomDuChamp, array $erreurs): string
{

    if (isset($erreurs[$nomDuChamp])) {
        return '<span class="error" style="color:red;">' . $erreurs[$nomDuChamp] . '</span>';
    }
    return "";

}
function verifierMotDePasse(string $pass): string
{



    // Vérification de la présence d'une majuscule
    if (
        !preg_match('/[A-Z]/', $pass)
        || !preg_match('/[a-z]/', $pass)
        || !preg_match('/[0-9]/', $pass)
        || !preg_match('/[\W]/', $pass)
        || strlen($pass) < 12
    )
        ; {

        return '<span class="error" style="color:red;">Le mot de passe doit contenir au moins 12 caractères dont 1 lettre  majuscule,une lettre minuscule, 1 caractère spécial et 1 chiffre</span> ';
    }
}

?>

<h2>Réinitialiser mon mot de passe</h2>
<form action="#" method="POST">

    <div>
        <label for="password" class="label-input">Mot de passe actuel</label>
        <input type="password" id="password" name="password" class="label-field"><br>
        <?php echo afficheErreur('password', $erreurs); ?>
        <br>
    </div>
    <div class="date">
        <div>
            <label for="newpass" class="label-input">Nouveau mot de passe</label>
            <input type="password" id="newpass" name="newpass" class="label-fixed-value">
            <?php echo afficheErreur('newpass', $erreurs);
            ?>

        </div>

        <div>
            <label for="confirmpass" class="label-input">Confirmation du mot de passe</label>
            <input type="password" id="confirmpass" name="confirmpass" class="label-field">
            <?php echo afficheErreur('confirmpass', $erreurs);
            echo verifierMotDePasse('confirmpass');
            ?>
        </div>
    </div>

    <br>
    <button type="submit" class="dark-button">Réinitialiser le mot de passe</button>
    </div>
</form>