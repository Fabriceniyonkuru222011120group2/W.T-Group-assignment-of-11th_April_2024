<?php
// Connection
$host = "localhost";
$user = "admin";
$pass = "bityear2@2024";
$database = "bityeartwo2024";

// Create the connection
$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO `like` (lid, contentid, userid) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $ulid, $contentid, $userid);
    
    // Set parameters and execute
    $ulid = $_POST['lid'];
    $contentid = $_POST['contentid'];
    $userid = $_POST['userid'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM `like`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Like</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Table of Like Data</h2>
    
    <table id="dataTable">
        <tr>
            <th>Likeid</th>
            <th>Contentid</th>
            <th>Userid</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["lid"] . "</td><td>" . $row["contentid"] . "</td><td>" . $row["userid"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
