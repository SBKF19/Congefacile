<?php
include "header.php";
include 'includes/database.php';
?>
<!--Burger menu -->
<ul class="menu">
    <li><a class="menuItem" href="accueil.php">Accueil</a></li>
    <li><a class="menuItem" href="nouvelle_demande.php">Nouvelle demande</a></li>
    <li><a class="menuItem" href="historique_des_demandes.php">Historique des demandes</a></li>
    <div class="menu-lign"></div>
    <li><a class="menuItem" href="mes_informations.php">Mes informations</a></li>
    <li><a class="menuItem">Mes préférences</a></li>
    <li><a class="menuItem" href="includes/deco.php">Déconnexion</a></li>
  </ul>
  <button class="hamburger">
    <!-- material icons https://material.io/resources/icons/ -->
    <i class="menuIcon material-icons">menu</i>
<!--    <i class="closeIcon material-icons">close</i> -->
  </button>
<!--Menu latéral -->
<div class="cont2"><!--Début du container-->
        <div class="side-menu">
                <div class="side-menu-pages">
                        <div class="onglet">
                                <a href="accueil.php">Accueil</a>
                        </div>
                        <div class="onglet">
                                <a href="nouvelle_demande.php">Nouvelle demande</a>
                        </div>
                        <div class="onglet">
                                <a href="historique_des_demandes.php">Historique des demandes</a>
                        </div>
                        <div class="menu-lign"></div>
                        <div class="onglet">
                                <a href="mes_informations.php">Mes informations</a>
                        </div>
                        <div class="onglet">
                                <a>Mes préférences</a>
                        </div>
                        <div class="onglet">
                                <a href="includes/deco.php">Déconnexion</a>
                        </div>
                </div>



                <div class="side-menu-profile">
                        <div class="side-menu-profile-image">
                                <img src="images/avatar-homme.png" />
                        </div>
                        <div class="side-menu-profile-text">
                                <?php include 'name_and_role.php'; ?>
                        </div>
                </div>
        </div>
        <script src="includes/burger_menu.js"></script>
