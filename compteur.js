function calculerDiff() {

    const start = document.getElementById("date_debut").value;
    const end = document.getElementById("date_fin").value;
    const nbjoursField = document.getElementById("nbjours");

    if (!start || !end) {
        nbjoursField.value = "";
        return;
    }

    const date1 = new Date(start);
    const date2 = new Date(end);

    const time_diff = date2.getTime() - date1.getTime();
    const days_diff = Math.ceil(time_diff / (1000 * 3600 * 24)) + 1;

    nbjoursField.value = days_diff;
    console.log("Nombre de jours calculé :", days_diff);
}
