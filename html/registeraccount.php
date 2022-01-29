<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/hubbuddi/public_html/workact/html/PHPMailer/Exception.php';
require '/home8/hubbuddi/public_html/workact/html/PHPMailer/PHPMailer.php';
require '/home8/hubbuddi/public_html/workact/html/PHPMailer/SMTP.php';

include_once("dbconnect.php");

$staffid = $_POST["staffid"];
$email = $_POST["email"];
$password = $_POST["password"];
$pass_sha1 = sha1($password);
$usertype = $_POST["usertype"];

$query = "INSERT INTO `tbl_user`(`staffID`,`email`,`password`,`usertype`,`IC`,`name`,`age`,`image`) VALUES('$staffid','$email','NotVerify','$usertype','--','--','0','../images/Imageupload.png')";
if(mysqli_query($conn, $query)){

    echo "<script type='text/javascript'>alert('Successfully Registered, Please verify your email.');history.go(-1)</script>";
    sendEmail($email,$password);
} else {
    echo "<script type='text/javascript'>alert('Email Already Exists!');history.go(-1)</script>";
}

function sendEmail($email,$password){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0; 
    $mail->isSMTP(); 
    $mail->Host= 'mail.hubbuddies.com'; 
    $mail->SMTPAuth= true; 
    $mail->Username= 'workact@hubbuddies.com'; 
    $mail->Password= 'd0MhEGUM}X8J';
    $mail->SMTPSecure= 'tls';         
    $mail->Port= 587;
    
    $mail->setFrom("workact@hubbuddies.com","WorkAct");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Verify Account";
    $mail->Body  = "We have received your register account request, 
    your account need <a href='https://hubbuddies.com/workact/html/verifyaccount.php?email=".$email."&key=".$password."'>click me</a> to verify for this system.<br><br>
    Thank You.<br><br>Sincerely,<br>Customer Service<br>WorkAct<br><br>
    <center><strong>Please do not reply to this email.</strong></center>";;

    $mail->send();
}
?>

