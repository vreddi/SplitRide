#![Alt Text][logo](https://github.com/vreddi/SplitRide/blob/master/resources/images/logo1.png) SplitRide Application


SplitRide provides users with a platform to collaboratively travel to their desired destinations.
Our user-base is comprised of college-students and faculty members which enhances the 
SplitRide experience to be more communal and safer. With a simple search query, passengers are 
matched with appropriate drivers and are connected to each other for the ride. The expenses are split 
between the travelers based on driver's criteria to make the journey enjoyable and beneficial for all. 

Document & Team Info: https://wiki.cites.illinois.edu/wiki/display/cs411sp15/Team+Heisenbug


###ACCOMPLISHMENT:
When we started our project, we aimed at being at least as useful as the already existent Rideshare groups on social media platforms if not fare better. Today, as we look at SplitRide, we are proud to claim that, though not completely perfect, it is a fully-functional ridesharing application that serves to connect student drivers with their fellow student passengers. Our application has a feature rich front-end, helping prospective passengers plan trips with ease. By helping them know more about a driver – in terms of past driving history, passenger are ensured of security. At the same time, drivers have complete control over who they want to split a ride with.

###USEFULNESS:  
As college students, we tend to give each other lifts when we travel to the same place, so as to save on gas and other expenses. This has spawned various Rideshare groups on facebook and other social networks. However, these groups tend to be disorganized and not very effective.  Having a designated social media platform entirely for ridesharing reduces cluttered facebook groups and makes it much easier to plan trips.
Also, having such a specific use case of allowing people to share rides, we've been able to offer some very useful features like map integration, user profiles, different perspectives for different types of users, detailed trip pages, full control given to the driver - also the initiator - of the trip, driver reviews, a powerful search function, and reminders for upcoming trips. The look and feel of the website is aligned to the look of most familiar social media websites, offering almost no or gentle learning curve to use the website. 
We believe that having an exclusive application solely dedicated to ride-sharing would greatly speed up the process of posting and finding trips happening around users, typically college students. An interactive and stable website only makes the experience much more enjoyable.  


###RELATIONAL SCHEMA:
*Drivers (UserID, Vehicle, NoOfTrips, NoOfCancellations)
*Trips (TripID, TripTimeStamp, NoOfSeats, NoOfSeatsAvailable, Notes, DriverID, SourceID, DestinationID)
*Users (UserID, FirstName, LastName, Email, DOB, Password, Phone_No, Gender, AboutMe, City)
*Followers (UserID, FollowerID)
*Pictures (UserID, URL)
*Places (PlaceID, Lat, Longt, ImageURL, Address)
*Review (AuthorID, TripID, Rating, Content)
*Rides (PassengerID, TripID, Cost)
*TripComments (CommentTimeStamp, TripID, AuthorID, Text)
*TripLikes (TripID, UserID)
 
#####All Tables:
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/Database%20Schema/All%20Tables.png)

For more details about realtions and other aspects about the schema check the "Database Schema" Directory.

###ER-DIAGRAM:

![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/ERDiagram.png)

###COLLECTING DATA:
Geographic information being rendered in maps (including address and geo coordinates) were obtained by using Google Maps JavaScript API V3. User Data was obtained from users during signup, with an added option of making changes to personal details through profile->additional settings. Trip details are obtained from drivers when trips are created.

###FUNCTIONALITY:
The application basically serves the following broad functions -
+<b><u>Signing up, viewing and setting up your profile:</u></b> The very first thing that anyone using the website would be to register/sign-up to the website. Sign up is easy and fast and we only grab the most essential of data. After signing in, the user is allowed to change his account's settings and even add a profile picture!
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img1.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img2.png)

+<b><u>Plan a trip:</u></b> A user is automatically assigned the role of the driver on planning a trip. Apart from the basic information like Source and Destination details (auto-filled by Google Places API), we also allow him/her to add the number of seats available and any additional notes he would want the riders to read.
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img3.png)

+<b><u>Join, Leave, Cancel Trip:</u></b> The strength of our application lies in the different perspectives of the Trip page according to the type of the user. A driver would see the option of cancelling trips or specific riders from the trip. A rider would see the option of leaving the trip while a non-rider would see the option of joining a trip. All operations take place dynamically and reflected in the database almost instantaneously. 
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img4.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img6.png)
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img7.png)

+<b><u>Browse through the Home feed and be able to access upcoming and past trips:</b></u> The social aspect of the application is reflected in the home feed which houses all the trips happening on the website, neatly arranged like a stack of cards, with the most recent trip on the top. To view more details, the user simply needs to click on the 'View-trip' link on the top-right corner of each card. As gentle reminders, upcoming and past trips of the user are also shown individually.
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/img5.png)
