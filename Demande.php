
<?php
include 'includes/collab-menu.php';
include 'includes/database.php';
/*
$query = $connexion->prepare('
	SELECT answer
	FROM request
	WHERE id = :id
');
$id = $_GET["id"];
$query->bindParam(':id', $id);

$query->execute();

$idpage = $query->fetch(\PDO::FETCH_ASSOC);

$query = $connexion->prepare('
	SELECT created_at, start_at, end_at, receipt_file, DATEDIFF( end_at, start_at) as DateDiff, name , comment , last_name, first_name
	FROM request, request_type, person
	WHERE request_type_id = request_type.id AND collaborator_id = person.id AND request.id = :id
');

$query->bindParam(':id', $id);

$query->execute();

$dates = $query->fetch(\PDO::FETCH_ASSOC);

    // Si je ne suis pas en POST, je n'ai pas besoin de traiter le formulaire.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.


    $data['commentaire'] = trim($data['commentaire']);
    if (isset($data['accepter']) && isset($data['commentaire']) && !isset($idpage['answer'])){
        $query = $connexion->prepare('UPDATE request SET answer = :answer, answer_comment = :answer_comment, answer_at = :answer_at WHERE id = :id');
        $query->bindParam(':answer', $answer);
        $query->bindParam(':answer_comment', $answer_comment);
        $query->bindParam(':answer_at', $answer_at);
        $query->bindParam(':id', $id);
        $answer = 1;
        $answer_comment = $data['commentaire'];
        $answer_at = date("Y-m-d H:i:s");
        $query->execute();
    }

    if(isset($data['refuser'])&& isset($data['commentaire'])&& !isset($answer)){
        $query = $connexion->prepare('UPDATE request SET answer = :answer, answer_comment = :answer_comment, answer_at = :answer_at WHERE id = :id');
        $query->bindParam(':answer', $answer);
        $query->bindParam(':answer_comment', $answer_comment);
        $query->bindParam(':answer_at', $answer_at);
        $query->bindParam(':id', $id);
        $answer = 0;
        $answer_comment = $data['commentaire'];
        $answer_at = date("Y-m-d H:i:s");
        $query->execute();
    }
}*/
?>
<div class="History">
    <h1>Demande de <?/*= $dates["first_name"]." ".$dates["last_name"]*/?></h1>
    <h3>Demande du  <?/*= date("d/m/Y H:i:s", strtotime($dates["created_at"]))*/?></h3>
    <p class="text-no-margin">Période : <?/*=date("d/m/Y H:i:s", strtotime($dates["start_at"])) */?> au <?/*= date("d/m/Y H:i:s",strtotime($dates["end_at"])) */?></p>
    <p class="text-low-margin">Type de demande :</p>
    <p class="text-no-margin">Nombre de jours : <?/*= $dates["DateDiff"] */?> jours</p>
    <form method="POST">
        <br>
        <div>
            <label class="label-field" for="commentaire">Commentaire Supplémentaire</label>
            <br>
            <textarea readonly="readonly" class="placeholder"><?/*= $dates["comment"] */?></textarea>
        </div>
    <?php/*
    if(isset($dates["receipt_file"])){*/?>
        <br>
    <button class="light-button"><a download="<?/*= $dates["receipt_file"] */?>.txt">Télécharger le justificatif</a><img src="images/download.png"/></button>
    <?php /*}
    */?>
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