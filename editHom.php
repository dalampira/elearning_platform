<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("SELECT goals, filename, submissions, date FROM homework WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$stmt) {
    header('Location: homework.php');
    exit;
}
$stmt->close();

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="authors" content="Osia Dalampira-Kiprigli">
        <meta name="description" content="First page where the user connects.">
        <meta name="keywords" content="homepage, homework, announcements, documents, communication">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Homework Form</title>
    </head>
    <body>
    <form method="Post" enctype="multipart/form-data">
        <p>
            <label for="goals">Στόχοι:</label>
            <input type="text" name="goals" id="goals" placeholder="<?php echo $data['goals']?>" required>
        </p>
        <p>
            <label for="filename">Τοποθεσία εγγράφου:<input type="file" name="myfile" required></label>
        </p>
        <p>
            <label for="submissions">Παραδοτέα:</label>
            <input type="text" name="submissions" id="submissions" placeholder="<?php echo $data['submissions']?>" required>
        </p>
        <p>
            <label for="date">Ημερομηνία:</label>
            <input type="date" name="date" id="date" placeholder="<?php echo $data['date']?>" required>
        </p>

        <input type="submit" value="Submit">
    </form>
    </body>
    </html>
<?php
if (isset($_POST['goals'], $_FILES['myfile']['name'],$_POST['submissions'],  $_POST['date']))
{
    $folder_path = 'files/';
    $filename = basename($_FILES['myfile']['name']);
    $newname = $folder_path . $filename;
    $FileType = pathinfo($newname, PATHINFO_EXTENSION);

    if ($FileType == "doc"|| $FileType == "docx") {
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $newname)) {
            $stmt = $con->prepare('UPDATE homework SET goals=?, filename=?, submissions=?, date=? WHERE id= ?');
            $stmt->bind_param("ssssi", $_POST['goals'],$filename, $_POST['submissions'], $_POST['date'], $_GET['id']);
            $stmt->execute();

            if ($stmt) {
                $stmt->close();
                echo "File edited successfully";
                header('Location: homework.php');
                exit;
            }
        } else {
            echo "Failed to edit file.";
            header('Location: homework.php');
            exit;
        }
    }
}
?>