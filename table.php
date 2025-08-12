<?php
include "db.php";

// Add Data
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    mysqli_query($conn, "INSERT INTO students (name, email, phone_number) VALUES ('$name', '$email','$phone_number')");
}

// Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
}


// Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE students SET name='$name', email='$email', phone_number='$phone_number' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'> Your table has been updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP CRUD</title>
</head>
<body>

<h2>Add Student</h2>
<form method="POST">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    phone_number: <input type="number" name="phone_number" required />
    <button type="submit" name="submit">Submit</button>
</form>

<h2>User List</h2>
<table border="1" cellpadding="5" >
    <tr style="background-color: teal;">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>phone_number</th>
        <th>Action</th>
    </tr>
    <?php
    //displaying data using query
    $result = mysqli_query($conn, "SELECT * FROM students");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='text' name='name' value='{$row['name']}' required>
                        <input type='email' name='email' value='{$row['email']}' required>
                        <input type='number' name='phone_number' value='{$row['phone_number']}' required>
                        <button type='submit' name='update'>Update</button>
                    </form>
                    <a href='?delete={$row['id']}' onclick=\"return confirm('Delete this student?')\">Delete</a>
                </td>
            </tr>";
    }
    ?>
</table>

</body>
</html>
