<?php include 'includes/collab-menu.php'?>

<div class="demande">
	<h1>Mes informations</h1>
	
    <form action="post">

        <div class="date">
                <div>
                    <label for="nom" class="label-input">Nom de famille</label>
                    <input type="text" id="nom"  class="defaultbox-input defaultbox" readonly>
                </div>

                <div>
                    <label for="prenom" class="label-input">Prénom</label>
                    <input type="text" id="prenom"  class=" defaultbox-input defaultbox" readonly>
                    
                </div>
        </div>
            
<br>
        <div>
            <label for="mail" class="label-input">Adresse email</label>
            <input type="email" id="mail"  class="defaultbox-input defaultbox" readonly>
        </div>
<br>
        <div class="date">
            <div>
                <label for="direction" class="label-input">Direction/Service</label>
                <select type="text" id="direction" class="defaultbox-input defaultbox" readonly>
                    <option value="" ></option>
                </select>
            </div>
                <br>
                
            <div>
                <label for="poste" class="label-input">Poste</label>
                <select type="text" id="poste" class="defaultbox-input defaultbox" readonly>
                    <option value="" ></option>
                </select>
            </div>
        </div>
<br>
        <div>
            <label for="Manager" class="label-input">Manager</label>
            <select type="text" id="manager" class="defaultbox-input defaultbox" readonly>
                <option value="" ></option>
            </select>
        </div>
    </form>

    <br>

    <h2>Réinitialiser mon mot de passe</h2>

    <form>
        <label for="password" class="label-input">Mot de passe actuel</label>
        <input type="password" id="password" name="password" class="label-field"><br>
        <div class="date">
            
        <div>
                <label for="newpass" class="label-input">Nouveau mot de passe</label>
                <input type="password" id="newpass" name="newpass" class="label-fixed-value">
            </div>
            <div>
                <label for="confirmpass" class="label-input">Confirmation du mot de passe</label>
                <input type="password" id="confirmpass" name="confirmpass" class="label-field">
            </div>
        </div>
        <br>
        <br>

        <button type="submit" class="dark-button">Réinitialiser le mot de passe</button>
    </form>





<?php include 'includes/footer.php'?>