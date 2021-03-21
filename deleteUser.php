<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM users WHERE id = $id");
$stmt->execute();

if ($stmt) {
    $stmt->close();
    header('Location: index.php');
    exit;
} else {
    echo "Error deleting record";
}
