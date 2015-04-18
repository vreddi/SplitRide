<?php

    $cookie_name = 'user';

    if(!isset($_COOKIE['user'])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        header('Location: cook.php' ) ;

    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - SplitRide</title>

    <!-- Linking Style CSS File -->
    <link rel="stylesheet" type="text/css" href="css/sr_signup-style.css">

    <!-- Linking BootStrap 3.3.2 -->
    <link rel="stylesheet" type="text/css" href="resources/bootstrap-3.3.2-dist/css/bootstrap.css">

    <!-- Linking Font-Awesome 4.3.0 -->
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.3.0/css/font-awesome.css">

    <!-- Linking jQuery -->
    <script type="text/javascript" src="js/jquery-1.11.2.js"></script>

    <!-- Linking Login Script -->
    <script type="text/javascript" src="js/sr_sign-up.js"></script>

</head>

<body>

    <!-- Attaching the Background Video for the sign-up page-->
    <video id="vid-bg" autoplay muted loop src="resources/videos/roadtrip.mp4"></video>


    <!-- Login Frame (Gmail-like) -->
    <div class="container" id = "content">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                        alt="">
                    <form class="form-signin" method="post" action="queries.php?q=validate_user">
                    <input type="text" class="form-control" placeholder="Email" name = "username" required autofocus>
                    <input type="password" class="form-control" name = "password" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Sign in</button>
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me">
                        Remember me
                    </label>
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                    </form>
                    <a class="text-center new-account" href="#register" data-toggle="modal">Create an account </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Regesteration Window -->
    <div class="modal fade" id="register" aria-labelledby="modalLabel" aria-hidden="true">

        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h3>Sign Up</h3>
         </div>

        <div class="modal-body">
            <form role="form" action="queries.php?q=add_user" method="post">
                            <!--
                            <div class="alert alert-danger" role="alert" name = "password-error" id = "password-error">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              <span class="sr-only">Error:</span>
                              Passwords do not match.
                            </div>
                            <div class="alert alert-danger" role="alert" name = "email-error" id = "email-error">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              <span class="sr-only">Error:</span>
                              Invalid email address.
                            </div>
                            <div class="alert alert-danger" role="alert" name = "not-unique" id = "not-unique">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              <span class="sr-only">Error:</span>
                              Another user has entered that email address. 
                            </div> !-->
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" reuired>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="submit" value="Register" class="btn btn-primary btn-block">
                        
                        </form>
        </div>


        <div class="modal-footer">
            <button type="reset" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>

    </div>

    </div>
    <script>
        $('#password_confirmation').on('keyup', function(e){
                if ($(this).val() == $('#password').val()) {
                    $('#message').html('matching').css('color', 'green');
                } 
                else $('#message').html('not matching').css('color', 'red');
            }
        );
    </script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="resources/bootstrap-3.3.2-dist/js/bootstrap.js"></script>
</body>

</html>
