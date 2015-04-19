
$(document).ready(function(){


	/**
	* Description: Attaches every user information on the home page for the particular
	* logged in user.
	*/
	function attachUserInfo(){
		//Get profile pic
		var username = '@Session["username"]';
		var profilePicture = $.get("queries.php?q=get_profile_pic");
		console.log(profilePicture);
		console.log(username);
	}



});
