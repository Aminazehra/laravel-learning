<?php
include 'db.php';

// Tell the browser it's JSON
header('Content-Type: application/json');

$result = mysqli_query($conn, 'SELECT * FROM users');
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Output JSON
echo json_encode($users);
?>
