<?php

session_start();
include 'admin-menu.php';

?>  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="demande.css" src="demande.css">
    <title>Types de demandes</title>
</head>

<body>
    <div class="container">
        <h2>Types de demandes</h2>
        <label type="type">Nom du type</label>
        <input type="text" id="type" value="Congé-payé">
        <div class="buttons">
        <a href="#"> <button class="supp">Supprimer </button></a> 
        <a href="#"> <button class="AJour">Mettre à jour</button></a> 
        </div>
    </div>
</body>
</html>
