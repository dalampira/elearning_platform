<?php
require 'config.php';

if (mysqli_connect_errno() ) {
    die('Could not connect: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT loginname FROM users WHERE role = "tutor"');

$stmt->execute();
// Store the result so we can check if the account exists in the database.
$result = $stmt->get_result();

echo '<p>'.$result->num_rows.'</p>';

if ($result->num_rows > 0) {

    while ($data = $result->fetch_assoc()){
        //$stmt->bind_result($loginname);
        //$stmt->fetch();
        echo $data['loginname'];
    }
}
echo '<p>'.password_hash('4444', PASSWORD_DEFAULT).'</p>';
$stmt->close();

if (mysqli_connect_errno() ) {
    die('Could not connect: ' . mysqli_connect_error());
}

$stmt = $con->prepare('INSERT INTO homework (goals, filename, submissions, date) VALUES (?,?,?,?)');
$stmt->bind_param("ssss", $_POST['goals'], $filename, $_POST['submissions'], $_POST['date']);
$stmt->execute();
$last_id = $con->insert_id;
$stmt->close();

echo $last_id;

$stmt = $con->prepare('SELECT id FROM homework WHERE id = SCOPE_IDENTITY()');
$result = $stmt->get_result();
$data = $result->fetch_assoc();
echo $data['id'];


$stmt->close();

