<?php
session_start();
error_reporting(0);
include("dbconnect.php");

$email = $_POST["email"];
$IC = $_POST['icnumber'];
$name = $_POST['name'];
$department = $_POST['department'];
$departmentPosition = $_POST['departmentPosition'];
$gender = $_POST['gender'];
$phoneNum = $_POST['phone'];
$nationality = $_POST['nationality'];
$AddressLine1 = $_POST['add1'];
$AddressLine2 = $_POST['add2'];
$Postcode = $_POST['pos'];
$Country = $_POST['coun'];
$StateRegion = $_POST['state'];

$sqlupdate  = "UPDATE tbl_user SET IC='$IC', name='$name', departmentPosition='$departmentPosition', gender='$gender', phoneNum='$phoneNum', department='$department', nationality='$nationality', AddressLine1='$AddressLine1', AddressLine2='$AddressLine2', Postcode='$Postcode', Country='$Country', StateRegion='$StateRegion' WHERE email = '$email' ";

 if(mysqli_query($conn, $sqlupdate)){
    
    echo "<script type='text/javascript'>alert('Successfully Update');history.go(-1)</script>";
} else {
    echo "<script type='text/javascript'>alert('Failed Update!');history.go(-1)</script>";
}


?>
