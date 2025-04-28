
<?php
include 'includes/collab-menu.php';
include 'includes/database.php';

$query = $connexion->prepare('
    SELECT request.id as id, answer, start_at, end_at, DATEDIFF( end_at, start_at) as DateDiff, name , comment , last_name, first_name
    FROM request, request_type, person
    WHERE request_type_id = request_type.id AND collaborator_id = person.id AND answer IS NOT NULL
');

$query->execute();

$dates = $query->fetchAll(\PDO::FETCH_ASSOC);


?>
<div class="History">
    <h1>Demandes en attente</h1>
    <div class="containerFilter">
        <div class="side-menu-profile filterBar">
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Type de demande</label>

                <input class ="filter type-filter" type="text" name="typedemande" id="typedemande">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Collaborateur</label>
                <input class ="filter medium-filter" type="text" name="Collaborateur" id="Collaborateur">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Date de début</label>
                <input class ="filter medium-filter" type="text" name="dateDebut" id="dateDebut">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Date de fin</label>
                <input class ="filter medium-filter" type="text" name="dateFin" id="dateFin">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Nb jours</label>
                <input class ="filter small-filter" type="text" name="nbJours" id="nbJours">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Statut</label>
                <input class="filter medium-filter" type="text" name="Collaborateur" id="Collaborateur">
            </div>
        </div>
        <div class="list_conge">
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-type">
                        <p class="break-details"><?= $dates[$i]["name"];?></p>
                    </div>
                    <?php } else{ ?>
                        <div class="filter-info-type filterBorderBottom">
                        <p class="break-details"><?= $dates[$i]["name"];?></p>
                        </div>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-medium">
                        <p class="break-details"><?= $dates[$i]["first_name"]." ".$dates[$i]["last_name"]; ?></p>
                    </div>
                    <?php } else{ ?>
                        <div class="filter-info-medium filterBorderBottom">
                        <p class="break-details"><?= $dates[$i]["first_name"]." ".$dates[$i]["last_name"]; ?></p>
                        </div>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-medium">
                        <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                    </div>
                    <?php } else{ ?>
                        <div class="filter-info-medium filterBorderBottom">
                        <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                        </div>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-medium">
                        <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                    </div>
                    <?php } else{ ?>
                        <div class="filter-info-medium filterBorderBottom">
                        <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                        </div>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-small">
                        <p class="break-details"><?= $dates[$i]["DateDiff"]; ?></p>
                    </div>
                    <?php } else{ ?>
                        <div class="filter-info-small filterBorderBottom">
                        <p class="break-details"><?= $dates[$i]["DateDiff"]; ?></p>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1 && $dates[$i]['answer'] === 1){ ?>
                    <div class="filter-info-medium">
                        <p class="break-details">Validé</p>
                    </div>
                    <?php }
                    if( $i === Count($dates)-1 && $dates[$i]['answer'] === 0){ ?>
                    <div class="filter-info-medium">
                        <p class="break-details">Refusé</p>
                    </div>
                    <?php }
                    if( $i !== Count($dates)-1 && $dates[$i]['answer'] === 1){ ?>
                    <div class="filter-info-medium filterBorderBottom">
                        <p class="break-details">Validé</p>
                    </div>
                    <?php }
                    if( $i !== Count($dates)-1 && $dates[$i]['answer'] === 0){ ?>
                    <div class="filter-info-medium filterBorderBottom">
                        <p class="break-details">Refusé</p>
                    </div>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="filter-info-details">
                        <button class="details-button">
                        <a href="/php/Bouton/Demande.php?id=<?= $dates[$i]['id'] ?>">Détails</a>
                        </button>
                    </div>
                    <?php } else{ ?>
                    <div class="filter-info-details filterBorderBottom">
                        <button class="details-button">
                        <a href="/php/Bouton/Demande.php?id=<?= $dates[$i]['id'] ?>">Détails</a>
                        </button>
                    </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<script src="index.js"></script>
<?php
include 'includes/footer.php';
?>
