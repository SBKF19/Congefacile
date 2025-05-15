<?php
ob_start();
        include "includes/admin-menu.php";
        include "includes/database.php";


        if (isset($_GET['id'])){
                $id_poste = $_GET['id'];
                $query = $connexion->prepare('
                SELECT name, id
                FROM department
                WHERE id = :id');
                $query->bindParam(':id', $id_poste);
                $query->execute();
                $postes = $query->fetchAll(\PDO::FETCH_ASSOC);
                $nom_poste = $postes[0]['name'];

                $query = $connexion->prepare('
                SELECT COUNT(*) as count
                FROM person
                WHERE department_id = :id');
                $query->bindParam(':id', $id_poste);
                $query->execute();
                $nb_postes = $query->fetchAll(\PDO::FETCH_ASSOC);
                $nb_postes = $nb_postes[0]['count'];
        }



if (isset($_POST['supprimer'])) {
    if ($nb_postes > 0) {
        $error_message = "Impossible de supprimer ce poste car il est associé à $nb_postes personne(s).";
    } else {
        $requete = $connexion->prepare('DELETE FROM department WHERE id = :id');
        $requete->bindParam(':id', $id_poste);
        $requete->execute();
        header('Location: directions_services.php');
        exit();
    }
}
if (isset($_POST['modifier'])) {
    $nom_poste = $_POST['name'];
    $requete = $connexion->prepare('UPDATE department SET name = :name WHERE id = :id');
    $requete->bindParam(':name', $nom_poste);
    $requete->bindParam(':id', $id_poste);
    $requete->execute();
    header('Location: directions_services.php');
    exit();
}

if (isset($_POST['ajouter'])) {
    $nom_poste = $_POST['name'];
    $requete = $connexion->prepare('INSERT INTO department (name) VALUES (:name)');
    $requete->bindParam(':name', $nom_poste);
    $requete->execute();
    header('Location: directions_services.php');
    exit();
}

?>
<div class="History">
        <h1><?php if(isset($_GET['id'])){
                        echo $nom_poste;
                } else {
                        echo "Ajouter une direction/service";
                } ?></h1>
                <br>
        <form method="POST" action="">
        <label for="name" class="label-field">
                Nom du service
        </label>
        <input type="text" id="name" name="name" class="label-input defaultbox-input" value="<?php if(isset($_GET['id'])){
                        echo $nom_poste;
                } else {
                        echo "";
                } ?>" class="large-filter filter" required>
        <div class="date">
                <?php if (isset($_GET['id'])){
                        echo '<div>
                <input type="submit" id="supprimer" name="supprimer" class="deny" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette direction/service ?\');"/>
                </div>
                <div>
                <input type="submit" id="modifier" name="modifier" class="alt-dark-button" value="Mettre à jour"/>
                </div>';
                } else{
                        echo '<div>
                <input type="submit" id="ajouter" name="ajouter" class="alt-dark-button" value="Ajouter la direction/service"/>
                </div>';
                }

                ?>
        </div>
        <?php if (!empty($error_message)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>
        </form>


</div>
</div>
<?php
include "includes/footer.php";
ob_end_flush();
?>