
$(document).ready(function(){


	/**
	* Description: Attaches every user information on the home page for the particular
	* logged in user.
	*/
	function attachUserInfo(){

		$.getJSON("http://web.engr.illinois.edu/~vreddi2/php/fetchComments.php", function(data){

			//Remove any comments if already printed on screen
			$("ul.commentList").empty();

			$.each(data.result, function(){

				$("ul.commentList").append("<li><div class=\"commentText\"><p class=\"\">"+this['name']+": "+this['content']+"</p> <span class=\"date sub-text\">on "+this['dateTime']+"</span></div></li>");

			});

		});

	}



});
