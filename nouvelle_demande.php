<?php
include 'includes/verify-connect.php';
include 'includes/database.php';

$requete = $connexion->prepare('SELECT name FROM request_type');
$requete->execute();
$types = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
$erreurs['date'] = '';
$erreurs['justificatif'] = '';
$erreurs['empty'] = '';
$aller = '';

// Vérifie si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupère les données du formulaire
    $type = $_POST['type'] ?? '';
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $justificatif = $_FILES['justificatif'] ?? '';
    $commentaire = $_POST['commentaire'] ?? '';

    // Vérifie si touts les champs obligatoires sont remplis
    if (($type == '') || ($date_debut == '') || ($date_fin == '')) {
        if (($type != '') && (($date_debut == '') || ($date_fin == ''))) {
            $erreurs['date'] = "Veuillez sélectionner une date de début et de fin";
        } else {
            $erreurs['date'] = "";

            $erreurs['justificatif'] = "";
            $erreurs['empty'] = "*Veuillez remplir tous les champs obligatoires.";
            $aller = 'nouvelle_demande.php';
        }
    } else {
        //Vérifie que la date de début n'est pas postérieure à la date de fin
        if (strtotime($date_debut) > strtotime($date_fin)) {
            $erreurs['date'] = "*la date de début ne peut pas être postérieure à la date de fin.";
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

            // On récupère la date actuelle
            $date_actuelle = date('Y-m-d H:i:s');

            $requeteInsertion = $connexion->prepare('
            INSERT INTO request (request_type_id, collaborator_id, created_at, start_at, end_at, receipt_file, comment) VALUES (
            :typeID,
            :collaborator_id,
            :date_actuelle,
            :date_debut,
            :date_fin,
            :justificatif,
            :commentaire
        )'
            );

            $requeteInsertion->bindParam('typeID', $typeID[0]['id']);
            $requeteInsertion->bindParam('collaborator_id', $_SESSION['utilisateur']['person_id']);
            $requeteInsertion->bindParam('date_actuelle', $date_actuelle);
            $requeteInsertion->bindParam('date_debut', $date_debut);
            $requeteInsertion->bindParam('date_fin', $date_fin);
            $requeteInsertion->bindParam('justificatif', $_FILES['justificatif']);
            $requeteInsertion->bindParam('commentaire', $commentaire);

            // Si tous les champs sont remplis, on exécute la requête d'insertion et la requête d'alerte
            $aller = '';
            $erreurs['empty'] = '';
            $requeteInsertion->execute();
            header('Location: historique_des_demandes.php');
        }
    }
}
?>


<div class="History">
    <h1>Effectuer une nouvelle demande</h1>
    <form action="<?php echo $aller ?>" method="POST" class="form-request">
        <div>

            <j class='erreur'><?php echo $erreurs['empty']; ?></j>
            <label for="type" class="label-field">Type de demande-champ obligatoire</label>
            <br>
            <select name="type" id="type" class="select-option select-input">
                <option value="" class="placeholder">Selectionner un type</option>
                <?php foreach ($types as $typ): ?>
                    <option value="<?php echo htmlspecialchars($typ['name']); ?>" <?php echo (isset($_POST['type']) && $_POST['type'] === $typ['name']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($typ['name']); ?>
                    </option>
                <?php endforeach; ?>

            </select>
            <br>
            <br>

            <j class='erreur'><?php echo $erreurs['date']; ?></j>

        </div>
        <div class="date">
            <div>
                <label for="date_debut" class="label-field">Date début-champ obligatoire</label>
                <br>
                <input type="date" id="date_debut" name="date_debut" class="label-select date-input"
                    value="<?php echo htmlspecialchars($date_debut ?? ''); ?>">
            </div>
            <div>
                <div>
                    <label for="date_fin" class="label-field">Date de fin-champ obligatoire</label>
                    <br>
                    <input type="date" id="date_fin" name="date_fin" class="label-select date-input"
                        value="<?php echo htmlspecialchars($date_fin ?? ''); ?>">

                    <j class='erreur'><?php echo $erreurs['justificatif']; ?></j>

                </div>
                <br>
            </div>
        </div>
        <div>
            <label for="nbjour" class="label-fixed-value">Nombre de jours demandés</label>
            <br>
            <input type="text" id="nbjours" readonly class="defaultbox defaultbox-input fixed-value">
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
                placeholder="Si conge exceptionnel ou sans solde, vous pouvez préciser votre demande."><?php echo htmlspecialchars($commentaire ?? ''); ?></textarea>
            <br>
        </div>
        <button type="submit" class="dark-button">Soumettre ma demande*</button>
    </form>
    <p>
        *En cas d'erreur de saisie ou de changement, vous pourrez modifier votre demande tant que celle ci n'a pas été
        validée par le manager
    </p>
</div>
<?php
include 'includes/footer.php'
    ?>