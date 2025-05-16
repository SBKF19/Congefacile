<?php
session_start();
include 'includes/verify-connect.php';
include 'includes/database.php';
?>
<?php

$id_collabo = $_SESSION['utilisateur']['person_id']; // A remplacer par $_SESSION[user id](...) une fois les tests terminés

if ($_SESSION['utilisateur']['role'] == "Collaborateur") {
        $requete = $connexion->prepare('
SELECT u.email, u.role, u.person_id, u.id AS user, p.first_name, p.last_name, p.department_id, p.position_id,
p.manager_id, p.id AS person, d.name, d.id AS department
FROM user u, person p, department d
WHERE u.id = :id_collabo
AND u.person_id = p.id
AND p.department_id = d.id
AND u.role = "Collaborateur"');
        $requete->bindParam(':id_collabo', $id_collabo);
        $requete->execute();

        $informations = $requete->fetch(\PDO::FETCH_ASSOC);
        if ($informations === false) {
                echo '<h1>Les informations n\'ont pas été trouvées.</h1>';
                echo '<a class="dark-button" href="index.php">Retour</a>';
                exit;
        }

        $nom = $informations["last_name"];
        $prenom = $informations["first_name"];
        $email = $informations["email"];
        $service = $informations["name"];
        $id_position = $informations["position_id"];
        $id_manager = $informations["manager_id"];
} elseif ($_SESSION['utilisateur']['role'] == "Manager") {
        $requete = $connexion->prepare('
SELECT u.email, u.role, u.person_id, u.id AS user, p.first_name, p.last_name, p.department_id, p.position_id,
p.id AS person, d.name, d.id AS department
FROM user u, person p, department d
WHERE u.id = :id_collabo
AND u.person_id = p.id
AND p.department_id = d.id
AND u.role = "Manager"');
        $requete->bindParam(':id_collabo', $id_collabo);
        $requete->execute();

        $informations = $requete->fetch(\PDO::FETCH_ASSOC);

        if ($informations === false) {
                echo '<h1>Les informations n\'ont pas été trouvées.</h1>';
                echo '<a class="dark-button" href="index.php">Retour</a>';
                exit;
        }

        $nom = $informations["last_name"];
        $prenom = $informations["first_name"];
        $email = $informations["email"];
        $service = $informations["name"];
        $id_position = $informations["position_id"];
        $id_manager = $informations["person_id"];
}

if ($_SESSION['utilisateur']['role'] == "Collaborateur") {
        $requete = $connexion->prepare('
SELECT pos.name, pos.id AS position, p.id, p.last_name, p.first_name
FROM position pos, person p
WHERE pos.id = :id_position AND p.id = :id_manager');
        $requete->bindParam(':id_position', $id_position);
        $requete->bindParam(':id_manager', $id_manager);
} elseif ($_SESSION['utilisateur']['role'] == "Manager") {
        $requete = $connexion->prepare('
SELECT pos.name, pos.id AS position, p.id, p.last_name, p.first_name
FROM position pos, person p
WHERE pos.id = :id_position AND p.id = :id_manager');
        $requete->bindParam(':id_position', $id_position);
        $requete->bindParam(':id_manager', $id_manager);
}
$requete->execute();
$informations2 = $requete->fetch(\PDO::FETCH_ASSOC);

$poste = $informations2["name"];
$nom_manager = $informations2["last_name"];
$prenom_manager = $informations2["first_name"];

?>

<div class="demande">
        <h1>Mes informations</h1>
        <form action="post">
                <div class="date">
                        <div>
                                <label for="nom" class="label-input">Nom de famille</label>
                                <input type="text" id="nom de famille" name="nom de famille"
                                        class="defaultbox-input defaultbox" value="<?php echo $nom; ?>" readonly>
                        </div>

                        <div>
                                <label for="prenom" class="label-input">Prénom</label>
                                <input type="text" id="prénom" name="prénom" class=" defaultbox-input defaultbox"
                                        value="<?php echo $prenom; ?>" readonly>
                        </div>
                </div>
                <br>
                <div>
                        <label for="mail" class="label-input">Adresse email</label>
                        <input type="text" id="email" name="email" class=" defaultbox-input defaultbox"
                                value="<?php echo $email; ?>" readonly>
                </div>
                <br>
                <div class="date">
                        <div>
                                <label for="direction" class="label-input">Direction/Service</label>
                                <input type="text" id="service" name="service" class="defaultbox-input defaultbox"
                                        value="<?php echo $service; ?>" readonly>
                                </select>
                        </div>
                        <br>

                        <div>
                                <label for="poste" class="label-input">Poste</label>
                                <input type="text" id="poste" name="poste" class="defaultbox-input defaultbox"
                                        value="<?php echo $poste; ?>" readonly>
                                </select>
                        </div>
                </div>
                <br>
                <div>
                        <label for="Manager" class="label-input">Manager</label>
                        <input type="text" id="nom_manager" name="nom_manager" class="defaultbox-input defaultbox"
                                value="<?php echo $prenom_manager . " " . $nom_manager; ?>" readonly>
                        </select>
                </div>
        </form>
        <br>
        <?php include('mdp_oublie_colla.php') ?>
</div>


<?php
include "includes/footer.php";
?>