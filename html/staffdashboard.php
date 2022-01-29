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
    echo "
    <script>
        alert('Sorry, Please Login account first.');
        window.location.href = '../html/loginpage.php';
    </script>";
<?php
}



$date = date("Ymd");
$nowFormat = date('H:i:s');

if (isset($_POST['punchin'])) {


    $sqlsearch = "SELECT * FROM tbl_attendance WHERE staffID='$staffID' AND date=current_date";
    $result = $conn->query($sqlsearch);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $punch_in_2 = $row['punch_in_2'];
        }
        if ($punch_in_2 === null) {
            $sqlupdate  = "UPDATE tbl_attendance SET punch_in_2='$nowFormat', status='punch in 2' WHERE date='$date' AND staffID='$staffID'";

            if (mysqli_query($conn, $sqlupdate)) {
                echo "<script type='text/javascript'>alert('Good Afternoon, Successfully Punch in');history.go(-1)</script>";
            } else {
                echo "<script type='text/javascript'>alert('Sorry, Failed Punch in 2');history.go(-1)</script>";
            }
        } else {
            $sqlupdate  = "UPDATE tbl_attendance SET punch_in_3='$nowFormat', status='punch in 3' WHERE date='$date' AND staffID='$staffID'";
            if (mysqli_query($conn, $sqlupdate)) {
                echo "<script type='text/javascript'>alert('Good Evening, Successfully Punch in');history.go(-1)</script>";
            } else {
                echo "<script type='text/javascript'>alert('Sorry, Failed Punch in 3');history.go(-1)</script>";
            }
        }
    } else {

        $query = "INSERT INTO tbl_attendance(attendanceID,staffID,status,date,punch_in_1,total_work_time) VALUES('$date-$staffID','$staffID','punch in 1','$date','$nowFormat','0')";
        if (mysqli_query($conn, $query)) {
            echo "<script type='text/javascript'>alert('Good Morning, Successfully Punch in');history.go(-1)</script>";
        } else {
            echo "<script type='text/javascript'>alert('Sorry, Failed Punch in!');history.go(-1)</script>";
        }
    }
}
if (isset($_POST['punchout'])) {


    $sqlsearch = "SELECT * FROM tbl_attendance WHERE staffID='$staffID'AND date=current_date";
    $result = $conn->query($sqlsearch);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $punch_in_1 = $row['punch_in_1'];
            $punch_in_2 = $row['punch_in_2'];
            $punch_in_3 = $row['punch_in_3'];
            $punch_out_1 = $row['punch_out_1'];
            $punch_out_2 = $row['punch_out_2'];
            $total_work_time = $row['total_work_time'];
            $totalworkmontyh +=$total_work_time;
        }
        
        if ($punch_out_1 === null) {
            $hourdiff = round((strtotime($nowFormat) - strtotime($punch_in_1)) / 3600, 1);
            $sqlupdate  = "UPDATE tbl_attendance SET punch_out_1='$nowFormat', status='punch out 1', total_work_time='$hourdiff' WHERE date='$date' AND staffID='$staffID'";

            if (mysqli_query($conn, $sqlupdate)) {
                echo "<script type='text/javascript'>alert('Good Afternoon, Successfully Punch out');history.go(-1)</script>";
            } else {
                echo "<script type='text/javascript'>alert('Sorry, Failed Punch out 1$hourdiff');history.go(-1)</script>";
            }
        } else {
            if ($punch_out_2 === null) {
                $hourdiff = round((strtotime($nowFormat) - strtotime($punch_in_2)) / 3600, 1) + $total_work_time;
                $sqlupdate  = "UPDATE tbl_attendance SET punch_out_2='$nowFormat', status='punch out 2', total_work_time='$hourdiff'  WHERE date='$date' AND staffID='$staffID'";

                if (mysqli_query($conn, $sqlupdate)) {
                    echo "<script type='text/javascript'>alert('Good Evening, Successfully Punch out');history.go(-1)</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Sorry, Failed Punch in 2');history.go(-1)</script>";
                }
            } else {
                $hourdiff = round((strtotime($nowFormat) - strtotime($punch_in_2)) / 3600, 1) + $total_work_time;
                $sqlupdate  = "UPDATE tbl_attendance SET punch_out_3='$nowFormat', status='punch out 3', total_work_time='$hourdiff' WHERE date='$date' AND staffID='$staffID'";
                if (mysqli_query($conn, $sqlupdate)) {
                    echo "<script type='text/javascript'>alert('Good Night, Successfully Punch out');history.go(-1)</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Sorry, Failed Punch in 3');history.go(-1)</script>";
                }
            }
        }
    }
}
$month = date('m');
    $sqlsearch = "SELECT * FROM tbl_attendance WHERE staffID='$staffID' AND MONTH(date) = '$month'";
    $result = $conn->query($sqlsearch);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            extract($row);
            $total_work_time = $row['total_work_time'];
            $totalworkmontyh +=$total_work_time;
        }
         echo "<script type='text/javascript'>alert('$totalworkmontyh,$sqlsearch');history.go(-1)</script>";
    }else{
        
    }
   
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        function toggle() {
            var punchin = document.getElementById('PunchIn');

            var displaySetting = punchin.style.display;

            if (displaySetting == 'block') {
                punchin.style.display = 'none';
                $("#PunchOut").show();
            } else {
                punchin.style.display = 'block';
                $("#PunchIn").show();
            }
        }
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
        echo "
        <script>
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
                        <p>
                            <?php echo $name ?>
                        </p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div><br>


                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="active"><a href="#"><i class="fa fa-file"></i> <span>Dashboard</span></a></li>
                    <li class="header">ACTIVITIES MANAGEMENT</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li><a href="../html/addactivitiespage.php"><i class="fa fa-plus"></i> <span>Add Activities</span></a></li>
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
                        Dashboard
                    </h2>
                    <small>
                        <ol class="breadcrumb" style="background-color: rgba(248, 244, 244, 0); position: absolute; top:6%; left:0.3%">

                            <li><a href="#"> Home</a></li>
                            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                        </ol>
                    </small>
                </span>

            </section><br>

            <!-- Main content -->
        
            <!-- /.content -->

            <!-- Left Column -->
            <section>
                <div class="container">
                    <div class="row">
                        <section class="col-md-7 connectedSortable">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title"> <i class="fa fa-pie-chart">&nbsp;&nbsp</i>Your Leave Application</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <!-- box-body -->
                                <div class="box-body">
                                        <?php
        session_start();
        error_reporting(0);
        include("dbconnect.php");
        $email = $_SESSION['email'];
        $year =$_POST['year'];
        $country=$_POST['country'];
        $sqlloadleave = "SELECT * FROM tbl_leave WHERE staffID='$staffID'";
        
    ?>
              <table id="example" class="table table-striped table-bordered"  style="width:100%" >
                <thead>
                  <tr>
                    <th>Leave ID</th>
                    <th>Reason Employee</th>
                    <th>Leave Date Start</th>
                    <th>Leave Date End</th>
                    <th>Status</th>
                    <th>Reason Employee</th>
                   
                    
                  </tr>
                </thead>
                <tbody>
                 
                  <tr>
                    <?php
	    $result = $conn->query($sqlloadleave);
	    if ($result->num_rows > 0){
	        while ($row = $result -> fetch_assoc()){
	            extract($row);
	   ?>
	   <tr>
	       
                <td><?php echo $leaveID ?></td>
                <td><?php echo $reason_employee ?></td>
                <td><?php echo $leave_day_start ?></td>
                <td><?php echo $leave_day_end ?></td>
                <td><?php echo $status ?></td>
                <td><?php echo $reason_employer ?></td>
                </tr>
            <?php
	        }
	    }
          ?>  
                  </tr>
                </tbody>

              </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>


                        <!-- Right Column -->
                        <section>
                            <div class="container">
                                <div class="row">
                                    <section class="col-md-5 connectedSortable">
                                        <div class="box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"> <i class="fa fa-clock-o">&nbsp;&nbsp</i>Take Attendance</h3>
                                                <h3 class="box-title"> &nbsp; &nbsp;&nbsp;</i>Working Hour This Month: <?php echo $totalworkmontyh ?> hours</h3>

                                            </div>
                                            <!-- /.box-header -->
                                            <!-- box-body -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div id="clockContainer">
                                                        <div id="hour"></div>
                                                        <div id="minute"></div>
                                                        <div id="second"></div>
                                                    </div>
                                                    <script src="../js/analogclock.js"></script>
                                                </div>
                                                <!-- /.row -->
                                                <div class="row">
                                                    <div id="digital-clock"></div>
                                                    <script src="../js/digitalclock.js"></script>
                                                </div>
                                                <?php
                                                $sqlloaduser = "SELECT * FROM tbl_attendance WHERE staffID = '$staffID' AND date=current_date";
                                                $result = $conn->query($sqlloaduser);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        extract($row);
                                                        $statuspunch = $row['status'];
                                                        $punch_in_1 = $row['punch_in_1'];
                                                        $punch_in_2 = $row['punch_in_2'];
                                                        $punch_in_3 = $row['punch_in_3'];
                                                        $punch_out_1 = $row['punch_out_1'];
                                                        $punch_out_2 = $row['punch_out_2'];
                                                        $punch_out_3 = $row['punch_out_3'];
                                                    }
                                                } else {
                                                    $statuspunch = 'no';
                                                }

                                                if ($statuspunch == 'no') {
                                                ?>
                                                    <!-- /.row -->
                                                    <div class="row">
                                                        <div class="container" style="width:100%; text-align:center;">

                                                            Last updated on --
                                                        </div>

                                                        <!-- /.row -->
                                                        <div class="row">

                                                            <div class=container style="width:100%; text-align:center;">

                                                                <form method="POST">
                                                                    <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                    <button type="submit" class="btn btn-info" id="PunchIn" style="width:120px;" name="punchin">Punch In</button>
                                                                </form>

                                                            <?php
                                                        } else if ($statuspunch == 'On Leave') {
                                                            ?>
                                                                <!-- /.row -->
                                                                <div class="row">
                                                                    <div class="container" style="width:100%; text-align:center;">

                                                                        You are on leave.
                                                                    </div>

                                                                    <!-- /.row -->
                                                                    <div class="row">

                                                                        <div class=container style="width:100%; text-align:center;">
                                                                            <form method="POST">
                                                                            </form>
                                                                        <?php
                                                                    } else if ($statuspunch == 'punch out 1') {
                                                                        ?>
                                                                            <!-- /.row -->
                                                                            <div class="row">
                                                                                <div class="container" style="width:100%; text-align:center;">

                                                                                    Last updated on <?php echo $punch_out_1 ?>
                                                                                </div>

                                                                                <!-- /.row -->
                                                                                <div class="row">

                                                                                    <div class=container style="width:100%; text-align:center;">
                                                                                        <form method="POST">
                                                                                            <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                            <button type="submit" class="btn btn-info" id="PunchIn" style="width:120px;" name="punchin">Punch In</button>
                                                                                        </form>
                                                                                    <?php
                                                                                } else if ($statuspunch == 'punch out 2') {
                                                                                    ?>
                                                                                        <!-- /.row -->
                                                                                        <div class="row">
                                                                                            <div class="container" style="width:100%; text-align:center;">

                                                                                                Last updated on <?php echo $punch_out_2 ?>
                                                                                            </div>

                                                                                            <!-- /.row -->
                                                                                            <div class="row">

                                                                                                <div class=container style="width:100%; text-align:center;">
                                                                                                    <form method="POST">
                                                                                                        <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                        <button type="submit" class="btn btn-info" id="PunchIn" style="width:120px;" name="punchin">Punch In</button>
                                                                                                    </form>
                                                                                                <?php
                                                                                            } else if ($statuspunch == 'punch out 3') {
                                                                                                ?>
                                                                                                    <!-- /.row -->
                                                                                                    <div class="row">
                                                                                                        <div class="container" style="width:100%; text-align:center;">

                                                                                                            Last updated on <?php echo $punch_out_3 ?>
                                                                                                        </div>

                                                                                                        <!-- /.row -->
                                                                                                        <div class="row">

                                                                                                            <div class=container style="width:100%; text-align:center;">
                                                                                                                <form method="POST">
                                                                                                                </form>
                                                                                                                <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                                <button type="submit" class="btn btn-info" id="PunchIn" style="width:120px;" name="punchin">Punch In</button>
                                                                                                            <?php
                                                                                                        } else if ($statuspunch == 'punch in 1') {
                                                                                                            ?>
                                                                                                                <!-- /.row -->
                                                                                                                <div class="row">
                                                                                                                    <div class="container" style="width:100%; text-align:center;">

                                                                                                                        Last updated on <?php echo $punch_in_1 ?>
                                                                                                                    </div>

                                                                                                                    <!-- /.row -->
                                                                                                                    <div class="row">

                                                                                                                        <div class=container style="width:100%; text-align:center;">
                                                                                                                            <form method="POST">
                                                                                                                                <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                                                <button type="submit" class="btn btn-info bg-red" id="PunchOut" style="width:120px;" name="punchout">Punch Out</button>

                                                                                                                            </form>
                                                                                                                        <?php
                                                                                                                    } else if ($statuspunch == 'punch in 2') {
                                                                                                                        ?>
                                                                                                                            <!-- /.row -->
                                                                                                                            <div class="row">
                                                                                                                                <div class="container" style="width:100%; text-align:center;">

                                                                                                                                    Last updated on <?php echo $punch_in_2 ?>
                                                                                                                                </div>

                                                                                                                                <!-- /.row -->
                                                                                                                                <div class="row">

                                                                                                                                    <div class=container style="width:100%; text-align:center;">
                                                                                                                                        <form method="POST">
                                                                                                                                            <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                                                            <button type="submit" class="btn btn-info bg-red" id="PunchOut" style="width:120px;" name="punchout">Punch Out</button>

                                                                                                                                        </form>
                                                                                                                                    <?php
                                                                                                                                } else if ($statuspunch == 'punch in 3') {
                                                                                                                                    ?>
                                                                                                                                        <!-- /.row -->
                                                                                                                                        <div class="row">
                                                                                                                                            <div class="container" style="width:100%; text-align:center;">

                                                                                                                                                Last updated on <?php echo $punch_in_3 ?>
                                                                                                                                            </div>

                                                                                                                                            <!-- /.row -->
                                                                                                                                            <div class="row">

                                                                                                                                                <div class=container style="width:100%; text-align:center;">
                                                                                                                                                    <form method="POST">
                                                                                                                                                        <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                                                                        <button type="submit" class="btn btn-info bg-red" id="PunchOut" style="width:120px;" name="punchout">Punch Out</button>

                                                                                                                                                    </form>

                                                                                                                                                <?PHP
                                                                                                                                            } else {
                                                                                                                                                ?>
                                                                                                                                                    <!-- /.row -->
                                                                                                                                                    <div class="row">
                                                                                                                                                        <div class="container" style="width:100%; text-align:center;">

                                                                                                                                                            Last updated on <?php echo $staffID ?>
                                                                                                                                                        </div>

                                                                                                                                                        <!-- /.row -->
                                                                                                                                                        <div class="row">

                                                                                                                                                            <div class=container style="width:100%; text-align:center;">
                                                                                                                                                                <form method="POST">
                                                                                                                                                                    <input type="hidden" name="staffID" value="<?php echo $staffID ?>">
                                                                                                                                                                    <button type="submit" class="btn btn-info bg-red" id="PunchOut" style="width:120px;" name="punchout">Punch Out</button>
                                                                                                                                                                </form>
                                                                                                                                                            <?php
                                                                                                                                                        }
                                                                                                                                                            ?>
                                                                                                                                                            </div>
                                                                                                                                                        </div>
                                                                                                                                                        <!-- /.row -->
                                                                                                                                                    </div>

                                                                                                                                                </div>
                                                                                                                                                <!-- /.box-body -->
                                                                                                                                            </div>
                                                                                                                                            <!-- /.box -->
                                    </section>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>

            <?php
            session_start();
            error_reporting(0);
            include("dbconnect.php");

            $sqlloadactivities = "SELECT * FROM tbl_activities WHERE staffID = '$staffID'";

            ?>

            <section>
                <div class="container">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user">&nbsp;&nbsp</i>Activities List</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Activities ID</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Descirption</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $result = $conn->query($sqlloadactivities);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                extract($row);
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $activitiesID ?>
                                        </td>
                                        <td>
                                            <?php echo $activitiesTitle ?>
                                        </td>
                                        <td>
                                            <?php echo $activitiesStartDate ?>
                                        </td>
                                        <td>
                                            <?php echo $activitiesEndDate ?>
                                        </td>
                                        <td>
                                            <?php echo $activitiesDescirption ?>
                                        </td>
                                        <td>
                                            <?php echo $activitiesStatus ?>
                                        </td>
                                    </tr>
                            <?php
                                            }
                                        }
                            ?>
                            </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->


                </div>
            </section>

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
        <?PHP

        ?>

        var xValues = ["Present", "On Leave", "Absent"];
        var yValues = [10, 2, 2];
        var barColors = [

            "#00aba9",
            "rgba(238, 241, 18, 0.747)",
            "#b91d47",

        ];

        new Chart("myChart1", {
            type: "doughnut",
            data: {
                labels: xValues,
                display: false,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });

        function logOut() {
            window.location.assign("../html/logout.php?");
            alert("Successfully Log Out.");
            window.location.assign("loginpage.php");
        }
    </script>


    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
    <!-- Bootstrap 3.3.6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>


</body>

</html>