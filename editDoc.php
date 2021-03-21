<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("SELECT title, description, filename FROM documents WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$stmt) {
    $stmt->close();
    header('Location: documents.php');
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
        <title>Edit Document Form</title>
    </head>
    <body>
    <form method="Post" enctype="multipart/form-data">
        <p>
            <label for="title">Τίτλος:</label>
            <input type="text" name="title" id="title" placeholder="<?php echo $data['title']?>" required>
        </p>
        <p>
            <label for="description">Περιγραφή:</label>
            <input type="text" name="description" id="description" placeholder="<?php echo $data['description']?>" required>
        </p>
        <p>
            <label for="filename">Τοποθεσία εγγράφου:<input type="file" name="myfile" required></label>
        </p>
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
<?php
    if (isset($_POST['title'], $_POST['description'], $_FILES['myfile']['name']))
    {
        $folder_path = 'files/';
        $filename = basename($_FILES['myfile']['name']);
        $newname = $folder_path . $filename;
        $FileType = pathinfo($newname, PATHINFO_EXTENSION);

        if ($FileType == "doc"|| $FileType == "docx") {
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $newname)) {
            $stmt = $con->prepare('UPDATE documents SET title=?, description=?, filename=? WHERE id= ?');
            $stmt->bind_param("sssi", $_POST['title'], $_POST['description'], $filename, $_GET['id']);
            $stmt->execute();

            if ($stmt) {
                $stmt->close();
                echo "File edited successfully";
                header('Location: documents.php');
                exit;
            }
        } else {
            echo "Failed to edit file.";
            header('Location: documents.php');
            exit;
        }
    }
}

?>