#![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/logo1.png) SplitRide Application


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
Drivers (UserID, Vehicle, NoOfTrips, NoOfCancellations)
Trips (TripID, TripTimeStamp, NoOfSeats, NoOfSeatsAvailable, Notes, DriverID, SourceID, DestinationID)
Users (UserID, FirstName, LastName, Email, DOB, Password, Phone_No, Gender, AboutMe, City)
Followers (UserID, FollowerID)
Pictures (UserID, URL)
Places (PlaceID, Lat, Longt, ImageURL, Address)
Review (AuthorID, TripID, Rating, Content)
Rides (PassengerID, TripID, Cost)
TripComments (CommentTimeStamp, TripID, AuthorID, Text)
TripLikes (TripID, UserID)
 
#####All Tables:
![Alt Text](https://github.com/vreddi/SplitRide/blob/master/Database%20Schema/All%20Tables.png)

For more details about realtions and other aspects about the schema check the "Database Schema" Directory.

###ER-DIAGRAM:

![Alt Text](https://github.com/vreddi/SplitRide/blob/master/resources/images/ERDiagram.png)
