<?php
    /*
FILE: queries.php
DESCRIPTION: Used for all the different kinds of queries the SplitRide application would require. Each 
Query is a different function of request in the file.
*/


//Connect Connection Script
include("connection.php");


ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
   
    
    
    //determine the which query to form
    $query_func = $_REQUEST['q'];

    switch ($query_func) {
    	case 'add_user':
    		addUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], md5($_POST['password']));
    		break;
        case 'validate_user':
                
                $encrip_password = md5($_POST['password']);
                validateLogin($_POST['username'], $encrip_password);
                break;

        case 'get_profile_pic':
                getUserProfilePic($_COOKIE['userID']);
                break;

        case 'upload_profile_pic':
                upload_pp($_COOKIE['userID']);
                break;
        
        case 'get_user_name':
                getUserName($_COOKIE['userID']);
                break;  

        case 'plan_trip':
                $dateTimeStamp = $_POST['date']." ".$_POST['time'].":00";
                // echo $dateTimeStamp;
                $added = addTripDetails($dateTimeStamp, $_POST['source'], $_POST['destination'], $_POST['seats'], $_COOKIE['userID'], $_POST['notes']);
                
                header('Location: /pages/sr_homePage.php');

                break;


        case 'logout':
                deleteCookie();
                break;

    	default:
    		# code...
    		break;
    }
    
    /**
    *Description: This function deletes the cookies for USERID
    */
    function deleteCookie()
    {
        setcookie("userID", "", -3600);
    }

    /**
    * Description: This function is used to add a user to the database. THe data is added to the 'Users'
    * Table. Currently it does not check for the validity of the data.
    *
    * @param firstname
    * @param lastName
    * @param email
    * @param password
    */
    function addUser($fisrtName, $lastName, $emailAddress, $password){
    	$format = 'INSERT INTO Users(FirstName, LastName, Email, Password) VALUES (\'%s\', \'%s\', \'%s\', \'%s\')';
    	$query = sprintf($format, $fisrtName, $lastName, $emailAddress, $password);
    	$res = mysqli_query(getConnection(), $query);
    	if($res)
    		echo "New User Added!";
    	else
    		echo "Error";
    }


    /**
    * Description: This function validates the user data from the database. Checks for the
    * data presence in the data table and presents the response accordingly.
    *
    * @param username
    * @param password
    */
    function validateLogin($username, $password){   

        $query = "SELECT * FROM Users WHERE Email ='".$username."' AND Password = '".$password."';" ;
                        
        $res = mysqli_query(getConnection(), $query);
	

        if(mysqli_num_rows($res) >= 1){

            //setting cookies if validating user
            if($_REQUEST['q']=='validate_user')
            {
                $cookie_name = "userID";
                $cookie_value = getUserID($_POST['username']);
                setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
            }

            header('Location: pages/sr_homePage.php');
            exit();
            // echo "<h1><pre>";
            // echo "Login Successful! :)";
            // echo "</pre></h1>";
            // echo "<div class=\"container\">";
            // echo "<h1>April Fools!!!!!!!! </h1>";
            // echo "<iframe width=\"820\" height=\"700\" src=\"https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&cc_load_policy=1\" frameborder=\"0\" allowfullscreen autoplay></iframe>";
            // echo "</div>";
        }
        else{
            echo "<h1><pre>";
            echo "Login Failed! :(";
            echo "</pre></h1>";
	
        }

        // getUserProfilePic(1);

        // getTrip(1);

        // getUserName(1);

        // getUserID('vishrutreddi@gmail.com');

    }

    /**
    * Description: Given a UserID this function finds the URL of the User's
    * Profile Pictures and truens the link.
    *
    * @param userID
    */
    function getUserProfilePic($userID){

        $query = "SELECT URL FROM Pictures WHERE UserID = '".$userID."';";

        $res = mysqli_query(getConnection(), $query);

        $pictureURL = "http://farm8.static.flickr.com/7085/7201237400_9f2a686a92_m.jpg";
        if(mysqli_num_rows($res) >= 1){
            //echo "<h1><pre>";
            while($row = $res->fetch_array())
            {
                $pictureURL = $row['URL'];
                // echo "Pricture URL: <img src=\"".$row['URL']."\">";
                // echo "<br />";
            }
            //echo "</pre></h1>";
        }
        else{
            //echo "Picture ID does not exist";
        }
        echo $pictureURL;
        return $pictureURL;
    }


    function getUserID($username) {
    //$query = "SELECT UserID FROM Users WHERE Email = '".$username."';";
        //Anurag : I made Life simple!
        $query = "SELECT UserID FROM Users WHERE Email = '$username';";
       $res = mysqli_query(getConnection(),$query);
       $return_data="";
       if(mysqli_num_rows($res) >=1) {
          //echo "<h1><pre>";
          while($row = $res->fetch_array())
              {
                  $return_data = $row['UserID'];
                  //echo "UserID is".$return_data;
                  
              }
          //echo "</pre></h1>";    
          return $return_data;    
           }
           
       else {
            //echo "NO results found";
        }     
       
   
    }


    function getTrip() {
        $query = "SELECT * FROM Trips ORDER BY TripTimeStamp DESC;";
        $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        if(mysqli_num_rows($res) >=1) {
            echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                $source = $row['Source'];
                $destination = $row['Destination'];
                $timeStamp = $row['TripTimeStamp'];
                echo "Trip :".$source."->".$destination." Time: ".$timeStamp;
                echo "</pre></h1>";
                echo "<h1><pre>";
            }
            echo "</pre></h1>";
            return $return_trip; 
        }
        else {
            echo "NO results found";
        }   
    }


    /**
    * Description: This function prints and returns a tuple consisting of First name and Last Name
    * @param userID 
    */ 
    function getUserName($userID)
    {

        $query = "SELECT FirstName, LastName FROM Users WHERE UserID ='".$userID."';";
                        
        $res = mysqli_query(getConnection(), $query);
        $Fullname="";
        
        if(mysqli_num_rows($res) >= 1){
            while($row = $res->fetch_array())
            {
                $firstname = $row['FirstName'];             
                $lastname = $row['LastName'];
                $Fullname = $firstname." ".$lastname;
                
            }

        }
        echo $Fullname;
        return $Fullname;
    }



    // /**
    //     * Description: This function gets the Driverid from TripID.
    //     * @param tripid 
    //     */ 
    // function getDriverfromTrip($tripid) {
    //     $query = "SELECT DriverID FROM Drives WHERE TripID = '.$tripid.';";
    //     $res = mysqli_query(getConnection(),$query);
    //     $driverid = 0;
    //     if(mysqli_num_rows($res) >=1) {
    //         while($row = $res->fetch_array()) {
    //             $driverid = $row['DriverID'];
    //             echo "DriverID: ".$driverid;
    //         }
    //         clearConnection();
    //         return $driverid;
    //         /*
    //         $vehicle = getDriver_vehicle($driverid);
    //         $trips = getDriver_trips($driverid);
    //         $cancel = getDriver_cancel($driverid);
    //         return array($driverid,$vehicle,$trips,$cancel);
    //         */
    //     }
    //     else {
    //         echo "No results found";
    //     }    
    // }

    // /**
    //     * Description: This function gets the vehicle information for a specific driver from Driverid.
    //     * @param driverid 
    //     */
    // function getDriver_vehicle($driverid) {
    //     $query = "SELECT Vehicle FROM Drivers WHERE UserID = '.$driverid.';";
    //     $res = mysqli_query(getConnection(),$query);
    //     $vehicle = "";
    //     if(mysqli_num_rows($res) >=1) {
            
    //         while($row = $res->fetch_array()) {
    //             $vehicle = $row['Vehicle'];
    //             echo "Vehicle ".$vehicle;
    //         }
    //         clearConnection();
    //         return $vehicle; 
    //     }
    //     else {
    //         echo "NO results found";
    //         }
        
    //     }
    // /**
    //     * Description: This function gets the number of trips for a specific driver from Driverid.
    //     * @param driverid 
    //     */
    // function getDriver_trips($driverid) {
    //     $query = "SELECT NoOfTrips FROM Drivers WHERE UserID = '.$driverid.';";
    //     $res = mysqli_query(getConnection(),$query);
    //     $trips = "";
    //     if(mysqli_num_rows($res) >=1) {
                
    //         while($row = $res->fetch_array()) {
    //             $trips = (string)$row['NoOfTrips'];
    //             echo "Trips no: ".$cancel;
    //         }
    //         clearConnection();
    //         return $trips; 
    //     }
    //     else {
    //         echo "NO results found";
    //     }
        
    // }

    // /**
    //     * Description: This function gets the number of cancellations for a specific driver from Driverid.
    //     * @param driverid 
    //     */    
    // function getDriver_cancel($driverid) {
    //         $query = "SELECT NoOfCancellations FROM Drivers WHERE UserID = '.$driverid.';";
    //         $res = mysqli_query(getConnection(),$query);
    //         $cancel = "";
    //         if(mysqli_num_rows($res) >=1) {
                
    //             while($row = $res->fetch_array()) {
    //                 $cancel = (string)$row['NoOfCancellations'];
    //                 echo "Cancellation no: ".$cancel;
    //             }
    //             clearConnection();
    //             return $cancel; 
    //         }
    //         else {
    //             echo "NO results found";
    //         }
        
    //     }
    // /**
    //     * Description: This function gets the AuthorID for a specific comment of a given trip, by TripID.
    //     * @param tripid 
    //     */
    // function getTripCom_author($tripid) {
    //     $query = "SELECT AuthorID FROM TripComments WHERE TripID = '.$tripid.' ORDER BY CommentTimeStamp DESC;";
    //     $res = mysqli_query(getConnection(),$query);
    //     $authors = [];
    //     if(mysqli_num_rows($res) >= 1) {
    //         while($row = $res->fetch_array()){
    //             array_push($authors, array('AuthorID' => $row['AuthorID']);
    //             echo "Author ID".$row['AuthorID'];
    //         }
    //         clearConnection();
    //         return $authors;
    //     }
    //     else {
    //         echo "No results";
    //     }
    // }

    // /**
    //     * Description: This function gets the time stamp for a specific comment of a given trip, by TripID.
    //     * @param tripid 
    //     */
    // function getTripCom_time($tripid) {
    //     $query = "SELECT CommentTimeStamp FROM TripComments WHERE TripID = '.$tripid.' ORDER BY CommentTimeStamp DESC;";
    //     $res = mysqli_query(getConnection(),$query);
    //     $time = [];
    //     if(mysqli_num_rows($res) >= 1) {
    //         while($row = $res->fetch_array()){
    //             array_push($time, array('CommentTimeStamp' => $row['CommentTimeStamp']);  
    //             echo "CommentTimeStamp: ".$row['CommentTimeStamp'];
    //         }
    //         clearConnection();
    //         return $time;
    //     }
    //     else {
    //         echo "No results";
    //     }
    // }

    // /**
    //     * Description: This function gets the specific comment of a given trip, by TripID.
    //     * @param tripid 
    //     */
    // function getTrip_Com($tripid) {
    //     $query = "SELECT Text FROM TripComments WHERE TripID = '.$tripid.' ORDER BY CommentTimeStamp DESC;";
    //     $res = mysqli_query(getConnection(),$query);
    //     $comments = [];
    //     if(mysqli_num_rows($res) >= 1) {
    //         while($row = $res->fetch_array()){
    //             array_push($comments, array('Text' => $row['Text']); 
    //             echo "Text: ".$row['Text'];
    //         }
    //         clearConnection();
    //         return $comments;
    //     }
    //     else {
    //         echo "No results";
    //     }
    // }

    // /**
    //     * Description: This function gives the list of FriendID of a given user by userID.
    //     * @param tripid 
    //     */
    // function getFriendID($userid) {
    //     $query = "SELECT FriendID FROM Friends WHERE UserID = '.$userid.';";
    //     $res = mysqli_query(getConnection(),$query);
    //     $friends = [];
    //     if(mysqli_num_rows($res) >= 1) {
    //         while($row = $res->fetch_array()){
    //             array_push($friends, array('FriendID' => $row['FriendID']);
    //             echo "FriendID: ".$row['FriendID'];
    //         }
    //         clearConnection();
    //         return $friends;
    //     }
    //     else {
    //         echo "No results";
    //     }
    // }


    
     /**
    * Description: This function returns the number of seats remaining 
    * @param $tripID
    * @return $seatsRemaining
    */ 

    function returnNoOfSeats($tripID)
    {
        $seatsRemaining = 0;
        $query = "SELECT NoOfSeats FROM Trips WHERE TripID = $tripID";
        $res = mysqli_query(getConnection(), $query);
        if(mysqli_num_rows($res) >= 1)
            $row = $res->fetch_array();

        $seatsRemaining= $row['NoOfSeats'];
        return $seatsRemaining;
    }


/**
    * Description: This function adds a passenger to the Trip and returns True if it were possible
    * @param $passID
    * @param $tripID
    * @return true or false
    */ 
    function addPassengerToTrip($passID, $tripID)
    {
        
            $query = "INSERT into Rides VALUES ('$passID' , '$tripID');";
            $res = mysqli_query(getConnection(), $query);
            if($res == true)
            {
                
                return true;

            }
            else
                {   echo "can't enter passid!!"; 
                    return false;
                }

        

    }

    /**
    * Description: This function allows a passenger to leave the Trip and returns True if it were possible
    * @param $passID
    * @param $tripID
    * @return true or false
    */ 
    function leaveTrip($passID, $tripID)
    {
        $query = "DELETE FROM Rides WHERE PassengerID = $passID AND TripID = $tripID;";
        $res = mysqli_query(getConnection(), $query);
            if($res == true)
            {

                return true;

            }
            else
                { 
                    echo "can't remove passen7ger!"; 
                    return false;
                }
    }

    /**
    * Description: This function checks if the user is the driver of the Trip and returns True if he is
    * @param $userID
    * @param $tripID
    * @return true or false
    */ 
    function checkDriver($userID, $tripID)
    {
        $query = "SELECT DriverID FROM Trips where TripID = $tripID;";
        $res = mysqli_query(getConnection(), $query);
        if($res==false)
            {echo "Unexpected error! TripID doesn't exist!";return false;}
        if(mysqli_num_rows($res) >= 1)
            $row = $res->fetch_array();
        else
        {
            echo "Unexpected error! TripID doesn't exist!";
            return false;
        }

        $DriverID= $row['DriverID'];
        if($DriverID==$userID)
        { return true;
  
        }
    }


    /**
    * Description: This function allows the driver to leave the Trip and returns true if possible
     * @param $userID
    * @param $tripID
    * @return   true or false
    */ 
    function cancelTrip($userID, $tripID)
    {
            $query = "DELETE FROM Trips WHERE TripID = $tripID;";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error! TripID doesn't exist!";
                return false;
            }
            else
                return true;

    }
     /**
    * Description: This function removes a passenger from Rides and returns true if possible
     * @param $passID
    * @param $tripID
    * @return  true or false
    */ 
    function removePassenger($passID, $tripID)
    {
        $query = "DELETE FROM Rides WHERE PassengerID = $passID;";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }







    /**
    * Description: This function uploads the picture that the user provides to imgur 
    * and then saves the url generated to the database
    * @param username (generated from the cookies)
    * TESTED - OK
    */
    function upload_pp($username) {
        $img=$_FILES['img'];
        $url = "";
            if(isset($_POST['submit'])){ 
             if($img['name']==''){  
              // echo "<h2>An Image Please.</h2>";
             }else{
              $filename = $img['tmp_name'];
              $client_id="0de23ade0aa4f95";
              $handle = fopen($filename, "r");
              $data = fread($handle, filesize($filename));
              $pvars   = array('image' => base64_encode($data));
              $timeout = 30;
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
              curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
              curl_setopt($curl, CURLOPT_POST, 1);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
              $out = curl_exec($curl);
              curl_close ($curl);
              $pms = json_decode($out,true);
              $url=$pms['data']['link'];
              if($url!=""){
               // echo "<h2>Uploaded Without Any Problem</h2>";
               // echo "<img src='$url'/>";
              }else{
               // echo "<h2>There's a Problem</h2>";
               //echo $pms['data']['error'];  
          } 
         }
        }
        //echo "<img src = \"".$url."\">";
        // echo "".$url;

        $userID = $_COOKIE['userID'];
        // echo $username;
        $query = "INSERT INTO Pictures Values ('$userID','$url');";
                        
        $res = mysqli_query(getConnection(), $query);
      }



        //Description: Function to add Trip Details
        function addTripDetails($TripTimeStamp, $src, $dstn, $NoOfSeats, $userID, $notes)
        {
            $query = "INSERT INTO Trips(DriverID,TripTimeStamp, Source, Destination, NoOfSeats, NoOfSeatsAvailable, Notes) Values ('$userID','$TripTimeStamp', '$src','$dstn', '$NoOfSeats', '$NoOfSeats', '$notes');";
            $res = mysqli_query(getConnection(), $query);
                if($res==false)
                {
                    //setting cookies if validating user
                    $cookie_name = "trip_added";
                    $cookie_value = 'false';
                    setcookie($cookie_name, $cookie_value, time() + (3600), "/"); // 86400 = 1 day
                    
                    echo "Unexpected error!";
                    return false;
                }
                else{

                    //setting cookies if validating user
                    $cookie_name = "trip_added";
                    $cookie_value = 'true';
                    setcookie($cookie_name, $cookie_value, time() + (3600), "/"); // 86400 = 1 day

                    return true;
                }
                    

        }

      //Following functions are used to modify/add user details
    //-------------------------------------------------------
    

    //Description: Change User Name
    function changeUserName($UserID, $newName)
    {
        $query = "UPDATE Users SET FirstName = '$newName' where UserID = $UserID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true; 
    }
    //Description: Change User About me
    function changeUserAboutMe($UserID,$aboutMe)
    {
        $query = "UPDATE Users SET AboutMe = '$aboutMe' where UserID = $UserID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }
    //Description: Checks password
    //@return Returns true if old pw matches new pw
    function checkPassword($UserID,$oldpw, $newpw)
    {
        $oldPw = md5($oldPw);
        $newPw = md5($newPw);
        if($oldPw==$newPw)
            return true;
        else
            return false;

    }
    //Description: Change Password
    function changePassword($UserID,$newPw)
    {
        $newPw = md5($newPw);
        $query = "UPDATE Users SET Password = '$newPw' where UserID = $UserID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }

    //Description: Change DOB of User
    function changeDOB($UserID,$dob)
    {
        $query = "UPDATE Users SET DOB = '$dob' where UserID = $UserID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }

    //Description: Change User Gender
    function changeGender($UserID,$gender)
    {
        $query = "UPDATE Users SET DOB = '$dob' where UserID = $UserID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }

    //Description: Change User Phone Number
    function changePhno($UserID,$phno)
    {
            $query = "UPDATE Users SET Phone_No = '$phno' where UserID = $UserID;";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
    }








?>