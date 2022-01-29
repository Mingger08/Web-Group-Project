<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="//code.jquery.com/jquery.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">


    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>

    <style>
        .image_area {
            position: relative;
        }
        
        img {
            display: block;
            max-width: 100%;
        }
        
        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
        
        .modal-lg {
            max-width: 1000px !important;
        }
        
        .overlay {
            position: absolute;
            bottom: 1px;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }
        
        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
        }
        
        .text {
            color: #333;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <form method="post" name="profileform" action="../html/updateprofile.php">
            <div class="row">
                
                <?php
                session_start();
                error_reporting(0);
                include("dbconnect.php");
                $email = $_SESSION['email'];
                $password = $_SESSION['password'];
                if (isset($_SESSION["email"])) {
                    $sqlloaduser = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' ";
                    $result = $conn->query($sqlloaduser);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            extract($row);
                            $staffID = $row['staffID'];
                            $IC = $row['IC'];
                            $name = $row['name'];
                            $age = $row['age'];
                            $department = $row['department'];
                            $departmentPosition = $row['departmentPosition'];
                            $gender = $row['gender'];
                            $phoneNum = $row['phoneNum'];
                            $nationality = $row['nationality'];
                            $AddressLine1 = $row['AddressLine1'];
                            $AddressLine2 = $row['AddressLine2'];
                            $Postcode = $row['Postcode'];
                            $Country = $row['Country'];
                            $StateRegion = $row['StateRegion'];
                            $usertype = $row['usertype'];
                        }
                    }
                ?>

                    <?php
                } else {
                ?>
                        echo "
                        <script>
                            alert('Sorry, Please Login account first.');
                            window.location.href = '../html/loginpage.php';
                        </script>";
                        <?php
                }
                ?>
                <?php
                if($usertype == 'Employer'){
                ?>
                <div class="row justify-content-end">
                    <a class="btn-close" aria-label="Close" href="admindashboard.php"></a>
                </div>
                 <?php
                } else {
                ?>      
                <div class="row justify-content-end">
                    <a class="btn-close" aria-label="Close" href="staffdashboard.php"></a>
                </div>
                <?php
                }
                ?>
                            <div class="col-md-3 border-right">
                                <div class="p-3 py-5">
                                    <h4 align="center">Profile Picture</h4>
                                    <br />
                                    <div></div>
                                    <div class="col-md-3">&nbsp;</div>
                                    <div class="col-md-12">
                                        <div class="image_area">

                                            <label for="upload_image">
                                    <img src="<?php echo $image ?>" id="uploaded_image"
                                        class="img-responsive rounded-circle" />
                                    <div class="overlay">
                                        <span class="text ">Click to Change Profile Image</span>
                                    </div>
                                    <input type="file" name="image" class="image" id="upload_image"
                                        style="display:none" />
                                </label>

                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Crop Image Before Upload</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="img-container">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <img src="" id="sample_image" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="preview"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="crop" class="btn btn-primary">Crop</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <span class="font-weight-bold">Staff</span><span class="text-black-50">ID: <?php echo $staffID ?></span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-10"><label class="labels">Name</label><input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $name ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">IC-Number</label><input type="text" class="form-control" placeholder="IC-Number" name="icnumber" value="<?php echo $IC ?>"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="form-group col-md-6">
                                            <label for="inputgender" class="form-label">Gender</label>
                                            <input class="form-control" list="genOptions" onfocus=this.value='' id="gender" name="gender" required value="<?php echo $gender ?>">
                                            <datalist id="genOptions">
                                            <option value="Male">
                                            <option value="Female">
                                            <option value="Other">
                                        </datalist>

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputnationality" class="form-label">Nationality</label>
                                            <input class="form-control" list="natOptions" onfocus=this.value='' id="nationality" name="nationality" required value="<?php echo $nationality ?>">
                                            <datalist id="natOptions">
                                            <option value="Malaysian">
                                            <option value="Non-Malaysian">
                                            <option value="Other">
                                        </datalist>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control" placeholder="Eg. 0123456789" name="phone" value="<?php echo $phoneNum ?>"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="Enter address line 1" name="add1" value="<?php echo $AddressLine1 ?>"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="Enter address line 2" name="add2" value="<?php echo $AddressLine2 ?>"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="Enter postcode" name="pos" value="<?php echo $Postcode ?>"></div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="Country" name="coun" value="<?php echo $Country ?>"></div>
                                        <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" placeholder="State" name="state" value="<?php echo $StateRegion ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-9"><label class="labels">Email</label><input type="text" class="form-control" placeholder="<?php echo $email ?>" name="email" value="<?php echo $email ?>" readonly></div>
                                         <div class="col-md-2"><label class="labels"></label> <a class="btn" href="changepasswordpage.php">Change Password</a></div>
                                    </div>



                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Working
                                Details</span><span class="border rounded-pill px-3 p-1 add-status bg-danger"></i>&nbsp;<Strong>Active</Strong></span>
                                    </div><br>
                                    <div class="form-group col-md-12">
                                        <label for="inputdepartment" class="form-label">Department</label>
                                        <input class="form-control" list="depOptions" onfocus=this.value='' id="department" name="department" required value="<?php echo $department ?>">
                                        <datalist id="depOptions">
                                            <option value="Department 1">
                                            <option value="Department 2">
                                            <option value="Department 3">
                                        </datalist>
                                    </div><br>
                                    <div class="col-md-12"><label class="labels">Position</label><input type="text" class="form-control" placeholder="Position" name="departmentPosition" value="<?php echo $departmentPosition ?>"></div>
                                </div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                        Profile</button></div>
        </form>
        </div>

        <script>
            $(document).ready(function() {

                var $modal = $('#modal');

                var image = document.getElementById('sample_image');

                var cropper;

                $('#upload_image').change(function(event) {
                    var files = event.target.files;

                    var done = function(url) {
                        image.src = url;
                        $modal.modal('show');
                    };

                    if (files && files.length > 0) {
                        reader = new FileReader();
                        reader.onload = function(event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    }
                });

                $modal.on('shown.bs.modal', function() {
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 3,
                        preview: '.preview'
                    });
                }).on('hidden.bs.modal', function() {
                    cropper.destroy();
                    cropper = null;
                });

                $('#crop').click(function() {
                    canvas = cropper.getCroppedCanvas({
                        width: 400,
                        height: 400
                    });

                    canvas.toBlob(function(blob) {
                        url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            $.ajax({
                                url: 'upload.php',
                                method: 'POST',
                                data: {
                                    image: base64data,
                                },
                                success: function(data) {

                                    $modal.modal('hide');
                                    $('#uploaded_image').attr('src', data);

                                }
                            });
                        };
                    });
                });

            });


            function profileformValidation() {
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>