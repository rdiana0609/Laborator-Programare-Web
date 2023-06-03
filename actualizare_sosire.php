<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    // Create connection
    $conn = new mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $departure = $_REQUEST["departure"];
    $sql = "SELECT oras2 FROM trenuri WHERE oras1 = '$departure' ";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        $locations = array();
        while($row = $result->fetch_assoc()) {
            array_push($locations, $row["oras2"]);
        }
        echo (implode(',', $locations));
      } else {
        echo "";
      }
?>