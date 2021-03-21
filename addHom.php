<?php
require 'config.php';

if ( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_POST['submit']))
{
    $folder_path = 'files/';
    $filename = basename($_FILES['myfile']['name']);
    $newname = $folder_path . $filename;
    $FileType = pathinfo($newname, PATHINFO_EXTENSION);

    if ($FileType == "doc"|| $FileType == "docx") {
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $newname)) {
            $stmt = $con->prepare('INSERT INTO homework (goals, filename, submissions, date) VALUES (?,?,?,?)');
            $stmt->bind_param("ssss", $_POST['goals'], $filename, $_POST['submissions'], $_POST['date']);
            $stmt->execute();
            $last_id = $con->insert_id;
            $stmt->close();

            if ($stmt) {
                echo "File uploaded successfully";
                header('Location: homework.php');
            }
        } else {
            echo "Failed to upload file.";
            header('Location: homework.php');
        }
    }

    $subject = "Υποβλήθηκε η εργασία ".$last_id;;
    $text = "Η ημερομηνία παράδοσης είναι ". $_POST['date'];
    $stmt = $con->prepare('INSERT INTO announcements (date, subject, text) VALUES (?,?,?)');

    $stmt->bind_param("sss", $_POST['date'], $subject, $text);
    $stmt->execute();
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
    <title>Add Homework Form</title>
</head>
<body>
<form method="Post" enctype="multipart/form-data">
    <p>
        <label for="goals">Στόχοι:</label>
        <input type="text" name="goals" id="goals" required>
    </p>
    <p>
        <label for="filename">Τοποθεσία εγγράφου:<input type="file" name="myfile" required></label>
    </p>
    <p>
        <label for="submissions">Παραδοτέα:</label>
        <input type="text" name="submissions" id="submissions" required>
    </p>
    <p>
        <label for="date">Ημερομηνία:</label>
        <input type="date" name="date" id="date" required>
    </p>
    <input type="submit" name="submit">
</form>
</body>
</html>
