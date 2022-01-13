<?php
session_start();
error_reporting(0);
include("dbconnect.php");

$email = $_POST["email"];
$password = $_POST["password"];
$pass_sha1 = sha1($password);


$query = "SELECT staffID,usertype FROM `tbl_user` WHERE `email` = '$email' AND `password` = '$pass_sha1' ";
$result = $conn->query($query);

if ($result->num_rows > 0) {



    while ($row = $result->fetch_assoc()) {
        $staffID = $row['staffID'];
        $usertype = $row['usertype'];
    }
    if ($usertype == 'Employee') {
         echo "<script>
            alert('Success! $staffID');
            window.location.href='../html/staffdashboard.html';
            </script>";
    } else if ($usertype == 'Employer') {
        echo "<script>
            alert('Success! $staffID');
            window.location.href='../html/admindashboard.html';
            </script>";
    } else {
        echo "<script type='text/javascript'>alert('Failed! Please enter correct email or password!');history.go(-1)</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('Failed! Please enter correct email or password!');history.go(-1)</script>";
}
