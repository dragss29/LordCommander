<?php
include '../db.php';

$email = $_POST['email'];
$commander_name = $_POST['commander_name'];

$query = $mysqli->prepare("SELECT id FROM users WHERE email = ? OR user_gamertag = ?");
$query->bind_param("ss", $email, $commander_name);
$query->execute();
$query->store_result();

$response = [
    'emailExists' => false,
    'commanderNameExists' => false
];

if ($query->num_rows > 0) {
    $query->bind_result($id);
    while ($query->fetch()) {
        $result = $mysqli->query("SELECT email, user_gamertag FROM users WHERE id = $id");
        $row = $result->fetch_assoc();
        if ($row['email'] == $email) {
            $response['emailExists'] = true;
        }
        if ($row['user_gamertag'] == $commander_name) {
            $response['commanderNameExists'] = true;
        }
    }
}

echo json_encode($response);
