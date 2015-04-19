
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

		$('.profile-usertitle-name').empty();
		$('.profile-usertitle-name').append(username['responseText']);

		$('.profile-userpic img').attr("src",profilePicURL['responseText']);
		
	}

	attachUserInfo();

});



// Delete the Cookie
	$('#logout-btn').on('click', function(e){

		$.get("http://splitride.web.engr.illinois.edu/queries.php?q=logout");
		window.location.replace('http://splitride.web.engr.illinois.edu/');
	});


$('.nav li').on('click', function(){

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

	}
});





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