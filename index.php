<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page </title>
</head>
<body>
    <h2> login Page </h2>

    <!--creating form-->
    <form method="POST">
        E-MAIL:<input type="text" name="email" required><br>
        PASSWORD:<input type="password" name="password" required><br>
        <input type="submit" name="submit" value="LOGIN"/>
    </form>

    <?php
    //if form is submitted
        if (isset($_POST['submit'])){

            //connect sql with db
            $conn = mysqli_connect('localhost','root','','login_db');
            if (!$conn) {
                die('Connection failed'. mysqli_connect_error());
        }

        //get form inputs
        $email = $_POST['email'];
        $password = $_POST['password'];

        //check credentials
        $sql = "SELECT * FROM users where email= '$email' AND  password ='$password'
        ";
        //runs query on db
        $result = mysqli_query($conn, $sql);

        //checks user exists
        if (mysqli_num_rows($result) == 1) {
            echo"<p> Login Successfull</p>";
        } 
        else {
            echo "<p>Invalid Credentials </p>";
        }
        mysqli_close($conn);
    }
    ?>

</body>
</html>