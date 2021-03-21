<?php
require 'config.php';

if ( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['date'], $_POST['subject'],$_POST['text']) ) {
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];

    $stmt = $con->prepare('INSERT INTO announcements (date, subject, text) VALUES (?,?,?)');
    $stmt->bind_param("sss", $_POST['date'], $_POST['subject'], $_POST['text']);
    $stmt->execute();
    if ($stmt) {
        $stmt->close();
        header('Location: announcement.php');
        exit;
    } else {
        echo "Error deleting record";
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
    <title>Add Announcement Form</title>
</head>
<body>
<form method="Post">
    <p>
        <label for="date">Ημερομηνία:</label>
        <input type="date" name="date" id="date" required>
    </p>
    <p>
        <label for="subject">Θέμα:</label>
        <input type="text" name="subject" id="subject" required>
    </p>
    <p>
        <label for="text">Κείμενο:</label>
        <input type="text" name="text" id="text" required>
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>
