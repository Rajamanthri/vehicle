<?php
session_start();
include 'connect.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Check if the booking ID is provided
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Delete the booking if it belongs to the logged-in user
    $sql = "DELETE FROM bookings WHERE booking_id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $booking_id, $_SESSION['email']);

    if ($stmt->execute()) {
        header('Location: vehicle.php'); // Redirect to the vehicle page after successful deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
}
?>
