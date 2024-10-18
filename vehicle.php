<?php
session_start();
include 'connect.php'; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch all service reservations for the logged-in user from the 'bookings' table
$sql = "SELECT * FROM bookings WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']); // Bind logged-in user's email to the query
$stmt->execute();
$result = $stmt->get_result(); // Execute query and get results
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Service Reservations</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<header>
    <div class="nav1">
        <a href="vehicle.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</header>

<section class="sec1">
    <h1 class="head1">Welcome to Your Vehicle Service Dashboard</h1>
    <p class="head2">Here are your service reservations:</p>
</section>

<section class="dishes">
    <?php
    if ($result->num_rows > 0) {
        // Loop through the reservations and display each
        while ($row = $result->fetch_assoc()) {
            echo "<div class='dish'>";
            echo "<p><strong>Vehicle Number:</strong> " . $row['vehicle_no'] . "</p>";
            echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
            echo "<p><strong>Time:</strong> " . $row['time'] . "</p>";
            echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
            echo "<p><strong>Mileage:</strong> " . $row['mileage'] . " km</p>";
            echo "<p><strong>Message:</strong> " . $row['message'] . "</p>";
            echo "<a href='delete_booking.php?id=" . $row['booking_id'] . "'>Cancel Reservation</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No service reservations found.</p>";
    }
    ?>
</section>

</body>
</html>

<?php
$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>
