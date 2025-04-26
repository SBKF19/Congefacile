<?php
include 'includes/collab-menu.php';
include 'includes/database.php';
?>
<div class="History">
    <h1>Demande de <??></h1>
    <h3>Demande du </h3>
    <p class="text-no-margin">Période : au </p>
    <p class="text-low-margin">Type de demande :</p>
    <p class="text-no-margin">Nombre de jours : jours</p>
    <form method="POST">
        <br>
        <div>
            <label class="label-field" for="commentaire">Commentaire Supplémentaire</label>
            <br>
            <textarea readonly="readonly" class="placeholder"></textarea>
        </div>
        <br>
    <button class="light-button"><a download=".txt">Télécharger le justificatif</a><img src="images/download.png"/></button>
    <br>
    <h2>Répondre à la demande</h2>
    <div>
            <label for="commentaire" class="label-field">Saisir un commentaire</label>
            <br>
            <textarea name="commentaire" id="commentaire" class="placeholder"></textarea>
    </div>
    <br>
        <div class="title-with-button">
                <button type="submit" id="refuser" class="deny" name="refuser"><a>Refuser la demande</a></button>
                <button type="submit" id="accepter" class="confirm" name="accepter"><a>Accepter la demande</a></button>
        </div>
    </form>
</div>
</div>
<?php
include 'includes/footer.php';
?>