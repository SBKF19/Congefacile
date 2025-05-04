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
                                <input class="large-filter filter" type="text" id="nomPoste">
                        </div>
                        <div class="filterMargin">
                                <label class="label-select">Nb personnes liées</label>
                                <input class="medium-filter filter" type="text" id="nbPersLiees">
                        </div>
                </div>
                <?php
                for ($i = 0; $i < Count($postes); $i++){ ?>
                <div class="congeType large-filter card">
                    <div class="list_conge">
                        <div>
                            <?php
                                    if( $i === Count($postes)-1){ ?>
                                        <p class="info break-details"><?= $postes[$i]['name']?></p>
                                    <?php } else{ ?>
                                        <p class="info filterBorderBottom break-details"><?= $postes[$i]['name']?></p>
                                    <?php } ?>
                                    
                        </div>
                        <div class="congeType medium-filter">
                            <?php
                                    if( $i === Count($postes)-1){ ?>
                                        <p class="info break-details"><?= $postes[$i]['nbPostesPerson']?></p>
                                    <?php } else{ ?>
                                        <p class="info filterBorderBottom break-details"><?= $postes[$i]['nbPostesPerson']?></p>
                                    <?php } ?>
                        </div>
                        <div class="congeType">
                <?php
                    if( $i === Count($postes)-1){ ?>
                    <div class="infoDetail">
                        <button class="details-button" href="*" style="text-decoration: none;">Détails</button>
                    </div>
                    <?php } else{ ?>
                    <div class="infoDetail filterBorderBottom">
                        <button class="details-button" href="*" style="text-decoration: none;">Détails</button>
                    </div>
                    <?php }?>
                        </div>
                </div>
                <?php }?>
        </div>

</div>
<script>
    const searchbarNomPoste = document.querySelector("#nomPoste");
    const searchNbPersLiees = document.querySelector("#nbPersLiees");

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
