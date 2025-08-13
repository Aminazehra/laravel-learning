<?php
include "db.php";

// Add Data
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    mysqli_query($conn, "INSERT INTO students (name, email, phone_number, is_active) VALUES ('$name', '$email','$phone_number', 1)");
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
    $is_active = $_POST['is_active']; 

    $sql = "UPDATE students 
            SET name='$name', email='$email', phone_number='$phone_number', is_active='$is_active'  
            WHERE id=$id";

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
    Phone Number: <input type="number" name="phone_number" required>
    <button type="submit" name="submit">Submit</button>
</form>

<h2>User List</h2>
<table border="1" cellpadding="5">
    <tr style="background-color: teal; color:white;">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th style="background-color:green">Status</th>
        <th>Action</th>
    </tr>
   <?php
$result = mysqli_query($conn, "SELECT * FROM students");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <form method='POST' style='display:inline;'>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td><input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' required></td>
                <td><input type='email' name='email' value='" . htmlspecialchars($row['email']) . "' required></td>
                <td><input type='number' name='phone_number' value='" . htmlspecialchars($row['phone_number']) . "' required></td>
                
                <td style='background-color: " . ($row['is_active'] == 1 ? "green" : "beige") . ";'>
                    <select name='is_active' >
                        <option value='1' " . ($row['is_active'] == 1 ? 'selected' : '') . ">Active</option>
                        <option value='0' " . ($row['is_active'] == 0 ? 'selected' : '') . ">Inactive</option>
                    </select>
                </td>

                <td>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                    <button type='submit' name='update'>Update</button>
                    <a href='?delete=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('Delete this student?')\">Delete</a>
                </td>
            </form>
        </tr>";
}
?>
</table>

</body>
</html>
