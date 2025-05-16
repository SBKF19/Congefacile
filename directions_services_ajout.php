<?php
ob_start(); //Empêche d'avoir une erreur de header
include 'includes/verify-connect.php';
include 'includes/database.php';

if (isset($_GET['id'])) { //Vérifie si la redirection vers la page contient un ID
        $id_service = $_GET['id']; //Récupère l'ID du service dans l'URL
        $query = $connexion->prepare('
        SELECT name, id
        FROM department
        WHERE id = :id');
        $query->bindParam(':id', $id_service);
        $query->execute();
        $services = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nom_service = $services[0]['name']; //Récupère le nom du service

        $query = $connexion->prepare('
        SELECT COUNT(*) as count
        FROM person
        WHERE department_id = :id'); //Compte le nombre de personnes associées à ce service
        $query->bindParam(':id', $id_service);
        $query->execute();
        $nb_services = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nb_services = $nb_services[0]['count']; //Récupère le nombre de personnes associées
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Traitement des données du formulaire
        if (isset($_POST['supprimer'])) {
                if ($nb_services > 0) { //Vérifie si le nombre de personnes associées est supérieur à 0
                        $error_message = "Impossible de supprimer cette direction/service car il/elle est associé(e) à $nb_services personne(s).";
                } else {
                        $requete = $connexion->prepare('DELETE FROM department WHERE id = :id'); //Supprime le service
                        $requete->bindParam(':id', $id_service);
                        $requete->execute();
                        header('Location: directions_services.php');
                        exit();
                }
        } elseif (isset($_POST['modifier'])) {
                if (!empty($_POST['name'])){ //Vérifie si le champ du nom du service est rempli
                        $nom_service = $_POST['name'];
                        $requete = $connexion->prepare('UPDATE department SET name = :name WHERE id = :id'); //Met à jour le service
                        $requete->bindParam(':name', $nom_service);
                        $requete->bindParam(':id', $id_service);
                        $requete->execute();
                        header('Location: directions_services.php');
                        exit();
                } else {
                        $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        } elseif (isset($_POST['ajouter'])) {
                if (!empty($_POST['name'])){ //Vérifie si le champ du nom du service est rempli
                        $nom_service = $_POST['name'];
                        $requete = $connexion->prepare('INSERT INTO department (name) VALUES (:name)'); //Ajoute le service
                        $requete->bindParam(':name', $nom_service);
                        $requete->execute();
                        header('Location: directions_services.php');
                        exit();
                } else {
                        $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        }
}

?>
<div class="History">
        <h1>
        <?php if (isset($_GET['id'])) {
                        echo $nom_service; //Affiche le nom du service si redirection depuis "détails"
                } else {
                        echo "Ajouter une direction/service"; //Affiche "Ajouter une direction/service" si redirection depuis "ajout"
                } ?>
        </h1>
        <br>
        <form method="POST" action="">
                <label for="name" class="label-field">
                        Nom du service
                </label>
                <input type="text" id="name" name="name" class="label-input defaultbox-input" value="<?php
                if (isset($_GET['id'])) {
                        echo $nom_service; //Affiche le nom du service si redirection depuis "détails"
                } else {
                        echo ""; //Affiche un champ vide si redirection depuis "ajout"
                } ?>" class="large-filter filter" required>
                <div class="date">
                        <?php if (isset($_GET['id'])) {
                                echo '<div>
                <input type="submit" id="supprimer" name="supprimer" class="deny" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette direction/service ?\');"/>
                </div>
                <div>
                <input type="submit" id="modifier" name="modifier" class="alt-dark-button" value="Mettre à jour"/>
                </div>'; //Affiche le bouton "Mettre à jour" et "Supprimer" si redirection depuis "détails"
                        } else {
                                echo '<div>
                <input type="submit" id="ajouter" name="ajouter" class="alt-dark-button" value="Ajouter la direction/service"/>
                </div>'; //Affiche le bouton "Ajouter la direction/service" si redirection depuis "ajout"
                        }?>
                </div>
                <?php if (!empty($error_message)): ?>
                        <p style="color: red;"><?php echo htmlspecialchars($error_message); // Affiche le message d'erreur de champs vides
                        ?></p>
                <?php endif; ?>
        </form>


</div>
</div>
<?php
include "includes/footer.php";
ob_end_flush(); //Empêche d'avoir une erreur de header
?>