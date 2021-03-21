<?php
require 'config.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
if (mysqli_connect_errno() ) {
    die('Could not connect: ' . mysqli_connect_error());
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
    <title>Έγγραφα Μαθήματος</title>
</head>
<body>
<a id="documents"></a>
<div class="header">
    <h1>Έγγραφα Μαθήματος</h1>
</div>

<div class="nav">
    <ul>
        <li><a href="index.php">Αρχική Σελίδα</a></li>
        <li><a href="announcement.php">Ανακοινώσεις</a></li>
        <li><a href="communication.php">Επικοινωνία</a> </li>
        <li class="visited">Έγγραφα Μαθήματος</li>
        <li><a href="homework.php">Εργασίες</a> </li>
    </ul>
</div>
<div class="mainBody">
    <?php
    if ($_SESSION['role']==='tutor') {
        echo "<a href='addDoc.php'>[Προσθήκη Νέου Εγγράφου] </a>";
    }
    ?>
    <div>
        <?php
        $stmt = $con->prepare('SELECT * FROM documents');
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()){
                $id = $data['id'];
                $title = $data['title'];
                $description = $data['description'];
                $filename = $data['filename'];
                echo "<hr>";
                if ($_SESSION['role']==='tutor'){
                    echo "<a href='deleteDoc.php?id=".$data['id']."'>[Delete] </a>";
                    echo "<a href='editDoc.php?id=".$data['id']."'> [Edit]</a>";
                }
                echo "<p><h2>$title</h2></p>";
                echo "<p>$description</p>";
                echo "<a href='files/$filename' download>Download</a>";
            }
        }
        ?>
    </div>
    <a href="#documents" class="top">Top</a>
</div>
</body>
</html>
