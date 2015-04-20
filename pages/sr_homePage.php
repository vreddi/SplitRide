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

  <script>
    function getCookie(name) {
      var dc = document.cookie;
      var prefix = name + "=";
      var begin = dc.indexOf("; " + prefix);
      if (begin == -1) {
          begin = dc.indexOf(prefix);
          if (begin != 0) return null;
      }
      else
      {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
        end = dc.length;
        }
    }
    return unescape(dc.substring(begin + prefix.length, end));
  } 

  
  function showSuccessMssg(){

    var addedTripCookie = getCookie("trip_added");

    if(addedTripCookie != null){


      //Success
      if(addedTripCookie == "true"){

        swal("Done!", "Trip Added!", "success")
      }
      //Failure
      else{
        swal({   title: "Oops!",   text: "Something Went Wrong! Try Again",   type: "error",   confirmButtonText: "Ok" });
      }
    }
    document.cookie = 'trip_added=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }

   showSuccessMssg();
  </script>



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
            <img src="" class="profile-image img-circle" id="user-profile-pic" style=" height: 130px; width: 130px; margin-top: 30px;"></a>

            <div id="side-bar-trips-title" style="color: #bbb;">
            </div>

            <div id="side-bar-trips-title">
              Upcoming Trips:
            </div>

            <hr>
            <div class="msg msg-success"><img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfp1/t31.0-8/1417660_10202428821390512_305950237_o.jpg" class="profile-image img-circle pull-left" style="height: 30px; width: 30px;">CHM -> CHI <div style="font-size: 20px;">9:30AM </div></div>

            <div class="msg msg-success"><img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfp1/t31.0-8/1417660_10202428821390512_305950237_o.jpg" class="profile-image img-circle pull-left" style="height: 30px; width: 30px;">CHM -> CHI <div style="font-size: 20px;">9:30AM </div></div>

            <div id="side-bar-trips-title">
              Past Trips:
            </div>
            <hr>

            <div class="msg"><img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfp1/t31.0-8/1417660_10202428821390512_305950237_o.jpg" class="profile-image img-circle pull-left" style="height: 30px; width: 30px;">CHM -> CHI <div style="font-size: 20px;">9:30AM </div></div>


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
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
              </form>
   
              <ul class="nav navbar-nav">
                <li>
                  <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
                </li>
                <li>
                  <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Plan a Trip</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- /top nav -->



            <!-- main col right -->
            <!-- Trip Column -->
            <div class="col-sm-6">

              <div class="well"> 
              </div>

              <!-- Trip Item -->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/2/000/29b/0ea/3602fab.jpg" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>
                  <a href="#" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;">CHM -> CHI <br> <div style="font-size: 30px;">9:30 AM</div></h4>
                </div>

                <div class="panel-body">
                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center pull-left" style="width: 150px; height: auto;">
                  <img src="http://www.kravmagagilbert.com/wp-content/uploads/2014/08/arrow-39526_640.png" style="width: 100px; height: auto; margin-left: 12%; margin-top: 20px; border: ">
                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center pull-right" style="width: 150px; height: auto;">
                  <div class="clearfix"></div>

                  <!-- Comment Section for Trip -->
                  <form>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                      </div>
                      <input type="text" class="form-control" placeholder="Add a comment..">
                    </div>
                  </form>

                </div>
              </div> 
              <!-- Trip Item End -->

              <!-- Trip Item -->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xfp1/t31.0-8/1417660_10202428821390512_305950237_o.jpg" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>
                  <a href="#" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;">CHM -> CHI <br> <div style="font-size: 30px;">9:30 AM</div></h4>
                </div>

                <div class="panel-body">
                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center" style="width: 500px; height: auto;">
                  <div class="clearfix"></div>

                  <!-- Comment Section for Trip -->
                  <form>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                      </div>
                      <input type="text" class="form-control" placeholder="Add a comment..">
                    </div>
                  </form>

                </div>
              </div> 
              <!-- Trip Item End -->

              <!-- Trip Item -->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <img src="https://media.licdn.com/mpr/mpr/shrink_100_100/p/7/005/00b/1cd/087e352.jpg" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>
                  <a href="#" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;">NYC -> MIA <br> <div style="font-size: 30px;">3:00 PM</div></h4>
                </div>

                <div class="panel-body">
                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center" style="width: 500px; height: auto;"> 
                  <div class="clearfix"></div>

                  <!-- Comment Section for Trip -->
                  <form>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                      </div>
                      <input type="text" class="form-control" placeholder="Add a comment..">
                    </div>
                  </form>

                </div>
              </div> 
              <!-- Trip Item End -->

              <!-- Trip Item -->
              <div class="panel panel-default">

                <div class="panel-heading">
                  <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/7/005/089/3b2/14dc93d.jpg" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>
                  <a href="#" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;">CHM -> CHI <br> <div style="font-size: 30px;">9:30 AM</div></h4>
                </div>

                <div class="panel-body">
                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center" style="width: 500px; height: auto;">
                  <div class="clearfix"></div>

                  <!-- Comment Section for Trip -->
                  <form>
                    <div class="input-group">
                      <div class="input-group-btn">
                        <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                      </div>
                      <input type="text" class="form-control" placeholder="Add a comment..">
                    </div>
                  </form>

                </div>
              </div> 
              <!-- Trip Item End -->


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
</body>
</html>