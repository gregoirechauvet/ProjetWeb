<?php
session_start();
require('Models/Functions.php');

if(isset($_POST['Login']) && isset($_POST['Password'])) {
	$Log = Login($_POST['Login'], $_POST['Password']);
	if(!empty($Log)) {
		$_SESSION['login'] = $Log['login'];
		$_SESSION['prenom'] = $Log['prenom'];
		$_SESSION['nom'] = $Log['nom'];
		if(Administrateur($_SESSION['login'])['administrateur'] == 1) {
			$_SESSION['admin'] = 1;
		}
	} else {
		$Message = 'Connexion incorrecte';
	}
}

if(isset($_POST['Type']) && isset($_POST['Date']) && isset($_POST['Time']) && isset($_POST['Nom']) && isset($_POST['Lieu']) && isset($_SESSION['admin']) /* Pour vérifier si l'utilisateur est authorisé. */) {
	$id = AddEvent($_POST['Type'], $_POST['Nom'], $_POST['Date'], $_POST['Time'], $_POST['Lieu'], (isset($_POST['Oeuvres']) ? $_POST['Oeuvres'] : Array()));
	if($id == -1) {
		$ErrorInsertion = "Date ou heure incorrecte.";		
	} else {
		if(isset($_POST['Inscription'])) {
			AddChoriste($_SESSION['login'], $id);
		}
	}
}

$Partitions = AllOeuvres();

if(isset($_SESSION['login'])) {
	$Evenements = AllEvents();
} else {
	$Evenements = AllConcerts();
}
for($i = 0; $i < sizeof($Evenements); $i++) {
	$Evenements[$i]['Choristes'] = ChoristeParticipe($Evenements[$i]['idevenement']);
}

include('Views/Home.php');

?>