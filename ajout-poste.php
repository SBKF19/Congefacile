<?php
        include "includes/admin-menu.php";
        include "includes/database.php";


$query = $connexion->prepare('
    SELECT DISTINCT (name), COUNT(position.id) as nbPostesPerson
    FROM position , person
    WHERE position.id = position_id
    GROUP BY name;
');

$query->execute();

$postes = $query->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="History">
        <div class="title-with-button">
        <h2>Postes</h2>
        <button class="dark-button">Ajouter un poste</button>
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
                        <div class="congeType large-filter">
                            <?php
                                for ($i = 0; $i < Count($postes); $i++){
                                    if( $i === Count($postes)-1){ ?>
                                        <p class="info break-details"><?= $postes[$i]['name']?></p>
                                    <?php } else{ ?>
                                        <p class="info filterBorderBottom break-details"><?= $postes[$i]['name']?></p>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType medium-filter">
                            <?php
                                for ($i = 0; $i < Count($postes); $i++){
                                    if( $i === Count($postes)-1){ ?>
                                        <p class="info break-details"><?= $postes[$i]['nbPostesPerson']?></p>
                                    <?php } else{ ?>
                                        <p class="info filterBorderBottom break-details"><?= $postes[$i]['nbPostesPerson']?></p>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType">
                <?php
                for ($i = 0; $i < Count($postes); $i++){
                    if( $i === Count($postes)-1){ ?>
                    <div class="infoDetail">
                        <button class="details-button" href="*" style="text-decoration: none;">Détails</button>
                    </div>
                    <?php } else{ ?>
                    <div class="infoDetail filterBorderBottom">
                        <button class="details-button" href="*" style="text-decoration: none;">Détails</button>
                    </div>
                    <?php }
                } ?>
                        </div>
                </div>

        </div>

</div>
<?php
        include "includes/footer.php";
?>
