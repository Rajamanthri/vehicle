<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        echo 'Passwords do not match.';
    } else {
       
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql1 = "INSERT INTO users (Uname, email, passwrd, phone, role) VALUES (?, ?, ?, ?, 'user')";

        $stmt = $conn->prepare($sql1);

        if ($stmt) {
            $stmt->bind_param("ssss", $name, $email, $hashedPassword, $phone);
            if ($stmt->execute()) {
            
                $_SESSION['user_id'] = $stmt->insert_id; 
                header("Location: vehicle.php"); 
                exit;
            } else {
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Error: ' . $conn->error;
        }
    }
}

$conn->close();
?>
