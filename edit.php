<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("SELECT date, subject, text FROM announcements WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$stmt) {
    $stmt->close();
    header('Location: announcement.php');
    exit;
}

?>

<!DOCTYPE html>
    <meta charset="UTF-8">
    <meta name="authors" content="Osia Dalampira-Kiprigli">
    <meta name="description" content="First page where the user connects.">
    <meta name="keywords" content="homepage, homework, announcements, documents, communication">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <meta charset="UTF-8">
    <title>Edit Announcement Form</title>
</head>
<body>
<form method="Post">
    <p>
        <label for="date">Ημερομηνία:</label>
        <input type="date" name="date" id="date" placeholder="<?php echo $data['date']?>" required>
    </p>
    <p>
        <label for="subject">Θέμα:</label>
        <input type="text" name="subject" id="subject" placeholder="<?php echo $data['subject']?>" required>
    </p>
    <p>
        <label for="text">Κείμενο:</label>
        <input type="text" name="text" id="text" placeholder="<?php echo $data['text']?>" required>
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>

<?php
    if (isset($_POST['date'], $_POST['subject'],$_POST['text']) ) {

        $stmt = $con->prepare('UPDATE announcements SET date=?, subject=?, text=? WHERE id= ?');
        $stmt->bind_param("sssi", $_POST['date'], $_POST['subject'], $_POST['text'], $_GET['id']);
        $stmt->execute();
        if ($stmt) {
            $stmt->close();
            header('Location: announcement.php');
            exit;
        } else {
            echo "Error editing record";
            header('Location: announcement.php');
            exit;
        }

    }
?>