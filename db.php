<?php
// Activer le rapport d'erreurs pour faciliter le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Détails de la connexion à la base de données
$host = "localhost";
$username = "u561197304_lordcommander";
$password = "i.e53ZE,";
$database = "u561197304_lord";

// Connexion à la base de données
$mysqli = new mysqli($host, $username, $password, $database);

// Vérification de la connexion
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
} else {
  //echo "Connection successful!";
}
?>