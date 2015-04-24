<?php
    $cookie_name = 'userID';
    if(isset($_COOKIE['userID'])) {
        
    } else {
        header('Location: /index.php' );
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>SplitRide</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="../resources/bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
  	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href="../css/feedStyles.css" rel="stylesheet">

    <script src="../resources/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="../resources/sweetalert-master/dist/sweetalert.css">
</head>
	
<body>
   
<style>
div#load_screen{
  background: #000;
  opacity: 1;
  position: fixed;
    z-index:10;
  top: 0px;
  width: 100%;
  height: 1600px;
}
div#load_screen > div#loading{
  color:#FFF;
  width:120px;
  height:24px;
  margin: 300px auto;
}
</style>
<script>
window.addEventListener("load", function(){
  var load_screen = document.getElementById("load_screen");
  document.body.removeChild(load_screen);
});
</script>

<div id="load_screen"><div id="loading"><div class="container">
<span class="glyphicon"><h1>Loading...</h1></span>
</div></div></div>
<!-- Your normal document content lives here -->


  <div class="wrapper">
    <div class="box">
      <div class="row row-offcanvas row-offcanvas-left">


        <!-- sidebar -->
        <div class="column col-sm-2 col-xs-1 sidebar-offcanvas">
          <div class="text-center">
            <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <!--<a href="/" class="navbar-brand logo">SplitRide</a>-->
            </div>
            <a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html"><img src="" class="profile-image img-circle" id="user-profile-pic" style=" height: 130px; width: 130px; margin-top: 30px;"></a>

            <div id="side-bar-trips-title" style="color: #bbb;">
            </div>

            <div id="side-bar-trips-title">
              Upcoming Trips:
            </div>

            <hr>
            <div class="upcoming">

              <!--Upcoming Trips Go Here -->
            </div>
            

            <div id="side-bar-trips-title">
              Past Trips:
            </div>
            <hr>

            <div class="past">

              <!--Past Trips Go Here -->
            </div>


            <a class="btn btn-lg btn-primary" id="logout-btn" style="width: 150px; bottom: 10px; left: 45px; position: absolute;">Logout</a>
          </div>
        </div>
        <!-- /sidebar -->

        <!-- main right col -->
        <div class="column col-sm-10 col-xs-11" id="main">

          <!-- top nav -->
          <div class="navbar navbar-blue navbar-static-top">  
            
            <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a href="/" class="navbar-brand logo">SplitRide</a>
            </div>
  
            <nav class="collapse navbar-collapse" role="navigation">
              <form class="navbar-form navbar-left">
              <div class="input-group input-group-sm" style="max-width:360px;">
                 <input type="text" class="form-control input-lg" placeholder="Search Location, User..." id="srch-term"/>
                <div class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="displaySearchResults()"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
              </form>

   
              <ul class="nav navbar-nav">
                <li>
                  <a href="http://splitride.web.engr.illinois.edu/pages/sr_homePage.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                </li>

                <li>
                  <a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html"><i class="glyphicon glyphicon glyphicon-user"></i> Profile</a>
                </li>


                <li>
                  <a href="http://splitride.web.engr.illinois.edu/pages/sr_planATrip.html" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Plan a Trip</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- /top nav -->


            <!-- main col right -->
            <!-- Trip Column -->
            <div class="col-sm-8 col-md-offset-2" id="dashboard-pg-right" >

              <div class="well"> 
              </div>


              

              


            </div>
        </div><!--/row-->
      </div><!-- /col-9 -->
    </div><!-- /padding -->
  </div>
  <!-- /main -->


<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="../resources/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
<script src="../js/sr_homePage-script.js"></script>
<script src="../js/moments.js"></script>
</body>
</html>