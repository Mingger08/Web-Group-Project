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

<body style="background-color: rgba(226, 226, 226, 0.473);">
    <!-- As a heading -->
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
  
    
         

    <div class="container">
        <div class="row text-center">
            <div class="col-12 ">
                <h2>Change Account Password</h2>
                <div class="row justify-content-center">
                    <div class="col-6 " style="background-color: rgba(119, 119, 119, 0.473);">
                         <div class="row justify-content-end">
                            <a class="btn-close" aria-label="Close" href="loginpage.php"></a>
                        </div>
                        <div class="modal-contentforget">


                            <form name="forgetform" action="../html/changepassword.php"
                                onSubmit="return forgetformValidation();" method="POST">
                                <!--Text Field Container-->
                                <div class="containerforget">
                                    <h4 align="center">Forget Password?</h4><br><br>
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    <br><br><br>
                                    <div class="rowforget" align="center">
                                        <button class="w-75 btn btn-lg btn-primary" type="submit">Reset Password</button>
                                    </div>
                                </div>
                                <br><br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function forgetformValidation() {
                var email = document.forgetform.email;

                var val_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                /*Email Format*/
                if (!email.value.match(val_email)) {
                    alert("You have entered an invalid email address!");
                    email.focus();
                    return false;
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