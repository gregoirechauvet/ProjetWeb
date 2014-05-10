<?php function Enough($Event) {
	static $k = 0;
	if(isset($_SESSION['login'])) {
		$Ok = Array(0, 0, 0, 0);
		for($i = 0; $i < sizeof($Event['Choristes']); $i++) {
			if($Event['Choristes'][$i]['voix'] == 'Soprano') {
				$Ok[0]++;
			} elseif($Event['Choristes'][$i]['voix'] == 'Alto') {
				$Ok[1]++;
			} elseif($Event['Choristes'][$i]['voix'] == 'Ténor') {
				$Ok[2]++;
			} else {
				$Ok[3]++;
			}
		}
		if($Ok[0] > 0 AND $Ok[1] > 1 AND $Ok[2] > 1 AND $Ok[3] > 1) {
			return 1;
		} else {
			return 0;
		}
	} else {
		return $k++%2;
	}
} 
function Month($i) {
	$Mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
	return $Mois[$i - 1];
} ?><!DOCTYPE html>
<head>
	<meta charset="UTF-8"/>
	<title>Timeline</title>
	<link rel="stylesheet" href="Public/Stylesheets/Home.css"/>
	<script type="text/javascript">
	window.onload = function() {
		<?php if(isset($_SESSION['admin'])) { ?>
		document.querySelector("#AddEvent").addEventListener('click', function(e) {
			document.querySelector('#Modal').style.display = 'block';
			e.stopPropagation();
		}, false);
		document.querySelector('body').addEventListener('click', function() {
			if(document.querySelector('#Modal').style.display == 'block') {
				document.querySelector('#Modal').style.display = 'none';
			}
		}, false);
		document.querySelector('#Modal > div').addEventListener('click', function(e) {
			e.stopPropagation();
		}, false);
		<?php } ?>
		document.querySelector("#Connexion").addEventListener('click', function() {
			var e = this.parentNode.querySelector('div');
			if(e.style.display == 'none' || e.style.display == '') {
				e.style.display = 'block';
			} else {
				e.style.display = 'none';
			}
		}, false);
		for(var i = 0; i < document.querySelectorAll(".Info").length; i++) {
			document.querySelectorAll(".Info")[i].addEventListener('click', function() {
				var e = this.querySelector('.Hidden');
				if(e.style.display == 'none' || e.style.display == '') {
					e.style.display = 'block';
				} else {
					e.style.display = 'none';
				}
			}, false);
		}
	}
	</script>
</head>

<nav>
	<div>
		<img src="Public/Images/Logo.png" height="25" alt="Logo" style="padding: 3px 0 0 3px; vertical-align: -8px;"/>
		<?php if(isset($_SESSION['admin'])) { ?>
			<input id="AddEvent" type="button" value="Ajouter un évènement"/>
		<?php } ?>
		<?php if(isset($ErrorInsertion)) { echo '<span style="color: red">'.$ErrorInsertion.'</span>'; } ?>
	</div>
	<div>
		<?php if(!isset($_SESSION['login'])) { ?>
			<?php if(isset($Message)) { echo '<span style="color: red;">'.$Message.'</span>'; } ?>
			<p id="Connexion"><span>Connexion</span></p>
			<div>
				<form action="" method="post">
					<input type="text" name="Login" placeholder="Login" required/><br />
					<input type="password" name="Password" placeholder="Mot de passe" required/><br />
					<input type="submit" value="Se connecter"/>
				</form>
			</div>
		<?php } else { ?>
			<span>Bonjour, <?php echo $_SESSION['prenom'].' '.$_SESSION['nom']; ?></span>
			<a id="Connexion" href="Logout.php"><span>Déconnexion</span></a>
		<?php } ?>
	</div>
</nav>

<h1>Site de la chorale de l'ENSIIE</h1>
<h3>Frise chronologique des évènements</h3>
<section>
	<?php if(isset($_SESSION['login'])) { ?>
		<div class="Row" style="text-align: center;">
			<div>Assez de choristes</div>
			<div>Pas assez de choristes</div>
		</div>
	<?php } ?>
	<?php $DateOk = true; ?>
	<?php for($i = 0; $i < sizeof($Evenements); $i++) { ?>
		<div class="Row">
			<?php if($DateOk && $Evenements[$i]['heuredate'] < time()) { ?>
				<?php $DateOk = false; ?>
				<div class="Ok Today">
					<div>
						<div class="Mark">
							<mark>
								<img src="Public/Images/Auj.png" alt=""/>
							</mark>
						</div>
					</div>
				</div>
				<div></div>
			<?php } else { ?>
				<?php $Cal = Enough($Evenements[$i]); ?>
				<?php if($Cal == 0) { ?>
					<div></div>
				<?php } ?>
				<div class="Ok <?php if(isset($_SESSION['login'])) { echo 'Coloration'; } ?>">
				<!-- The following div is because Firefox sucks -->
					<div>
						<div class="Canevas"></div>
						<div class="Mark">
							<mark></mark>
						</div>
						<p class="Date"><?php echo date("d", $Evenements[$i]['heuredate'])." ".Month(date("n", $Evenements[$i]['heuredate']))." ".date("Y G:i", $Evenements[$i]['heuredate']); ?></p>
						<div class="Info">
							<p class="Nom"><?php echo $Evenements[$i]['nom']; if(isset($_SESSION['login'])) {
								echo (($Evenements[$i]['type'] == 'Concert') ? ' [Concert]' : ' [Répétition]');
							} ?></p>
							<p class="Lieu"><?php echo $Evenements[$i]['lieu']; ?></p>
							<?php setlocale(LC_ALL, 'fr_FR'); ?>
							<div class="Hidden">
								<?php if(isset($_SESSION['login'])) { ?>
								<p class="Bold">Soprano(s) :</p>
								<ul>
									<?php foreach($Evenements[$i]['Choristes'] as $Choriste) { ?>
										<?php if($Choriste['voix'] == "Soprano") { ?>
											<li><?php echo $Choriste['prenom']." ".$Choriste['nom']; ?></li>
										<?php } ?>
									<?php } ?>
								</ul>
								<p class="Bold">Alto(s) :</p>
								<ul>
									<?php foreach($Evenements[$i]['Choristes'] as $Choriste) { ?>
										<?php if($Choriste['voix'] == "Alto") { ?>
											<li><?php echo $Choriste['prenom']." ".$Choriste['nom']; ?></li>
										<?php } ?>
									<?php } ?>
								</ul>
								<p class="Bold">Ténor(s) :</p>
								<ul>
									<?php foreach($Evenements[$i]['Choristes'] as $Choriste) { ?>
										<?php if($Choriste['voix'] == "Ténor") { ?>
											<li><?php echo $Choriste['prenom']." ".$Choriste['nom']; ?></li>
										<?php } ?>
									<?php } ?>
								</ul>
								<p class="Bold">Basse(s) :</p>
								<ul>
									<?php foreach($Evenements[$i]['Choristes'] as $Choriste) { ?>
										<?php if($Choriste['voix'] == "Basse") { ?>
											<li><?php echo $Choriste['prenom']." ".$Choriste['nom']; ?></li>
										<?php } ?>
									<?php } ?>
								</ul>
								<?php } ?>
								<a href="https://www.google.fr/maps/place/<?php echo urlencode($Evenements[$i]['lieu']); ?>/">
									<img src="http://maps.googleapis.com/maps/api/staticmap?key=AIzaSyDYRi-Fj9jW2K8Ztaloy1cA-wOUQn4s1-Y&amp;center=<?php echo urlencode($Evenements[$i]['lieu']); ?>&amp;zoom=12&amp;size=640x400&amp;maptype=roadmap&amp;sensor=false" alt=""/>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php if($Cal == 1) { ?>
					<div></div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>
	<div id="Modal">
		<div>
			<form action="index.php" method="post">
				<label for="Type" class="FixedSize">Type :</label><select id="Type" name="Type">
					<option value="0">Concert</option>
					<option value="1">Répétition</option>
				</select><br />
				<label for="Nom" class="FixedSize">Nom :</label><input id="Nom" type="text" name="Nom" required/><br />
				<label for="Date" class="FixedSize">Date :</label><input id="Date" type="date" name="Date" placeholder="AAAA-MM-JJ"required/><br />
				<label for="Time" class="FixedSize">Time :</label><input id="Time" type="time" name="Time" placeholder="hh:mm" required/><br />
				<label for="Lieu" class="FixedSize">Lieu :</label><input id="Lieu" type="text" name="Lieu" required/><br />
				<fieldset>
					<legend>Oeuvres au programme</legend>
					<?php foreach($Partitions as $Oeuvre) { ?>
						<input id="<?php echo $Oeuvre['idoeuvre']; ?>" type="checkbox" name="Oeuvres[]" value="<?php echo $Oeuvre['idoeuvre']; ?>"/><label for="<?php echo $Oeuvre['idoeuvre']; ?>"><?php echo $Oeuvre['auteur']." : ".$Oeuvre['titre']; ?></label><br />
					<?php } ?>
				</fieldset>
				<input id="Inscription" type="checkbox" name="Inscription" checked="checked"/><label for="Inscription">S'incrire à l'évènement</label><br />
				<input type="submit" value="Ajouter"/>
			</form>
	</div>
</section>