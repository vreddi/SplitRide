var tripData;

if(window.location.hash.substring(1).length > 0){
	var tripDet = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_trip_info_by_id&tripID=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	var jsonData = JSON.parse(tripDet['responseText']);
	tripData = jsonData.Result;
}
else{

	window.location.replace('http://splitride.web.engr.illinois.edu/');

}

function refreshRiderList(){

	if(window.location.hash.substring(1).length > 0){
	var tripDet = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_trip_info_by_id&tripID=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	var jsonData = JSON.parse(tripDet['responseText']);
	tripData = jsonData.Result;
	}
	else{

		window.location.replace('http://splitride.web.engr.illinois.edu/');

	}

}

$(document).ready(function(){

	$('.profile-content').empty();
	attachTripDetails();

});

function _calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}


function attachTripDetails(){

	var tripDetails = "";
	tripDetails += '<h1>Trip Info: </h1>'
	tripDetails += '<hr>'
	tripDetails += '<h3><b>Driver:</b></h3>'
	tripDetails += '<hr>'
	tripDetails += '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + tripData[0]["DriverID"] + '"><img src="' + tripData[0]["Driver Pic URL"] + '" class="profile-image img-circle pull-left" style="margin-top: 0px; width: 100px; height: 100px;"></a>'
	
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'

	tripDetails += '<h4><b>Name: </b>' + tripData[0]["Driver First"] + " " + tripData[0]["Driver Last"] + '</h4>'
	tripDetails += '<h4><b>Phone: </b>' + tripData[0]["Phone"] + ' </h4>'
	tripDetails += '<h4><b>Gender: </b>' + tripData[0]["Gender"] + ' </h4>'

	var age = _calculateAge(new Date(tripData[0]["DOB"]));

	if(age > 100){
		age = "Unknown";
	}

	tripDetails += '<h4><b>Age: </b> ' + age + '</h4>'
	tripDetails += '<br>'

	tripDetails += '<h3><b>Source:</b></h3>'
	tripDetails += '<hr>'
	tripDetails += '<h4>' + tripData[0]["Source Address"] + '</h4>'
	tripDetails += '<h3><b>Destination:</b></h3>'
	tripDetails += '<hr>'
	tripDetails += '<h4>' + tripData[0]["Destination Address"] + '</h4>'
	tripDetails += '<br>'
	tripDetails += '<h3><b>Departure Date/Time:</b></h3>'
	tripDetails += '<hr>'
	tripDetails += '<h4>' + tripData[0]["Trip Time"] + '</h4>'
	tripDetails += '<br>'
	tripDetails += '<h3><b>Driver\'s Notes:</b></h3>'
	tripDetails += '<hr>'
	tripDetails += '<h4><p style="width: 700px; word-wrap: break-word;">' + tripData[0]['Trip Notes'] + '</p></h4>'

	tripDetails += '<hr>'
	tripDetails += '<br>'
	tripDetails += '<img src="' + tripData[0]["SourceURL"] + '" class="thumbnail text-center pull-left" style="width: 250px; height: auto;">'
	tripDetails += '<img src="http://www.kravmagagilbert.com/wp-content/uploads/2014/08/arrow-39526_640.png" style="width: 150px; height: auto; margin-left: 12%; margin-top: 25px; border: ">'
	tripDetails += '<img src="' + tripData[0]["DestinationURL"] + '" class="thumbnail text-center pull-right" style="width: 250px; height: auto;">'

	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'

	var totalRiders = tripData[2].length;

	tripDetails += '<h3>Current Riders (' + String(parseInt(tripData[0]["Total Seats"]) - parseInt(tripData[0]["Seats Available"])) + "/" + tripData[0]["Total Seats"] + '):<h3>'
	tripDetails += '<hr>'	
	tripDetails += '<br>'
	tripDetails += '<div id="current-riders">'

	// Get current User Cookie UserID
	var user_id = getCookie("userID");
	
	if(parseInt(tripData[0]["DriverID"]) == user_id){

		for(var i = 0; i < totalRiders; i++){

		tripDetails += '<div style="width: 90px;" class="' + tripData[2][i]["UserID"] + '">'
		tripDetails += '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + tripData[2][i]["UserID"] + '" class="' + tripData[2][i]["UserID"] + '"><img src="' + tripData[2][i]["URL"] + '" class="profile-image img-circle pull-left" style="margin-top: 0px; margin-left: 10px; width: 80px; height: 80px;"></a>'
		tripDetails += '<button class="btn btn-danger" style="margin-left:10px;" onclick="removepassenger(' + tripData[2][i]["UserID"] + ')">Remove</button>'
		tripDetails += '</div>'
	}

	}
	else{

		for(var i = 0; i < totalRiders; i++){

		tripDetails += '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + tripData[2][i]["UserID"] + '" class="' + tripData[2][i]["UserID"] + '"><img src="' + tripData[2][i]["URL"] + '" class="profile-image img-circle pull-left" style="margin-top: 0px; margin-left: 10px; width: 80px; height: 80px;"></a>'
	}

	}

	
	tripDetails += '</div>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'
	tripDetails += '<br>'


	tripDetails += '<h2>Map: </h2>'
	tripDetails += '<hr>'

	var source = tripData[0]["Source Address"].replace(/\ /g, "+");

	var destination = tripData[0]["Destination Address"].replace(/\ /g, "+");

	tripDetails += '<iframe style="margin-left: 15%;" width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?origin=' + source + '&destination=' + destination + '&key=AIzaSyDXfOS4U6P6O3flOx8zVieIVXu7sh92mqE"></iframe>'

	var isRider = false;

	for(var i = 0; i < tripData[2].length; i++){

		if(parseInt(tripData[2][i]["UserID"]) == user_id){
			isRider = true;
		}
	}

	if(parseInt(tripData[0]["DriverID"]) == user_id){
		tripDetails += '<div class="" data-toggle="buttons">'
	    tripDetails +=    '<label class="btn btn-lg btn-block btn-danger text-default" onclick="cancelTrip()">'
	    tripDetails +=        '<input type="radio" name="options" id="option2" autocomplete="off">'
	    tripDetails +=        '<i class="fa fa-times-circle fa-3x"></i>'
	    tripDetails +=        '<br />'
	    tripDetails +=        'Cancel Trip'
	    tripDetails +=    '</label>'   
	    tripDetails += '</div>'
	}
	else if(parseInt(tripData[0]["Seats Available"]) == 0){
		tripDetails += '<br>'
		tripDetails += '<br>'
		tripDetails += '<br>'
		tripDetails += '<div class="text-center">'
		tripDetails +=	'<i class="fa fa-car fa-3x"></i>'
		tripDetails +=	'<br />'
	    tripDetails +=  '<h2>Trip Full</h2>'
	    tripDetails +=  '</div>'
	}
	else if(isRider){
		tripDetails += '<div class="" data-toggle="buttons">'
	    tripDetails +=    '<label class="btn btn-lg btn-block btn-default text-success active" onclick="joinRide()">'
	    tripDetails +=        '<input type="radio" name="options" id="option1" autocomplete="off" checked>'
	    tripDetails +=        '<i class="fa fa-check-circle-o fa-3x animated fadeIn"></i>'
	    tripDetails +=        '<br />'
	    tripDetails +=        'Join Trip'
	    tripDetails +=    '</label>'
	    tripDetails +=    '<label class="btn btn-lg btn-block btn-danger text-default" onclick="leaveTrip()">'
	    tripDetails +=        '<input type="radio" name="options" id="option2" autocomplete="off">'
	    tripDetails +=        '<i class="fa fa-sign-out fa-3x"></i>'
	    tripDetails +=        '<br />'
	    tripDetails +=        'Leave Trip'
	    tripDetails +=    '</label>'  
	    tripDetails += '</div>'
	}
	else{
		tripDetails += '<div class="" data-toggle="buttons">'
	    tripDetails +=    '<label class="btn btn-lg btn-block btn-success text-success active">'
	    tripDetails +=        '<input type="radio" name="options" id="option1" autocomplete="off" checked>'
	    tripDetails +=        '<i class="fa fa-check-circle-o fa-3x animated fadeIn"></i>'
	    tripDetails +=        '<br />'
	    tripDetails +=        'Joined!'
	    tripDetails +=    '</label>'
	    tripDetails +=    '<label class="btn btn-lg btn-block btn-default text-default" onclick="joinRide()">'
	    tripDetails +=        '<input type="radio" name="options" id="option2" autocomplete="off">'
	    tripDetails +=        '<i class="fa fa-circle-o fa-3x"></i>'
	    tripDetails +=        '<br />'
	    tripDetails +=        'Join Ride'
	    tripDetails +=    '</label>'   
	    tripDetails += '</div>'
	}

    $('.profile-content').append(tripDetails);

}


function cancelTrip(){

	var cancel = $.ajax({
			url: "http://splitride.web.engr.illinois.edu/queries.php?q=cancel_trip&tripID=" + parseInt(tripData[0]["TripId"]) + "",
			async: false
	})

	window.location.replace("http://splitride.web.engr.illinois.edu/pages/sr_homePage.php");

}

function removepassenger(userID){

	var removePassenger = $.ajax({
			url: "http://splitride.web.engr.illinois.edu/queries.php?q=remove_passenger_from_trip&tripID=" + parseInt(tripData[0]["TripId"]) + "&passengerID="+ userID + "",
			async: false
	})

	refreshRiderList();

	$("div ."+userID ).remove();
}

function joinRide(){

//Add passengers to the trip
//But first check remaining seats

	// Get current User Cookie UserID
	var user_id = getCookie("userID");

	
	var addPassenger = $.ajax({
			url: "http://splitride.web.engr.illinois.edu/queries.php?q=add_passenger_to_trip&tripID=" + parseInt(tripData[0]["TripId"]) + "",
			async: false
	})
	refreshRiderList();

	var newRiderURL;

	for(var i = 0; i < tripData[2].length; i++){

		if(parseInt(tripData[2][i]["UserID"]) == user_id){
			newRiderURL = tripData[2][i]["URL"];
		}
	}

	$( "."+user_id ).remove();
	$("#current-riders").append('<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + user_id + '" class="' + user_id + '"><img src="' + newRiderURL + '" class="profile-image img-circle pull-left" style="margin-top: 0px; margin-left: 10px; width: 80px; height: 80px;"></a>')


}


function leaveTrip(){

	// Get current User Cookie UserID
	var user_id = getCookie("userID");

	
	var leavePassenger = $.ajax({
			url: "http://splitride.web.engr.illinois.edu/queries.php?q=leave_passenger_from_trip&tripID=" + parseInt(tripData[0]["TripId"]) + "",
			async: false
	})
	refreshRiderList();

	$( "."+user_id ).remove();


}