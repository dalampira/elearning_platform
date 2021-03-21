<?php

require 'config.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
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
    <title>Αρχική Σελίδα</title>
</head>
<body>
<div class="header">
    <h1> Αρχική Σελίδα</h1>
</div>

<div class="nav">
    <ul>
        <li class="visited">Αρχική Σελίδα</li>
        <li><a href="announcement.php">Ανακοινώσεις</a></li>
        <li><a href="communication.php">Επικοινωνία</a> </li>
        <li><a href="documents.php">Έγγραφα Μαθήματος</a></li>
        <li><a href="homework.php">Εργασίες</a> </li>
    </ul>
</div>

<div class="mainBody">
    <p>Καλωσήλθατε στον ιστοχώρο του μαθήματος Εκπαιδευτικά Περιβάλλοντα Διαδικτύου.
    <p>Εδώ θα βρείτε το υλικό του μαθήματος, ασκήσεις και άλλες χρήσιμες πληροφορίες.</p>
    <p>Στις επιμέρους ενότητες, βρίσκονται σχετικές ανακοινώσεις, έγγραφα και εργασίες,
        όπως επίσης και φόρμα επικοινωνίας με τον καθηγητή.</p>
    <img src="images/img.png" alt="Auth logo"/>
    <?php
    if ($_SESSION['role']==='tutor') {
        echo "<h2>Λίστα Χρηστών</h2></a>";
        echo "<a href='addUser.php'>[Προσθήκη Νέου Χρήστη] </a>";

        $stmt = $con->prepare('SELECT * FROM users');
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $name = $data['name'];
                $lastname = $data['lastname'];
                $loginname = $data['loginname'];
                $role = $data['role'];
                echo "<hr>";
                echo "<a href='deleteUser.php?id=" . $data['id'] . "'>[Delete] </a>";
                echo "<a href='editUser.php?id=" . $data['id'] . "'> [Edit]</a>";

                echo "<p><span class='bold'>Όνομα : </span>" . "$name" . "<span class='bold'> Επώνυμο: </span>"."$lastname"."<span class='bold'> Email: </span>".$loginname."<span class='bold'> Ρόλος: </span>"."$role"."</p>";

            }
        }
    }
    ?>
</div>
</body>
</html>
