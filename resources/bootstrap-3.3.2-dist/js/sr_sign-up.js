/*
INFO:


COPYRIGHT: SplitRide
*/


//Execute when the Document is Ready
jQuery(document).ready(function(){

	$('video #vid-bg').on("loadmetadata", scalevideo);

	/**
	*	This function will do all the leg work for us, getting width and height of the viewport,
	*	native aspect ratio of the video so there is no video stretching and then conform it to 
	* 	the output viewport.
	*/
	function scaleVideo(){

		//Get current window's height
		var windowHeight = $(window).height();

		//Get current window's width
		var windowWidth = $(window).width();

		//Get the Video Native Dimensions (Aspect Ratio)
		var videoNativeWidth = $('video #vid-bg')[0].videoWidth;
		var videoNativeHeight = $('video #vid-bg')[0].videoHeight;

		//Calculate the Height and Width Scale Factor
		var heightScaleFactor = windowHeight / videoNativeHeight;
		var widthScaleFactor = windowWidth / videoNativeWidth;

		//Now we need just the highest scale factor
		if(widthScaleFactor > heightScaleFactor){
			var scale = widthScaleFactor;
		}
		else{
			var scale = heightScaleFactor;
		}

		//Scale the Video mentaining the aspect ratio
		var scaledVideoHeight = videoNativeHeight * scale;
		var scaledVideoWidth = videoNativeWidth * scale;

		//Set the Background Videos New Height and Width
		$('video #vid-bg').height(scaledVideoHeight);
		$('video #vid-bg').width(scaledVideoWidth);

	}
})