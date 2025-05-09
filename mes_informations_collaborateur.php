<?php
        include "includes/database.php";
        include "includes/collab-menu.php";
?>
<?php
$id_collabo = 1; // A remplacer par $_SESSION[user id](...) une fois les tests terminés

$requete = $connexion->prepare('
SELECT u.email, u.role, u.person_id, u.id AS user, p.first_name, p.last_name, p.department_id, p.position_id, p.manager_id, p.id AS person, d.name, d.id AS department FROM user u, person p, department d WHERE u.id = :id_collabo AND u.person_id = p.id AND p.department_id = d.id AND u.role = "Collaborateur"');
$requete->bindParam(':id_collabo', $id_collabo);
$requete->execute();

$informations = $requete->fetch(\PDO::FETCH_ASSOC);
if ($informations === false) {
        echo '<h1>Les informations n\'ont pas été trouvées.</h1>';
        echo '<button class="dark-button"><a href="index.php">Retour</a></button>';
        exit;
}



$nom = $informations["last_name"];
$prenom = $informations["first_name"];
$email = $informations["email"];
$service = $informations["name"];
$id_position = $informations["position_id"];
$id_manager = $informations["manager_id"];

$requete = $connexion->prepare('
SELECT pos.name, pos.id AS position, p.id, p.last_name, p.first_name FROM position pos, person p WHERE pos.id = :id_position AND p.id = :id_manager');
$requete->bindParam(':id_position', $id_position);
$requete->bindParam(':id_manager', $id_manager);
$requete->execute();
$informations2 = $requete->fetch(\PDO::FETCH_ASSOC);

$poste = $informations2["name"];
$nom_manager = $informations2["last_name"];
$prenom_manager = $informations2["first_name"];

?>
<div class="History">
<label for="nom de famille">Nom de famille</label>
<input type="text" id="nom de famille" name="nom de famille" value="<?php echo $nom; ?>" readonly>
<label for="prénom">Prénom</label>
<input type="text" id="prénom" name="prénom" value="<?php echo $prenom; ?>" readonly>
<label for="email">Adresse email</label>
<input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>
<label for="service">Direction/Service</label>
<input type="text" id="service" name="service" value="<?php echo $service; ?>" readonly>
<label for="poste">Poste</label>
<input type="text" id="poste" name="poste" value="<?php echo $poste; ?>" readonly>
<label for="nom_manager">Manager</label>
<input type="text" id="nom_manager" name="nom_manager" value="<?php echo $prenom_manager." ".$nom_manager; ?>" readonly>



</div>












</div>
<?php
        include "includes/footer.php";
?>