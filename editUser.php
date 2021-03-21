<?php
require 'config.php';

$id = $_GET['id'];

// sql to delete a record
$stmt = $con->prepare("SELECT name, lastname, loginname, role FROM users WHERE id = $id");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();


if (!$stmt) {
    $stmt->close();
    header('Location: index.php');
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
        <title>Edit User Form</title>
    </head>
    <body>
    <form method="Post">
        <p>
            <label for="name">Όνομα:</label>
            <input type="text" name="name" id="name" placeholder="<?php echo $data['name']?>" required>
        </p>
        <p>
            <label for="lastname">Επώνυμο:</label>
            <input type="text" name="lastname" id="lastname" placeholder="<?php echo $data['lastname']?>" required>
        </p>
        <p>
            <label for="loginname">Email:</label>
            <input type="text" name="loginname" id="loginname" placeholder="<?php echo $data['loginname']?>" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <label for="roles">Ιδιότητα:</label>
            <select id="roles" name="roles" required>
                <option value="student">Student</option>
                <option value="tutor">Tutor</option>
            </select>
        </p>
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>

<?php
    if (isset($_POST['name'], $_POST['lastname'],$_POST['loginname'], $_POST['password'], $_POST['roles']) ) {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        $stmt = $con->prepare('UPDATE users SET name=?, lastname=?, loginname=?, password=?, role=? WHERE id= ?');
        $stmt->bind_param("sssssi", $_POST['name'], $_POST['lastname'], $_POST['loginname'], $password, $_POST['roles'], $_GET['id']);
        $stmt->execute();
        $stmt->close();
        if ($stmt) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error updating record";
        }
    }
?>