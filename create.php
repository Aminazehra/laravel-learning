<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title>
</head>
<body>
    <h2>CREATE OPERATION</h2>
    <form method="POST">
        E-MAIL: <input type="email" name="email" required />
        PASSWORD: <input type="password" name="password" required />
        <input type="submit" name="submit" value="Create"/>
    </form>

    <?php
    include 'db.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "User created successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
