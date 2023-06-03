<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "trenuri";

$con = mysqli_connect($servername, $username, $password, $dbName);

if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_error();
    exit();
}

$query = "SELECT oras2 FROM rute WHERE oras1=?";
$statement = $con->prepare($query);
$city = $_POST['plecare'];
$statement->bind_param('s', $city);
$statement->execute();
$result = $statement->get_result();

// Construct the options list for the arrival stations
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $sosire = $row['oras2'];
    $options .= "<option value='" . htmlspecialchars($sosire) . "'>" . htmlspecialchars($sosire) . "</option>";
}

// Check if any options were retrieved
if (!empty($options)) {
    // Return the options list
    echo $options;
} else {
    echo "<option value=''>No destinations available</option>";
}

// Close the statement and database connection
$statement->close();
mysqli_close($con);
?>
