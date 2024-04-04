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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];

    $sql = "INSERT INTO contact_information (full_name, phone_number, email, date, time, area, city, state, zip_code) 
            VALUES ('$full_name', '$phone_number', '$email', '$date', '$time', '$area', '$city', '$state', '$zip_code')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.html with success query parameter
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>