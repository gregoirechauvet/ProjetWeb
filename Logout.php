	<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['nom']);
unset($_SESSION['prenom']);
unset($_SESSION['admin']);
header('Location: index.php');
?>