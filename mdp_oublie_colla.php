<?php
session_start();
$erreurs = [];
$data = [];

include('include/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    $data['password'] = trim($data['password'] ?? '');
    $data['newpass'] = trim($data['newpass'] ?? '');
    $data['confirmpass'] = trim($data['confirmpass'] ?? '');

    // Vérification du mot de passe actuel
    if (empty($data['password'])) {
        $erreurs['password'] = 'Veuillez saisir votre mot de passe.';
    } else {
        $requete = $connexion->prepare('SELECT password FROM user WHERE email = :email');
        $requete->execute(['email' => $_SESSION['utilisateur']['email']]);
        $motdepasseExistant = $requete->fetchColumn();

        if (!$motdepasseExistant || !password_verify($data['password'], $motdepasseExistant)) {
            $erreurs['password'] = 'Le mot de passe actuel ne correspond pas.';
        }
    }

    // Vérification du nouveau mot de passe
    if (empty($data['newpass']) || empty($data['confirmpass'])) {
        $erreurs['newpass'] = 'Veuillez saisir et confirmer votre nouveau mot de passe.';
    } elseif ($data['newpass'] !== $data['confirmpass']) {
        $erreurs['confirmpass'] = "Les mots de passe ne sont pas identiques.";
    } elseif ($msg = verifierMotDePasse($data['newpass'])) {
        $erreurs['newpass'] = $msg;
    }

    // Si pas d'erreurs, mise à jour du mot de passe
    if (empty($erreurs)) {
        $motDePasseHashe = password_hash($data['newpass'], PASSWORD_DEFAULT);

        $requeteInsertion = $connexion->prepare('
            UPDATE user
            SET password = :password
            WHERE email = :email
        ');
        $requeteInsertion->execute([
            'password' => $motDePasseHashe,
            'email' => $_SESSION['utilisateur']['email']
        ]);

        // Redirection après succès
        header('Location: index.php');
        exit();
    }
}

// Fonction de vérification de la force du mot de passe
function verifierMotDePasse(string $pass): string
{
    if (
        !preg_match('/[A-Z]/', $pass) || 
        !preg_match('/[a-z]/', $pass) || 
        !preg_match('/[0-9]/', $pass) || 
        !preg_match('/[\W]/', $pass) || 
        strlen($pass) < 12
    ) {
        return 'Le mot de passe doit contenir au moins 12 caractères dont 1 lettre majuscule, une lettre minuscule, 1 caractère spécial et 1 chiffre';
    }
    return '';
}

// Fonction pour afficher les erreurs
function afficheErreur(string $nomDuChamp, array $erreurs): string
{
    return isset($erreurs[$nomDuChamp]) ? '<span class="error" style="color:red;">' . $erreurs[$nomDuChamp] . '</span>' : '';
}
?>

<h2>Réinitialiser mon mot de passe</h2>
<form action="#" method="POST">
    <div>
        <label for="password">Mot de passe actuel</label>
        <input type="password" id="password" name="password" class="label-field"><br>
        <?php echo afficheErreur('password', $erreurs); ?>
    </div>
    
    <div>
        <label for="newpass">Nouveau mot de passe</label>
        <input type="password" id="newpass" name="newpass" class="label-field"><br>
        <?php echo afficheErreur('newpass', $erreurs); ?>
    </div>
    
    <div>
        <label for="confirmpass">Confirmation du mot de passe</label>
        <input type="password" id="confirmpass" name="confirmpass" class="label-field"><br>
        <?php echo afficheErreur('confirmpass', $erreurs); ?>
    </div>

    <br>
    <button type="submit" class="dark-button">Réinitialiser le mot de passe</button>
</form>
