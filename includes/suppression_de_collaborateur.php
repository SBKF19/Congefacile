<?php

include "database.php";
$id_collaborateur = 1;

if($_SERVER["REQUEST_METHOD"] == "POST"){




        $requete = $connexion->prepare('DELETE FROM user WHERE id=:id_collaborateur AND role = "Collaborateur"');
        $requete->bindParam(':id_collaborateur', $id_collaborateur);
        $requete->execute();
}

?>
<input type="submit" value="supprimer" class="deny">