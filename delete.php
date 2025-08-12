<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATION</title>
</head>
<body>
    <h2>DELETE OPERATION</h2>

    <form method="POST">
        ID: <input type="number" name="id" required />
        <input type="submit" name="submit" value="Delete">
    </form>
<?php 
include 'db.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "USER Deleted";
        } else {
            echo "No user found with that ID";
        }
    } else {
        echo json_encode(["message" => "Delete failed", "error" => mysqli_error($conn)]);
    }
}
?>
</body>
</html>
