<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT Uid, passwrd, role FROM users WHERE email = '$email' && passwrd= '$password'";


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['user_role'] = $role;
        if ($role == "super_admin") {
          header("Location: super_admin_dashboard.php");
                exit;
       } elseif ($role == "admin") {
        header("Location: admin_dashboard.php");
             exit;
    } elseif ($role == "user") {
            header("Location: vehicle.php");
           exit;
    }
    }

    
}else{
    echo 'Invalid data';
}

$conn->close();
?>
