<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, staff_id, name, password, is_admin FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['staff_id'] = $row['staff_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['is_admin'] = $row['is_admin'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>