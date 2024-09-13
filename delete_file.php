<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: files.php");
    exit();
}

$file_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM files WHERE id = ?");
$stmt->bind_param("i", $file_id);

if ($stmt->execute()) {
    $_SESSION['file_delete_success'] = "File deleted successfully";
} else {
    $_SESSION['file_delete_error'] = "Error deleting file: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: files.php");
exit();
?>