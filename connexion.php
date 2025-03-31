<?php
include 'includes/login-menu.php';
include 'includes/database.php';

$erreurs = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    $data['email'] = trim($data['email'] ?? '');
    $data['mot_de_passe'] = trim($data['mot_de_passe'] ?? '');

    // Vérification si l'email n'est pas vide.
    if (empty($data['email'])) {
        $erreurs['email'] = '*Veuillez saisir votre email.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = '*Veuillez saisir un email valide.';
    }

    // Vérification si le mdp n'est pas vide.
    if (empty($data['mot_de_passe'])) {
        $erreurs['mot_de_passe'] = '*Veuillez saisir votre mot de passe.';
    }


    $requete = $connexion->prepare('
        SELECT person_id, email, password, role
        FROM user
        WHERE email = :email');

    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $utilisateur = $requete->fetch(\PDO::FETCH_ASSOC);


    // Utilisateur non trouvé en base de données.
    if ($utilisateur === false) {
        $erreurs['email'] = '*Compte non valide.';
    } else {
        if (($data['mot_de_passe'] == $utilisateur['password'])) {
            // OK l'utilisateur peut se connecter.
            // On créé une session avec les données de l'utilisateur.
            $_SESSION['utilisateur'] = [
                'person_id' => $utilisateur['person_id'],
                'email' => $utilisateur['email'],
                'role' => $utilisateur['role'],
            ];

            // On créé un message de succès de connexion.
            $_SESSION['message'] = [
                'type' => 'success',
                'message' => 'Vous êtes maintenant connecté.',
            ];

            // On redirige l'utilisateur sur la page d'accueil.
            header('Location: accueil.php');
        } else {
            $erreurs['mot_de_passe'] = '*Mot de passe invalide.';
        }
    }

}
?>


<div class="wholeConnection">
    <h1>CongéFacile</h1>
    <p>CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l'entreprise. <br>
        Plus beoin d'échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer <br>
        vos abscences en toute transparences et simplicité. Connectez-vous ci-dessous pour accéder à votre espace.</p>
    <h1>Connectez-vous</h1>
    <form action="" method="POST">
        <div class="connexion">
            <label for="email">Adresse email</label>
            <?php
            if (!empty($erreurs['email'])) {
                echo "<j class='erreur'>{$erreurs['email']}</j></br>";
            }
            ?>
            <span>
                <img class="pic-mail" src="images/email (1).png" alt="">
                <input type="email" id="email" name="email" required placeholder="****@mentalworks.fr">
            </span>
        </div>

        <div class="connexion password-container">
            <label for="mot_de_passe">Mot de passe</label>
            <?php
            if (!empty($erreurs['mot_de_passe'])) {
                echo "<j class='erreur'>{$erreurs['mot_de_passe']}</j></br>";
            }
            ?>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            <span class="toggle-password" onclick="togglePassword()">
                <img src="images/oeil-ouvert.png" id="eyeIcon" alt="Afficher/Masquer le mot de passe">
            </span>
        </div>

        <?php

        ?>
        <button type="submit" class="dark-button" name="submit">Connexion au portail</button>
    </form>

    <div class="forgot-password">
        <p>Vous avez oublié votre mot de passe ? <a href="#">Cliquez ici</a> pour le réinitialiser.</p>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.src = "images/oeil-ouvert.png";
        } else {
            passwordField.type = "password";
            eyeIcon.src = "images/oeil-ouvert.png";
        }
    }
</script>
<?php
include 'includes/footer.php';
?>