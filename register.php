<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

    <div class="div1" id="registrationForm">
        <h2>Register</h2>
        <form method="POST" action="register_process.php">
            <lable>Name: </lable>
            <input type="text" id="name" name="name" required><br><br>

            <lable>Email:</lable>
            <input type="email" id="email" name="email" required><br><br>

            <lable>Password:</lable>
            <input type="password" id="password" name="password" required><br><br>

            <lable>Confirm Password:</lable>
            <input type="password" id="cpassword" name="cpassword" required><br><br>

            <lable>Phone Number:</lable>
            <input type="text" id="phone" name="phone" required><br><br>

            <input type="submit" id="btn1" value="Register Now">

        </form>

        <p class="log">Already have an account? <a class="logp" href="login.php">Log in</a></p>
    </div>

    <a href="#" class="linkReg">Register Now</a>
</body>

</html>
