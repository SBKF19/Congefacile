<?php
include 'includes/verify-connect.php';
include 'includes/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_collabo = intval($_GET['id']); // Convert to integer for safety
} else {
    die("Error: Invalid or missing collaborator ID.");
}

$requete = $connexion->prepare('
        SELECT u.email, u.enabled, u.created_at, u.role, u.person_id, u.id AS user, p.last_name, p.first_name, p.manager_id, p.department_id, p.position_id, p.id AS person, d.name, d.id AS department
        FROM user u, person p, department d
        WHERE u.id = :id_collabo AND u.role = "Collaborateur" AND u.person_id = p.id AND p.department_id = d.id
');
$requete->bindParam(":id_collabo", $id_collabo);
$requete->execute();
$demande = $requete->fetch(\PDO::FETCH_ASSOC);

// Check if $demande contains valid data
if (!$demande) {
    die("Error: Collaborator not found.");
}

$nom = $demande["last_name"];
$prenom = $demande["first_name"];
$email = $demande["email"];
$date = $demande["created_at"];
$service = $demande["name"];
$id_manager = $demande["manager_id"];
$id_position = $demande["position_id"];
$personne = $demande["person_id"];


// Fetch departments
$departments = $connexion->query('SELECT name FROM department')->fetchAll(PDO::FETCH_ASSOC);
if (!$departments) {
    $departments = []; // Default to an empty array if no departments are found
}

// Fetch positions
$positions = $connexion->query('SELECT name FROM position')->fetchAll(PDO::FETCH_ASSOC);
if (!$positions) {
    $positions = []; // Default to an empty array if no positions are found
}

// Fetch manager names
$manager_first_name = $connexion->query('SELECT first_name, last_name FROM person WHERE manager_id IS NULL')->fetchAll(PDO::FETCH_ASSOC);
$manager_last_name = $connexion->query('SELECT last_name FROM person WHERE manager_id IS NULL')->fetchAll(PDO::FETCH_ASSOC);

if (!$manager_first_name || !$manager_last_name) {
    $manager_first_name = [];
    $manager_last_name = [];
}

// Fetch position name
$position = $connexion->prepare('SELECT name FROM position WHERE id = :id_position');
$position->bindParam(':id_position', $id_position);
$position->execute();
$position = $position->fetchAll(PDO::FETCH_ASSOC);

if (!empty($position) && isset($position[0]['name'])) {
    $poste = $position[0]['name'];
} else {
    $poste = ''; // Default value if no position is found
}
// Fetch department ID
$requete = $connexion->prepare('SELECT id FROM department WHERE name = :service');
$requete->bindParam(':service', $service);
$requete->execute();
$serviceID = $requete->fetchAll(PDO::FETCH_ASSOC);

if (!empty($serviceID) && isset($serviceID[0]['id'])) {
    $serviceIDValue = $serviceID[0]['id'];
} else {
    $serviceIDValue = null; // Default value if no department is found
}

// Build manager names
$manager_name = [];
for ($i = 0; $i < count($manager_first_name); $i++) {
    if (isset($manager_first_name[$i]['first_name'], $manager_last_name[$i]['last_name'])) {
        array_push($manager_name, $manager_first_name[$i]['first_name'] . " " . $manager_last_name[$i]['last_name']);
    }
}

// Handle manager display name
$manager_display_name = '';
if (!empty($manager_name) && isset($manager_name[$id_manager - 1])) {
    $manager_display_name = htmlspecialchars($manager_name[$id_manager - 1]);
}

?>
<div class="History">
<h1><?php echo $prenom." ".$nom; ?></h1>
<form action="" method="POST">
<div class="date">
        <input type="checkbox">
        <p><?php echo "Profil actif depuis le ".date("d", strtotime($date)).'/'.date("m", strtotime($date)).'/'.date("Y", strtotime($date)) ?></p>
</div>
<div>
        <label for="email">Adresse email - champ obligatoire</label>
        <input class="email-input" type="email" id="email" name="email" value="<?php echo $email; ?>">
</div>
<div class="date">
        <div>
                <label for="nom_famille">Nom de famille - champ obligatoire</label>
                <input type="text" id="nom_famille" name="nom_famille" value="<?php echo $nom; ?>">
        </div>
        <div>
                <label for="prenom">Prénom - champ obligatoire</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
        </div>
</div>
<div class="date">
        <div>
                <label for="service">Direction/Service - champ obligatoire</label>
                <select name="service" type="service" id="service" class="select-option select-input">
                        <option value="" class="placeholder">Sélectionner un service</option>
                        <?php foreach ($departments as $dep): ?>
                                <option value="<?php echo htmlspecialchars($dep['name']);
                                ?>"
                                <?php
                                if($dep['name'] == $service){
                                        echo htmlspecialchars('selected');
                                };/*bug : reste en selected sur l'option avec l'ID 1, peu importe l'id de la demande*/
                                ?>
                                >
                                        <?php echo htmlspecialchars($dep['name']); ?>
                                </option>
                        <?php endforeach; ?>
                </select>
        </div>
        <div>
                <label for="poste">Poste - champ obligatoire</label>
                <select name="poste" type="poste" id="poste" class="select-option select-input">
                        <option value="" class="placeholder">Sélectionner un poste</option>
                        <?php foreach ($positions as $pos): ?>
                                <option value="<?php echo htmlspecialchars($pos['name']);
                                ?>"
                                <?php
                                if($pos['name'] == $poste){
                                        echo htmlspecialchars('selected');
                                };/*bug : reste en selected sur l'option avec l'ID 1, peu importe l'id de la demande*/
                                ?>
                                >
                                        <?php echo htmlspecialchars($pos['name']); ?>
                                </option>
                        <?php endforeach; ?>
                </select>
        </div>

</div>
<div>
        <label for="manager">Manager - champ obligatoire</label>
        <input name="manager" type="manager" id="manager" class="select-option select-input" value="<?php
                echo htmlspecialchars($manager_name[$id_manager-1]);
                ?>" readonly>
</div>
<div class="date">
        <div>
                <label for="mdp">Nouveau mot de passe</label>
                <input type="password" id="mdp" name="mdp">
        </div>
        <div>
                <label for="mdp-confirm">Confirmation du mot de passe</label>
                <input type="password" id="mdp-confirm" name="mdp-confirm">
        </div>
</div>
<div class="date">
<?php include "includes/modification_de_collaborateur.php"; ?>
</div>
</form>
</div>


</div>
<?php
include "includes/footer.php";
?>