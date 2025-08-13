<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <h2>Login Page</h2>

    <!--creating form-->
    <form method="POST">
        E-MAIL: <input type="text" name="email" required><br>
        PASSWORD: <input type="password" name="password" required><br>
        <input type="submit" name="submit" value="LOGIN"/>
    </form>

    <?php
    //if form is submitted
    if (isset($_POST['submit'])) {

        //connect sql with db
        $conn = mysqli_connect('localhost','root','','login_db');
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        //get form inputs
        $email = $_POST['email'];
        $password = $_POST['password'];

        //check credentials
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        //checks user exists
        if (mysqli_num_rows($result) == 1) {
            // Fetch the user row from the result
            $user = mysqli_fetch_assoc($result);

            // Check is_active column
            if ($user['IS_ACTIVE'] == 1) {
                echo "<p>Login Successful</p>";
            } else {
                echo "<p>Your account is inactive. Please contact admin.</p>";
            }
        } 
        else {
            echo "<p>Invalid Credentials</p>";
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
