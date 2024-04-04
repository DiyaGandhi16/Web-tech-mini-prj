<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and execute SQL statement to delete record
    $stmt = $conn->prepare("DELETE FROM contact_information WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

// Redirect back to show.php
header("Location: show.php");
exit();
?>
