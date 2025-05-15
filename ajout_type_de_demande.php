<?php
include 'includes/verify-connect.php';
include 'includes/database.php';


$query = $connexion->prepare('
    SELECT DISTINCT (request_type.name) as typeRequette, COUNT(request_type_id) as nbPersonnesAssociees
    FROM request_type, request
    WHERE request_type.id = request_type_id
    GROUP BY name;
');

$query->execute();

$postes = $query->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="History">
        <div class="title-with-dark-button">
        <h1>Types de demandes</h1>
        <button class="large-dark-button"><a>Ajouter un type de demande</a></button>
        </div>
        <div class="containerFilter">
                <div class="side-menu-profile filterBar">
                        <div class="filterMargin">
                                <label class="label-select">Nom du type de demande</label>
                                <input class="large-filter filter" type="text">
                        </div>
                        <div class="filterMargin">
                                <label class="label-select">Nb demandes associées</label>
                                <input class="medium-filter filter" type="text">
                        </div>
                </div>
                <div class="list_conge">
                        <div class="congeType">
                            <?php
                                for ($i = 0; $i < Count($postes); $i++){
                                    if( $i === Count($postes)-1){ ?>
                                    <div class="filter-info-large">
                                        <p class="break-details"><?= $postes[$i]['typeRequette']?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-large filterBorderBottom">
                                        <p class="break-details"><?= $postes[$i]['typeRequette']?></p>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType">
                            <?php
                                for ($i = 0; $i < Count($postes); $i++){
                                    if( $i === Count($postes)-1){ ?>
                                    <div class="filter-info-medium">
                                        <p class="break-details"><?= $postes[$i]['nbPersonnesAssociees']?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-medium filterBorderBottom">
                                        <p class="break-details"><?= $postes[$i]['nbPersonnesAssociees']?></p>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="congeType">
                <?php
                for ($i = 0; $i < Count($postes); $i++){
                    if( $i === Count($postes)-1){ ?>
                    <div class="filter-info-details">
                        <button class="details-button" href="*"><a>Détails</a></button>
                    </div>
                    <?php } else{ ?>
                    <div class="filter-info-details filterBorderBottom">
                        <button class="details-button" href="*"><a>Détails</a></button>
                    </div>
                    <?php }
                } ?>
        </div>

</div>

</div>
<?php
        include "includes/footer.php";
?>
