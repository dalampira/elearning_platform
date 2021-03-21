<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM announcements WHERE id = $id");
$stmt->execute();

if ($stmt) {
    $stmt->close();
    header('Location: announcement.php');
    exit;
} else {
    echo "Error deleting record";
}
