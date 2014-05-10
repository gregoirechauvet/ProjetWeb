<?php
ini_set('display_errors', 1);

require('Connexion.php');

function Login($User, $Pass) {
	global $bdd;
	return $bdd->query('SELECT login, nom, prenom FROM Utilisateur, Choriste WHERE Utilisateur_login = login AND identifiant = \''.htmlentities($User).'\' AND motdepasse = md5(\''.htmlentities($Pass).'\')')->fetch();
}

function AllEvents() {
	global $bdd;
	return $bdd->query('SELECT idEvenement, type, heureDate, lieu, nom FROM Evenement ORDER BY heureDate DESC')->fetchAll();
}

function AllConcerts() {
	global $bdd;
	return $bdd->query('SELECT idEvenement, type, heureDate, lieu, nom FROM Evenement WHERE type = \'Concert\' ORDER BY heureDate DESC')->fetchAll();
}

function ChoristeParticipe($idEvenement) {
	global $bdd;
	return $bdd->query('SELECT idChoriste, nom, prenom, voix FROM Participe NATURAL JOIN Choriste WHERE Participe.idEvenement = '.htmlentities($idEvenement).' ORDER BY voix')->fetchAll();
}

function Administrateur($id) {
	global $bdd;
	return $bdd->query('SELECT label, administrateur FROM Responsabilite, Utilisateur WHERE responsabilite_titre = titre AND login = '.htmlentities($id))->fetch();
}

function AllOeuvres() {
	global $bdd;
	return $bdd->query('SELECT idOeuvre, titre, auteur, partition FROM Oeuvre ORDER BY auteur, titre')->fetchAll();
}

function AddEvent($Type, $Nom, $Date, $Heure, $Lieu, $Oeuvres) {
	global $bdd;
	if(ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2}$", $Date) and ereg("^[0-9]{2}:[0-9]{2}$", $Heure)) {
		$bdd->exec("INSERT INTO Evenement(type, heureDate, lieu, nom) VALUES ('".((htmlentities($Type) == 0) ? 'Concert' : 'Répétition')."', ".strtotime($Date." ".$Heure).", '".htmlentities($Lieu)."', '".htmlentities($Nom)."')");
		$idEvent = $bdd->query("SELECT MAX(idEvenement) FROM Evenement")->fetch()[0];
		foreach($Oeuvres as $Oeuvre) {
			$bdd->exec("INSERT INTO Est_au_programme(Evenement_idEvenement, Oeuvre_idOeuvre) VALUES (".$idEvent.", ".htmlentities($Oeuvre).")");
		}
		return $idEvent;
	} else {
		return -1;		
	}
}

function AddChoriste($id, $idEvent) {
	global $bdd;
	$bdd->exec("INSERT INTO Participe(idChoriste, idEvenement) VALUES (".$id.", ".$idEvent.")");
}