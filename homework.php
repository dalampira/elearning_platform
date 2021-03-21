<?php
require 'config.php';
// If the user is not logged in redirect to the login page...
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
    <title>Εργασίες</title>
</head>
<body>
<a id="homework"></a>
<div class="header">
    <h1>Εργασίες</h1>
</div>

<div class="nav">
    <ul>
        <li><a href="index.php">Αρχική Σελίδα</a></li>
        <li><a href="announcement.php">Ανακοινώσεις</a></li>
        <li><a href="communication.php">Επικοινωνία</a> </li>
        <li><a href="documents.php">Έγγραφα Μαθήματος</a></li>
        <li class="visited">Εργασίες</li>
    </ul>
</div>
<div class="mainBody">
    <?php
    if ($_SESSION['role']==='tutor') {
        echo "<a href='addHom.php'>[Προσθήκη Νέας Εργασίας] </a>";
    }
    ?>
    <div>
        <?php
        $stmt = $con->prepare('SELECT * FROM homework');
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()){
                $id = $data['id'];
                $goals = $data['goals'];
                $filename = $data['filename'];
                $submissions = $data['submissions'];
                $date = $data['date'];
                echo "<hr>";
                if ($_SESSION['role']==='tutor'){
                    echo "<a href='deleteHom.php?id=".$data['id']."'>[Delete] </a>";
                    echo "<a href='editHom.php?id=".$data['id']."'> [Edit]</a>";
                }
                echo "<h2>Εργασία "."$id".":</h2>";
                echo "<p>Οι στόχοι της εργασίας είναι</p>";
                echo "<ol>$goals</ol>";
                echo "<p>Εκφώνηση:</p>";
                echo "<a href='files/$filename' download>Download</a>";
                echo "<p>Παραδοτέα:</p>";
                echo "<ol>$submissions</ol>";
                echo "<p><span class='red'>Ημερομηνία παράδοσης:</span>$date</p>";

            }
        }
        ?>
    </div>
    <a href="#homework" class="top">Top</a>
</div>
</body>
</html>
