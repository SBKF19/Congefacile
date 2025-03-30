
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
    <h2>Demandes en attente</h2>
    <div class="containerFilter">
        <div class="side-menu-profile filterBar">
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Type de demande</label>

                <input class ="filter" type="text" name="typedemande" id="typedemande">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Collaborateur</label>
                <input class ="filter" type="text" name="Collaborateur" id="Collaborateur">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Date de début</label>
                <input class ="filter" type="text" name="dateDebut" id="dateDebut">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Date de fin</label>
                <input class ="filter" type="text" name="dateFin" id="dateFin">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Nb jours</label>
                <input class ="filter" type="text" name="nbJours" id="nbJours">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Statut</label>
                <input class="filter" type="text" name="Collaborateur" id="Collaborateur">
            </div>
        </div>
        <div class="list_conge">
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                        <p class="info break-details"><?= $dates[$i]["name"];?></p>
                    <?php } else{ ?>
                        <p class="info filterBorderBottom break-details"><?= $dates[$i]["name"];?></p>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                        <p class="info break-details"><?= $dates[$i]["first_name"]." ".$dates[$i]["last_name"]; ?></p>
                    <?php } else{ ?>
                        <p class="info filterBorderBottom break-details"><?= $dates[$i]["first_name"]." ".$dates[$i]["last_name"]; ?></p>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                        <p class="info break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                    <?php } else{ ?>
                        <p class="info filterBorderBottom break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                        <p class="info break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                    <?php } else{ ?>
                        <p class="info filterBorderBottom break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                        <p class="info break-details"><?= $dates[$i]["DateDiff"]; ?></p>
                    <?php } else{ ?>
                        <p class="info filterBorderBottom break-details"><?= $dates[$i]["DateDiff"]; ?></p>
                    <?php }
                } ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1 && $dates[$i]['answer'] === 1){ ?>
                        <p class="info break-details">Validé</p>
                    <?php }                    
                    if( $i === Count($dates)-1 && $dates[$i]['answer'] === 0){ ?>
                        <p class="info break-details">Refusé</p>
                    <?php }
                    if( $i !== Count($dates)-1 && $dates[$i]['answer'] === 1){ ?>
                        <p class="info break-details filterBorderBottom">Validé</p>
                    <?php }
                    if( $i !== Count($dates)-1 && $dates[$i]['answer'] === 0){ ?>
                        <p class="info break-details filterBorderBottom">Refusé</p>
                    <?php }
                }
                ?>
            </div>
            <div class="congeType">
                <?php
                for ($i = 0; $i < Count($dates); $i++){
                    if( $i === Count($dates)-1){ ?>
                    <div class="infoDetail">
                        <a class="details-button" href="/php/Bouton/Demande.php?id=<?= $dates[$i]['id'] ?>" style="text-decoration: none;">Details</a>
                    </div>
                    <?php } else{ ?>
                    <div class="infoDetail filterBorderBottom">
                        <a class="details-button" href="/php/Bouton/Demande.php?id=<?= $dates[$i]['id'] ?>" style="text-decoration: none;">Details</a>
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
    