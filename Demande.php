
<?php
include 'includes/collab-menu.php';
include 'includes/database.php';

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
}
?>
<div class="Request">
    <h2>Demande de <?= $dates["first_name"]." ".$dates["last_name"]?></h2>
    <h3>Demande du  <?= date("d/m/Y H:i:s", strtotime($dates["created_at"]))?></h3>
    <p>Période : <?=date("d/m/Y H:i:s", strtotime($dates["start_at"])) ?> au <?= date("d/m/Y H:i:s",strtotime($dates["end_at"])) ?></p> 
    <p>Nombre de jours : <?= $dates["DateDiff"] ?> jours</p>
    <form method="POST" style = "Margin-Bottom: 5%">
        <div>
            <label class="titreCommentaire" for="commentaire">Commentaire Supplémentaire</label>
            <textarea readonly="readonly" rows="3"><?= $dates["comment"] ?></textarea>
        </div>
    </form>
    <?php
    if(isset($dates["receipt_file"])){?>
    <a class="details-button" style="text-decoration: none;" download="<?= $dates["receipt_file"] ?>.txt">Télécharger le justificatif</a>
    <?php }
    ?>
    <h2>Répondre à la demande</h2>
        <form method="POST">
        <div>
            <label class="titreCommentaire" for="commentaire">Saisir un commentaire</label>
            <textarea rows="3" name="commentaire" id="commentaire"></textarea>
        </div>
        <div class="side-menu-profile">
            <div>
                <input type="submit" id="refuser" class="deny" name="refuser" value="Refuser la demande">
            </div>
            <div>
                <input type="submit" id="accepter" class="confirm" name="accepter" value="Accepter la demande">
            </div>
        </div>
    </form>
</div>
<?php
include 'includes/footer.php';
?>