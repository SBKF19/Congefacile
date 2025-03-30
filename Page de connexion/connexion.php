<?php
include 'includes/login-menu.php';
include 'includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    $data['email'] = trim($data['email'] ?? '');
    $data['mot_de_passe'] = trim($data['mot_de_passe'] ?? '');

    // Vérification si l'email n'est pas vide.
    if (empty($data['email'])) {
        $erreurs['email'] = 'Veuillez saisir votre email.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = 'Veuillez saisir un email valide.';
    }

    // Vérification si le mdp n'est pas vide.
    if (empty($data['mot_de_passe'])) {
        $erreurs['mot_de_passe'] = 'Veuillez saisir votre mot de passe.';
    }


    $requete = $connexion->prepare('
        SELECT person_id, email, password
        FROM user
        WHERE email = :email');

    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $utilisateur = $requete->fetch(\PDO::FETCH_ASSOC);


    // Utilisateur non trouvé en base de données.
    if ($utilisateur === false) {
        $erreurs['email'] = 'Compte non valide.';
    } else {
        if (($data['mot_de_passe'] == $utilisateur['password'])) {
            // OK l'utilisateur peut se connecter.
            // On créé une session avec les données de l'utilisateur.
            $_SESSION['utilisateur'] = [
                'person_id' => $utilisateur['person_id'],
                'email' => $utilisateur['email'],
            ];

            // On créé un message de succès de connexion.
            $_SESSION['message'] = [
                'type' => 'success',
                'message' => 'Vous êtes maintenant connecté.',
            ];

            // On redirige l'utilisateur sur la page d'accueil.
            header('Location: demande_conge_test.php');
        } else {
            $erreurs['email'] = 'Compte non valide.';
        }
    }

}
?>


<div class="wholeConnection">
    <h1>CongéFacile</h1>
    <p>CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l'entreprise. <br> Plus beoin
        d'échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer <br> vos abscences en
        toute transparences et simplicité. Connectez-vous ci-dessous pour accéder à votre espace.</p>
    <h1>Connectez-vous</h1>
    <form action="accueil.php" method="POST">
        <div class="connexion">
            <label for="email">Adresse email</label>
            <span>
                <img class="pic-mail" src="email (1).png" alt="">
                <input type="email" id="email" name="email" required placeholder="****@mentalworks.fr">
            </span>
        </div>

        <div class="connexion password-container">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            <span class="toggle-password" onclick="togglePassword()">
                <img src="oeil-ouvert.png" id="eyeIcon" alt="Afficher/Masquer le mot de passe">
            </span>
        </div>

        <?php
        if (!empty($erreurs)) {
            foreach ($erreurs as $champ => $message) {
                echo "<j class='erreur'>$message</j></br>";
            }
        }
        ?>
        <button type="submit" class="buttonConnexion" name="submit">Connexion au portail</button>
    </form>

    <div class="forgot-password">
        <p>Vous avez oublié votre mot de passe ? <a href="#">Cliquez ici</a> pour le réinitialiser.</p>
    </div>
</div>



<!----
    <form method="POST" action="">

<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

    <div class="col-span-full">
        <label for="mot_de_passe" class="block text-sm/6 font-medium text-gray-900">Mot de passe</label>
        <input name="mot_de_passe" type="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 
        -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 
        sm:text-sm/6" id="mot_de_passe" value="">

    </div>
    
    <div>
        <button
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            name="submit">Envoyer</button>
    </div>
</div>
</form> !--->






<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.src = "oeil-ouvert.png";
        } else {
            passwordField.type = "password";
            eyeIcon.src = "oeil-ouvert.png";
        }
    }
</script>
<?php
include 'includes/footer.php';
?>