<?php
ini_set('display_errors', 1);
try {
  $bdd = new PDO('pgsql:host=pgsql;dbname=gregoire_chauvet', 'gregoire.chauvet', 'password');
} catch(Exception $e) {
  echo $e;
}
?>
