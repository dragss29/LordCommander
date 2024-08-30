<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

include '../db.php';
session_start();

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Utilisateur non connecté');
    }

    $user_id = $_SESSION['user_id'];
    $game = $_GET['game'] ?? '';
    $lang = $_GET['lang'] ?? 'fr';

    $query = $mysqli->prepare("
        SELECT ua.*, au.unite_id, au.quantity, u.{$lang}_nom as unit_name, u.points, f.image as faction_image
        FROM user_armies ua
        LEFT JOIN army_unites au ON ua.id = au.army_id
        LEFT JOIN unites u ON au.unite_id = u.id
        LEFT JOIN factions f ON FIND_IN_SET(f.{$lang}_nom, ua.factions)
        WHERE ua.user_id = ? AND ua.game_name = ?
    ");
    $query->bind_param("is", $user_id, $game);
    $query->execute();
    $result = $query->get_result();

    $armies = [];
    while ($row = $result->fetch_assoc()) {
        $army_id = $row['id'];
        if (!isset($armies[$army_id])) {
            $armies[$army_id] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'total_points' => $row['total_points'],
                'unit_count' => $row['unit_count'],
                'faction_image' => $row['faction_image'],
                'units' => []
            ];
        }
        if ($row['unite_id']) {
            $armies[$army_id]['units'][] = [
                'id' => $row['unite_id'],
                'name' => $row['unit_name'],
                'quantity' => $row['quantity'],
                'points' => $row['points']
            ];
        }
        // Afficher le contenu de $armies à chaque itération
        error_log("Info charge: " . print_r($armies, true));
    }

    echo json_encode(array_values($armies));
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $mysqli->close();
}
?>