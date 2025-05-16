<?php
ob_start();
include 'includes/verify-connect.php';
include 'includes/database.php';


        if (isset($_GET['id'])){
                $id_type = $_GET['id'];
                $query = $connexion->prepare('
                SELECT name, id
                FROM request_type
                WHERE id = :id');
                $query->bindParam(':id', $id_type);
                $query->execute();
                $types = $query->fetchAll(\PDO::FETCH_ASSOC);
                $nom_type = $types[0]['name'];

                $query = $connexion->prepare('
                SELECT COUNT(*) as count
                FROM request
                WHERE request_type_id = :id');
                $query->bindParam(':id', $id_type);
                $query->execute();
                $nb_types = $query->fetchAll(\PDO::FETCH_ASSOC);
                $nb_types = $nb_types[0]['count'];
        }



if (isset($_POST['supprimer'])) {
    if ($nb_types > 0) {
        $error_message = "Impossible de supprimer ce type de demande car il est associé à $nb_types demande(s).";
    } else {
        $requete = $connexion->prepare('DELETE FROM request_type WHERE id = :id');
        $requete->bindParam(':id', $id_type);
        $requete->execute();
        header('Location: types_de_demandes.php');
        exit();
    }
}
if (isset($_POST['modifier'])) {
    $nom_type = $_POST['name'];
    $requete = $connexion->prepare('UPDATE request_type SET name = :name WHERE id = :id');
    $requete->bindParam(':name', $nom_type);
    $requete->bindParam(':id', $id_type);
    $requete->execute();
    header('Location: types_de_demandes.php');
    exit();
}

if (isset($_POST['ajouter'])) {
    $nom_type = $_POST['name'];
    $requete = $connexion->prepare('INSERT INTO request_type (name) VALUES (:name)');
    $requete->bindParam(':name', $nom_type);
    $requete->execute();
    header('Location: types_de_demandes.php');
    exit();
}

?>
<div class="History">
        <h1>Types de demandes</h1>
                <br>
        <form method="POST" action="">
        <label for="name" class="label-field">
                Nom du type
        </label>
        <input type="text" id="name" name="name" class="label-input defaultbox-input" value="<?php if(isset($_GET['id'])){
                        echo $nom_type;
                } else {
                        echo "";
                } ?>" class="large-filter filter" required>
        <div class="date">
                <?php if (isset($_GET['id'])){
                        echo '<div>
                <input type="submit" id="supprimer" name="supprimer" class="deny" value="Supprimer" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce type de demande ?\');"/>
                </div>
                <div>
                <input type="submit" id="modifier" name="modifier" class="alt-dark-button" value="Mettre à jour"/>
                </div>';
                } else{
                        echo '<div>
                <input type="submit" id="ajouter" name="ajouter" class="alt-dark-button" value="Ajouter le type de demande"/>
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