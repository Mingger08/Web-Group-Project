<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>WorkAct- created by Spider.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mainpage.css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"> -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage"><b>Work</b>ACT</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="registerpage.php">SIGN UP</a></li>
        <li><a href="loginpage.php"><i class="fa fa-lock"></i> LOGIN</a></li>
       
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>WorkAct</h1> 
  <p><h5>EMPLOYEE MONITORING SOFTWARE</h5></p> 
  
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Us</h2><br>
      <h4>Manage and monitor all your remote employees from a single dashboard</h4><br>
      <p>Manage all the computers in your organization remotely from a centralized location. Your WorkAct account is accessible from any internet-enabled device giving you access from anywhere at any time. With our real-time computer monitoring software, you can view activities as they happen and manage instantly.</p>
      <br><button class="btn btn-default btn-lg" id="myButton">Get Started Now</button>
      <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
            location.href = "loginpage.php";
        };
    </script>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> Our mission is to provide the employee a better insights into employee performance. Keeping track of team???s workplace behavior assists in identifying how productive each employee is.
</h4><br>
      <p><strong>VISION:</strong> Our vision is to evaluate the effectiveness of the implemented measures and determining whether additional measures are required.</p>
    </div>
  </div>
</div>

 <div id="portfolio" class="container-fluid text-center bg-white">
    <h2>Our Team Members</h2><br>
    
    <div class="row align-center slideanim">
      <div class="col-sm-3"></div>
      <div class="col-sm-3">
        <div class="thumbnail">
          <img src="../images/Weiyang.png" alt="weiyang" width="200" height="200">
          <p><strong>Kok Wei Yang</strong></p>
          <p>23 years old</p>
          <p>Bsc. IT Software Engineering</p>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="thumbnail">
          <img src="../images/Mingger.png" alt="mingger" width="200" height="200">
          <p><strong>Neo Ming Ger</strong></p>
          <p>23 years old </p>
          <p>Bsc. IT Software Engineering</p>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center bg-grey">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-time logo-small"></span>
      <h4>TIME MANAGEMENT</h4>
      <p>Track employees presence and activities</p>
    </div>
    <div class="col-sm-4">
      <span class="	glyphicon glyphicon-screenshot logo-small"></span>
      <h4>GET REALTIME INSIGHT</h4>
      <p>See what your employees are doing in real time</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-folder-open logo-small"></span>
      <h4>MANAGE ATTENDANCE</h4>
      <p>Accurate work hours</p>
    </div>
  </div>
</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-white">
  
  
  <h2>Benefits</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"Observation points out employee strengths."</span></h4>
      </div>
      <div class="item">
        <h4>"Employees are saved from imprisonment and fines."</span></h4>
      </div>
      <div class="item">
        <h4>"Employees have access to a more flexible working environment."</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> WorkAct, MY</p>
      <p><span class="glyphicon glyphicon-envelope"></span> workact@hubbuddies.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>


<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Created by Spider.com.  <strong>Copyright &copy; 2022 <a href="#"><b>Work</b>ACT</a>.</strong> All rights reserved.</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
