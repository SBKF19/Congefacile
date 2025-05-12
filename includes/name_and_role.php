<?php $requete = $connexion->prepare('SELECT FIRST_NAME, LAST_NAME, user.role FROM person 
                                JOIN user ON person.id = user.person_id WHERE person.id = :id');
$requete->bindParam(':id', $_SESSION['utilisateur']['person_id']);
$requete->execute();
$name_person[] = $requete->fetch(PDO::FETCH_ASSOC); ?>
<p class="username">
    <?php echo $name_person[0]['FIRST_NAME'] . ' ' . $name_person[0]['LAST_NAME'] ?>
</p>
<p class="job"><?php echo $name_person[0]['role'] ?></p>