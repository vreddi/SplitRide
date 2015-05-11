#![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/logo1.png) SplitRide Application


SplitRide provides users with a platform to collaboratively travel to their desired destinations.
Our user-base is comprised of college-students and faculty members which enhances the 
SplitRide experience to be more communal and safer. With a simple search query, passengers are 
matched with appropriate drivers and are connected to each other for the ride. The expenses are split 
between the travelers based on driver's criteria to make the journey enjoyable and beneficial for all. 

Document & Team Info: https://wiki.cites.illinois.edu/wiki/display/cs411sp15/Team+Heisenbug

---
###ACCOMPLISHMENT:
When we started our project, we aimed at being at least as useful as the already existent Rideshare groups on social media platforms if not fare better. Today, as we look at SplitRide, we are proud to claim that, though not completely perfect, it is a fully-functional ridesharing application that serves to connect student drivers with their fellow student passengers. Our application has a feature rich front-end, helping prospective passengers plan trips with ease. By helping them know more about a driver – in terms of past driving history, passenger are ensured of security. At the same time, drivers have complete control over who they want to split a ride with.

---
###USEFULNESS:  
As college students, we tend to give each other lifts when we travel to the same place, so as to save on gas and other expenses. This has spawned various Rideshare groups on facebook and other social networks. However, these groups tend to be disorganized and not very effective.  Having a designated social media platform entirely for ridesharing reduces cluttered facebook groups and makes it much easier to plan trips.
Also, having such a specific use case of allowing people to share rides, we've been able to offer some very useful features like map integration, user profiles, different perspectives for different types of users, detailed trip pages, full control given to the driver - also the initiator - of the trip, driver reviews, a powerful search function, and reminders for upcoming trips. The look and feel of the website is aligned to the look of most familiar social media websites, offering almost no or gentle learning curve to use the website. 
We believe that having an exclusive application solely dedicated to ride-sharing would greatly speed up the process of posting and finding trips happening around users, typically college students. An interactive and stable website only makes the experience much more enjoyable.  

---
###RELATIONAL SCHEMA:
+ Drivers (UserID, Vehicle, NoOfTrips, NoOfCancellations)
+ Trips (TripID, TripTimeStamp, NoOfSeats, NoOfSeatsAvailable, Notes, DriverID, SourceID, DestinationID)
+ Users (UserID, FirstName, LastName, Email, DOB, Password, Phone_No, Gender, AboutMe, City)
+ Followers (UserID, FollowerID)
+ Pictures (UserID, URL)
+ Places (PlaceID, Lat, Longt, ImageURL, Address)
+ Review (AuthorID, TripID, Rating, Content)
+ Rides (PassengerID, TripID, Cost)
+ TripComments (CommentTimeStamp, TripID, AuthorID, Text)
+ TripLikes (TripID, UserID)
 
#####All Tables:
| Name |
| -----------:|
| Drivers |
| Followers |
| Pictures |
| PlacePics |
| Places |
| Rides |
| Reviews |
| TripComments |
| TripLikes |
| Trips |
| Users |

For more details about realtions and other aspects about the schema check the "Database Schema" Directory.

---
###ER-DIAGRAM:

![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/ERDiagram.png)

---
###COLLECTING DATA:
Geographic information being rendered in maps (including address and geo coordinates) were obtained by using Google Maps JavaScript API V3. User Data was obtained from users during signup, with an added option of making changes to personal details through profile->additional settings. Trip details are obtained from drivers when trips are created.

---
###FUNCTIONALITY:
The application basically serves the following broad functions -
<b><u>1. Signing up, viewing and setting up your profile:</u></b> The very first thing that anyone using the website would be to register/sign-up to the website. Sign up is easy and fast and we only grab the most essential of data. After signing in, the user is allowed to change his account's settings and even add a profile picture!
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img1.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img2.png)

<b><u>2. Plan a trip:</u></b> A user is automatically assigned the role of the driver on planning a trip. Apart from the basic information like Source and Destination details (auto-filled by Google Places API), we also allow him/her to add the number of seats available and any additional notes he would want the riders to read.
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img3.png)

<b><u>3. Join, Leave, Cancel Trip:</u></b> The strength of our application lies in the different perspectives of the Trip page according to the type of the user. A driver would see the option of cancelling trips or specific riders from the trip. A rider would see the option of leaving the trip while a non-rider would see the option of joining a trip. All operations take place dynamically and reflected in the database almost instantaneously. 
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img4.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img6.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img7.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img8.png)

<b><u>4. Browse through the Home feed and be able to access upcoming and past trips:</b></u> The social aspect of the application is reflected in the home feed which houses all the trips happening on the website, neatly arranged like a stack of cards, with the most recent trip on the top. To view more details, the user simply needs to click on the 'View-trip' link on the top-right corner of each card. As gentle reminders, upcoming and past trips of the user are also shown individually.
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img5.jpg)

<b><u>5. Search by User Name, Location, basically anything:</u></b> (explained in detail in Advanced Functions) We take a lot of pride in our Search function, which offers a convenient and fast way to search across the database for User Profiles and/or Trip information.

<b><u>6. Review Drivers/Co-Passengers:</u></b> We believe that riders should be able to express their feelings after a trip and thus allow them to review their drivers or co-passengers by accessing the review form on every user's profiles. Also since all reviews are shown without any moderation, we allow users to lookup their co-riders' profiles and reviews in advance and make informed decisions.

<b><u>7. Logout:</b></u> Safely Logout of our servers and enjoy your ride!

---
###ADVANCED FUNCTIONALITY:
<p>
<b><u>Trip Details Page & Profile System:</u></b> Like we mentioned before, the different user perspective is the most powerful functionality out of all. The Trip page is where different kinds of users have different functionality. The page is the same but the application recognizes the user and then intelligently provides the user with his restricted functionality. The easiest way to explain this is with an example. So lets say a Driver created a Trip Page. Then we he visits that page he would have the functionality of canceling that trip (as it is his trip) and removing currently joined riders from that trip. When a Rider joins that trip and visits that page, He only has the restricted functionality to opt out of the trip i.e get out of that trip. Once out then he would again have the functionality of joining that trip. If the number of riders are all full for the trip then no more Riders are allowed to join the trip page. The trip page also recognizes if the Returning Rider is already in the trip or not. So a lot of information is perceived by that page in order to cater the right kind of user. 

We tackled this problem very intelligently where encrypted user's Unique ID grabbed fro the backend inside the DOM (The link for the profile page of each user). This method proved to be most efficient as the data for redirection and presentation of restricted functionality for specific users could be directly identified by parsing the DOM using JQuery. Our use of huge JSON files reduced the number of PHP Query request that we made which in-turn made the site faster and more efficient.

We also added profile system to our application also much like any real world application. Our goal here was to get as close to a working real world model as possible. Each user can view his/her profile along with the capabilities of changing their Account Details and browsing their Reviews. Any user can click on any user on the website and it would redirect to a profile template loaded up with the requested user's information. The application intelligently decides that the incoming user is not the owner of the profile and hence should not get profile privileges such as changing Email, FirstName, LastName etc. Users can also follow other users (just like in twitter) which gives them a sense of popularity within the community.
</p>
<p>
<b><u>Search:</u></b> Our website offers a very useful Search function, complete with case insensitivity and being able to search for every word in the search query separately such that even if the user only slightly remembers what he/she's looking for, he's bound to move only ahead with our unique Search.
Very broadly, our search displays the following kind of results:
* By User Names  – The strings would be searched against the user table, especially the FirstName and LastName attribute, so as to give a list of all users where the search string is a part of their name or substring of their name.
* By Source/Destination of Trips – The strings would be searched against the Places database to get a list of all those trips where the search string occurs in the source name or destination name.
However simple that sounds, it wasn't that easy to implement, specially since we aimed at doing the entire search in just two queries. Yes, all trip details and user details query the database just once! This results in exceptional speedy results and thus enhances user experience. 
</p>
<p>
To accomplish this task, we employed the following steps:
* Accepted the string and posted it to the php page.
* Constructed a partial query which returned every trip detail (along with Driver, Place, Likes, and Comments details - joining more than 5 tables).
* Tokenized the string (to get the first word) and appended lower(Source.Address) like lower('%token%') to the end of the partial query.
* We keep tokenizing the string until we get nothing and appending as above.
* We then run the entire query and push each tuple into an array.
* We then encode it into a JSON which is then parsed by the JS file.
* The entire task from its conception to debugging to accomplishing it took us a good amount of time and we learned plenty from the experience, both in front-end and back-end.
</p>

---
###BASIC FUNCTIONALITY (CODE SNIPPET):

```php
//Description: Function to add Trip Details
function addTripDetails($TripTimeStamp, $srcID, $dstnID, $NoOfSeats, $userID, $notes){
      $query = "INSERT INTO Trips(DriverID,TripTimeStamp, SourceID, DestinationID, NoOfSeats, NoOfSeatsAvailable, Notes) Values ('$userID','$TripTimeStamp', '$srcID','$dstnID', '$NoOfSeats', '$NoOfSeats', '$notes');";
      $res = mysqli_query(getConnection(), $query); 

      if($res==false) {
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
```

The above function adds the trip details to the Database when a user plans/creates a trip on the front end. 

---
###TECHNICAL CHALLENGE:
One common programming practice is to make functions small and atomic and good at accomplishing a single task.  As we were developing the controller layer of our application, we attempted to apply this principle to the PHP functions which contained our queries.  In essence, each individual database query had a single php function which corresponded to it.  This negatively affected the performance of our site as for every page load, there would be dozens of  server requests would be made from our site which would require many queries.  This was because that request would then make many php calls, which would in turn make many individual SQL queries, causing a dramatic increase in server response time.  To deal with this, we were forced to refactor a significant chunk of our php code to include larger php functions which perform many queries in a single call. This wasn't easy at all, especially with the frustrating number of joins and the fact that the omission of even a comma would mean breaking the website. Although this was challenging, the performance gain was well worth the refactoring time. Now the website is snappy and neat.

---
###DEVIATIONS FROM INITIAL PROJECT:
Our final product had several deviations from the schema that was originally proposed in Stage 1. In the end we added an additional entity in our ER model for places that people would share rides to and from. In addition, we added several attributes to existing entities.  We also removed certain relations that were present in the original model which ended up being unnecessary to achieve functionality in our model.

---
###VIDEO DEMO:
<p>
(Click to Play)
</p>
[![IMAGE ALT TEXT HERE](http://img.youtube.com/vi/N7fzvAA8gxU/0.jpg)](http://www.youtube.com/watch?v=N7fzvAA8gxU)

---
###TEAM LOGO: 

![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/heisenbug.png)
