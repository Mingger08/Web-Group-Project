<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/hubbuddi/public_html/workact/html/PHPMailer/Exception.php';
require '/home8/hubbuddi/public_html/workact/html/PHPMailer/PHPMailer.php';
require '/home8/hubbuddi/public_html/workact/html/PHPMailer/SMTP.php';

include_once("dbconnect.php");
if (isset($_POST['forget'])) {
$email = $_POST['email'];
$pass=generateStrongPassword();
$password=sha1($pass);

$emailReset = "SELECT * FROM tbl_user WHERE email='$email'";
$result = $conn->query($emailReset);

if($result->num_rows>0){
    $sqlupdate= "UPDATE tbl_user SET password = '$password' WHERE email='$email'";
    if($conn->query($sqlupdate)===TRUE){
            echo "<script type='text/javascript'>alert('Temporary password has been successfully sent to the mail. Please check and re-login again.');history.go(-1)</script>";
            sendEmail($email,$pass);
    }
    else{
        echo "<script type='text/javascript'>alert('Failed.');history.go(-1)</script>";
        }
}
else{
    echo "<script type='text/javascript'>alert('This email does not exist.');history.go(-1)</script>";
}    
}

if(isset($_POST['change'])) {
$email = $_POST['email'];
$tpass= $_POST['tempass'];
$temporypass = sha1($tpass);
$pass= $_POST['password'];
$password=sha1($pass);

$emailReset = "SELECT * FROM tbl_user WHERE email='$email' AND password='$temporypass'";
$result = $conn->query($emailReset);

if($result->num_rows>0){
     while ($row = $result->fetch_assoc()) {
                $staffID = $row['staffID'];
            }
    
    $sqlupdate= "UPDATE tbl_user SET password = '$password' WHERE email='$email'";
    if($conn->query($sqlupdate)===TRUE){
             echo "<script>
            alert('Success! $staffID');
            window.location.href='../html/loginpage.php';
            </script>";
        
    }
    else{
        echo "<script type='text/javascript'>alert('Failed.');history.go(-1)</script>";
        }
}
else{
    echo "<script type='text/javascript'>alert('Failed.$email');history.go(-1)</script>";
}    
}
function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'lud')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';

	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[tweak_array_rand(str_split($set))];
		$all .= $set;
	}

	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[tweak_array_rand($all)];

	$password = str_shuffle($password);

	if(!$add_dashes)
		return $password;

	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}


function tweak_array_rand($array){
	if (function_exists('random_int')) {
		return random_int(0, count($array) - 1);
	} elseif(function_exists('mt_rand')) {
		return mt_rand(0, count($array) - 1);
	} else {
		return array_rand($array);
	}
}

function sendEmail($email,$pass){
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
    $mail->Subject = "Temporary Password";
    $mail->Body  = "We have received your forgot password request, 
    your temporary password is <strong>$pass</strong>. 
    Please use the temporary password to re-login again.<br><br>
    Thank You.<br><br>Sincerely,<br>Customer Service<br>WorkAct.<br><br>
    <center><strong>Please do not reply to this email.</strong></center>";;

    $mail->send();
}
?>