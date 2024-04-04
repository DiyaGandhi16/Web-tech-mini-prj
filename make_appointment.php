<!DOCTYPE html>
<html>
<head>
    <title>Make Appointment</title>
    <style>
        .app_button {
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
        .head {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .head {
        text-align: center;
        margin-top: 20px;
    }

    .app_button {
        display: block;
        width: 150px;
        text-align: center;
        padding: 8px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .app_button:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<body>
    <h1 class='head'>Make Appointment</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Doctor Name</th>
                    <th>Field</th>
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

                // Fetch doctors from database
                $sql = "SELECT * FROM doctors";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $sr = 1;
                    // Display doctors list in table
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$sr."</td><td>".$row["name"]."</td><td>".$row["field"]."</td><td><a href='appointment.html?doctor=".urlencode($row["name"])."' class='app_button'>Make Appointment</a></td></tr>";
                        $sr++;
                    }
                } else {
                    echo "<tr><td colspan='3'>No doctors found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
