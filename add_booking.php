<?php
session_start();
include 'connect.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_no = $_POST['vehicle_no']; // Vehicle number from form
    $date = $_POST['date']; // Reservation date
    $time = $_POST['time']; // Reservation time
    $location = $_POST['location']; // Service location
    $mileage = $_POST['mileage']; // Current vehicle mileage
    $message = $_POST['message']; // Additional message

    // Insert the new booking into the bookings table
    $sql = "INSERT INTO bookings (vehicle_no, date, time, location, mileage, message, username) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiss", $vehicle_no, $date, $time, $location, $mileage, $message, $_SESSION['email']);

    if ($stmt->execute()) {
        header('Location: vehicle.php'); // Redirect to the vehicle page after successful insertion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle Service Reservation</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<header>
    <div class="nav1">
        <a href="vehicle.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</header>

<div class="div1">
    <h1>Add Vehicle Service Reservation</h1>
    <form method="POST" action="add_booking.php">
        <label for="vehicle_no">Vehicle Number:</label>
        <input type="text" id="vehicle_no" name="vehicle_no" required><br><br>

        <label for="date">Service Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Preferred Time:</label>
        <input type="time" id="time" name="time" required><br><br>

        <label for="location">Preferred Service Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="mileage">Vehicle Mileage (km):</label>
        <input type="number" id="mileage" name="mileage" required><br><br>

        <label for="message">Additional Message:</label>
        <textarea id="message" name="message"></textarea><br><br>

        <input type="submit" value="Add Reservation">
    </form>
</div>

</body>
</html>
