<?php
require 'config.php';

if ( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['name'], $_POST['lastname'],$_POST['loginname'], $_POST['password'], $_POST['roles']) ) {

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $con->prepare('INSERT INTO users (name, lastname, loginname, password, role) VALUES (?,?,?,?,?)');
    $stmt->bind_param("sssss", $_POST['name'], $_POST['lastname'], $_POST['loginname'], $password, $_POST['roles']);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error adding user";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="authors" content="Osia Dalampira-Kiprigli">
    <meta name="description" content="First page where the user connects.">
    <meta name="keywords" content="homepage, homework, announcements, documents, communication">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User Form</title>
</head>
<body>
<form method="Post">
    <p>
        <label for="name">Όνομα:</label>
        <input type="text" name="name" id="name" required>
    </p>
    <p>
        <label for="lastname">Επώνυμο:</label>
        <input type="text" name="lastname" id="lastname" required>
    </p>
    <p>
        <label for="loginname">Email:</label>
        <input type="text" name="loginname" id="loginname" required>
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </p>
    <p>
        <label for="roles">Ιδιότητα:</label>
        <select id="roles" name="roles" required>
            <option value="student">Student</option>
            <option value="tutor">Tutor</option>
        </select>
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>

