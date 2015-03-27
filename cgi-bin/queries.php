<?php
    /*
FILE: queries.php
DESCRIPTION: Used for all the different kinds of queries the SplitRide application would require. Each 
Query is a different function of request in the file.
*/
    //Connect Connection Script
    include("connection.php");
    
    //determine the which query to form
    $query_func = $_POST['q'];

    switch (q) {
    	case 'add_user':
    		addUser(_POST['first_name'], _POST['last_name'], _POST['email'], md5(_POST['password']));
    		break;
    	
    	default:
    		# code...
    		break;
    }

    function getUserInfo(){
        $res = mysql_query("SELECT * FROM Users", getConnection() );
    }

    function addUser($fisrtName, $lastName, $emailAddress, $password){
    	$format = 'INSERT INTO Users(FirstName, LastName, Email, Password) VALUES (\'%s\', \'%s\', \'%s\', \'%s\')';
    	$query = sprintf($format, $fisrtName, $lastName, $emailAddress, $password);
    	$res = mysqli_query($getConnection(), $query);
    	if($res)
    		echo "New User Added!";
    	else
    		echo "Error";
    }

?>