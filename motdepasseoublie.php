<?php
include 'includes/login-menu.php';
include 'includes/database.php';
?>
<div class="whole_forgot_pword">
    <h1>Mot de passe oublié</h1>
    <p>Renseignez votre adresse email dans le champ ci-dessous.<br>
        Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.
    </p>
    <form action="" method="POST">
        <div class="connexion">
            <label class="petit_texte" for="email">Adresse email</label>
            <div class="mail-input">
                <span class="icon">
                    <img src="images/mail.png" alt="Icône email">
                </span>
                <input type="email" id="email" name="email" required placeholder="****@mentalworks.fr">
            </div>
        </div>
        <button type="submit" class="dark-button" name="submit">Demander à réinitialiser votre mot de passe</button>
    </form>
    <p><a>Cliquez ici</a> pour retourner à la de connexion</p>

</div>
<?php
include 'includes/footer.php';
?>