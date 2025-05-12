<?php include 'includes/collab-menu.php'?>
<script src="compteur.js"></script>
<div class="demande">
	<h1>Effectuer une nouvelle demande</h1>
	<form action="post">
		<div>
			<label for="fname" class="label-input">Type de demande-champ obligatoire</label>
			<br>
			<select type="type" id="type" class="label-select">
				<option value="" >Selectionner un type</option>
			</select>
			<br>
			<br>
		</div>
		<div class="date">
			<div>
				<label for="date_debut" class="label-input">Date début-champ obligatoire</label>
				<br>
				<input type="date" id="date_debut" name="date_debut" class="label-select">
			</div>
			<div>
				<div>
					<label for="date_fin" class="label-input">Date de fin-champ obligatoire</label>
					<br>
					<input type="date" id="date_fin" name="date_fin" class="label-select">
				</div>
				<br>
			</div>
		</div>
		<div>
			<label for="nbjours" class="label-input">Nombre de jours demandés</label>
			<br>
			<input type="text" id="nbjours" readonly  class="defaultbox">
		</div>
		<br>
		<div>
			<label for="justificatif" class="label-input">Justificatif si applicable</label>
			<br>
			<input type="file" id="justificatif" name="justificatif" accept=".pdf" class="label-select">
		</div>
		<br>
		<div>
			<label for="message" class="label-input">Commentaire supplémentaire</label>
			<br>
			<textarea name="message" class="placeholder" placeholder="Si conge exceptionnel ou sans solde, vous pouvez préciser votre demande."></textarea>
			<br>
		</div>
		<button type="submit" class="dark-button">Soumettre ma demande*</button>
	</form>
	<p>
		*En cas d'erreur de saisie ou de changement, vous pourrez modifier votre demande tant que celle ci n'a pas été validée par le manager
	</p>
</div>
<?php include 'includes/footer.php'?>