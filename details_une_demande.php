<?php
include 'includes/database.php';
include 'includes/verify-connect.php';
?>

<div class="History">

        <?php
        $id_demande = $_GET["id"]; /*à changer une fois que vous aurez fait la redirection depuis le bouton "détails" */
        $requete = $connexion->prepare('
		SELECT d.request_type_id, d.created_at, d.start_at, DATEDIFF(start_at, end_at) as DateDiff, d.end_at, d.answer_comment, d.answer, d.id AS request, t.name AS request_type
		FROM request d, request_type t
		WHERE d.request_type_id = t.id
		AND d.id = :id_demande
	');
        $requete->bindParam(":id_demande", $id_demande);

        $requete->execute();

        $demande = $requete->fetch(\PDO::FETCH_ASSOC);

	if ($demande === false) {
		echo '<h1>La demande n\'a pas été trouvée.</h1>';
		echo '<a class="dark-button" href="index.php">Retour à la liste</a>';
		exit;
	}

        $type_demande = $demande["request_type"];
        $date_creation = $demande["created_at"];
        $date_debut = $demande["start_at"];
        $date_fin = $demande["end_at"];
        $duree = $demande["DateDiff"];
        $commentaire = $demande["answer_comment"];
        $reponse = $demande["answer"];
        ?>

        <h1>Ma demande de congé</h1>
        <h3>Ma demande du <?php echo date("d/m/Y", strtotime($date_creation)); ?></h3>
        <p class="text-no-margin">Type de demande : <?php echo $type_demande; ?></p>
        <p class="text-low-margin">Période :
                <?php echo date("d/m/Y H:i", strtotime($date_debut)) . " au " . date("d/m/Y H:i", strtotime($date_fin)); ?>
        </p>
        <p class="text-no-margin">Nombre de jours :
                <?php
                if ($duree < 0) {
                        $duree = $duree * -1;
                        echo $duree;
                } else {
                        echo $duree;
                } /*Correction d'un bug qui met le nombre de jour en négatif si le statut est égal à 1 ou 0
               à voir si vous arrivez à le réparer sans la boucle if*/
                ?>
        </p>
        <p>Statut de la demande :
                <?php
                if (!isset($reponse)) {
                        echo "<span class='pending'>En attente</span>";
                } elseif ($reponse == 1) {
                        echo "<span class='confirmed'>Validé</span>";
                } elseif ($reponse == 0) {
                        echo "<span class='denied'>Refusé</span>";
                }
                ;
                ?>
        </p>
        <?php
        if (isset($reponse)) {
                echo "<label class='label-field' for='commentaire'>Commentaire du manager :</label>
        <textarea name='commentaire' readonly class='placeholder textarea-comment' placeholder='" . $commentaire . "'></textarea>";
                echo "<a class='light-button' href= 'historique_des_demandes.php'>Retourner à la liste de mes demandes</a>";
        } elseif (!isset($reponse)) {
                echo "<div class='title-with-button'>
                <a class='light-button' href= 'historique_des_demandes.php'>Retourner à la liste de mes demandes</a>
                <a class='alt-dark-button' href='modifier-ma-demande.php?id=" . $id_demande . "'>Modifier ma demande</a>
        </div>";
        }
        ;
        ?>

</div>
</div>

<?php
include "includes/footer.php";
?>