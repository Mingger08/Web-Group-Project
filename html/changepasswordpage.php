<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="../css/login.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>WorkAct- created by Spider.com</title>

    <link href="../css/login.css" rel="stylesheet">
        <style>
        body {
    height: 100%;
}

.modal-contentforget {
    padding-top: 80px;
    padding-bottom: 4px;
    text-decoration-color: #fff;
}

.modal-contentforget {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
}


.forgetform .form-floating:focus-within {
    z-index: 2;
}

.forgetform input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}


    </style>
</head>

<body style="background-color:#605CA8;">
    <!-- As a heading -->
    <?php
                session_start();
                error_reporting(0);
                include("dbconnect.php");
                $email = $_SESSION['email'];
                $password = $_SESSION['password'];?>
    <!--<nav class="navbar navbar-dark bg-dark">-->
    <!--    <div class="container-fluid">-->
    <!--        <span class="navbar-brand mb-0 h1">WorkAct</span>-->

    <!--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"-->
    <!--            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">-->
    <!--            <span class="navbar-toggler-icon"></span>-->
    <!--        </button>-->
    <!--        <div class="collapse navbar-collapse" id="navbarNav">-->
    <!--            <ul class="navbar-nav">-->
    <!--                <li class="nav-item">-->
    <!--                    <a class="nav-link active" aria-current="page" href="#">Home</a>-->
    <!--                </li>-->
    <!--                <li class="nav-item">-->
    <!--                    <a class="nav-link" href="../html/Spider.html">About Team</a>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</nav>-->
 <div class = "row">
      <div class="row justify-content-end">
                    <a class="btn-close" aria-label="Close" href="manageprofile.php" style="background-color:#fff"></a>
                </div>

    <div class="container" >
        
        <div class="row text-center">
            <div class="col-12"">
                <h2>Change Account Password</h2>
                <div class="row justify-content-center">
                    <div class="col-4 " style="background-color: rgba(255, 255, 255, 0.473);">
                       
                        <div class="modal-contentforget">


                            <form name="forgetform" action="../html/changepassword.php"
                                onSubmit="return changepassformValidation();" method="POST">
                                <!--Text Field Container-->
                                <div class="containerforget">
                                    <h5 align="center">Reset Password</h5><br>
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="<?php echo $email ?>" readonly>
                                        <label for="floatingInput">Email address</label>
                                    </div><br>
                                     <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingPassword" name="tempass" placeholder="Old Password/ Temporary Password" required>
                                            <label for="floatingPassword">Old Password/ Temporary Password</label>
                                        </div><br>
                                     <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingConPassword" name="conpassword" placeholder="Confirm Password" required>
                                            <label for="floatingConPassword">Confirm Password</label>
                                        </div>
                                        <br>
                                    <br>
                                    <div class="rowforget" align="center">
                                        <button class="w-100 btn btn-lg btn-primary" style="background-color: #605CA8; font-size: 16px" type="submit" name="change">Reset Password</button>
                                    </div>
                                </div>
                                <br><br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div><br><br><br><br>
          <footer class="container-fluid text-center">
       
        <p>Created by Spider.com. <strong>Copyright &copy; 2022 <a href="#"><b>Work</b>ACT</a>.</strong> All rights
          reserved.</p>
      </footer>
        <script>
             function changepassformValidation() {
            var password = document.signupform.password;
            var cpassword = document.signupform.conpassword;
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
</body>

</html>