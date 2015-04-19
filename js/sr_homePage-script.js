
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

});



// Delete the Cookie
	$('#logout-btn').on('click', function(e){

		$.get("http://splitride.web.engr.illinois.edu/queries.php?q=logout");
		window.location.replace('http://splitride.web.engr.illinois.edu/');
	});
