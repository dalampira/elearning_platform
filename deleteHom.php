<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM homework WHERE id = $id");
$stmt->execute();

if ($stmt) {
    $stmt->close();
    header('Location: homework.php');
    exit;
} else {
    echo "Error deleting record";
}