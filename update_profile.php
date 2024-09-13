<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $date_of_birth = $_POST['dateOfBirth'];
    $hire_date = $_POST['hireDate'];

    $stmt = $conn->prepare("UPDATE employees SET name = ?, email = ?, phone = ?, position = ?, date_of_birth = ?, hire_date = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $name, $email, $phone, $position, $date_of_birth, $hire_date, $user_id);

    if ($stmt->execute()) {
        $_SESSION['profile_update_success'] = "Profile updated successfully";
    } else {
        $_SESSION['profile_update_error'] = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: profile.php");
    exit();
}
?>