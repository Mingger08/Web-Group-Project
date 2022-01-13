<?php
session_start();
error_reporting(0);
include("dbconnect.php");

$staffid = $_POST["staffid"];
$email = $_POST["email"];
$password = $_POST["password"];
$pass_sha1 = sha1($password);

$query = "INSERT INTO `tbl_user`(`fname`,`lname`,`email`,`password`) VALUES('" . strtoupper($firstname) . "','" . strtoupper($lastname) . "','" . strtolower($email) . "','$pass_sha1')";
if ($conn->query($sqladd) === TRUE) {

    $target_dir = "../images/user/";
    $target_file = $target_dir . basename($_FILES["imageToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    $decoded_string = base64_decode($encoded_string);
    $filename = $staffid;
    $path = '../images/user/' . $filename . '.png';
    $is_written = file_put_contents($path, $decoded_string);

    echo "<script type='text/javascript'>alert('Successfully Registered');history.go(-1)</script>";
} else {
    echo "<script type='text/javascript'>alert('Email Already Exists!');history.go(-1)</script>";
}

?>
