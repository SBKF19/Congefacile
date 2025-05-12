<?php
include "database.php";
$id_collaborateur = 1;
if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Fetch the correct position ID
    $requetePosition = $connexion->prepare('SELECT id FROM position WHERE name = :name');
    $requetePosition->bindParam(':name', $poste);
    $requetePosition->execute();
    $position = $requetePosition->fetch(PDO::FETCH_ASSOC);

    if ($position) {
        $poste = $position['id']; // Replace the name with the corresponding ID
    } else {
        die("Error: Invalid position name.");
    }

        $requeteInsertion = $connexion->prepare('UPDATE user u, person p SET u.email = :email, p.last_name = :nom_famille, p.first_name = :prenom, p.department_id = :serviceID, p.position_id = :poste  WHERE u.id = :id_collaborateur AND u.role = "Collaborateur" AND p.id = u.person_id');
        $requeteInsertion->bindParam(':email', $email);
        $requeteInsertion->bindParam(':nom_famille', $nom_famille);
        $requeteInsertion->bindParam(':prenom', $prenom);
        $requeteInsertion->bindParam(':serviceID', $serviceID[0]['id']);
        $requeteInsertion->bindParam(':poste', $poste);
        $requeteInsertion->bindParam(':id_collaborateur', $id_collaborateur);
        try{
                $requeteInsertion->execute();
        }
                catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
        }

}
?>
<input type="submit" value="Modifier" class="dark-button">