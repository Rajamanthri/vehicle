<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "vehicle";

        $conn = new mysqli($serverName, $userName, $passWord, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connection_error);
        }
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productDescription = $_POST['product_description'];
        $productPrice = $_POST['product_price'];

        $sql = "UPDATE products SET name=?, description=?, price=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdi", $productName, $productDescription, $productPrice, $productId);
            if ($stmt->execute()) {
               
                header("Location: admin_dashboard.php");
                exit;
            } else {
                echo 'Error updating the product: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo 'Error preparing SQL statement: ' . $conn->error;
        }

        $conn->close();
    } else {
        echo 'Invalid request.';
    }
} else {
    header('Location: login.php');
    exit;
}
?>
