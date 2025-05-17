<?php
ob_start(); //Empêche d'avoir une erreur de header
include 'includes/verify-connect.php';
include 'includes/database.php';

if (isset($_GET['id'])){ //Vérifie si la redirection vers la page contient un ID
        $id_poste = $_GET['id']; //Récupère l'ID du poste dans l'URL
        $query = $connexion->prepare('
        SELECT name, id
        FROM position
        WHERE id = :id');
        $query->bindParam(':id', $id_poste);
        $query->execute();
        $postes = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nom_poste = $postes[0]['name']; //Récupère le nom du poste

        $query = $connexion->prepare('
        SELECT COUNT(*) as count
        FROM person
        WHERE position_id = :id'); //Compte le nombre de personnes associées à ce poste
        $query->bindParam(':id', $id_poste);
        $query->execute();
        $nb_postes = $query->fetchAll(\PDO::FETCH_ASSOC);
        $nb_postes = $nb_postes[0]['count']; //Récupère le nombre de personnes associées
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Traitement des données du formulaire
        if (isset($_POST['supprimer'])) {
                if ($nb_postes > 0) {//Vérifie si le nombre de personnes associées est supérieur à 0
                        $error_message = "Impossible de supprimer ce poste car il est associé à $nb_postes personne(s)."; //Message d'erreur si le poste est associé à des personnes
                } else {
                        $requete = $connexion->prepare('DELETE FROM position WHERE id = :id'); //Supprime le poste
                        $requete->bindParam(':id', $id_poste);
                        $requete->execute();
                        header('Location: postes.php');
                        exit();
                }
        }
        elseif (isset($_POST['modifier'])){
                if (!empty($_POST['name'])){ //Vérifie si le champ du nom du poste est rempli
                        $nom_poste = $_POST['name'];
                        $requete = $connexion->prepare('UPDATE position SET name = :name WHERE id = :id'); //Met à jour le poste
                        $requete->bindParam(':name', $nom_poste);
                        $requete->bindParam(':id', $id_poste);
                        $requete->execute();
                        header('Location: postes.php');
                        exit();
                } else {
                $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        } elseif (isset($_POST['ajouter'])) {
                if(!empty($_POST['name'])){ //Vérifie si le champ du nom du poste est rempli
                        $nom_poste = $_POST['name'];
                        $requete = $connexion->prepare('INSERT INTO position (name) VALUES (:name)'); //Ajoute le poste
                        $requete->bindParam(':name', $nom_poste);
                        $requete->execute();
                        header('Location: postes.php');
                        exit();
                } else {
                $error_message = "Veuillez remplir le champ du nom du poste."; //Message d'erreur si le champ est vide
                }
        }
}

?>
<div class="History">
        <h1>
                <?php if(isset($_GET['id'])){
                        echo $nom_poste; //Affiche le nom du poste si redirection depuis "détails"
                } else {
                        echo "Ajouter un poste"; //Affiche "Ajouter un poste" si redirection depuis "ajouter un poste"
                } ?>
        </h1>
        <br>
        <form method="POST" action="">
                <label for="name" class="label-field">
                        Nom du poste
                </label>
        <input type="text" id="name" name="name" class="label-input defaultbox-input" value="<?php
        if(isset($_GET['id'])){
                echo $nom_poste; //Input pré-rempli avec le nom du poste si redirection depuis "détails"
        } else {
                echo ""; //Input vide si redirection depuis "ajouter un poste"
        }
        ?>" class="large-filter filter" required>
        <div class="date">
                <?php if (isset($_GET['id'])){
                        echo '<div>
                <input type="submit" id="supprimer" name="supprimer" class="deny" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce poste ?\');"/>
                </div>
                <div>
                <input type="submit" id="modifier" name="modifier" class="alt-dark-button" value="Mettre à jour"/>
                </div>'; //Boutons "Supprimer" et "Mettre à jour" si redirection depuis "détails"
                } else{
                        echo '<div>
                <input type="submit" id="ajouter" name="ajouter" class="alt-dark-button" value="Ajouter le poste"/>
                </div>'; //Bouton "Ajouter le poste" si redirection depuis "ajouter un poste"
                }

                ?>
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