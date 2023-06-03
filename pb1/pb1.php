<?php

header("Access-Control-Allow-Origin: *");

$mysqli = new mysqli("localhost", "root", "", "trenuri");
if ($mysqli->connect_error) {
    exit("Couldn't connect to DB");
}

$query = "SELECT oras2 FROM rute WHERE oras1=?;";
$statement = $mysqli->prepare($query);
$statement->bind_param('s', $_GET["oras1"]);
$statement->execute();
$statement->bind_result($result);

echo "<table>";

while ($statement->fetch()) {
    echo "<tr><td>$result</td></tr>";
}
echo "</table>";