


$(document).ready(function(){


	/**
	* Description: Attaches every user information on the home page for the particular
	* logged in user.
	*/
	function attachUserInfo(){
		//Get profile pic
		var username = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_name",
				async: false
		})

		var profilePicURL = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_profile_pic",
				async: false
		})

		$('#side-bar-trips-title').empty();
		$('#side-bar-trips-title').append(username['responseText']);

		$('#user-profile-pic').attr("src",profilePicURL['responseText']);
		
	}


	attachUserInfo();
	addMainContent();

	attachRecentTrips();


});

$("#srch-term").keyup(function(event){
    if(event.keyCode == 13){
        $(".btn-default").click();
    }
});

function attachRecentTrips(){

	var recentTrips = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_recent_trips",
				async: false
		})


	var upcomingTrips = JSON.parse(JSON.parse(recentTrips['responseText']).result[0]);
	var pastTrip = JSON.parse(JSON.parse(recentTrips['responseText']).result[1]);
	var trips = ""

	for(var i = 0; i < upcomingTrips.result.length ; i ++){

		var driverPic = upcomingTrips.result[i]["DriverPic"];
		trips = ""

		var tripTimeStamp = upcomingTrips.result[i]["TripDateTime"];
		var dater = tripTimeStamp
		var date = moment(dater).format('DD-MM-YYYY');
		var dateMonthAsWord = moment(dater).calendar();
		trips += '<a href="http://splitride.web.engr.illinois.edu/pages/sr_trip.html#' + upcomingTrips.result[i]["TripID"] +'" ><div class="msg msg-success"><img src="' + driverPic +'" class="profile-image img-circle pull-left" style="height: 30px; width: 30px;"><div style="font-size: 20px;">' + dateMonthAsWord +'</div></div></a>'
	
		$(".upcoming").append(trips);

	}

	trips = ""
	var driverPic = pastTrip.result[0]["DriverPic"];
	var tripTimeStamp = pastTrip.result[0]["TripDateTime"];
	var dater = tripTimeStamp
	var date = moment(dater).format('DD-MM-YYYY');
	var dateMonthAsWord = moment(dater).calendar();
	trips += '<a href="http://splitride.web.engr.illinois.edu/pages/sr_trip.html#' + pastTrip.result[0]["TripID"] +'" ><div class="msg msg-default"><img src="' + driverPic +'" class="profile-image img-circle pull-left" style="height: 30px; width: 30px;"><div style="font-size: 20px;">' + dateMonthAsWord +'</div></div></a>'

	$(".past").append(trips);


}

function displaySearchResults(){

	$('.col-sm-8').empty();

	$('.col-sm-8').append('<div class="well"> </div>');

	var content = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=search&words="+document.getElementById("srch-term").value,
				async: false
		})

	trips = JSON.parse(JSON.parse(content['responseText']).result[0]);
	
	for(i = 0; i < trips["result"].length; i++)
	{
		var tripID = trips.result[i]['TripID'];
		
		tripItem = '<!-- Trip Item -->'
    	tripItem +='	         <div class="panel panel-default" id="' + tripID + '">'

    	tripItem +=            '<div class="panel-heading">'

    	tripItem +=              '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + trips.result[i]['DriverID'] + '"><img src="' + trips.result[i]['DriverPic'] + '" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>'

    	var dater = trips.result[i]['TripDateTime'];
		
		var date = moment(dater).format('DD-MM-YYYY');

		var dateMonthAsWord = moment(dater).format('LLLL');

     	
     	tripItem +=             '<a href="http://splitride.web.engr.illinois.edu/pages/sr_trip.html#' + tripID + '" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;"><br> <div style="font-size: 30px; id="time-goes-here">'+ dateMonthAsWord +'</div></h4>'
	    tripItem +=            '</div>'


	    tripItem +=            '<div class="panel-body">'
	    tripItem +=           '<div class="row">'
	    tripItem +=            '<img src="' + trips.result[i]['SourceImg'] + '" class="thumbnail text-center pull-left" style="width: 250px; height: auto;">'
	    tripItem +=            '<img src="http://www.kravmagagilbert.com/wp-content/uploads/2014/08/arrow-39526_640.png" style="width: 150px; height: auto; margin-left: 7%; margin-top: 25px; border: ">'
	    tripItem +=            '<img src="' + trips.result[i]['DestImg'] + '" class="thumbnail text-center pull-right" style="width: 250px; height: auto;">'
	    tripItem +=            '<div class="clearfix"></div>'
	     tripItem +=            '</div>'

	     tripItem +=           '<div class="row">'
	     tripItem += 			'<h4><p class="text-center pull-left" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-left: 15px;">' + trips.result[i]['SourceAdd'] + '</p></h4>'
	     tripItem +=           '<h4><p class="text-center pull-right" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-right: 15px;">' + trips.result[i]['DestAdd'] + '</p></h4>'
	     tripItem +=           '</div>'

	    tripItem +=      ' </div>'
	    tripItem +=     '</div>' 
	    tripItem +=        '<!-- Trip Item End -->';

	    $('.col-sm-8').append(tripItem);
	   }

	   users = JSON.parse(JSON.parse(content['responseText']).result[1]);

	   for(i = 0; i < users["result"].length; i++)
	{
		var userID = users.result[i]['UserID'];
		
		tripItem = '<!-- User Item -->'
    	tripItem +='	         <div class="panel panel-default" id="' + userID + '">'

    	tripItem +=            '<div class="panel-heading">'

    	tripItem +=              '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + userID + '"><img src="' + users.result[i]['ProfilePic'] + '" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>'



     	
     	tripItem +=             '<h4 style="margin-left: 90px;"><br> <div style="font-size: 30px; id="time-goes-here">'+ users.result[i]['FirstName'] + " " + users.result[i]['LastName'] +'</div></h4>'
	    tripItem +=            '</div>'
	   
	    tripItem +=        '<!-- User Item End -->';

	    $('.col-sm-8').append(tripItem);
	   }


}

function addMainContent(){

	$('.col-sm-8').empty();

	$('.col-sm-8').append('<div class="well"> </div>');



	var content = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_homePage_left_content",
				async: false
		})

	var jsonData = JSON.parse(content['responseText']);

	for( var i = 0; i < jsonData.result.length; i++){
		
		var tripID = jsonData.result[i]['TripID'];
		
		tripItem = '<!-- Trip Item -->'
    	tripItem +='	         <div class="panel panel-default" id="' + tripID + '">'

    	tripItem +=            '<div class="panel-heading">'

    	tripItem +=              '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + jsonData.result[i]['DriverID'] + '"><img src="' + jsonData.result[i]['DriverPic'] + '" class="profile-image img-circle pull-left" style="margin-top: 0px;"></a>'

    	var dater = jsonData.result[i]['TripDateTime'];
		
		var date = moment(dater).format('DD-MM-YYYY');

		var dateMonthAsWord = moment(dater).format('LLLL');

     	
     	tripItem +=             '<a href="http://splitride.web.engr.illinois.edu/pages/sr_trip.html#' + tripID + '" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;"><br> <div style="font-size: 30px; id="time-goes-here">'+ dateMonthAsWord +'</div></h4>'
	    tripItem +=            '</div>'


	    tripItem +=            '<div class="panel-body">'
	    tripItem +=           '<div class="row">'
	    tripItem +=            '<img src="' + jsonData.result[i]['SourceImg'] + '" class="thumbnail text-center pull-left" style="width: 250px; height: auto;">'
	    tripItem +=            '<img src="http://www.kravmagagilbert.com/wp-content/uploads/2014/08/arrow-39526_640.png" style="width: 150px; height: auto; margin-left: 7%; margin-top: 25px; border: ">'
	    tripItem +=            '<img src="' + jsonData.result[i]['DestImg'] + '" class="thumbnail text-center pull-right" style="width: 250px; height: auto;">'
	    tripItem +=            '<div class="clearfix"></div>'
	     tripItem +=            '</div>'

	     tripItem +=           '<div class="row">'
	     tripItem += 			'<h4><p class="text-center pull-left" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-left: 15px;">' + jsonData.result[i]['SourceAdd'] + '</p></h4>'
	     tripItem +=           '<h4><p class="text-center pull-right" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-right: 15px;">' + jsonData.result[i]['DestAdd'] + '</p></h4>'
	     tripItem +=           '</div>'

	    tripItem +=      ' </div>'
	    tripItem +=     '</div>' 
	    tripItem +=        '<!-- Trip Item End -->';

	    $('.col-sm-8').append(tripItem);
	}

}

// Delete the Cookie
	$('#logout-btn').on('click', function(e){

		$.get("http://splitride.web.engr.illinois.edu/queries.php?q=logout");
		window.location.replace('http://splitride.web.engr.illinois.edu/');
		window.location.replace('http://splitride.web.engr.illinois.edu/');
	});


