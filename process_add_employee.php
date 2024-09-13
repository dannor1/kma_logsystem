<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $date_of_birth = $_POST['date_of_birth'];
    $hire_date = $_POST['hire_date'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if department exists, if not create it
    $stmt = $conn->prepare("SELECT id FROM departments WHERE name = ?");
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
        $stmt->bind_param("s", $department);
        $stmt->execute();
        $department_id = $stmt->insert_id;
    } else {
        $row = $result->fetch_assoc();
        $department_id = $row['id'];
    }

    $stmt = $conn->prepare("INSERT INTO employees (staff_id, name, department_id, phone, email, position, date_of_birth, hire_date, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissssss", $staff_id, $name, $department_id, $phone, $email, $position, $date_of_birth, $hire_date, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>