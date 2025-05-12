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
        <button class="large-dark-button"><a>Ajouter un poste</a></button>
        </div>
        <div class="containerFilter">
                <div class="side-menu-profile filterBar">
                        <div class="filterMargin">
                                <label class="label-select">Nom du poste</label>
                                <input class="large-filter filter" type="text" id="nomPoste">
                        </div>
                        <div class="filterMargin">
                                <label class="label-select">Nb personnes liées</label>
                                <input class="medium-filter filter" type="text" id="nbPersLiees">
                        </div>
                </div>
                <?php
                for ($i = 0; $i < Count($postes1); $i++){ ?>
                <div class="congeType card">
                    <div class="list_conge">
                        <div class="Type1">
                            <?php
                            if( $i === Count($postes1)-1){ ?>
                            <div class="filter-info-type">
                                <p class="break-details"><?= $postes1[$i]["name"];?></p>
                            </div>
                            <?php } else{ ?>
                                <div class="filter-info-type filterBorderBottom">
                                <p class="break-details"><?= $postes1[$i]["name"];?></p>
                                </div>
                            <?php }
                        ?>
                            </div>
                        <div class="Type2">
                            <?php
                                    if( $i === Count($tab)-1){ ?>
                                    <div class="filter-info-medium">
                                        <p class="break-details"><?= $tab[$i]?></p>
                                    </div>
                                    <?php } else{ ?>
                                        <div class="filter-info-medium filterBorderBottom">
                                        <p class="break-details"><?= $tab[$i]?></p>
                                        </div>
                                    <?php }
                            ?>
                        </div>
                        <div class="">
                <?php
                    if( $i === Count($postes1)-1){ ?>
                    <div class="filter-info-details">
                        <button class="details-button" href="*"><a>Détails</a></button>
                    </div>
                    <?php } else{ ?>
                    <div class="filter-info-details filterBorderBottom">
                        <button class="details-button" href="*"><a>Détails</a></button>
                    </div>
                    <?php } ?>
                        </div>
                </div>
            <?php } ?>
        </div>

</div>
</div>
<script>
    const searchbarNomPoste = document.querySelector("#nomPoste");
    const searchbarNbPersLiees = document.querySelector("#nbPersLiees");

    searchbarNomPoste.addEventListener("keyup", (e) =>{
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type1");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters,typeElement,cards);
    });

    searchbarNbPersLiees.addEventListener("keyup", (e) =>{
        const searchedLetters = e.target.value;
        const typeElement = document.querySelectorAll(".Type2");
        const cards = document.querySelectorAll(".card");
        filterElements(searchedLetters,typeElement,cards);
    });

    function filterElements(letters, Type, elements){
        if(letters.length > 0){
            for (let i=0; i < elements.length; i++){
                if(Type[i].textContent.includes(letters) || Type[i].textContent.toLowerCase().includes(letters)){
                    elements[i].style.display = "flex";
                } else{
                    elements[i].style.display = "none";
                }
            }
        }
        else{
            for (let i=0; i < elements.length; i++){
                if(Type[i].textContent.toLowerCase().includes(letters)){
                    elements[i].style.display = "flex";
                }
            }
        }
    }

</script>
<?php
        include "includes/footer.php";
?>
