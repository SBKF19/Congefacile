<?php
        include "includes/collab-menu.php";
        include "includes/database.php";


$erreurs['date'] = '';
$erreurs['justificatif'] = '';
$id_demande = $_GET["id"];
$type_demande = '';
$debut = '';
$fin = '';
$duree = 0;
$infos_sup = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'] ?? '';
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $justificatif = $_FILES['justificatif'] ?? '';
    $commentaire = $_POST['commentaire'] ?? '';

    //Vérifie que la date de début n'est pas postérieure à la date de fin
    if (strtotime($date_debut) > strtotime($date_fin)) {
        $erreurs['date'] = "<j class='erreur'>*la date de début ne peut pas être postérieure à la date de fin.</j>";
    } else {
        $erreurs['date'] = '';
        if (strlen($date_debut) >= 4 && strlen($date_fin) >= 4) {
            $annee_debut = substr($date_debut, 0, 4);
            $annee_fin = substr($date_fin, 0, 4);
        } else {
            $annee_debut = '';
            $annee_fin = '';
        }
        $jours_demandes = (strtotime($date_fin) - strtotime($date_debut)) / (60 * 60 * 24) + 1;

        $requete = $connexion->prepare('SELECT id FROM request_type where name = :type');
        $requete->bindParam(':type', $type);
        $requete->execute();

        $typeID = $requete->fetchAll(PDO::FETCH_ASSOC);

        $date_actuelle = date('Y-m-d H:i:s');
        $requeteInsertion = $connexion->prepare('
        UPDATE request SET request_type_id = :typeID, created_at = :date_actuelle, start_at = :date_debut, end_at = :date_fin, receipt_file = :justificatif, comment = :commentaire WHERE id = :id_demande;
        '
        );


        $requeteInsertion->bindParam(':typeID', $typeID[0]['id']);
        $requeteInsertion->bindParam(':date_actuelle', $date_actuelle);
        $requeteInsertion->bindParam(':date_debut', $date_debut);
        $requeteInsertion->bindParam(':date_fin', $date_fin);
        $requeteInsertion->bindParam(':justificatif', $_FILES['justificatif']);
        $requeteInsertion->bindParam(':commentaire', $commentaire);
        $requeteInsertion->bindParam(':id_demande', $id_demande);

        try {
                $requeteInsertion->execute();
                header('Location: afficher-ma-demande.php?id_demande=' . $id_demande);
                exit;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

    }
}

        $id_demande = $_GET["id"];
        $requete = $connexion->prepare('
		SELECT d.request_type_id, d.start_at, DATEDIFF(start_at, end_at) as DateDiff, d.end_at, d.comment, d.id AS request, t.name AS request_type
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
        $debut = $demande["start_at"];
        $fin = $demande["end_at"];
        $duree = $demande["DateDiff"];
        $infos_sup = $demande["comment"];
        $types = $connexion->query('SELECT name FROM request_type')->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="History">
    <h1>Modifier ma demande</h1>
    <form action="" method="POST" class="form-request">
        <div>
            <label for="type" class="label-field">Type de demande - champ obligatoire</label>
            <br>
            <select name="type" type="type" id="type" class="select-option select-input">
                <option value="" class="placeholder">Sélectionner un type</option>
                <?php foreach ($types as $typ): ?>
                    <option value="<?php echo htmlspecialchars($typ['name']);
                    ?>"
                    <?php
                    if($typ['name'] == $type_demande){
                        echo htmlspecialchars('selected');
                    };/*bug : reste en selected sur l'option avec l'ID 1, peu importe l'id de la demande*/
                    ?>
                    >
                        <?php echo htmlspecialchars($typ['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <br>
            <?php echo $erreurs['date']; ?>
        </div>
        <div class="date">
            <div>
                <label for="date_debut" class="label-field">Date début - champ obligatoire</label>
                <br>
                <input type="date" id="date_debut" name="date_debut" class="label-select date-input"
                value="<?php
                echo date("Y", strtotime($debut)).'-'.date("m", strtotime($debut)).'-'.date("d", strtotime($debut));
                ?>">
            </div>
            <div>
                <div>
                    <label for="date_fin" class="label-field">Date de fin - champ obligatoire</label>
                    <br>
                    <input type="date" id="date_fin" name="date_fin" class="label-select date-input"
                    value="<?php
                        echo date("Y", strtotime($fin)).'-'.date("m", strtotime($fin)).'-'.date("d", strtotime($fin));
                        ?>">

                    <?php echo $erreurs['justificatif']; ?>
                </div>
                <br>
            </div>
        </div>
        <div>
            <label for="nbjour" class="label-fixed-value">Nombre de jours demandés</label>
            <br>
            <input type="number" id="nbjour" name="nbjour" accept=".pdf" class="defaultbox defaultbox-input fixed-value"
            value="<?php
            if ($duree < 0) {
                $duree *= -1;
                echo $duree;
            } else {
                echo $duree;
            }
            ?>">
        </div>
        <br>
        <div>
            <label for="justificatif" class="label-field">Justificatif si applicable</label>
            <br>
            <input type="file" id="justificatif" name="justificatif" accept=".pdf" class="label-select file-input">
        </div>
        <br>
        <div>
            <label for="commentaire" class="label-field">Commentaire supplémentaire</label>
            <br>
            <textarea name="commentaire" class="placeholder"
                placeholder="Si conge exceptionnel ou sans solde, vous pouvez préciser votre demande."><?php
                echo $infos_sup;
                ?></textarea>
            <br>
        </div>
        <input type="submit" class="dark-button" value="Modifier ma demande*">
    </form>
    <p>
        *En cas d'erreur de saisie ou de changements, vous pourrez modifier votre demande tant que celle-ci n'a pas été
        validée par le manager.
    </p>
</div>


<?php

        include "includes/footer.php";
?>