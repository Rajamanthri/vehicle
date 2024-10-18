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
        $sql1 = "INSERT INTO users (name, email, password, phone, role) VALUES (?, ?, ?, ?, 'admin')";

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Hello! Super Admin </h1>
    <header>
        <div class="nav1">

            <a href="food.php">Home</a>
            <a href="super_admin_dashboard.php" id="registerLink">Register</a>
            <a href="add_product.php">Add Product</a>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>

        </div>
    </header>
    
   
    <h2>Create Admin</h2>
    <div class="div1" id="registrationForm">
        <h2>Register</h2>
        <form method="POST" action="super_admin_dashboard.php">
            <lable>Name:</lable>
            <input type="text" id="name" name="name" required><br><br>

            <lable>Email:</lable>
            <input type="email" id="email" name="email" required><br><br>

            <lable>Password:</lable>
            <input type="password" id="password" name="password" required><br><br>

            <lable>Confirm Password:</lable>
            <input type="password" id="cpassword" name="cpassword" required><br><br>

            <lable>Phone Number:</lable>
            <input type="text" id="phone" name="phone" required><br><br>

            <input type="submit" id="btn1" value="Register Admin Now">

        </form>

        <p class="log">Already have an account? <a class="logp" href="login.php">Log in</a></p>
    </div>

    <a href="#" class="linkReg">Register Now</a>
    
   
    <h2>Admin Users</h2>
    <ul>
        <?php foreach ($admin_list as $admin) : ?>
            <li><?php echo $admin['email']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>



