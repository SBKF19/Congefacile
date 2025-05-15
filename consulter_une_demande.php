
<?php
include 'includes/admin-menu.php';
include 'includes/database.php';
?>
<div class="History">
<?php
if($_SESSION['utilisateur']['role'] !== 'Manager'){
    header('Location: connexion.php');
}
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
	SELECT created_at, start_at, end_at, receipt_file, DATEDIFF( end_at, start_at) as DateDiff, name , comment , last_name, first_name , answer_comment
	FROM request, request_type, person
	WHERE request_type_id = request_type.id AND collaborator_id = person.id AND request.id = :id
');

$query->bindParam(':id', $id);

$query->execute();
$dates = $query->fetch(\PDO::FETCH_ASSOC);
        if ($dates === false) {
            echo '<h1>La demande n\'a pas été trouvée.</h1>';
            echo '<button class="dark-button"><a href="accueil.php">Retour à la liste</a></button>';
            exit;
        }


    // Si je ne suis pas en POST, je n'ai pas besoin de traiter le formulaire.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    
    
    $data['commentaire'] = trim($data['commentaire']);
    if (isset($data['commentaire']) && !isset($idpage['answer'])){
        $query = $connexion->prepare('UPDATE request SET answer = :answer, answer_comment = :answer_comment, answer_at = :answer_at WHERE id = :id');
        $query->bindParam(':answer', $answer); 
        $query->bindParam(':answer_comment', $answer_comment);
        $query->bindParam(':answer_at', $answer_at); 
        $query->bindParam(':id', $id);
        if(isset($data['refuser'])){
            $answer = 0;
        } else {
            $answer = 1;
        }
        $answer_comment = $data['commentaire'];
        $answer_at = date("Y-m-d H:i:s");
        $query->execute();
        $demande = $query->fetch(\PDO::FETCH_ASSOC);
        if ($demande === false) {
            echo '<h1>La demande à bien été répondue.</h1>';
            echo '<button class="dark-button"><a href="accueil.php">Retour à la liste</a></button>';
            exit;
        }
        
    }
}

?>

    <div class="Request">
        <h2>Demande de <?= $dates["first_name"]." ".$dates["last_name"]?></h2>
        <h3>Demande du  <?= date("d/m/Y H:i:s", strtotime($dates["created_at"]))?></h3>
        <p>Période : <?=date("d/m/Y H:i:s", strtotime($dates["start_at"])) ?> au <?= date("d/m/Y H:i:s",strtotime($dates["end_at"])) ?></p>
        <p>Type de demande : <?=$dates["name"] ?></p> 
        <p>Nombre de jours : <?= $dates["DateDiff"] ?> jours</p>
        <form method="POST" style = "Margin-Bottom: 5%">
            <div>
                <label class="titreCommentaire" for="commentaire">Commentaire Supplémentaire</label>
                <textarea readonly="readonly" rows="3"><?= $dates["comment"] ?></textarea>
            </div>
        </form>
        <?php
        if(isset($dates["receipt_file"])){?>
        <a class="details-button" style="text-decoration: none;" download="Justificatif.pdf" href = "<?= $dates["receipt_file"] ?>" >Télécharger le justificatif</a>
        <?php }
        ?>
        <h2>Répondre à la demande</h2>
        <?php if (!isset($idpage["answer"])){ ?>
            <form method="POST">
            <div>
                <label class="titreCommentaire" for="commentaire">Saisir un commentaire</label>
                <textarea rows="3" name="commentaire" id="commentaire"></textarea>
            </div>

                <div class="side-menu-profile">
                <div style="margin-right: 3%;">
                    <input type="submit" id="refuser" class="deny" name="refuser" value="Refuser la demande">
                </div>
                <div>
                    <input type="submit" id="accepter" class="confirm" name="accepter" value="Accepter la demande">
                </div>
            </div>
            <?php } else { ?>
            <div>
                <label class="titreCommentaire" for="commentaire">Saisir un commentaire</label>
                <textarea rows="3" name="commentaire" readonly id="commentaire"><?php echo $dates["answer_comment"] ?></textarea>
            </div>
            <?php } ?>
            
        </form>
    </div>
</div>
<?php
include 'includes/footer.php';
?>