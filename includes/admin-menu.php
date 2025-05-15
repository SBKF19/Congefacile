<?php
include "header.php";
include 'database.php';
$requete = $connexion->prepare('SELECT COUNT(collaborator_id) AS demande_en_attente FROM request JOIN user
ON collaborator_id = user.person_id JOIN person ON user.person_id = person.id WHERE request.answer IS NULL AND person.manager_id = :id');

$requete->bindParam(':id', $_SESSION['utilisateur']['person_id']);
$requete->execute();
$demande_en_attente = $requete->fetch(PDO::FETCH_ASSOC);

?>

<div class="cont2">
        <div class="side-menu">
                <div class="side-menu-pages">
                        <div class="onglet">
                                <a href="accueil.php">Accueil</a>
                        </div>
                        <div class="onglet">
                                <a href="demandes_en_attente.php">Demandes en attente</a>
                                <div class="side-menu-counter">
                                        <p><?php echo $demande_en_attente['demande_en_attente'] ?></p>
                                </div>
                        </div>
                        <div class="onglet">
                                <a href="historique_des_demandes.php">Historique des demandes</a>
                        </div>
                        <div class="onglet">
                                <a href="mon_equipe.php">Mon équipe</a>
                        </div>
                        <div class="onglet">
                                <a>Statistiques</a>
                        </div>
                        <div class="menu-lign"></div>
                        <div class="onglet">
                                <a href="mes_informations.php">Mes informations</a>
                        </div>
                        <div class="onglet">
                                <a>Mes préférences</a>
                        </div>
                        <div class="onglet toggle-button">
                                <a>Administration</a>
                                <div><img src="images/chevron-en-bas.png" /></div>
                        </div>
                        <div class="hidden-menu">
                                <div>
                                        <a href="types_de_demandes.php">Types de demandes</a>
                                </div>
                                <div>
                                        <a>Directions/Services</a>
                                </div>
                                <div>
                                        <a>Managers</a>
                                </div>
                                <div>
                                        <a href="postes.php">Postes</a>
                                </div>
                        </div>
                        <div class="onglet">
                                <a href="includes/deco.php">Déconnexion</a>
                        </div>
                </div>

                <div class="side-menu-profile">
                        <div class="side-menu-profile-image">
                                <img src="images/man.png" />
                        </div>
                        <div class="side-menu-profile-text">
                                <?php include 'name_and_role.php'; ?>
                        </div>
                </div>
        </div>
        <script src="includes/menu-lateral.js"></script>