// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var srcPlace;
var destPlace;

var destLong;
var srcLong;

var jsonData
var srcURL = "http://images.fineartamerica.com/images-medium-large/2-nyc-empire-nina-papiorek.jpg";
var destURL = "http://images.fineartamerica.com/images-medium-large/2-nyc-empire-nina-papiorek.jpg";

function trial(){


    // srcPhotoRef = getphotoReference(srcLong, srcPlace['geometry']['location']['D']);
    // destPhotoRef = getphotoReference(destLong, destPlace['geometry']['location']['D']);

    // getImage(srcPlace['place_id'], "src");
    // getImage(destPlace['place_id'], "dest");

    var planTrip = $.ajax({
        url: "http://splitride.web.engr.illinois.edu/queries.php?q=plan_trip&date="+document.getElementById("date").value+"&time="+document.getElementById("time").value+"&seats="+document.getElementById("seats").value+"&notes="+document.getElementById("notes").value+"&srcImgURL"+srcURL+"&fullSrcAdd="+document.getElementById("exampleInputName1").value+"&srcLat="+srcPlace['geometry']['location']['D']+"&srcLng="+srcLong+"&destImgURL="+destURL+"&destLat="+destPlace['geometry']['location']['D']+"&destLng="+destLong+"&fullDestAdd="+ document.getElementById("exampleInputName2").value + "",
        async: false
    })

    if(planTrip['responseText'] == "true"){

      swal("Done!", "Trip Added!", "success");

    }
    else{
      swal({   title: "Oops!",   text: "Something Went Wrong! Try Again",   type: "error",   confirmButtonText: "Ok" });
    }

}

// function getphotoReference(lng, lat){
  
//   var Data = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" + lat + "," + lng + "&radius=500&key=AIzaSyDXfOS4U6P6O3flOx8zVieIVXu7sh92mqE";
//   $.getJSON(Data, function(){
//     return json.results[1].photos[0].photo_reference;
//   });
// }

// function createPhotoMarker(place) {
//   var photos = place.photos;
//   if (!photos) {
//     return;
//   }

//   var marker = new google.maps.Marker({
//     map: map,
//     position: place.geometry.location,
//     title: place.name,
//     icon: photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35})
//   });
// }


//https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CnRtAAAA4CKbWJOMnj1syMYITjKugHSC7CpjVjRtoNN0MtgVnuh_vOQXvepMYwd5lnPFwZnDro2UYPy06DfdjXIl0AwEogy4Ucq5hFcAzH7CiT6gyQPe2Ss4H361yYnSbx1L0acIT0PEmvBsUCAQHGjbrxoqshIQ0F9bvEiHvDoe7kLBUIAJ4hoUStJBxKbbPCWefGhmHIOwgD7KGx4&key=AIzaSyA4Kc0by9EhIvVuhj5uSZgj9IoS0tUvEcE

// function img(latitude , longitude, location) {
//   //console.log("triggered");
//   $.getJSON("https://api.flickr.com/services/rest/?&method=flickr.photos.search&api_key=d6a398766cf8f3e7d5517b09b03fa953&lat=" + latitude + "&lon=" + longitude + "&content_type=4&format=json&jsoncallback=?", function(data) {
//   if(data.photos.photo.length.length < 6) {
//     console.log(data.photos.photo.length);
//     var url = "http://sharetraveler.com/wp-content/uploads/2014/08/rideshare.gif";
//     console.log(url);

//     if(location = "src"){
//       srcURL = url;
//     }
//     else{
//       destURL = url;
//     }
//   }

//   else {
//     console.log(data.photos.photo.length);
//     var picture = data.photos.photo[5];
//     console.log(picture);
//     var url = "https://farm" + picture.farm + ".staticflickr.com/" + picture.server + "/" + picture.id + "_" + picture.secret + ".jpg";
//     console.log(url);
//     if(location = "src"){
//       srcURL = url;
//     }
//     else{
//       destURL = url;
//     }
//   }
//   });
// }

// function getPicture(lat, lng, location){
//     coord = { "lat" : String(lat), "lng" : String(lng)};
//     //var latlng = new google.maps.LatLng(lat, lng);
//     service = 
//     geocoder.geocode({'location' : coord}, function(results, status){
//         if (status == google.maps.GeocoderStatus.OK){
//             if (results[1]){
//                 var photo = results[1][photos][0].getURL({'maxWidth': 1000, 'maxHeight': 1000});
//                 if(location = "src"){
//                   srcURL = photo;
//                 }
//                 else{
//                   destURL = photo;
//                 }
//               }
//             }
//         });

// }

// function getImage(PlaceID, location) {
//   var map = new google.maps.Map(document.getElementById('map-canvas'), {
//     center: new google.maps.LatLng(-33.8665433, 151.1956316),
//     zoom: 15
//   });

//   var request = {
//     placeId: PlaceID
//   };

//   var infowindow = new google.maps.InfoWindow();
//   var service = new google.maps.places.PlacesService(map);

//   service.getDetails(request, function(place, status) {
//     if (status == google.maps.places.PlacesServiceStatus.OK) {
//       var marker = new google.maps.Marker({
//         map: map,
//         position: place.geometry.location
//       });

//       if(location = "src"){
//         srcURL = place.photos[0].getUrl({ 'maxWidth': 1000, 'maxHeight': 1000 });
//       }
//       else{
//         destURL = place.photos[0].getUrl({ 'maxWidth': 1000, 'maxHeight': 1000 });
//       }
//       google.maps.event.addListener(marker, 'click', function() {
//         infowindow.setContent(place.name);
//         infowindow.open(map, this);
//       });
//     }
//   });
// }

// google.maps.event.addDomListener(window, 'load', getImage);


var geocoder, location1 = null, location2 = null;
var placeSearch, autocomplete1, autocomplete2; 
var componentForm1 = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

var componentForm2 = {
  street_number2: 'short_name',
  route2: 'long_name',
  locality2: 'long_name',
  administrative_area_level_1_2: 'short_name',
  country2: 'long_name',
  postal_code2: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  geocoder = new google.maps.Geocoder();
  
  autocomplete1 = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('exampleInputName1')),
      { types: ['geocode'] });

  autocomplete2 = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('exampleInputName2')),
      { types: ['geocode'] });

   // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete1, 'place_changed', function() {
    fillInAddress1();
  });

  google.maps.event.addListener(autocomplete2, 'place_changed', function() {
    fillInAddress2();
  });
}




function fillInAddress1() {
  // Get the place details from the autocomplete object.
  var place = autocomplete1.getPlace();

  if(place['geometry']['location']['K'] != undefined){
      srcLong = place['geometry']['location']['K']
  }
  else{
    srcLong = place['geometry']['location']['k']
  }

  srcPlace = place;

  for (var component in componentForm1) {
    document.getElementById(component).value = '';

document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm1[addressType]) {
      var val = place.address_components[i][componentForm1[addressType]];
      document.getElementById(addressType).value = val;
    }
  }

}

function fillInAddress2() {

var place = autocomplete2.getPlace();

 if(place['geometry']['location']['K'] != undefined){
      destLong = place['geometry']['location']['K']
  }
  else{
    destLong = place['geometry']['location']['k']
  }

destPlace = place;

  for (var component in componentForm2) {
    document.getElementById(component).value = '';

  document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm2[addressType]) {
      var val = place.address_components[i][componentForm2[addressType]];
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
