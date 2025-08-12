<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title>
</head>
<body>
    <h2>UPDATE  OPERATION</h2>
    <form method="POST">
        ID :<input type="number" name="number" required />
        FIRST NAME:<input type="text" name="firstname" required />
        E-MAIL: <input type="email" name="email" required />
        PASSWORD: <input type="password" name="password" required />
        <input type="submit" name="submit" value="Create"/>
    </form>
    
<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $id = $_POST['number']; // 'number' is your input name
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];


   
    $sql = "UPDATE users SET email = '$email', password = '$password', firstname = '$firstname' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
         if (mysqli_affected_rows($conn) > 0) {
            echo "USER UPDATED";
        } else {
            echo "No user found with that ID";
        }
        echo "USER UPDATED";
    } else {
        echo "UPDATE FAILED: " . mysqli_error($conn);
    }
}
?>
