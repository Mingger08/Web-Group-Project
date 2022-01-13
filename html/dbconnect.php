<?php
$servername = "localhost";
$username   = "hubbuddi_kokneoadmin";
$password   = "CXgkBCcK$QHQ";
$dbname     = "hubbuddi_workactdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>