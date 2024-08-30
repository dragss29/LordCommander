<?php
include '../db.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['lang'])) {
    $user_id = $_SESSION['user_id'];
    $lang = $_POST['lang'];
    
    $query = $mysqli->prepare("UPDATE users SET preferred_language = ? WHERE id = ?");
    $query->bind_param("si", $lang, $user_id);
    
    if ($query->execute()) {
        $_SESSION['language'] = $lang;
        echo json_encode(['success' => true, 'reload' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $mysqli->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'User not logged in or language not specified']);
}
?>