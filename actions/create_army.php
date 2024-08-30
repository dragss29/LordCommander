<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Utilisateur non connecté']);
    exit;
}

$user_id = $_SESSION['user_id'];
$name = $_POST['army_name'];
$description = $_POST['army_description'];
$game = $_POST['game'];
$units = $_POST['units'];

// Vérifier si une armée avec le même nom existe déjà pour cet utilisateur
$check_query = $mysqli->prepare("SELECT id FROM user_armies WHERE user_id = ? AND name = ?");
$check_query->bind_param("is", $user_id, $name);
$check_query->execute();
$result = $check_query->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'Une armée avec ce nom existe déjà']);
    exit;
}

// Calculer le nombre total de points et d'unités
$total_points = 0;
$unit_count = 0;
$factions = [];

foreach ($units as $unit_id => $quantity) {
    $query = $mysqli->prepare("SELECT points, faction_id FROM unites WHERE id = ?");
    $query->bind_param("i", $unit_id);
    $query->execute();
    $result = $query->get_result();
    $unit = $result->fetch_assoc();
    
    $total_points += $unit['points'] * $quantity;
    $unit_count += $quantity;
    
    if (!in_array($unit['faction_id'], $factions)) {
        $factions[] = $unit['faction_id'];
    }
}

// Convertir les IDs de faction en noms
$faction_names = [];
$faction_query = $mysqli->prepare("SELECT FR_nom FROM factions WHERE id IN (" . implode(',', $factions) . ")");
$faction_query->execute();
$faction_result = $faction_query->get_result();
while ($faction = $faction_result->fetch_assoc()) {
    $faction_names[] = $faction['FR_nom'];
}

$factions_string = implode(', ', $faction_names);

// Insérer l'armée dans la base de données
$query = $mysqli->prepare("INSERT INTO user_armies (user_id, name, description, total_points, unit_count, game_name, factions) VALUES (?, ?, ?, ?, ?, ?, ?)");
$query->bind_param("issiiss", $user_id, $name, $description, $total_points, $unit_count, $game, $factions_string);

if ($query->execute()) {
    $army_id = $mysqli->insert_id;
    
    // Insérer les unités de l'armée
    $unit_query = $mysqli->prepare("INSERT INTO army_unites (army_id, unite_id, quantity) VALUES (?, ?, ?)");
    foreach ($units as $unit_id => $quantity) {
        $unit_query->bind_param("iii", $army_id, $unit_id, $quantity);
        $unit_query->execute();
    }
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erreur lors de la création de l\'armée']);
}
?>