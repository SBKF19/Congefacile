<?php
include 'includes/login-menu.php';
include 'includes/database.php';
?>
<div class="History">
    <h1>Mot de passe oublié</h1>
    <p>Renseignez votre adresse email dans le champ ci-dessous.<br>
        Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.
    </p>
    <form action="" method="POST">
        <div class="connexion">
            <label class="petit_texte" for="email">Adresse email</label>
                <input type="email" id="email" name="email" class="email-input" required placeholder="****@mentalworks.fr">
        </div>
        <button type="submit" class="dark-button" name="submit">Demander à réinitialiser votre mot de passe</button>
    </form>
    <p><a href="connexion.php">Cliquez ici</a> pour retourner à la page de connexion</p>

</div>
<?php
include 'includes/footer.php';
?>