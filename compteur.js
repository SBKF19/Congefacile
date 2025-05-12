function calculerDiff() {
    const start = document.getElementById("date_debut").value;//selectionne la valeur de la date de début dans le document html
    const end = document.getElementById("date_fin").value;

    const date1 = new Date(start);//créé un objet de type date en js
    const date2 = new Date(end);

    const time_diff = date2.getTime() - date1.getTime();// calcul la différence entre les dates en millisecondes
    const days_diff = time_diff / (1000 * 3600 * 24);//conversion en jours

    document.getElementById("nbjours").value = days_diff; // affiche le résultat dans le input nbjours
  }