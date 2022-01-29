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
            $image = $row['image'];
            $name = $row['name'];
        }
    }
} else {
?>
    echo "<script>
        alert('Sorry, Please Login account first.');
        window.location.href = '../html/loginpage.php';
    </script>";
<?php
}

$date = date("Ymd");
$nowFormat = date('H:i:s');

if (isset($_POST['addactivities'])) {

    $PublicIP = $_SERVER['REMOTE_ADDR'];
    //Uses ipinfo.io to get the location of the IP Address, you can use another site but it will probably have a different implementation
    $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
    //Breaks down the JSON object into an array
    $json     = json_decode($json, true);
    //This variable is the visitor's county
    $country  = $json['country'];
    //This variable is the visitor's region
    $region   = $json['region'];
    //This variable is the visitor's city
    $city     = $json['city'];

    $activitiesTitle = $_POST["title"];
     
    $activitiesStartDate = date('Y-m-d H:i:s', strtotime($_POST['startdate']));
    $activitiesEndDate = date('Y-m-d H:i:s', strtotime($_POST['enddate']));
    $activitiesDescirption = $_POST["description"];
    $activitiesFile = $_POST["filesubmit"];
    $activitiesImage = $_POST["imagesubmit"];
    $activitiesStatus = $_POST["optionsRadios"];
    $activitiesLocation = "$city, $region, $country";

if ((strtotime($_POST['startdate'])) > (strtotime($_POST['enddate'])))
{
    echo "<script>
            alert('Failed Add! your end date is small than start date');
            window.location.href='../html/addactivitiespage.php';
            </script>";
}
else{
    $query = "INSERT INTO tbl_activities(activitiesID,staffID,activitiesTitle,activitiesStartDate,activitiesEndDate,activitiesDescirption,activitiesFile,activitiesImage,activitiesStatus,activitiesLocation) VALUES('$activitiesTitle-$staffID','$staffID','$activitiesTitle','$activitiesStartDate','$activitiesEndDate','$activitiesDescirption','$activitiesFile','$activitiesImage','$activitiesStatus','$activitiesLocation')";
    if (mysqli_query($conn, $query)) {
         echo "<script>
            alert('Success Add! $activitiesTitle');
            window.location.href='../html/staffdashboard.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>alert('Failed Add!');history.go(-1)</script>";
    }
}
    
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>StaffDashboard</title>
    <!--Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css">
    <!-- skin color -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/skin-purple.min.css">
    <!-- table -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!--digital clock-->
    <link rel="stylesheet" href="../css/digitalclock.css">
    <!-- analogclock -->
    <link rel="stylesheet" href="../css/analogclock.css">
    <link rel="stylesheet" href="../css/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<body class="hold transition skin-purple sidebar-mini ">
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
                $image = $row['image'];
                $name = $row['name'];
            }
        }
    } else {
    ?>
        echo "<script>
            alert('Sorry, Please Login account first.');
            window.location.href = '../html/loginpage.php';
        </script>";
    <?php
    }
    ?>


    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="admindashboard.html" class="logo">
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg" style="font-family:Lato, sans-serif;letter-spacing: 4px;"><b>Work</b>ACT</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">


                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo $image ?>" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo $image ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $name ?>

                                        <small> Staff ID:<?php echo $staffID ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->


                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="manageprofile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" onclick="logOut()" class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $image ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $name ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div><br>


                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li><a href="../html/staffdashboard.php"><i class="fa fa-file"></i> <span>Dashboard</span></a></li>
                    <li class="header">ACTIVITIES MANAGEMENT</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li class="active"><a href="#"><i class="fa fa-plus"></i> <span>Add Activities</span></a></li>
                    <li><a href="../html/viewactivitiespage.php"><i class="fa fa-table"></i> <span>View Activities</span></a></li>
                    <li class="header">LEAVE MANAGEMENT</li>
                    <li><a href="../html/addleavepage.php"><i class="fa fa-plus"></i> <span>Add Leave</span></a></li>


                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <span>
                    <h2>
                        Add Activities
                    </h2>
                    <small>
                        <ol class="breadcrumb" style="background-color: rgba(248, 244, 244, 0); position: absolute; top:6%; left:0.3%">

                            <li><a href="#"> Home</a></li>
                            <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li class="active"><i class="fa fa-plus"></i> Add Activities</a></li>

                        </ol>
                    </small>
                </span>

            </section><br>

            <!-- Main content -->
            <section>
                <form method="post">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">New Activities</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" placeholder="Enter ..." name="title">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="Planning">
                                                    Planning
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="Pending">
                                                    Pending
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="Done">
                                                    Done
                                                </label>
                                            </div>
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class="form-group">
                                                <label>Start Date:</label>
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" name="startdate" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-sm-6'>
                                            <div class="form-group">
                                                <label>End Date:</label>
                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input type='text' class="form-control" name="enddate" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-12'>
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">File Submit</label>
                                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="filesubmit">
                                            </div>
                                        </div>
                                        <div class='col-12'>
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Image Submit</label>
                                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagesubmit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-12' style='padding: 15px'>
                                    <button type="submit" class="btn btn-info" id="addactivities" style="width:120px;" name="addactivities">Submit</button>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </section>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Created by Spider.com
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022 <a href="#"><b>Work</b>ACT</a>.</strong> All rights reserved.
    </footer>

    </div>
    <!-- ./wrapper -->

    <script>
        function logOut() {
            window.location.assign("../html/logout.php?");
            alert("Successfully Log Out.");
            window.location.assign("loginpage.php");
        }
        $(function() {
            $('#datetimepicker1').datetimepicker();
        });
        $(function() {
            $('#datetimepicker2').datetimepicker();
        });
    </script>


    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
    <!-- Bootstrap 3.3.6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
</body>

</html>