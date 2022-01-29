<?php
    error_reporting(0);
    include_once("dbconnect.php");
    $email = $_GET['email'];
    $password = $_GET['key'];
    $passwordsha=sha1($password);
    $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password='NotVerify'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tbl_user SET password = '$passwordsha' WHERE email = '$email'";
        if ($conn->query($sqlupdate) === TRUE){
            echo 'success';
        }else{
            echo 'failed';
        }   
    }else{
        echo "failed";
    }
    
    
?>