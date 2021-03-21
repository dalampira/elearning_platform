<?php
require 'config.php';

if ( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['loginname'], $_POST['password']) ) {

    $stmt = $con->prepare('SELECT role, password FROM users WHERE loginname = ?');
    $stmt->bind_param('s', $_POST['loginname']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
            $stmt->bind_result($role, $password);
            $stmt->fetch();
// Account exists, now we verify the password.
        if (password_verify($_POST['password'],$password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['loginname'];
            $_SESSION['role'] = $role;
            header('Location:index.php');
        } else {
// Incorrect password
            echo '<p>Incorrect username and/or password!</p>';
        }
    } else {
// Incorrect username
        echo '<p>No such username</p>';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="authors" content="Osia Dalampira-Kiprigli">
    <meta name="description" content="First page where the user connects.">
    <meta name="keywords" content="homepage, homework, announcements, documents, communication">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
    <title>Login</title>
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <form method="Post">
        <label for="loginname"/>
        <input type="text" name="loginname" placeholder="Username" id="loginname" required>
        <label for="password"/>
        <input type="password" name="password" placeholder="Password" id="password" required>
        <input type="submit" value="Login">
    </form>
</div>
</body>
</html>
