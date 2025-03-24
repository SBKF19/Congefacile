<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link rel="stylesheet" href="style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />


    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet" />
    <title>Home</title>
</head>

<?php
    
include 'includes/database.php';

$query = $connexion->prepare('
	SELECT answer
	FROM request
	WHERE id = :id
');

$query->bindParam(':id', $_GET['id']);

$query->execute();

$answer = $query->fetch(\PDO::FETCH_ASSOC);

    // Si je ne suis pas en POST, je n'ai pas besoin de traiter le formulaire.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    // Suppression des espaces avant/après pour les différentes données.
    
    
    $data['commentaire'] = trim($data['commentaire']);
    if (isset($data['accepter']) && isset($data['commentaire']) && !isset($answer)){
        $query = $connexion->prepare('UPDATE request SET answer = :answer, answer_comment = :answer_comment, answer_at = :answer_at WHERE id = :id');
        $query->bindParam(':answer', $answer); 
        $query->bindParam(':answer_comment', $answer_comment);
        $query->bindParam(':answer_at', $answer_at); 
        $query->bindParam(':id', $id);
        $answer = 1;
        $answer_comment = $data['commentaire'];
        $answer_at = date("Y-m-d H:i:s");
        $id = $_GET['id'];
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
        $id = $_GET['id'];
        $query->execute();
    }
}
?>
<h4>Répondre à la demande</h4>
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
</html>