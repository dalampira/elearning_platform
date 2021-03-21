<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM documents WHERE id = $id");
$stmt->execute();

if ($stmt) {
    $stmt->close();
    header('Location: documents.php');
    exit;
} else {
    echo "Error deleting record";
}