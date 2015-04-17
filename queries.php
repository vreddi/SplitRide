<?php
    /*
FILE: queries.php
DESCRIPTION: Used for all the different kinds of queries the SplitRide application would require. Each 
Query is a different function of request in the file.
*/

//setting cookies if validating user
if($_REQUEST['q']=='validate_user')
{
    $cookie_name = "user";
    $cookie_value = $_POST['username'];
    setcookie($cookie_name, $cookie_value, time() + (60), "/"); // 86400 = 1 day
}
//--------------------
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
    //Connect Connection Script
    include("connection.php");
    
    //determine the which query to form
    $query_func = $_REQUEST['q'];
    switch ($query_func) {
    	case 'add_user':
    		addUser($_POST['first_name'], 
		$_POST['last_name'], 
		$_POST['email'], 
		md5($_POST['password']));
    		break;
    	
        case 'validate_user':
                $encrip_password = md5($_POST['password']);
                validateLogin($_POST['username'], $encrip_password);
                break;
    	default:
    		# code...
    		break;
    }
    
    function addUser($fisrtName, $lastName, $emailAddress, $password){
    	$format = 'INSERT INTO Users(FirstName, LastName, Email, Password) VALUES (\'%s\', \'%s\', \'%s\', \'%s\')';
    	$query = sprintf($format, $fisrtName, $lastName, $emailAddress, $password);
    	$res = mysqli_query(getConnection(), $query);
    	if($res)
    		echo "New User Added!";
    	else
    		echo "Error";
    }


    function validateLogin($username, $password){   


	echo "(Verification Data for Initial Demo:) Username:".$username."\tPassword:".$password;

        $query = "SELECT * FROM Users WHERE Email ='".$username."' AND Password = '".$password."';" ;
                        
        $res = mysqli_query(getConnection(), $query);
	

        if(mysqli_num_rows($res) >= 1){

            echo "<h1><pre>";
            echo "Login Successful! :)";
            echo "</pre></h1>";
            echo "<div class=\"container\">";
            echo "<h1>April Fools!!!!!!!! </h1>";
            echo "<iframe width=\"820\" height=\"700\" src=\"https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&cc_load_policy=1\" frameborder=\"0\" allowfullscreen autoplay></iframe>";
            echo "</div>";
        }
        else{
            echo "<h1><pre>";
            echo "Login Failed! :(";
            echo "</pre></h1>";
	
        }

    }
?>