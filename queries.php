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

        case 'post_review':

                $reviewer = $_COOKIE['userID'];
                $driver = $_REQUEST['driver'];
                $content = $_REQUEST['content'];
                $rating = $_REQUEST['rating'];

                echo postReview($driver, $reviewer, $content, $rating);

                break;

        case 'get_reviews':


                $driver = $_REQUEST['driver'];
                echo getReviews($driver);

                break;


        case 'get_user_recent_trips':

                $userID = $_COOKIE['userID'];
                $trips = getUserRecentTrips($userID);
                echo $trips;
                break;

        case 'search':

                $words = $_REQUEST['words'];
                echo searchALL($words);
                break;

        case 'start_following':

                $sessionUser = $_COOKIE['userID'];
                $profileUser = $_REQUEST['profileUser'];
                startFollowing($profileUser, $sessionUser);
                break;


        case 'unfollow':

                $sessionUser = $_COOKIE['userID'];
                $profileUser = $_REQUEST['profileUser'];
                unfollow($profileUser, $sessionUser);
                break;


        case 'is_follows':

                $sessionUser = $_COOKIE['userID'];
                $profileUser = $_REQUEST['profileUser'];
                isFollower($sessionUser, $profileUser);
                break;

        case 'cancel_trip':
                $tripID = $_REQUEST['tripID'];
                cancelTrip($tripID);
                break;

        case 'remove_passenger_from_trip':
                $tripID = $_REQUEST['tripID'];
                $userID = $_REQUEST['passengerID'];
                leaveTrip($userID, $tripID);

                break;

        case 'leave_passenger_from_trip':
                $tripID = $_REQUEST['tripID'];
                $userID = $_COOKIE['userID'];
                leaveTrip($userID, $tripID);

                break;

        case 'add_passenger_to_trip':
                $tripID = $_REQUEST['tripID'];
                $userID = $_COOKIE['userID'];
                addPassengerToTrip($userID, $tripID);

                break;

        case 'get_trip_info_by_id':

                $tripID = $_REQUEST['tripID'];
                $jsonData = getTripInfoByID($tripID);
                echo $jsonData;
                break;

        case 'change_user_details':

                $FirstName = $_REQUEST['FirstName'];
                $LastName = $_REQUEST['LastName'];
                $Email = $_REQUEST['Email'];
                $City = $_REQUEST['City'];
                $AboutMe = $_REQUEST['AboutMe'];
                $Phone = $_REQUEST['Phone'];
                $DOB = $_REQUEST['DOB'];
                $Gender = $_REQUEST['Gender'];

                changeUserDetails($_COOKIE['userID'], $FirstName, $LastName, $DOB, $AboutMe, $Phone, $Gender, $City);
                break;

        case 'get_user_details':

                $id = $_REQUEST['id'];
                $jsonData = getUserDetails($id);
                echo $jsonData;
                break;


        case 'get_user_trip_details':

                $id = $_REQUEST['id'];
                $jsonData = getUserTripDetails($id);
                echo $jsonData;
                break;

        // This case would get us all the left content area on the home-page
        // in JSON format
        case 'get_homePage_left_content':

                $jsonData = getHomePageRightContent();
                echo $jsonData;
                break;

        case 'get_source_URL':

                $tripID = $_REQUEST['trip_id'];
                $result = getTripDetails($tripID);
                $placeID = $result['SourceID'];
                echo $result['SourceID'];
                // echo getPlaceURL($placeID);
                break;

        case 'get_dest_URL':

                $tripID = $_REQUEST['trip_id'];
                $result = getTripDetails($tripID);
                $placeID = $result['DestinationID'];
                echo getPlaceURL($placeID);
                break;

        case 'get_profile_pic':
                getUserProfilePic($_COOKIE['userID']);
                break;
                
    	case 'add_user':
    		addUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], md5($_POST['password']));
    		break;
        case 'validate_user':
                
                $encrip_password = md5($_POST['password']);
                validateLogin($_POST['username'], $encrip_password);
                break;

        case 'get_driver_pic':

                $tripID = $_REQUEST['trip_id'];
                $details = getTripDetails($tripID);
                $user = $details['DriverID'];
                echo getUserProfilePic($user);
                break;

        case 'upload_profile_pic':
                upload_pp($_COOKIE['userID']);

                // Redirect to home-page
                header('Location: /pages/sr_profilePage.html');
                break;
        
        case 'get_user_name':
                getUserName($_COOKIE['userID']);
                break;  

        case 'plan_trip':
                //addUser("gfhgf", "hccgf", "sf", "sads");
                
                $dateTimeStamp = $_REQUEST['date']." ".$_REQUEST['time'].":00";
                $seats = $_REQUEST['seats'];
                $notes = $_REQUEST['notes'];

                //Getting Source Geo-Encoding
                $fullSrcAdd = $_REQUEST['fullSrcAdd'];

                $srcLng = $_REQUEST['srcLng'];
                $srcLat = $_REQUEST['srcLat'];


                //Geo-Encoding Destination
                $fullDestAdd = $_REQUEST['fullDestAdd'];

                $srcImgURL = getRandomImageURL();
                $destImgURL = getRandomImageURL();

                $destLng = $_REQUEST['destLng'];
                $destLat = $_REQUEST['destLat'];

                $srcID = addPlace($fullSrcAdd, $srcLat, $srcLng);
           
                $dstnID = addPlace($fullDestAdd, $destLat, $destLng);
          
                $added = addTripDetails($dateTimeStamp, $srcID, $dstnID, $seats, $_COOKIE['userID'], $notes);

                setImageURL($srcID, $srcImgURL);

                setImageURL($dstnID, $destImgURL);

                $added = ($added) ? 'true' : 'false';

                echo $added;

                break;

        case 'get_trip_dateTime':

                $tripID = $_REQUEST['trip_id'];
                $result = getTripDetails($tripID);
                echo $result['TripTimeStamp'];
                break;

        case 'get_trip_source':

                $tripID = $_REQUEST['trip_id'];
                $result = getTripDetails($tripID);
                $placeID = $result['SourceID'];
                echo getPlaceAddress($placeID);
                break;

     
        case 'get_trip_destination':

                $tripID = $_REQUEST['trip_id'];
                $result = getTripDetails($tripID);
                $placeID = $result['DestinationID'];
                echo getPlaceAddress($placeID);
                break;
        case 'check':
                echo "does this work?";
                echo $_REQUEST['trip_id'];
                break;

        case 'get_trip_ids':

                getAllTripIDs();
                break;

        case 'get_last_name':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['LastName'];
                break;

        case 'get_first_name':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['FirstName'];
                break;

        case 'get_user_email':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['Email'];
                break;

        case 'get_user_phone':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['Phone_No'];
                break;

        case 'get_user_dob':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['DOB'];
                break;

        case 'get_user_city':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['City'];
                break;

        case 'get_user_about_me':

                $userID = $_COOKIE['userID'];
                $result = getUserDetails($userID);
                echo $result['AboutMe'];
                break;



        case 'logout':
                deleteCookie();
                break;

    	default:
    		# code...
    		break;
    }
    




//userID_2 reviews userID_1
function postReview($userID_1, $userID_2, $content, $rating)
{
    $query = "Insert into Reviews values($userID_2, $rating, '$content', $userID_1, now());";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo $rating + " " + $userID_1 + " " + $userID_2 + " " + $content;
                echo "Unexpected error!";
                return false;
            }
            else
                return true;
}

function getReviews($userID)
{
    $query = "Select  ReviewTimeStamp, FirstName, LastName, AuthorID, Content, Rating, P.URL from Users as U, Pictures as P, Reviews as R where U.UserID = P.UserID and AuthorID = U.UserID and R.UserID = $userID;";
        $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error!";
                
            }
        
            $result = array();
            if(mysqli_num_rows($res) >=1) {
                while($row = $res->fetch_array()) {
                $arrayName = array('ReviewTime' => $row['ReviewTimeStamp'],'AuthorID' => $row['AuthorID'],'AuthorFirstName' => $row['FirstName'], 'AuthorLastName' => $row['LastName'],'Content' => $row['Content'], 'Rating' => $row['Rating'], 'AuthorPic' => $row['URL']);
                array_push($result,$arrayName);
                }

            }
            return json_encode(array('Result' => $result));
}



function getUserRecentTrips($UserID)
{
  $upcoming = getUserFutureTrips($UserID);
  $past = getUserPastTrips($UserID);
    
  $result = array();
  array_push($result,$upcoming);
  array_push($result,$past);
  return json_encode(array("result" => $result));
  
}


/**
    * Get Users Trips as Driver and Riders Future
    */
    function getUserFutureTrips($UserID){

      $query = "(SELECT T.DriverID,T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where T.TripTimeStamp > Now() and T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID GROUP BY T.TripID) UNION (SELECT T.DriverID, T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, Rides as R, TripLikes as Likes, TripComments as Com where R.PassengerID = U.UserID AND T.TripID = R.TripID and T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = T.DriverID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID and T.TripTimeStamp > Now() GROUP BY T.TripID) ORDER BY TripTimeStamp LIMIT 2; ";
      
    
      $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('DriverID' => $row['DriverID'],'TripID' => $row['TripID'],'DriverPic' => $row['URL'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
                array_push($result,$arrayName);
            }
        }
        else {}
        return json_encode(array("result" => $result));

    } 


    /**
    * Get Users Trips as Driver and Riders Past
    */
    function getUserPastTrips($UserID){

      $query = "(SELECT T.DriverID,T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where T.TripTimeStamp < Now() and T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID GROUP BY T.TripID) UNION (SELECT T.DriverID, T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, Rides as R, TripLikes as Likes, TripComments as Com where R.PassengerID = U.UserID AND T.TripID = R.TripID and T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = T.DriverID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID and T.TripTimeStamp < Now() GROUP BY T.TripID) ORDER BY TripTimeStamp DESC LIMIT 1; ";
      
    
      $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('DriverID' => $row['DriverID'],'TripID' => $row['TripID'],'DriverPic' => $row['URL'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
                array_push($result,$arrayName);
            }
        }
        else {}
        return json_encode(array("result" => $result));

    } 

  //SearchALL function
    function searchALL($substr)
    {
        $trips = searchTrip($substr); //array of Trip objects
        $users = searchUserByName($substr); //array of User objects
        // $userTrips = searchTripByUser($substr); //array of User objects
        $result = array();
        array_push($result,$trips);
        array_push($result,$users);
        // array_push($result,$usersTrips);
        return json_encode(array("result" => $result));
    }

    // function searchTripByUser($substring)
    // {
    //     $substr=$substring;
    //     $query = "(SELECT T.DriverID,T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where (T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID ) and (lower(FirstName) like lower('%$substr%') or lower(LastName) like lower('%$substr%')";
    //     while(($substr=="")!=1)
    //     {
    //         $substr = strtok(' ');
    //         $query = $query." or lower(U.FirstName) like lower('%$substr%') or lower(U.LastName) like lower('%$substr%')";            
    //     }
    //     $query = $query.") GROUP BY Trip.ID) UNION  (SELECT T.DriverID, T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, Rides as R, TripLikes as Likes, TripComments as Com where (R.PassengerID = U.UserID AND T.TripID = R.TripID and T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = T.DriverID and T.TripID = Com.TripID and T.TripID = Likes.TripID ) and (lower(U.FirstName) like lower('%$substr%') or lower(U.LastName) like lower('%$substr%')";
    //     $substr=$substring;
    //     while(($substr=="")!=1)
    //     {
    //         $substr = strtok(' ');
    //         $query = $query." or lower(U.FirstName) like lower('%$substr%') or U.LastName like lower('%$substr%')";            
    //     }
         
    //     $query = $query." ) GROUP BY T.TripID); ";
       
    //     $res = mysqli_query(getConnection(),$query);
    //     $return_trip = "";
    //     $result = array();
    //     if(mysqli_num_rows($res) >=1) {
    //         // echo "<h1><pre>";
    //         while($row = $res->fetch_array()) {
                
    //             $arrayName = array('TripID' => $row['TripID'],'DriverPic' => $row['URL'],'DriverID' => $row['Driverid'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
    //             array_push($result,$arrayName);
    //         }
    //     }
    //     else {}
    //     return json_encode(array("result" => $result));

    // }

    /**
    * Description: This function searches the Trips database for the search substring in SOURCE/DESTINATION
    * 
    * @param $substr Substring to be searched
    * @return JSON of all TripIDs
    **/

    function searchTrip($substr)
    {
        $query = "SELECT T.TripID, Pic.URL, U.UserID as Driverid, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, count(Likes.UserID) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where (T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID) and (lower(P1.Address) like lower('%$substr%') or lower(P2.Address) like lower('%$substr%')";
        $substr = strtok($substr, ' ');        
        while(($substr=='')!=1)
        {
            $query = $query." or lower(P1.Address) like lower('%$substr%') or lower(P2.Address) like lower('%$substr%')"; 
            $substr = strtok(' ');           
        }
        $query = $query." )GROUP BY T.TripID order by abs(datediff(now(), T.TripTimeStamp)),abs(timediff(now(),T.TripTimeStamp));";

       
        $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('TripID' => $row['TripID'],'DriverPic' => $row['URL'],'DriverID' => $row['Driverid'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
                array_push($result,$arrayName);
            }
        }
        else {}
        return json_encode(array("result" => $result));

    }

    /**
    * Description: This function searches the Users database for the search substring in FIRSTNAME/LASTNAME
    * 
    * @param $substr Substring to be searched
    * @return JSON of all TripIDs
    **/

    function searchUserByName($substr)
    {
        $substr = strtok($substr, ' ');
        $query = "SELECT UserID, FirstName, LastName, Email, DOB, Password, Phone_No, Gender, AboutMe, City, URL, count(FollowerID)  as NoOfFollowers  FROM Users natural join Pictures natural join Followers where lower(FirstName) like lower('%$substr%') or lower(LastName) like lower('%$substr%') ";        
        while(($substr=='')!=1)
        {
            $query = $query." or lower(FirstName) like lower('%$substr%') or lower(LastName) like lower('%$substr%')";
            $substr = strtok(' ');
        }
        $query = $query." GROUP BY UserID;";

         $res = mysqli_query(getConnection(), $query);
            $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('UserID' => $row['UserID'],'ProfilePic' => $row['URL'], 'FirstName' => $row['FirstName'], 'LastName' => $row['LastName'], 'Email' => $row['Email'], 'DOB' => $row['DOB'], 'Phone_No' => $row['Phone_No'], 'Gender' => $row['Gender'], 'AboutMe' => $row['AboutMe'], 'City' => $row['City'],'NoOfFollowers' => $row['NoOfFollowers']);
                array_push($result,$arrayName);
            }
        }
        
        else {}
        return json_encode(array("result" => $result));

    }



function startFollowing($userID, $followerID)
    {
        $query = "REPLACE INTO Followers values('$userID', '$followerID');";
        $res = mysqli_query(getConnection(), $query);
        if($res == true){
            return true;
        }
        else{
            echo "Cannot follow user!";
            return false;
        }
    }

function unFollow($userID, $followerID)
{
    $query = "DELETE FROM Followers where UserID = $userID and FollowerID = $followerID;";
    $res = mysqli_query(getConnection(), $query);
    if($res == true){
        return true;
    }
    else{
        echo "Cannot unfollow!";
        return false;
    }
}


//description: checks if user1 follows user2
function isFollower($userID_1, $userID_2)
{
    $query = "SELECT * FROM Followers where UserID = $userID_2 and FollowerID = $userID_1;";
    $res = mysqli_query(getConnection(), $query);
    if(mysqli_num_rows($res) >= 1)
        echo "true";
    else
        echo "false";
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
                echo "True you succesfully deleted the user! You tried to delete $passID from Trip $tripID";

            }
            else
            {  
                echo "False";
            }
            
    }


function getRandomImageURL()
{
        $query = "SELECT URL FROM PlacePics ORDER BY RAND() LIMIT 1;";
        $res = mysqli_query(getConnection(), $query);
        $row = $res->fetch_array();
        $URL= $row['URL'];
        return $URL;
}


/**
    * Description: This function adds a passenger to the Trip and returns True if it were possible
    * @param $passID
    * @param $tripID
    * @return true or false
    */ 
    function addPassengerToTrip($passID, $tripID)
    {
        
            $query = "REPLACE into Rides VALUES ('$passID' , '$tripID',0);";
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


    /*
    * Description: This function gives details about the driver - firstname,lastname,url, the trip time, the riders - firstname,lastname,userid,picture - 
    * and comments for a given trip, by TripID.
    * @param tripid 
    */
    function getTripInfoByID($tripID) {
    

        $result = array();
        $comments =array();
        //$reviews = array();
        $users =array();
        //$driver = array();

        /* This query return details of the all comments - time, user and text. */
        $query1 = "SELECT CommentTimeStamp, Text,FirstName,LastName FROM TripComments, Users WHERE TripID = $tripID AND UserID = AuthorID;";
        $res1 = mysqli_query(getConnection(),$query1);
        if(mysqli_num_rows($res1) >= 1) {
            while($row = $res1->fetch_array()) {
                $arrayName = array('TimeStamp' => $row['CommentTimeStamp'],'FirstName' => $row['FirstName'],'LastName' => $row['LastName'],'Text' => $row['Text']);
                array_push($comments, $arrayName);
            }
        }
        else{}

        /* This query return details of the driver - FirstName, LastName, Image URL and the trip - Time, Source and Destination. */
        $query2 =  "SELECT Phone_No, DriverID, DOB, Gender, NoOfSeats, NoOfSeatsAvailable, Notes, TripID, T.TripTimeStamp,U.FirstName,U.LastName,P.URL,Pl1.Address as Source,Pl2.Address as Destination,Pl1.ImageURL as SourceURL,Pl2.ImageURL as DestinationURL,T.Notes FROM Trips as T, Users as U, Pictures as P, Places as Pl1, Places as Pl2 WHERE T.TripID = $tripID AND T.DriverID = U.UserID AND T.DriverID = P.UserID AND T.SourceID = Pl1.PlaceID AND T.DestinationID = Pl2.PlaceID;";
        $res2 = mysqli_query(getConnection(),$query2);
        if(mysqli_num_rows($res2) >=1) {
            while($row = $res2->fetch_array()) {
                $arrayName = array('DOB' => $row['DOB'],'Gender' => $row['Gender'],'TripId' => $row['TripID'],'DriverID' => $row['DriverID'],'Driver First' => $row['FirstName'],'Driver Last' => $row['LastName'],'Driver Pic URL' => $row['URL'],'Source Address' => $row['Source'],'Destination Address' => $row['Destination'],'SourceURL' => $row['SourceURL'], 'DestinationURL' => $row['DestinationURL'],'Trip Time' => $row['TripTimeStamp'], 'Seats Available' => $row['NoOfSeatsAvailable'], 'Total Seats' => $row['NoOfSeats'], 'Trip Notes' => $row['Notes'], 'Phone' => $row['Phone_No']);
                array_push($result,$arrayName);
            }
        }           

        else {}

        /* This query return details of the all riders - Firstname, LastName,Image URL and UserID. */
        $query3 = "SELECT U.FirstName,U.LastName,U.UserID,P.URL FROM Rides as R,Users as U,Pictures as P WHERE R.TripID = $tripID AND R.PassengerID = U.UserID AND R.PassengerID = P.UserID;";
        $res3 = mysqli_query(getConnection(),$query3);
        if(mysqli_num_rows($res3) >=1) {
            while($row = $res3->fetch_array()) {
                $arrayName = array('User First' => $row['FirstName'],'User Last' => $row['LastName'],'UserID' => $row['UserID'],'URL' => $row['URL']);
                array_push($users,$arrayName);
            }
        }           

        else {} 
    

        $query4 = "SELECT Count(Likes.UserID) as TLike FROM TripLikes as Likes WHERE Likes.TripID =$tripID";
        $res4 = mysqli_query(getConnection(),$query4);
        if(mysqli_num_rows($res4) >=1) {
            while($row = $res4->fetch_array()) {
                $arrayName = array('NoOfLikes' => $row['TLike']);
                array_push($result,$arrayName);
            }
        }           

        else {} 
        array_push($result, $users);
        array_push($result, $comments);
        //array_push($result, $reviews);
        return json_encode(array('Result' => $result));
    }



    function changeUserDetails($UserID, $firstName, $lastName, $dob, $aboutMe, $phno, $gender, $city)
    {
        // $Pw = md5($pw);
        // $query = "SELECT Password FROM Users where UserID = '$UserID';";
        //     $res = mysqli_query(getConnection(), $query);

        //     $row = $res->fetch_array();
        //     $newPw = md5($newPw);
        //     $confirmNewPw=md5($confirmNewPw);
        //     $OldPw = $row['Password'];
        //     if($Pw==$OldPw && $newPw == $confirmNewPw)
        //     {   
                // $query = "SELECT 1+1";
                $query = "UPDATE Users SET FirstName = '$firstName', LastName = '$lastName', DOB = '$dob',AboutMe = '$aboutMe', Phone_No = '$phno', Gender = '$gender', City = '$city'  where UserID = $UserID;";
                $res = mysqli_query(getConnection(), $query);
                if($res==false)
                {
                    echo "Unexpected error!";
                    
                }
                else
                    echo 'True'; 
            // }
            // else
            //     echo 'False';

    }

    /**
    * Send Users Trips as Driver and Riders
    */
    function getUserTripDetails($UserID){

      $query = "(SELECT T.DriverID,T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID GROUP BY T.TripID) UNION (SELECT T.DriverID, T.TripID, Pic.URL, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, (count(Likes.UserID)) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, Rides as R, TripLikes as Likes, TripComments as Com where R.PassengerID = U.UserID AND T.TripID = R.TripID and T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = T.DriverID and T.TripID = Com.TripID and T.TripID = Likes.TripID and U.UserID = $UserID GROUP BY T.TripID); ";
      
    
      $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('DriverID' => $row['DriverID'],'TripID' => $row['TripID'],'DriverPic' => $row['URL'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
                array_push($result,$arrayName);
            }
        }
        else {}
        return json_encode(array("result" => $result));

    } 


     /**
    * Description: This function gets the User Details using a UserID
    * 
    * @param UserID 
    * @return JSON object is echoed and returned. Check the Field Column below to know the name indexes
*+-----------+--------------+------+-----+---------+----------------+
*| Field     | Type         | Null | Key | Default | Extra          |
*+-----------+--------------+------+-----+---------+----------------+
*| UserID    | int(11)      | NO   | PRI | NULL    | auto_increment |
*| FirstName | varchar(30)  | NO   |     | NULL    |                |
*| LastName  | varchar(30)  | NO   |     | NULL    |                |
*| Email     | varchar(60)  | NO   | UNI | NULL    |                |
*| DOB       | date         | YES  |     | NULL    |                |
*| Password  | varchar(70)  | YES  |     | NULL    |                |
*| Phone_No  | varchar(10)  | YES  |     | NULL    |                |
*| Gender    | char(1)      | YES  |     | NULL    |                |
*| AboutMe   | varchar(400) | YES  |     | None    |                |
*| City      | varchar(50)  | YES  |     | NULL    |                |
*| NoOfFollowers  
*+-----------+--------------+------+-----+---------+----------------+
    */
        function getUserDetails($userID)
        {
            $query = "SELECT UserID, FirstName, LastName, Email, DOB, Password, Phone_No, Gender, AboutMe, City, URL, count(FollowerID)  as NoOfFollowers  FROM Users natural join Pictures natural join Followers  where UserID = $userID group by UserID;";
            $res = mysqli_query(getConnection(), $query);
            $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('UserID' => $row['UserID'],'ProfilePic' => $row['URL'], 'FirstName' => $row['FirstName'], 'LastName' => $row['LastName'], 'Email' => $row['Email'], 'DOB' => $row['DOB'], 'Phone_No' => $row['Phone_No'], 'Gender' => $row['Gender'], 'AboutMe' => $row['AboutMe'], 'City' => $row['City'],'NoOfFollowers' => $row['NoOfFollowers']);
                array_push($result,$arrayName);
            }
        }
        
        else {}
        return json_encode(array("result" => $result));
        }
        
    
     // Description: Finds all the data elements needed and formats it in the following format.
                    // JSON FORMAT:             
                    // {
                    // "results" :  
                    // [
                    //     "TripID" :
                    //     "DriverPic": 
                    //     "DriverFirstName":
                    //     "DriverLastName":
                    //     "TripDateTime":
                    //     "SourceAdd":
                    //     "DestAdd":
                    //     "SourceImg":
                    //     "DestImg":
                    //     "NoOfLikes":
                    //     "NoOfComments":
                    //     ,
                    //     "TripID" :
                    //     "DriverPic": 
                    //     "DriverFirstName":
                    //     "DriverLastName":
                    //     "TripDateTime":
                    //     "SourceAdd":
                    //     "DestAdd":
                    //     "SourceImg":
                    //     "DestImg":
                    //     "NoOfLikes":
                    //     "NoOfComments":
                    //     .....etc......
                    // ]
                        
                    // }
     
    function getHomePageRightContent(){

        
      $query = "SELECT T.TripID, Pic.URL, U.UserID as Driverid, U.FirstName, U.LastName, T.TripTimeStamp, P1.Address as SourceAdd, P2.Address as DestAdd, P1.ImageURL as SourceImg, P2.ImageURL as DestImg, count(Com.Text) as NoOfComments, count(Likes.UserID) as NoOfLikes FROM Trips as T, Pictures as Pic, Users as U, Places as P1, Places as P2, TripLikes as Likes, TripComments as Com where T.DriverID = U.UserID AND T.SourceID = P1.PlaceID and T.DestinationID = P2.PlaceID and Pic.UserID = U.UserID and T.TripID = Com.TripID and T.TripID = Likes.TripID GROUP BY T.TripID order by abs(datediff(now(), T.TripTimeStamp)),abs(timediff(now(),T.TripTimeStamp));";

      $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('TripID' => $row['TripID'],'DriverPic' => $row['URL'],'DriverID' => $row['Driverid'], 'DriverFirstName' => $row['FirstName'], 'DriverLastName' => $row['LastName'], 'TripDateTime' => $row['TripTimeStamp'], 'SourceAdd' => $row['SourceAdd'], 'DestAdd' => $row['DestAdd'], 'SourceImg' => $row['SourceImg'], 'DestImg' => $row['DestImg'],'NoOfLikes' => $row['NoOfLikes'],'NoOfComments' => $row['NoOfComments']);
                array_push($result,$arrayName);
            }
        }
        else {}
        return json_encode(array("result" => $result));
    }

    /**
    *Description: This function deletes the cookies for USERID
    */
    function deleteCookie()
    {
        setcookie("userID", "",time() -3600);
        session_destroy();
        session_write_close();
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

        $query = "SELECT max(UserID) as last from Users;";
                    $res = mysqli_query(getConnection(), $query);
                    
                        // echo "problem with select max";
                    $row = $res->fetch_array();
                    $UserIDGenerated= $row['last'];
                    // echo $UserIDGenerated;


        $query = "INSERT INTO Followers VALUES($UserIDGenerated, 1);";
        $res = mysqli_query(getConnection(), $query);

        header("Location: http://splitride.web.engr.illinois.edu/");
        // if($res==false)
            // echo "insert into followers not working yaar";
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


    function getAllTripIDs() {
        $query = "SELECT TripID FROM Trips ORDER BY TripTimeStamp DESC;";
        $res = mysqli_query(getConnection(),$query);
        $return_trip = "";
        $result = array();
        if(mysqli_num_rows($res) >=1) {
            // echo "<h1><pre>";
            while($row = $res->fetch_array()) {
                
                $arrayName = array('TripID' => $row['TripID'] );
                array_push($result,$arrayName);
            }
        }
        else {}
        echo json_encode(array("result" => $result));
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
    * @param $tripID
    * @return   true or false
    */ 
    function cancelTrip($tripID)
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
        $query = "REPLACE INTO Pictures Values ('$userID','$url');";
                        
        $res = mysqli_query(getConnection(), $query);
      }



        //Function to add place details to table Places and return the ID of the just added place
        function addPlace($address, $lat, $lon)
        {
            $query = "INSERT INTO Places(Address, Lat, Longt) Values ('$address', '$lat', '$lon');";
            $res = mysqli_query(getConnection(), $query);
                if($res==false)
                {
                    // echo "Unexpected error! Place couldn't be added!";
                }
            $query = "SELECT max(PlaceID) FROM Places;";
            $res = mysqli_query(getConnection(), $query);
                if($res==false)
                {
                    // echo "Unexpected error! Max id couldnt be fetched!";
                }
                if(mysqli_num_rows($res) >= 1)
                $row = $res->fetch_array();

            $LastID= $row['max(PlaceID)'];
            return $LastID;

        }
       
        //Description: Function to add Trip Details
        function addTripDetails($TripTimeStamp, $srcID, $dstnID, $NoOfSeats, $userID, $notes)
        {
            $query = "INSERT INTO Trips(DriverID,TripTimeStamp, SourceID, DestinationID, NoOfSeats, NoOfSeatsAvailable, Notes) Values ('$userID','$TripTimeStamp', '$srcID','$dstnID', '$NoOfSeats', '$NoOfSeats', '$notes');";
            $res = mysqli_query(getConnection(), $query);
                if($res==false)
                {
                    
                    return false;
                }
                else{

                    
                     $query = "SELECT max(TripID) as last from Trips;";
                    $res = mysqli_query(getConnection(), $query);
                    if($res==false)
                        echo "problem with select max";
                    $row = $res->fetch_array();
                    $tripIdgenerated= $row['last'];

                    $query = "INSERT INTO TripLikes values($tripIdgenerated, 1);";
                    $res = mysqli_query(getConnection(), $query);
                    if($res==false)
                        echo "problem with insert";

                    return true;
                }
                    

        }
           /**
    * Description: This function gets the trip details using tripID
    * 
    * @param tripID(generated from the cookies)
    * @return $row : use row['TripTimeStamp'] etc to access trip details:
*| TripID             | int(11)      | NO   | PRI | NULL    | auto_increment |
*| TripTimeStamp      | datetime     | YES  |     | NULL    |                |
*| NoOfSeats          | int(11)      | YES  |     | NULL    |                |
*| NoOfSeatsAvailable | int(11)      | YES  |     | NULL    |                |
*| Notes              | varchar(500) | YES  |     | NULL    |                |
*| DriverID           | int(11)      | YES  | MUL | NULL    |                |
*| SourceID           | int(11)      | YES  | MUL | NULL    |                |
*| DestinationID      | int(11)      | YES  | MUL | NULL    |                
    */
        function getTripDetails($tripID)
        {
            $query = "SELECT * FROM Trips where TripID = '$tripID';";
            $res = mysqli_query(getConnection(), $query);

            if($res==false)
                {
                    echo "Unexpected error! Trip details couldnt be fetched!";
                }
                if(mysqli_num_rows($res) >= 1)
                {$row = $res->fetch_array();
                return $row;}
                echo "some error";
                

        }

        /**
    * Description: This function gets a concatenated string of a Place
    * 
    * @param placeID
    * @return $result: full address of the place
    **/
        function getPlaceAddress($placeID)
        {
            $query = "SELECT Address FROM Places where PlaceID = '$placeID';";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
                {
                    echo "Unexpected error! Trip details couldnt be fetched!";
                }
                if(mysqli_num_rows($res) >= 1)
                $row = $res->fetch_array();
                return $row['Address'];
        }

  /**
    * Description: This function gets a URL of the place
    * 
    * @param placeID
    * @return $result: image url of the place
    **/
        function getPlaceURL($placeID)
        {
            $query = "SELECT ImageURL FROM Places where PlaceID = '$placeID';";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
                {
                    echo "Unexpected error! Trip details couldnt be fetched!";
                }
                if(mysqli_num_rows($res) >= 1)
                $row = $res->fetch_array();
                return $row['ImageURL'];
        }
        /**
        * Description: This function gets the city of a Place
    * 
    * @param placeID
    * @return $result: full address of the place
    **/
        // function getCity($placeID)
        // {
        //     $query = "SELECT City FROM Places where PlaceID = '$placeID';";
        //     $res = mysqli_query(getConnection(), $query);
        //     if($res==false)
        //         {
        //             echo "Unexpected error! Trip details couldnt be fetched!";
        //         }
        //         if(mysqli_num_rows($res) >= 1)
        //         $row = $res->fetch_array();
        //     $result = $row['City'];
        // }


     //Following functions are used to modify/add user details
    //-------------------------------------------------------
    

    //Description: Change User First Name
    function changeUserFirstName($UserID, $newName)
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

    //Description: Change User LastName Name
    function changeUserLastName($UserID, $newName)
    {
        $query = "UPDATE Users SET LastName = '$newName' where UserID = $UserID;";
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



/**
    * Description: This function sets the imageURL of a Place and returns true if it were possible
    * 
    * @param placeID
    * @return true or false
    **/

        function setImageURL($placeID, $imageURL)
        {
            $query = "UPDATE Places SET ImageURL = '$imageURL' where PlaceID = $placeID;";
            $res = mysqli_query(getConnection(), $query);
            if($res==false)
            {
                echo "Unexpected error! Image URL could not be set!";
                return false;
            }
            else
                return true; 
        }








?>