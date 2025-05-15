<?php
//verifie si la session est déjà démarrée sinon démarre une nouvelle session
if (!isset($_SESSION)) {
    session_start();
}

// Vérifie si l'utilisateur est manager ou collaborateur sinon redirige vers la page de connexion
if ($_SESSION['utilisateur']['role'] == 'Manager') {
    include('includes/admin-menu.php');
} else if ($_SESSION['utilisateur']['role'] == 'Collaborateur') {
    include('includes/collab-menu.php');
} /*elseif ($_SESSION['utilisateur']['role'] != 'Collaborateur' && $_SESSION['utilisateur']['role'] != 'Manager') {
  header('Location: includes/deco.php');
}*/
?>