<?PHP

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
}?>
   
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminDashboard</title>
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
  
  
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
  <script>
    $(document).ready(function () {
      $('#example').DataTable(
     
      );
      
    });
  </script>

 <script src="../js/generatepdf.js"></script>

		<script>
			function generatePDF() {
				// Choose the element that our invoice is rendered in.
				const element = document.getElementById('table','example');
				// Choose the element and save the PDF for our user.
				html2pdf()
		.set({ html2canvas: { scale: 4 } })
		.from(element)
		.save();
			}
		</script>
  
  


</head>



<body class="hold transition skin-purple sidebar-mini ">
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
          <li><a href="admindashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="header">EMPLOYEE MANAGEMENT</li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href="manageleave.php"><i class="fa fa-edit"></i> <span>Manage Leave</span></a></li>
          <li class="header">REPORT</li>
          <li><a href="activitiesreport.php"><i class="fa fa-heart"></i> <span>Activities</span></a></li>
          <li><a href="attendancereport.php"><i class="fa fa-group"></i> <span>Attendance</span></a></li>
          <li class="active"><a href="leavereport.php"><i class="fa fa-calendar"></i> <span>Leave</span></a></li>

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
            Leave Report
          </h2>
          <small>
            <ol class="breadcrumb"
              style="background-color: rgba(248, 244, 244, 0); position: absolute; top:6%; left:0.3%">

              <li> Home</a></li>
              <li><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li ><i class="fa fa-file-o"></i> Report</a></li>
              <li class="active"><i class="fa  fa-calendar-check-o"></i> Leave</a></li>

            </ol>
          </small>
        </span>

      </section><br>

      <!-- Main content -->
      <section>
        <div class="row no-print">
            <div class="col-xs-11">
              <button type="button" class="btn btn-success pull-right" onClick="print()"><i class="fa fa-print"></i> Print
             
              <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onClick="generatePDF()">
                <i class="fa fa-download"></i> Generate PDF
              </button>
            </div>
          </div>
      </section><br><br>
      <section>
        <div class="container" >

          <div class="box" id="table">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user">&nbsp;&nbsp</i>Employee List</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
<?php
        session_start();
        error_reporting(0);
        include("dbconnect.php");
        $email = $_SESSION['email'];
        $year =$_POST['year'];
        $country=$_POST['country'];
        $sqlloadleave = "SELECT * FROM tbl_leave WHERE status != 'Pending'";
        
    ?>
              <table id="example" class="table table-striped table-bordered"  style="width:100%" >
                <thead>
                  <tr>
                    <th>Leave ID</th>
                    <th>Staff ID</th>
                    <th>Reason Employee</th>
                    <th>Leave Date Start</th>
                    <th>Leave Date End</th>
                    <th>Status</th>
                   
                    
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
                <td><?php echo $staffID ?></td>
                <td><?php echo $reason_employee ?></td>
                <td><?php echo $leave_day_start ?></td>
                <td><?php echo $leave_day_end ?></td>
                <td><?php echo $status ?></td>
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


  <!-- REQUIRED JS SCRIPTS -->
 <script>
   
    function logOut(){
        window.location.assign("../html/logout.php?");
        alert("Successfully Log Out.");
        window.location.assign("loginpage.php");
        }
  </script>
  <!-- jQuery 2.2.3
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> -->
  <!-- Bootstrap 3.3.6 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>


</body>

</html>
