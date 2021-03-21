<?php
require 'config.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['send_message'])) {
    if (mysqli_connect_errno() ) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    $stmt = $con->prepare('SELECT loginname FROM users WHERE role = "tutor"');
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()){
            $From = $_POST['from'];
            $to = $data['loginname'];
            $subject = $_POST['subject'];
            $msg = $_POST['text'];
            if(mail($to, $subject, $msg, $From)){
                //echo $to. 'mail sent';
            }
            else {
                $to = "Mail sent to ".$to;
                echo '<script type="text/javascript">alert("'.$to.'");</script>';
            }
        }
    }
    $stmt->close();
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
    <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
    <title>Επικοινωνία</title>
</head>
<body>
<div class="header">
    <h1>Επικοινωνία</h1>
</div>

<div class="nav">
    <ul>
        <li><a href="index.php">Αρχική Σελίδα</a></li>
        <li><a href="announcement.php">Ανακοινώσεις</a></li>
        <li class="visited">Επικοινωνία</li>
        <li><a href="documents.php">Έγγραφα Μαθήματος</a></li>
        <li><a href="homework.php">Εργασίες</a> </li>
    </ul>
</div>
<div class="mainBody">
    <div>
        <h2>Αποστολή email μέσω web φόρμας:</h2>
        <form method="Post">
            <div class="form">
                <label for="from">Αποστολέας: </label><br>
                <input type="text" id="from" name="from"><br>
            </div>
            <div class="form">
                <label for="subject">Θέμα: </label><br>
                <input type="text" id="subject" name="subject"><br>
            </div>
            <div class="form">
                <label for="text">Κείμενο: </label><br>
                <input type="text" id="text" name="text">
            </div>
            <div class="form">
                <button type="submit" name="send_message">Send</button>
            </div>
        </form>
    </div>

    <div>
        <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
        <p>Εναλλακτικά μπορείτε να στείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου</p>
        <p><a href = "mailto: tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a></p>
    </div>
</div>
</body>
</html>
