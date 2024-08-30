<?php
include '../db.php';
session_start();

// Vérifier si les données du formulaire sont présentes
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "Veuillez fournir un nom d'utilisateur et un mot de passe.";
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "success";
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
$query->close();
$mysqli->close();
?>