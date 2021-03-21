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
            echo 'moved';
            $stmt = $con->prepare('INSERT INTO documents (title, description, filename) VALUES (?,?,?)');
            $stmt->bind_param("sss", $_POST['title'], $_POST['description'], $filename);
            $stmt->execute();
            $stmt->close();
            if ($stmt) {
                echo "File uploaded successfully";
                header('Location: documents.php');
            }
        } else {
            echo "Failed to upload file.";
            header('Location: documents.php');
        }
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
    <title>Add Document Form</title>
</head>
<body>
<form method="Post" enctype="multipart/form-data">
    <p>
        <label for="title">Τίτλος:</label>
        <input type="text" name="title" id="title" required>
    </p>
    <p>
        <label for="description">Περιγραφή:</label>
        <input type="text" name="description" id="description" required>
    </p>
    <p>
        <label for="filename">Τοποθεσία εγγράφου:<input type="file" name="myfile" required></label>
    </p>
    <input type="submit" name="submit">
</form>
</body>
</html>
