<?php
ob_start(); //Empêche d'avoir une erreur de header
include 'includes/verify-connect.php';
include 'includes/database.php';

if (isset($_GET['id'])){ //Vérifie si la redirection vers la page contient un ID
        $id_type = $_GET['id']; //Récupère l'ID du type de demande dans l'URL
        $query = $connexion->prepare('
        SELECT name, id
        FROM request_type
        WHERE id = :id');
        $query->bindParam(':id', $id_type);
        $query->execute();
        $types = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nom_type = $types[0]['name']; //Récupère le nom du type de demande

        $query = $connexion->prepare('
        SELECT COUNT(*) as count
        FROM request
        WHERE request_type_id = :id');
        $query->bindParam(':id', $id_type);
        $query->execute();
        $nb_types = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nb_types = $nb_types[0]['count']; //Récupère le nombre de demandes associées
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Traitement des données du formulaire
        if (isset($_POST['supprimer'])) {
                if ($nb_types > 0) { //Vérifie si le nombre de demandes associées est supérieur à 0
                        $error_message = "Impossible de supprimer ce type de demande car il est associé à $nb_types demande(s)."; //Message d'erreur si le type de demande est associé à des demandes
                } else {
                        $requete = $connexion->prepare('DELETE FROM request_type WHERE id = :id'); //Supprime le type de demande
                        $requete->bindParam(':id', $id_type);
                        $requete->execute();
                        header('Location: types_de_demandes.php');
                        exit();
                }
        } elseif (isset($_POST['modifier'])) {
                if (!empty($_POST['name'])){ //Vérifie si le champ du nom du type de demande est rempli
                        $nom_type = $_POST['name'];
                        $requete = $connexion->prepare('UPDATE request_type SET name = :name WHERE id = :id'); //Met à jour le type de demande
                        $requete->bindParam(':name', $nom_type);
                        $requete->bindParam(':id', $id_type);
                        $requete->execute();
                        header('Location: types_de_demandes.php');
                        exit();
                } else {
                        $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        } elseif (isset($_POST['ajouter'])) { //Vérifie si le champ du nom du type de demande est rempli
                if (!empty($_POST['name'])){
                        $nom_type = $_POST['name'];
                        $requete = $connexion->prepare('INSERT INTO request_type (name) VALUES (:name)'); //Ajoute le type de demande
                        $requete->bindParam(':name', $nom_type);
                        $requete->execute();
                        header('Location: types_de_demandes.php');
                        exit();
                } else {
                $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        }
}

?>
<div class="History">
        <h1>Types de demandes</h1>
        <br>
        <form method="POST" action="">
        <label for="name" class="label-field">
                Nom du type
        </label>
        <input type="text" id="name" name="name" class="label-input defaultbox-input" value="<?php
        if(isset($_GET['id'])){
                echo $nom_type; //Affiche le nom du type de demande si redirection depuis "détails"
        } else {
                echo ""; //Affiche un champ vide si redirection depuis "ajout"
        } ?>"
        class="large-filter filter" required>
        <div class="date">
                <?php if (isset($_GET['id'])){
                        echo '<div>
                <input type="submit" id="supprimer" name="supprimer" class="deny" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce type de demande ?\');"/>
                </div>
                <div>
                <input type="submit" id="modifier" name="modifier" class="alt-dark-button" value="Mettre à jour"/>
                </div>'; //Affiche le bouton "supprimer" et "modifier" si redirection depuis "détails"
                } else{
                        echo '<div>
                <input type="submit" id="ajouter" name="ajouter" class="alt-dark-button" value="Ajouter le type de demande"/>
                </div>'; //Affiche le bouton "ajouter" si redirection depuis "ajout"
                }

                ?>
        </div>
        <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p> <!-- Affiche le message d'erreur si les champs sont vides -->
        <?php endif; ?>
        </form>
</div>
</div>
<?php
include "includes/footer.php";
ob_end_flush(); //Empêche d'avoir une erreur de header
?>