<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="connexion.css">
<<<<<<< HEAD
=======

>>>>>>> 1c6571b (demandes et postes)
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <h1>CongéFacile</h1>
        <p>CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l'entreprise. <br> Plus beoin d'échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer <br> vos abscences en toute transparences et simplicité. Connectez-vous ci-dessous pour accéder à votre espace.</p>
        <h1>Connectez-vous</h1>
        <form action="login.php" method="POST">
            <div class="connexion">
                <label for="email">Adresse email</label>
                <span>
                    <img class="pic-mail" src="email (1).png" alt="">
                    <input type="email" id="email" name="email" required placeholde="****@mentalworks.fr">
                </span>
            </div>
            
            <div class="connexion password-container">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <img src="oeil-ouvert.png" id="eyeIcon" alt="Afficher/Masquer le mot de passe">
                </span>
            </div>
            
            <button type="submit" class="button">Connexion au portail</button>
        </form>
        
        <div class="forgot-password">
            <p>Vous avez oublié votre mot de passe ? <a href="#">Cliquez ici</a> pour le réinitialiser.</p>
        </div>
    </div>
    
</body>
</html>
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
