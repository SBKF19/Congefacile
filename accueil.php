<?php
session_start();
include 'includes/database.php';
if ($_SESSION['utilisateur']['role'] == 'Manager') {
    include('includes/admin-menu.php');
} else if ($_SESSION['utilisateur']['role'] == 'Collaborateur') {
    include('includes/collab-menu.php');
} else {
    header('Location: connexion.php');
}

?>
<div class="wholeAccueil">
    <h1>CongéFacile</h1>
    <p>CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l’entreprise. <br> Plus besoin
        d’échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer vos absences en toute
        transparence et simplicité.</p>

    <h2>Etapes</h2>
    <div class="timeline-container">
        <div class="timeline">
            <div class="etape active" id="etape1">1</div>
            <div class="line"></div>
            <div class="etape" id="etape2">2</div>
            <div class="line"></div>
            <div class="etape" id="etape3">3</div>
        </div>
        <div class="descriptions">
            <div class="description-box">J’effectue ma demande de congés</div>
            <div class="description-box">Mon manager valide ou refuse la demande</div>
            <div class="description-box">Je consulte l’historique de mes demandes</div>
        </div>
    </div>
    <div class="bottomAccueil">
        <p>En cas de difficulté avec l’application, veuillez envoyer un email à <a
                href="mailto:contact@mentalworks.fr">contact@mentalworks.fr</a>.</p>
    </div>
</div>