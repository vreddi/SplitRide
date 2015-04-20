// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

$("#submit").on("click", function(e){
    getLatLn();
    //hacky synch
    while(location == null){
      continue;
    }
    dat = $.extend(componentForm, location);
    $.ajax({
        url : "/queries.php?q=plan_trip"
        data : dat
    })
})

var geocoder, location = null;
var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  geocoder = new google.maps.Geocoder();
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}


/**
*
*
*/
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';

document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}


$(function(){       
        
/*
  Author: Chrysto Panayotov ( info@bassta.bg )
  For GreenSock forums user azuki
  License : http://bassta.bg/license/
  
*/

    var $parallaxContainer    = $("#parallax-container"); //our container
    var $parallaxItems        = $parallaxContainer.find(".parallax");  //elements
    var fixer                 = -0.004;   //experiment with the value
    
    $(document).on("mousemove", function(event){          
          
      var pageX =  event.pageX - ($parallaxContainer.width() * 0.5);  //get the mouseX - negative on left, positive on right
      var pageY =  event.pageY - ($parallaxContainer.height() * 0.5); //same here, get the y. use console.log(pageY) to see the values
      
  //here we move each item
      $parallaxItems.each(function(){
        
        var item  = $(this);
        var speedX  = item.data("speed-x");         
        var speedY  = item.data("speed-y");
        
  TweenLite.to(item, 0.5, {
          x: (item.position().left + pageX * speedX )*fixer,    //calculate the new X based on mouse position * speed 
          y: (item.position().top + pageY * speedY)*fixer
        });
  
  //or use set - not so smooth, but better performance
  /*TweenLite.set(item, {
          x: (item.position().left + pageX * speedX )*fixer,
          y: (item.position().top + pageY * speedY)*fixer
        });*/
        
      });
    });       
  });

function getLatLn(){
    var address = getElementById('exampleInputName2').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      location = results[0].geometry.location;
    } else {
        alert("Geocode was not successful for the following reason: " + status);
     }
    });
}



