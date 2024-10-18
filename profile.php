
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style2.css">

</head>
<body>
<header>
        <div class="nav1">

            <a href="vehicle.php">Home</a>
            <a href="register.php" id="registerLink">Register</a>
            <a href="login.php">Login</a>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>

        </div>
    </header>
    <div class="div1">
        <h2>My Profile</h2>
        <?php
        session_start();
        include 'connect.php';
         if(isset($_SESSION['email'])){
            $em = $_SESSION['email'];
            $sql = "SELECT Uname, email, phone FROM users WHERE email = '$em';";
            $stmt = mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($stmt);
            if(mysqli_num_rows($stmt)>0){
                echo "<h3>Name:".$row['Uname']."</h3>
                     <h3>".$row['email']."</h3>
                     <h3>".$row['phone']."</h3>";
            }

            $conn->close();
         }
    


            // if ($stmt) {
            //     $stmt->bind_param("i", $em);
            //     if ($stmt->execute()) {
            //         $stmt->bind_result($name, $email, $phone);
            //         $stmt->fetch();

            //         echo "<p>Name: $name</p>";
            //         echo "<p>Email: $email</p>";
            //         echo "<p>Phone: $phone</p>";

            //         $stmt->close();
            //     } else {
            //         echo 'Error executing SQL query: ' . $stmt->error;
            //     }
            // } else {
            //     echo 'Error preparing SQL statement: ' . $conn->error;
            // }

        
        ?>
        
    </div>
</body>
</html>
