<?php
        include "includes/admin-menu.php";
        include "includes/database.php";


$query = $connexion->prepare('
    SELECT name, id
    FROM department
');

$query->execute();

$postes1 = $query->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="History">
        <div class="title-with-dark-button">
        <h1>Directions/Services</h1>
        <a class="large-dark-button" href="directions_services_ajout.php">Ajouter une direction/service</a>
        </div>
        <div class="containerFilter">
                <div class="side-menu-profile filterBar">
                        <div class="filterMargin">
                                <label class="label-select">Nom de la direction ou du service</label>
                                <input class="larger-filter filter" type="text">
                        </div>
                </div>
                <div class="list_conge">
                        <div class="congeType">
                            <?php
                                for ($i = 0; $i < Count($postes1); $i++){
                                    if( $i === Count($postes1)-1){ ?>
                                    <div class="filter-info-larger">
                                        <p class="break-details"><?= $postes1[$i]['name']?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-larger filterBorderBottom">
                                        <p class="break-details"><?= $postes1[$i]['name']?></p>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType">
                <?php
                for ($i = 0; $i < Count($postes1); $i++){
                    if( $i === Count($postes1)-1){ ?>
                    <div class="filter-info-details">
                        <button class="details-button"><a href="directions_services_ajout.php?id=<?= $postes1[$i]["id"] ?>">Détails</a></button>
                    </div>
                    <?php } else{ ?>
                    <div class="filter-info-details filterBorderBottom">
                        <button class="details-button"><a href="directions_services_ajout.php?id=<?= $postes1[$i]["id"] ?>">Détails</a></button>
                    </div>
                    <?php }
                } ?>
        </div>

</div>

</div>
<?php
        include "includes/footer.php";
?>
