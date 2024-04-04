<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointment List</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="admin_show.css"> -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        color: #333;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
     footer {
        color: #fff;
        text-align: center;
        padding: 20px;
        position: absolute;
        bottom: 0;
        width: 100%;
    } 
    .appointment-btn {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 5px;
        margin-top: 20px;
        transition: background-color 0.3s;
    }
    .appointment-btn:hover {
        background-color: #45a049;
    }
    
</style>

</head>
<body>

<div class="container">
    <h1>Appointment List</h1>
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>    
                <th>Name</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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

            // Fetch data from database
            $sql = "SELECT id, full_name, phone_number, email, date, time, area, city, state, zip_code FROM contact_information";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                $sr = 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$sr."</td><td>".$row["full_name"]."</td><td>".$row["phone_number"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td><td><button onclick='deleteRecord(".$row["id"].")' class='btn btn-danger'>Delete</button></td></tr>";
                    $sr++;
                }
            } else {
                echo "<tr><td colspan='11'>No records found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <footer style="position: fixed; bottom: 0; width: 50%;">
        <!-- <p>&copy; 2024 Our Clinic. All rights reserved.</p> -->
        <a class="appointment-btn" href ="make_appointment.php">Make an Appointment</a>
        <!-- <a class="appointment-btn" href = "user_show.php"> Our Appointments</a> -->
    </footer>
</div>
<script>
        function deleteRecord(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                // Send AJAX request to delete record
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Reload the page after deletion
                        location.reload();
                    }
                };
                xhttp.open("GET", "delete_record.php?id=" + id, true);
                xhttp.send();
            }
        }
    </script>

</body>
</html>
