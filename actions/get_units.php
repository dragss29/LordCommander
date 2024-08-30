<?php
header('Content-Type: application/json');
include '../db.php';

$faction_id = $_GET['faction_id'] ?? null;
$lang = $_GET['lang'] ?? 'fr';

if (!$faction_id || !is_numeric($faction_id)) {
    echo json_encode(['error' => 'Invalid faction ID']);
    exit;
}

try {
    $column_name = "{$lang}_nom";
    $stmt = $mysqli->prepare("SELECT id, `$column_name` as nom, points FROM unites WHERE faction_id = ?");
    $stmt->bind_param("i", $faction_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $units = [];
    while ($row = $result->fetch_assoc()) {
        $units[] = $row;
    }

    echo json_encode($units);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}