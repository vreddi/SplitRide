//User's Session Cookie
var user_id = getCookie("userID");
var myProfile = false;
var follower = false;


if(window.location.hash.substring(1).length > 0 && parseInt(window.location.hash.substring(1)) != parseInt(user_id)){
	
	myProfile = false;

	var follow = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=is_follows&profileUser=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	if(follow['responseText'] == 'true'){
		follower = true;
	}
	else{
		follower = false;
	}

	var userDetails = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_details&id=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	var jsonData = JSON.parse(userDetails['responseText']);
	userData = jsonData.result[0];

	var userTripDetails = $.ajax({
					url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_trip_details&id=" + parseInt(window.location.hash.substring(1)) + "",
					async: false
			})

	var jsonData = JSON.parse(userTripDetails['responseText']);
	userTripData = jsonData.result;
}
else{



	myProfile = true;
	var userDetails = $.ajax({
			url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_details&id=" + parseInt(user_id) + "",
			async: false
	})

	var jsonData = JSON.parse(userDetails['responseText']);
	userData = jsonData.result[0];

	var userTripDetails = $.ajax({
					url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_user_trip_details&id=" + parseInt(user_id) + "",
					async: false
			})

	var jsonData = JSON.parse(userTripDetails['responseText']);
	userTripData = jsonData.result;

}

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

$(document).ready(function(){


	/**
	* Description: Attaches every user information on the home page for the particular
	* logged in user.
	*/
	function attachUserInfo(){

		$('.profile-usertitle-name').empty();
		$('.profile-usertitle-name').append("" + userData['FirstName'] + " " +  userData['LastName']);

		$('.profile-userpic img').attr("src",userData['ProfilePic']);
		
	}

	attachUserInfo();
	// addAccountSettings()

	// Empty Content Area
	$('.profile-content').empty();
	addOverallContent();

	if(myProfile == false){

		$("#account").empty();
		$("#account").append('<i class="glyphicon glyphicon-user"></i>About ' + userData["FirstName"]);

		if(follower == true){
			$("#follow").removeClass( "btn-success" ).addClass( "btn-danger" );
			$('#follow').empty();
			$('#follow').append("Unfollow");

		}
		else{
			//Do nothing
		}

	}
	else{
		//Remove Follow Button
		$("#follow").remove();
	}

	$('.profile-usertitle-job').append(" " + String(parseInt(userData['NoOfFollowers']) - 1));

});

// Delete the Cookie
$('#logout-btn').on('click', function(e){

	$.get("http://splitride.web.engr.illinois.edu/queries.php?q=logout");
	window.location.replace('http://splitride.web.engr.illinois.edu/');
});

/* FOLLOW BUTTON */
$('#follow').on('click', function(){

	// Unfollow
	if(follower == true){

		var follow = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=unfollow&profileUser=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	}
	// Follow
	else{

		var follow = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=start_following&profileUser=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	}

	location.reload();

});


$('.nav li').on('click', function(){

	if(myProfile == false){

		// Clicked the tab which was already active..... Hah Noob!
		// Dont do anything
		if($(this).hasClass("active")){

		}
		else{

			// Remove the active class from every tab
			$('.nav li').attr('class','');

			// Make the new Tab Active
			$(this).attr('class','active');

			// Empty Content Area
			$('.profile-content').empty();


			var id = $(".active").attr('id');
			// Account Settings
			if(id == "acSettings"){

				showAccountDetails();

			}

			// Overall
			else if(id == "overall"){
				addOverallContent();
			}

			// Reviews / Check
			else{
				addReviews();
			}

		}

	}

	else{

		// Clicked the tab which was already active..... Hah Noob!
		// Dont do anything
		if($(this).hasClass("active")){

		}
		else{

			// Remove the active class from every tab
			$('.nav li').attr('class','');

			// Make the new Tab Active
			$(this).attr('class','active');

			// Empty Content Area
			$('.profile-content').empty();


			var id = $(".active").attr('id');
			// Account Settings
			if(id == "acSettings"){

				addAccountSettings();

			}

			// Overall
			else if(id == "overall"){
				addOverallContent();
			}

			// Reviews / Check
			else{
				addReviews();
			}

		}

	}
});






function showAccountDetails(){

	var aboutMe = "<h1>About " + userData["FirstName"] + "</h1>"
	aboutMe += '<hr>'
	aboutMe += '<br>'
	aboutMe += '<h3><b>Name: </b></h3><h4>' + userData["FirstName"] + " " + userData["LastName"] + '</h4>'
	aboutMe += '<h3><b>Email: </b></h3><h4>' + userData["Email"] + '</h4>'

	var dater = userData["DOB"];
		
	var date = moment(dater).format('DD-MM-YYYY');

	var dateMonthAsWord = moment(dater).format('LL');


	aboutMe += '<h3><b>Date of Birth: </b></h3><h4>' + dateMonthAsWord + '</h4>'
	aboutMe += '<h3><b>City: </b></h3><h4>' + userData["City"] + '</h4>'
	aboutMe += '<h3><b>Gender: </b></h3><h4>' + userData["Gender"] + '</h4>'
	aboutMe += '<h3><b>Phone: </b></h3><h4>' + userData["Phone_No"] + '</h4>'
	aboutMe += '<br>'
	aboutMe += '<hr>'
	aboutMe += '<h3>About Me:<br></h3>'
	aboutMe += "<h4>" + userData["AboutMe"] + '</h4>'

	//Append HTML Code
	$('.profile-content').append(aboutMe);

}


/**
* Description: This function adds the Overall-Content to the profile Content Area.
* Remember that this function does not remove the previous content in the content area on
* the profile page.
*/
function addReviews(){

	var reviewCode = "";
	if(myProfile == true){

		var reviews = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_reviews&driver=" + user_id + "",
				async: false
		})

	}
	else{

		var reviews = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=get_reviews&driver=" + parseInt(window.location.hash.substring(1)) + "",
				async: false
		})

	}

	reviewCode += '<div class="container">'
  reviewCode += '<div class="row">'
  reviewCode +=   '<div class="col-md-8">'
  reviewCode +=     '<h2 class="page-header">Reviews:</h2>'
  //Append HTML Code
	$('.profile-content').append(reviewCode);

	var authorReviews = JSON.parse(reviews['responseText']).Result;


	for(var i = 0; i < authorReviews.length; i++){

		reviewCode = ""

    reviewCode +=     '<section class="comment-list">'
     reviewCode +=      '<!-- First Comment -->'
     reviewCode +=      '<article class="row">'
     reviewCode +=        '<div class="col-md-2 col-sm-2 hidden-xs">'
     reviewCode +=          '<figure class="thumbnail">'
      reviewCode +=           '<img class="img-responsive" src="' + authorReviews[i]['AuthorPic'] + '" />'
      reviewCode +=           '<figcaption class="text-center">' + authorReviews[i]['AuthorFirstName'] + '</figcaption>'
      reviewCode +=         '</figure>'
      reviewCode +=       '</div>'
      reviewCode +=       '<div class="col-md-10 col-sm-10">'
      reviewCode +=         '<div class="panel panel-default arrow left">'
      reviewCode +=           '<div class="panel-body">'
      reviewCode +=             '<header class="text-left">'
      reviewCode +=               '<div class="comment-user"></i>Rating:'

      for(var j = 0; j < parseInt(authorReviews[i]['Rating']); j++){
      	reviewCode += '<i class="fa fa-star"></i>'
      }
     var tripTimeStamp = authorReviews[i]['ReviewTime'];
		var dater = tripTimeStamp
		var date = moment(dater).format('DD-MM-YYYY');
		var dateMonthAsWord = moment(dater).format('LLLL');
     reviewCode +=                '<div style="font-size: 20px;">' + dateMonthAsWord +'</div>'
     reviewCode +=              '</header>'
      reviewCode +=             '<div class="comment-post">'
      reviewCode += '<br>'
     reviewCode +=                '<p style="font-size: 20px;">'
      reviewCode +=                ''+ authorReviews[i]['Content'] + ''
      reviewCode +=               '</p>'
      reviewCode +=             '</div>'
      reviewCode +=           '</div>'
      reviewCode +=         '</div>'
     reviewCode +=        '</div>'
      reviewCode +=     '</article>'
         
    reviewCode +=     '</section>'

//Append HTML Code
	$('.profile-content').append(reviewCode);


	}

	reviewCode =  ""
	  reviewCode +=   '</div>'
 reviewCode +=  '</div>'
reviewCode += '</div>'

reviewCode += '<br>'
reviewCode += '<br>'
reviewCode += '<hr>'


reviewCode += '<div class="row">'
      reviewCode += '<div class="col-md-12">'
        reviewCode += '<div class="text-center">'
      
    
        
       reviewCode +=  '<form class="form-horizontal" role="form">'
       reviewCode +=    '<div class="form-group">'

		reviewCode +=   '<div class="form-group">'
        reviewCode +=     '<div class="col-md-12">'
        reviewCode +=       '<textarea class="form-control" name="aboutMe" rows="3" value="" id="reviewPostage">Review Goes Here...</textarea>'
        reviewCode +=      '<input class= "form-control" name="rating" id="Rating" type="number" placeholder="Rating" name="quantity" min="1" max="10" style="width: 200px;" required>'
        reviewCode +=     '</div>'
        reviewCode +=     '</div>'


      //   accountCode +=  '<div class="form-group">'
      //    accountCode +=    '<label class="col-md-3 control-label">Old Password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //    accountCode +=      '<input class="form-control" type="password" name = "opassword" value="">'
      //     accountCode +=   '</div>'
      //   accountCode +=   '</div>'

      //    accountCode +=  '<div class="form-group">'
      //    accountCode +=    '<label class="col-md-3 control-label">New Password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //    accountCode +=      '<input class="form-control" type="password" name = "password" value="">'
      //     accountCode +=   '</div>'
      //   accountCode +=   '</div>'


      //   accountCode +=   '<div class="form-group">'
      //   accountCode +=     '<label class="col-md-3 control-label">Confirm New password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //   accountCode +=       '<input class="form-control" type="password" name = "cpassword"value="">'
      //   accountCode +=     '</div>'
      // accountCode +=     '</div>'

     reviewCode +=      '<div class="form-group">'
      reviewCode +=       '<label class="col-md-3 control-label"></label>'
      reviewCode +=       '<div class="col-md-8">'
      reviewCode +=         '<input type="button" id="PostReview" class="btn btn-primary" value="Submit" onclick="postReview()">'
      reviewCode +=         '<span></span>'
       reviewCode +=      '</div>'
       reviewCode +=   '</div>'

     reviewCode +=    '</form>'
    reviewCode +=   '</div>'
    reviewCode +=   '</div>'
	

	//Append HTML Code
	$('.profile-content').append(reviewCode);

}

function postReview(){


	if(myProfile == true){

		var post = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=post_review&driver=" + user_id + "&content=" + document.getElementById("reviewPostage").value + "&rating=" + document.getElementById("Rating").value,
				async: false
		})

	}
	else{

		var post = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=post_review&driver=" + window.location.hash.substring(1) + "&content=" + document.getElementById("reviewPostage").value + "&rating=" + document.getElementById("Rating").value,
				async: false
		})

	}



	location.reload();

}

/**
* Description: This function adds the Overall-Content to the profile Content Area.
* Remember that this function does not remove the previous content in the content area on
* the profile page.
*/
function addOverallContent(){

	$('.profile-content').append('<h2>User\'s Trips:</h2>');


	for( var i = 0; i < jsonData.result.length; i++){
		
		var tripID = userTripData[i]['TripID'];
		
		tripItem = '<!-- Trip Item -->'
    	tripItem +='	         <div class="panel panel-default" id="' + tripID + '">'

    	tripItem +=            '<div class="panel-heading">'

    	tripItem +=              '<a hred="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html#' + "userTripData[i]['DriverID']" + '"><img src="' + userTripData[i]['DriverPic'] + '" class="profile-image img-circle pull-left" style="margin-top: 0px; width: 70px; height: 70px;"></a>'

    	var dater = userTripData[i]['TripDateTime'].replace(" ", "T");
		
		var date = moment(dater).format('DD-MM-YYYY');

		var dateMonthAsWord = moment(dater).format('LLLL');

     	
     	tripItem +=             '<a href="http://splitride.web.engr.illinois.edu/pages/sr_trip.html#' + tripID + '" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;"><br> <div style="font-size: 30px; id="time-goes-here">'+ dateMonthAsWord +'</div></h4>'
	    tripItem +=            '</div>'


	    tripItem +=            '<div class="panel-body">'
	    tripItem +=           '<div class="row">'
	    tripItem +=            '<img src="' + userTripData[i]['SourceImg'] + '" class="thumbnail text-center pull-left" style="width: 250px; height: auto;">'
	    tripItem +=            '<img src="http://www.kravmagagilbert.com/wp-content/uploads/2014/08/arrow-39526_640.png" style="width: 150px; height: auto; margin-left: 7%; margin-top: 25px; border: ">'
	    tripItem +=            '<img src="' + userTripData[i]['DestImg'] + '" class="thumbnail text-center pull-right" style="width: 250px; height: auto;">'
	    tripItem +=            '<div class="clearfix"></div>'
	     tripItem +=            '</div>'

	    

	     tripItem +=           '<div class="row">'
	     tripItem += 			'<h4><p class="text-center pull-left" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-left: 15px;">' + userTripData[i]['SourceAdd'] + '</p></h4>'
	     tripItem +=           '<h4><p class="text-center pull-right" style="width: 200px; word-wrap: break-word; text-align: center; margin-top: -10px; margin-right: 15px;">' + userTripData[i]['DestAdd'] + '</p></h4>'
	     tripItem +=           '</div>'

	    tripItem +=      ' </div>'
	    tripItem +=     '</div>' 
	    tripItem +=        '<!-- Trip Item End -->';

	    $('.profile-content').append(tripItem);
	}


	//Append HTML Code

}

function saveDetails(){


    var answer = $.ajax({
				url: "http://splitride.web.engr.illinois.edu/queries.php?q=change_user_details&FirstName="+ document.getElementsByName("firstName")[0].value + "&LastName=" + document.getElementsByName("lastName")[0].value + "&Email=" + document.getElementsByName("email")[0].value +"&DOB=" + document.getElementsByName("date")[0].value + "&City=" + document.getElementsByName("city")[0].value + "&Phone=" + document.getElementsByName("phone")[0].value + "&Gender=" + document.getElementsByName("gender")[0].value + "&AboutMe=" + document.getElementsByName("aboutMe")[0].value + "",
				async: false
		})


    if(answer['responseText'] = "True"){
    	sweetAlert("Yay!", "Account Details Changed", "success");
    }
    else{
    	sweetAlert("Oops...", "Something went wrong!", "error");
    }

}

/**
* Description: This function adds the Account Settings form to the profile Content Area.
* Remember that this function does not remove the previous content in the content area on
* the profile page.
*/
function addAccountSettings(){


	accountCode = '<h1>Edit Profile</h1>'
  	accountCode += '<hr>'
	accountCode += '<div class="row">'
      accountCode += '<!-- left column -->'
      accountCode += '<div class="col-md-3">' 
        accountCode += '<div class="text-center">'


        accountCode +=   '<a href="http://splitride.web.engr.illinois.edu/pages/sr_profilePage.html"><img src="' + userData['ProfilePic'] + '" id="profile-change-pic" class="avatar img-circle" alt="avatar" style="width:80px; height: 80px;"></a>'
        accountCode +=   '<h6>Upload a different photo...</h6>'
          
        accountCode +=   '<form action="/queries.php?q=upload_profile_pic" enctype="multipart/form-data" method="POST">'
 accountCode += 'Choose Image : <input name="img" size="35" type="file"/><br/>'
 accountCode += '<input type="submit" name="submit" value="Upload"/>'
 accountCode += '</form>'
   accountCode +=       '</div>'
    accountCode +=   '</div>'
      
    accountCode +=   '<!-- edit form column -->'
     accountCode +=  '<div class="col-md-9 personal-info">'
     accountCode +=    '<div class="alert alert-info alert-dismissable">'
     accountCode +=      '<a class="panel-close close" data-dismiss="alert">×</a> '
     accountCode +=      '<i class="fa fa-coffee"></i>'
      accountCode +=     '<strong>All Data that you enter is Final and cannot be reverted</strong><br>All Data Except Passwords could be viewed by other users.<br> Enter All Data to Change Data. Yes you would have to reset/change your password.'
      accountCode +=   '</div>'
       accountCode +=  '<h3>Personal info</h3>'
        
       accountCode +=  '<form class="form-horizontal" role="form">'
       accountCode +=    '<div class="form-group">'

        accountCode +=     '<label class="col-lg-3 control-label">First name:</label>'
         accountCode +=    '<div class="col-lg-8">'
          accountCode +=     '<input class="form-control" name="firstName" type="text" value="' + userData['FirstName'] + '">'
       accountCode +=      '</div>'
       accountCode +=    '</div>'
       accountCode +=    '<div class="form-group">'
        accountCode +=     '<label class="col-lg-3 control-label">Last name:</label>'
       accountCode +=      '<div class="col-lg-8">'
        accountCode +=      '<input class="form-control" name="lastName" type="text" value="' + userData['LastName'] + '">'
         accountCode +=    '</div>'
        accountCode +=   '</div>'
        accountCode +=   '<div class="form-group">'
         accountCode +=    '<label class="col-md-3 control-label">Username/Email:</label>'
          accountCode +=   '<div class="col-md-8">'
          accountCode +=     '<input class="form-control" name="email" type="text" value="' + userData['Email'] + '">'
          accountCode +=   '</div>'
          accountCode +=   '</div>'
 
          accountCode +=   '<div class="form-group">'
         accountCode +=    '<label class="col-md-3 control-label">Date of Birth: </label>'
          accountCode +=   '<div class="col-md-8">'
          accountCode +=     '<input class="form-control" name="date" id="date" type=date step=1 min=1660-09-8 value=' + userData['DOB'] + '>'
          accountCode +=   '</div>'
          accountCode +=   '</div>'

			accountCode +=   '<div class="form-group">'
          accountCode +=     '<label class="col-lg-3 control-label">City:</label>'
         accountCode +=    '<div class="col-lg-8">'
          accountCode +=     '<input class="form-control" type="text" name="city" value="' + userData['City'] + '">'
         accountCode +=      '</div>'
         accountCode +=    '</div>'

          accountCode +=   '<div class="form-group">'
         accountCode +=    '<label class="col-md-3 control-label">Phone #: </label>'
          accountCode +=   '<div class="col-md-8">'
          accountCode +=     '<input type="text" class="form-control bfh-phone" name ="phone" value="'+ userData['Phone_No'] + '" data-format="+1 (ddd) ddd-dddd">'
          accountCode +=   '</div>'
          accountCode +=   '</div>'

          accountCode +=   '<div class="form-group">'
          accountCode +=	'<label class="col-xs-3 control-label">Gender</label>'
       	accountCode +=		'<div class="col-xs-5">'
        accountCode +=    		'<select class="form-control" name="gender">'
         accountCode +=      					'<option value="male">Male</option>'
         accountCode +=       					'<option value="female">Female</option>'
         accountCode +=      					'<option value="other">Other</option>'
		accountCode +=			'</select>'
		accountCode +=		'</div>'
		accountCode +=	 '</div>'

		accountCode +=   '<div class="form-group">'
        accountCode +=     '<label class="col-md-3 control-label">About Me:</label>'
        accountCode +=     '<div class="col-md-8">'
        accountCode +=       '<textarea class="form-control" name="aboutMe" rows="3" value="">' + userData['AboutMe'] + '</textarea>'
        accountCode +=     '</div>'
        accountCode +=     '</div>'


      //   accountCode +=  '<div class="form-group">'
      //    accountCode +=    '<label class="col-md-3 control-label">Old Password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //    accountCode +=      '<input class="form-control" type="password" name = "opassword" value="">'
      //     accountCode +=   '</div>'
      //   accountCode +=   '</div>'

      //    accountCode +=  '<div class="form-group">'
      //    accountCode +=    '<label class="col-md-3 control-label">New Password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //    accountCode +=      '<input class="form-control" type="password" name = "password" value="">'
      //     accountCode +=   '</div>'
      //   accountCode +=   '</div>'


      //   accountCode +=   '<div class="form-group">'
      //   accountCode +=     '<label class="col-md-3 control-label">Confirm New password:</label>'
      //   accountCode +=     '<div class="col-md-8">'
      //   accountCode +=       '<input class="form-control" type="password" name = "cpassword"value="">'
      //   accountCode +=     '</div>'
      // accountCode +=     '</div>'

     accountCode +=      '<div class="form-group">'
      accountCode +=       '<label class="col-md-3 control-label"></label>'
      accountCode +=       '<div class="col-md-8">'
      accountCode +=         '<input type="submit" id="saveChanges" class="btn btn-primary" value="Save Changes" onclick="saveDetails()">'
      accountCode +=         '<span></span>'
       accountCode +=      '</div>'
       accountCode +=   '</div>'

     accountCode +=    '</form>'
    accountCode +=   '</div>'
   accountCode += '</div>'

 accountCode += '<hr>';	
	
	//Append HTML Code
	$('.profile-content').append(accountCode);
}


		// <h3 id="profile-trips-title"> Trips Involved In: </h3>

		// 		   <!-- Trip Item -->
	 //              <div class="panel panel-default">

	 //                <div class="panel-heading">
	 //                  <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/7/005/089/3b2/14dc93d.jpg" class="profile-image img-circle pull-left" style="margin-top: 0px; height: 70px; width: 70px"></a>
	 //                  <a href="#" class="pull-right">View Trip</a> <h4 style="margin-left: 90px;">CHM -> CHI <br> <div style="font-size: 30px;">9:30 AM</div></h4>
	 //                </div>

	 //                <div class="panel-body">
	 //                  <img src="http://www.cresa.com/webfiles/Chicago/ChicagoSkyline1.jpg" class="thumbnail text-center" style="width: 500px; height: auto;">
	 //                  <div class="clearfix"></div>

	 //                  <!-- Comment Section for Trip -->
	 //                  <form>
	 //                    <div class="input-group">
	 //                      <div class="input-group-btn">
	 //                        <button class="btn btn-default">+1</button><button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
	 //                      </div>
	 //                      <input type="text" class="form-control" placeholder="Add a comment..">
	 //                    </div>
	 //                  </form>

	 //                </div>
	 //              </div> 
	 //              <!-- Trip Item End --> 