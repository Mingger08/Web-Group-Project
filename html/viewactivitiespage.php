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

if (isset($_POST['edit'])) {
    $activitiesID = $_POST["activitiesID"];
    $sqlloadedit = "SELECT * FROM tbl_activities WHERE activitiesID = '$activitiesID'";
    $result = $conn->query($sqlloadedit);
    if ($result->num_rows > 0) {
        $_SESSION["activitiesID"] = "$activitiesID";
        echo "<script>
        alert('$activitiesID');
        window.location.href = '../html/editactivitiespage.php';
    </script>";
    }
}
if (isset($_POST['delete'])) {
    $activitiesID = $_POST["activitiesID"];
    $query = "DELETE FROM tbl_activities WHERE activitiesID = '$activitiesID'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('Success delete $activitiesID');
        window.location.href = '../html/viewactivitiespage.php';
    </script>";
    }
}
if (isset($_POST['submit'])) {
    $activitiesID = $_POST["activitiesID"];
    $sqlupdate  = "UPDATE tbl_activities SET activitiesStatus='Submitted' WHERE activitiesID = '$activitiesID' ";

    if (mysqli_query($conn, $sqlupdate)) {
        echo "<script>
        alert('Success submit $activitiesID');
        window.location.href = '../html/viewactivitiespage.php';
    </script>";
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
                    <li><a href="../html/addactivitiespage.php"><i class="fa fa-plus"></i> <span>Add Activities</span></a></li>
                    <li class="active"><a href="#"><i class="fa fa-table"></i> <span>View Activities</span></a></li>
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
                        View Activities
                    </h2>
                    <small>
                        <ol class="breadcrumb" style="background-color: rgba(248, 244, 244, 0); position: absolute; top:6%; left:0.3%">

                            <li><a href="#"> Home</a></li>
                            <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li class="active"><i class="fa fa-search"></i> View Activities</a></li>

                        </ol>
                    </small>
                </span>

            </section><br>

            <!-- Main content -->
            <!-- Main content -->
            <?php
            session_start();
            error_reporting(0);
            include("dbconnect.php");

            $sqlloadactivities = "SELECT * FROM tbl_activities WHERE staffID = '$staffID'";

            ?>
            <section>
                <div class="container">

                    <div class="box" id="table">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-user">&nbsp;&nbsp</i>Activities List</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
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
                                        <th>Action</th>

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
                                        <td><?php echo $activitiesID ?></td>
                                        <td><?php echo $activitiesTitle ?></td>
                                        <td><?php echo $activitiesStartDate ?></td>
                                        <td><?php echo $activitiesEndDate ?></td>
                                        <td><?php echo $activitiesDescirption ?></td>
                                        <td><?php echo $activitiesStatus ?></td>
                                        <td>
                                            <?php
                                                if ($activitiesStatus != "Submitted") {
                                            ?>

                                                <form method="POST" style="float: left; padding:5px">
                                                    <input type="hidden" name="activitiesID" value="<?php echo $activitiesID ?>">
                                                    <button type="submit" class="btn btn-success" style="width:38px;height:38px; border-radius:50%" name="edit"><i class="fa fa-edit"></i></button>
                                                </form>
                                                <form method="POST" style="float: left; padding:5px">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger" style="width:38px;height:38px; border-radius:50%"><i class="fa fa-trash"></i></button>
                                                </form>
                                                <div class="modal modal-danger fade" id="modal-danger">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Warning</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Sure to DELETE <?php echo $activitiesTitle ?>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                <form method="POST">
                                                                    <input type="hidden" name="activitiesID" value="<?php echo $activitiesID ?>">
                                                                    <button type="submit" class="btn btn-outline" name="delete">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <?php
                                                    if ($activitiesStatus == "Done") {
                                                ?>
                                                    <form method="POST" style="float: left; padding:5px">
                                                        <input type="hidden" name="activitiesID" value="<?php echo $activitiesID ?>">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="width:38px;height:38px; border-radius:50%"><i class="fa fa-arrow-circle-up"></i></button>
                                                    </form>
                                                    <div class="modal fade" id="modal-default">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span></button>
                                                                    <h4 class="modal-title">Default Modal</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Sure to SUBMIT <?php echo $activitiesTitle ?>?</p>
                                                                    <p>After submited, this can't be update and delete agian.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                    <form method="POST">
                                                                        <input type="hidden" name="activitiesID" value="<?php echo $activitiesID ?>">
                                                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                            <?php
                                                    }
                                                }
                                            ?>

                                        </td>
                                    </tr>
                            <?php
                                            }
                                        }
                            ?>
                            </tr>
                                </tbody>

                            </table>
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->


                </div>
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