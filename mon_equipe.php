<?php
include 'includes/verify-connect.php';
include 'includes/database.php';

$query = $connexion->prepare(

    //J'ai fix ta requete sql NICO 
    '
SELECT 
    person.first_name, 
    person.last_name, 
    user.email, 
    position.name AS Job, 
    COUNT(request.collaborator_id) AS nbConges
FROM user
JOIN person ON user.person_id = person.id
JOIN position ON person.position_id = position.id
LEFT JOIN request ON person.id = request.collaborator_id
JOIN department ON person.department_id = department.id
WHERE department.id = :department_id
  AND person.manager_id IS NOT NULL
GROUP BY person.first_name, person.last_name, user.email, position.name;
'
);
$id = $_SESSION['utilisateur']['department'];
$query->bindParam(':department_id', $id);
$query->execute();

$dates = $query->fetchAll(\PDO::FETCH_ASSOC);
?>

<div class="History">
    <div class="title-with-dark-button">
        <h1>Mon équipe</h1>
        <button class="large-dark-button"><a>Ajouter un collaborateur</a></button>
    </div>
    <div class="containerFilter">
        <div class="side-menu-profile filterBar">
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Nom</label>

                <input class="filter medium-filter" type="text" name="nomEquipe" id="nomEquipe">
            </div>
            <div class="filterMargin">
                <label class="label-select" for="commentaire">Prénom</label>
                <input class="filter medium-filter" type="text" name="prenomEquipe" id="prenomEquipe">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Adresse mail</label>
                <input class="filter type-filter" type="text" name="mailEquipe" id="mailEquipe">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Poste</label>
                <input class="filter  type-filter" type="text" name="posteEquipe" id="posteEquipe">
            </div>
            <div class="filterMargin">
                <label class="titreCommentaire" for="commentaire">Nb congés posés sur l'année</label>
                <input class="filter type-filter" type="text" name="nbConges" id="nbConges">
            </div>
        </div>
        <?php
        for ($i = 0; $i < Count($dates); $i++) { ?>
            <div class="congeType card">
                <div class="list_conge">
                    <div class="Type1">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium margin-team">
                                <p class="break-details"><?= $dates[$i]["first_name"]; ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom margin-team">
                                <p class="break-details"><?= $dates[$i]["first_name"]; ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type2">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium margin-team">
                                <p class="break-details"><?= $dates[$i]["last_name"]; ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom margin-team">
                                <p class="break-details"><?= $dates[$i]["last_name"]; ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type3">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-type">
                                <p class="break-details"><?= $dates[$i]["email"] ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-type filterBorderBottom">
                                <p class="break-details"><?= $dates[$i]["email"] ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type4">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-medium">
                                <p class="break-details"><?= $dates[$i]["Job"] ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-medium filterBorderBottom">
                                <p class="break-details"><?= $dates[$i]["Job"] ?></p>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="Type5">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-small margin-team">
                                <p class="break-details"><?= $dates[$i]["nbConges"]; ?></p>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-small filterBorderBottom margin-team">
                                <p class="break-details"><?= $dates[$i]["nbConges"]; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="">
                        <?php
                        if ($i === Count($dates) - 1) { ?>
                            <div class="filter-info-details details-padding">
                                <button class="details-button">
                                    <a href="*">Détails</a>
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="filter-info-details filterBorderBottom details-padding">
                                <button class="details-button">
                                    <a href="*">Détails</a>
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
    const searchbarNomEquipe = document.querySelector("#nomEquipe");
    const searchbarPrenomEquipe = document.querySelector("#prenomEquipe");
    const searchbarMailEquipe = document.querySelector("#mailEquipe");
    const searchbarPosteEquipe = document.querySelector("#posteEquipe");
    const searchbarNbConges = document.querySelector("#nbConges");

    searchbarNomEquipe.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type1");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });

    searchbarPrenomEquipe.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type2");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarMailEquipe.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type3");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarPosteEquipe.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type4");
        const borderBottom = document.querySelectorAll(".filterBorderBottom");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters, typeElement, cards, borderBottom);
    });
    searchbarNbConges.addEventListener("keyup", (e) => {
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type5");
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