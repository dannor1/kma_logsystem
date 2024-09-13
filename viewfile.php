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

$stmt = $conn->prepare("SELECT f.*, d.name as department_name, e.name as received_by_name FROM files f LEFT JOIN departments d ON f.department_id = d.id LEFT JOIN employees e ON f.received_by = e.id WHERE f.id = ?");
$stmt->bind_param("i", $file_id);
$stmt->execute();
$file = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$file) {
    header("Location: files.php");
    exit();
}

$conn->close();
?>

<!-- HTML to display file details -->