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
    <meta name="description" content="The page with announcements">
    <meta name="keywords" content="homepage, homework, announcements, documents, communication">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/mainStyle.css">
    <title>Ανακοινώσεις</title>
</head>
<body>
<a id="announce"></a>
<div class="header">
    <h1>Ανακοινώσεις</h1>
</div>

<div class="nav">
    <ul>
        <li><a href="index.php">Αρχική Σελίδα</a></li>
        <li class="visited">Ανακοινώσεις</li>
        <li><a href="communication.php">Επικοινωνία</a> </li>
        <li><a href="documents.php">Έγγραφα Μαθήματος</a></li>
        <li><a href="homework.php">Εργασίες</a> </li>
    </ul>
</div>
<div class="mainBody">
    <?php
        if ($_SESSION['role']==='tutor') {
            echo "<a href='add.php'>[Προσθήκη Νέας Ανακοίνωσης] </a>";
        }
    ?>
    <div>
        <?php
        $stmt = $con->prepare('SELECT * FROM announcements');
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()){
                $id = $data['id'];
                $date = $data['date'];
                $subject = $data['subject'];
                $text = $data['text'];
                echo "<hr>";
                if ($_SESSION['role']==='tutor'){
                    echo "<a href='delete.php?id=".$data['id']."'>[Delete] </a>";
                    echo "<a href='edit.php?id=".$data['id']."'> [Edit]</a>";
                }
                echo "<h2>Ανακοίνωση "."$id".":</h2>";
                echo "<p>Ημερομηνία: "."$date"."</p>";
                echo "<p>Θέμα: "."$subject"."</p>";
                echo "<p>"."$text"."</p>";
            }
        }
        ?>
    </div>
    <a href="#announce" class="top">Top</a>
</div>

</body>
</html>
