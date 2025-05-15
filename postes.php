<?php
        include "includes/admin-menu.php";
        include "includes/database.php";


$query = $connexion->prepare('
    SELECT name, id
    FROM position
');

$query->execute();

$postes1 = $query->fetchAll(\PDO::FETCH_ASSOC);

$query = $connexion->prepare('
    SELECT position_id
    FROM person
');

$query->execute();

$postes2 = $query->fetchAll(\PDO::FETCH_ASSOC);

$tab = [];
for ($i = 0; $i < Count($postes1); $i++){
    $count = 0;
    for ($a = 0; $a < Count($postes2); $a++){
        if ($postes1[$i]["id"] === $postes2[$a]["position_id"]){
            $count = $count + 1;
        }
    }
    array_push($tab,$count);
}
?>

<div class="History">
        <div class="title-with-dark-button">
        <h1>Postes</h1>
        <a class="large-dark-button" href="postes_details_ajout.php">Ajouter un poste</a>
        </div>
        <div class="containerFilter">
                <div class="side-menu-profile filterBar">
                        <div class="filterMargin">
                                <label class="label-select">Nom du poste</label>
                                <input class="large-filter filter" type="text">
                        </div>
                        <div class="filterMargin">
                                <label class="label-select">Nb personnes liées</label>
                                <input class="medium-filter filter" type="text">
                        </div>
                </div>
                <div class="list_conge">
                        <div class="congeType">
                            <?php
                                for ($i = 0; $i < Count($postes1); $i++){
                                    if( $i === Count($postes1)-1){ ?>
                                    <div class="filter-info-large">
                                        <p class="break-details"><?= $postes1[$i]['name']?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-large filterBorderBottom">
                                        <p class="break-details"><?= $postes1[$i]['name']?></p>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType">
                            <?php
                                for ($i = 0; $i < Count($tab); $i++){
                                    if( $i === Count($tab)-1){ ?>
                                    <div class="filter-info-medium">
                                        <p class="break-details"><?= $tab[$i]?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-medium filterBorderBottom">
                                        <p class="break-details"><?= $tab[$i]?></p>
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
                        <button class="details-button"><a href="postes_details_ajout.php?id=<?= $postes1[$i]["id"] ?>">Détails</a></button>
                    </div>
                    <?php } else{ ?>
                    <div class="filter-info-details filterBorderBottom">
                        <button class="details-button"><a href="postes_details_ajout.php?id=<?= $postes1[$i]["id"] ?>">Détails</a></button>
                    </div>
                    <?php }
                } ?>
                        </div>
                </div>

        </div>

</div>
</div>
<?php
        include "includes/footer.php";
?>
