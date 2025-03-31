<?php
        include "admin-menu.php";
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
                                <p class="info filterBorderBottom break-details">Placeholder</p>
                                <p class="info filterBorderBottom break-details">Placeholder</p>
                                <p class="info break-details">Placeholder</p>
                        </div>
                        <div class="congeType medium-filter">
                                <p class="info filterBorderBottom break-details">Placeholder</p>
                                <p class="info filterBorderBottom break-details">Placeholder</p>
                                <p class="info break-details">Placeholder</p>
                        </div>
                        <div class="congeType">
                                <div class="infoDetail filterBorderBottom">
                                        <button class="details-button">Détails</button>
                                </div>
                                <div class="infoDetail filterBorderBottom">
                                        <button class="details-button">Détails</button>
                                </div>
                                <div class="infoDetail">
                                        <button class="details-button">Détails</button>
                                </div>
                        </div>
                </div>

        </div>

</div>

</div>
<?php
        include "footer.php";
?>