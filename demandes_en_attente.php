<?php
include 'includes/verify-connect.php';
include 'includes/database.php';

$query = $connexion->prepare('
    SELECT request.id, created_at, start_at, end_at, DATEDIFF( end_at, start_at) as DateDiff, name , comment , last_name, first_name
    FROM request, request_type, person
    WHERE request_type_id = request_type.id AND collaborator_id = person.id AND manager_id = :manager_id AND answer IS NULL
    ORDER BY created_at ASC
');
$id = $_SESSION['utilisateur']['person_id'];
$query->bindParam(':manager_id', $id);
$query->execute();

$dates = $query->fetchAll(\PDO::FETCH_ASSOC);

?>
<div class="History">
    <h2>Demandes en attente</h2>
    <div class="containerFilter">
        <div class="side-menu-profile filterBar">
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Type de demande</label>

                <input class="filter type-filter" type="text" name="typedemande" id="typedemande">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Demandée le</label>
                <input class="filter medium-filter" type="text" name="dateDemande" id="dateDemande">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Collaborateur</label>
                <input class="filter medium-filter" type="text" name="Collaborateur" id="Collaborateur">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Date de début</label>
                <input class="filter medium-filter" type="text" name="dateDebut" id="dateDebut">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Date de fin</label>
                <input class="filter medium-filter" type="text" name="dateFin" id="dateFin">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Nb jours</label>
                <input class="filter medium-filter" type="text" name="nbJours" id="nbJours">
            </div>
        </div>
        <?php
        for ($i = 0; $i < Count($dates); $i++) { ?>
            <div class="congeType card">
                <div class="list_conge">
                    <div class="Type1">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-type">
                                <p class="break-details"><?= $dates[$i]["name"]; ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-type filterBorderBottom">
                                <p class="break-details"><?= $dates[$i]["name"]; ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type7">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["created_at"])) ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["created_at"])) ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type2">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium">
                                <p class="break-details"><?= $dates[$i]["first_name"] . " " . $dates[$i]["last_name"]; ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom">
                                <p class="break-details"><?= $dates[$i]["first_name"] . " " . $dates[$i]["last_name"]; ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type3">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["start_at"])); ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type4">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom">
                                <p class="break-details"><?= date("d/m/Y H:i", strtotime($dates[$i]["end_at"])); ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type5">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-small">
                                <p class="break-details"><?= $dates[$i]["DateDiff"]; ?> jour(s)</p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-small filterBorderBottom">
                                <p class="break-details"><?= $dates[$i]["DateDiff"]; ?> jour(s)</p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-details">
                                <button class="details-button">
                                    <a href="consulter_une_demande.php?id=<?= $dates[$i]['id'] ?>">Détails</a>
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-details filterBorderBottom">
                                <button class="details-button">
                                    <a href="consulter_une_demande.php?id=<?= $dates[$i]['id'] ?>">Détails</a>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    const searchbarTypeDemande = document.querySelector("#typedemande");
    const searchbarCollabo = document.querySelector("#Collaborateur");
    const searchbarDateDebut = document.querySelector("#dateDebut");
    const searchbarDateFin = document.querySelector("#dateFin");
    const searchbarNBJours = document.querySelector("#nbJours");
    const searchbarDateDemande = document.querySelector("#dateDemande");

    searchbarTypeDemande.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type1");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });

    searchbarCollabo.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type2");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarDateDebut.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type3");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarDateFin.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type4");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarNBJours.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type5");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarDateDemande.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type7");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    function filterElements(letters, Type, elements, borderbottom) {
        if (letters.length > 0) {
            for (let i = 0; i < elements.length; i++) {
                if (Type[i].textContent.includes(letters) || Type[i].textContent.toLowerCase().includes(letters)) {
                    elements[i].style.display = "flex";
                } else {
                    elements[i].style.display = "none";
                }
            }
        }
        else {
            for (let i = 0; i < elements.length; i++) {
                if (Type[i].textContent.includes(letters) || Type[i].textContent.toLowerCase().includes(letters)) {
                    elements[i].style.display = "flex";
                }
            }
        }
    }
</script>
<?php
include 'includes/footer.php';
?>
