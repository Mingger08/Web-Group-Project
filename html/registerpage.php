<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="../css/register2.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../css/register2.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>WorkAct- created by Spider.com</title>
    

    <!-- <link href="../css/register.css" rel="stylesheet"> -->
    <script src="../js/register.js"></script>

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
                                    <span class="login"> <p>Already have account? Please <a href="loginpage.php">login your account</a>.</p></a></span>
                                </div>
                                <form class="form-horizontal" name="signupform" action="../html/registeraccount.php" onSubmit="return signupformValidation();" method="POST" enctype="multipart/form-data">
                                    <h3 class="title">Please Register</h3>
                                    
                                   
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-user"></i></span>
                                        <input class="form-control"  type="text" name="staffid" placeholder="Staff ID" required="true">
                                    </div>
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                        <input class="form-control"  type="email"  name="email" placeholder="name@example.com" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" type="password" placeholder="Password" name="password"  required>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-icon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" type="password" placeholder="Confirm Password" name="conpassword"  required>
                                    </div>
                                        <div class="dropdown">
                                            <h6>Register as:</h6>
                                            
                                            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default">
                    <input type="radio" id="btnradio1" name="usertype" value="Employee" /> Employee
                </label> 
                <label class="btn btn-default">
                    <input type="radio" id="btnradio2" name="usertype" value="Employer" /> Employer
                </label> 
            </div>
                                        </div><br><br><br>
                                        
                                    <button class="btn-signin" style="position:relative; bottom: -20px" type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br><br><br>

    <footer class="container-fluid text-center">
       
        <p>Created by Spider.com. <strong>Copyright &copy; 2022 <a href="#"><b>Work</b>ACT</a>.</strong> All rights
          reserved.</p>
      </footer>
  
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "../images/Imageupload.png";
        }

        function signupformValidation() {
            var staffid = document.signupform.staffid;
            var email = document.signupform.email;
            var password = document.signupform.password;
            var cpassword = document.signupform.conpassword;
            var usertype = document.signupform.usertype;
            /*Validate*/
            var all_letters = /^[A-Za-z "]+$/;
            var val_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            var lower_num = /^[a-z0-9]+$/;
            var upper_lower_number = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

            /*Email Format*/
            if (!email.value.match(val_email)) {
                alert("You have entered an invalid email address!");
                email.focus();
                return false;
            }
            /*Password Contain Only Uppercase, Lowercase,min 8 length*/
            else if (!password.value.match(upper_lower_number)) {
                alert("Format password is wrong. Please insert the password contains at least one uppercase, one lowercase, one number and the minimum password length is eight.");
                password.focus();
                return false;
            }
            /*Password and confirm password must be same*/
            else if (password.value != cpassword.value) {
                alert("Password and confirm password is not same.");
                cpassword.focus();
                return false;
            }
        }
    </script>

</body>

</html>