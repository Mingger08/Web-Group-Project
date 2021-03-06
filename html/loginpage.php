<?PHP
session_start();
error_reporting(0);
include("dbconnect.php");
$sqlloadleave = "SELECT * FROM tbl_leave WHERE status = 'Approve'";
$result = $conn->query($sqlloadleave);
$date = date("Ymd");
$nowFormat = date('H:i:s');
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $thisemployeeStaffID = $row['staffID'];
            $dayStart = $row['leave_day_start'];
            $dayEnd = $row['leave_day_end'];
            $todayDate = date('Y-m-d');
            $todayDate = date('Y-m-d', strtotime($todayDate));
            $DateBegin = date('Y-m-d', strtotime($dayStart));
            $DateEnd = date('Y-m-d', strtotime($dayEnd));
            if (($todayDate >= $DateBegin) && ($todayDate <= $DateEnd)){
                 $query = "INSERT INTO tbl_attendance(attendanceID,staffID,status,date,total_work_time) VALUES('$todayDate-$thisemployeeStaffID','$thisemployeeStaffID','On Leave','$date','0')";
                if (mysqli_query($conn, $query)) {
                    
                } else {
                }
            }
        }

    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="canonical" href="../css/login.css"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>WorkAct- created by Spider.com</title>

</head>



   <body style="background-color: rgba(226, 226, 226, 0.473);">
    <!-- As a heading -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mainpage.php"><b>Work</b>ACT</a>
                   
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="registerpage.php">SIGN UP</a></li>
                    <li><a href="loginpage.php"><i class="fa fa-lock"></i> LOGIN</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container" style="padding: 150px 0 0 0;">
            <div class="form-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
                            <div class="form-container">
                                <div class="form-icon">
                                   <img src="../images/monitor.png"   width="300" 
                                   height="150">
                                    <span class="signup"><a href="registerpage.php">Don't have account? Signup</a></span>
                                </div>
                                <form class="form-horizontal" name="loginform" action="../html/loginaccount.php" onSubmit="return loginformValidation();" method="POST">
                                    <h3 class="title">Please Log In</h3>
                                    
                                   
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control"  type="email" name="email" placeholder="name@example.com">
                                    </div>
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-control text-center">
                                        <input type="checkbox" value="remember-me">  Remember me
                                    </div>
                                    <button class="btn signin" type="submit">Login</button>
                                    <span class="forgot-pass"><a href="forgetpassword.php">Forgot Username/Password?</a></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br><br>
 

    <footer class="container-fluid text-center">
       
        <p>Created by Spider.com. <strong>Copyright &copy; 2022 <a href="#"><b>Work</b>ACT</a>.</strong> All rights
          reserved.</p>
      </footer>

    <script>
        function loginformValidation() {
            /*Get Position*/
            var position = document.getElementById("position");
            var email = document.loginform.email;
            var password = document.loginform.password;

            /*Validate*/
            var upper_lower_number = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            var val_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            /*Email Format*/
            if (!email.value.match(val_email)) {
                alert("You have entered an invalid email address!");
                email.focus();
                return false;
            }
            /*Password Contain Only Uppercase, Lowercase,min 8 length */
            else if (!password.value.match(upper_lower_number)) {
                alert("Format password is wrong.");
                password.focus();
                return false;
            }
        }
        
    </script>

</body>

</html>