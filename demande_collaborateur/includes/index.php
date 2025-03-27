<?php
    require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>PHP et BD</title>
    </head>
    
    <body>
        <h1>Voici mes users :</h1>
		<?php
            $query = $connexion->prepare("SELECT * FROM users");
            $query->execute();
            $users = $query->fetchAll(\PDO::FETCH_ASSOC);
            
            //var_dump($users);
        
            foreach ($users as $row)
            {
                echo " id = " . $row['id_user'] . " nom = " . $row['nom_user'] . " prénom = " . $row['prenom_user'];
                echo "<br/>";
            }
        ?>
    </body>
    
</html>