// *
// * Add multiple markers
// * 2013 - en.marnoto.com
// *

// necessary variables
var map;
var infoWindow;


// markersData variable stores the information necessary to each marker
var markersData = [
{
   lat: 40.6386333,
   lng: -8.745,
   name: "Dr. Anand Prahalad Rao",
   address1:"London Street Road, State - 12345",
   address2: "Praia da Barra",
      postalCode: "3830-772" // don't insert comma in the last item of each marker
   },
   {
      lat: 40.59955,
      lng: -8.7498167,
      name: "Dr. Jhon",
      address1:"Quinta dos Patos, n.º 2",
      address2: "Praia da Costa Nova",
      postalCode: "3830-453 " // don't insert comma in the last item of each marker
   },
   {
      lat: 40.6247167,
      lng: -8.7129167,
      name: "Dr. Alexander",
      address1:"London Street Road, State - 12345",
      address2: "Gafanha da Nazaré",
      postalCode: "3830-225" // don't insert comma in the last item of each marker
   } // don't insert comma in the last item
   ];


   function initialize() {
      var mapOptions = {
         center: new google.maps.LatLng(40.601203,-8.668173),
         zoom: 18,
         mapTypeId: 'roadmap',
      };

      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

   // a new Info Window is created
   infoWindow = new google.maps.InfoWindow();

      // Create the DIV to hold the control and call the CustomControl() constructor passing in this DIV.
    var customControlDiv = document.createElement('div');
    customControlDiv.setAttribute('id', 'map-btn');
    var customControl = new CustomControl(customControlDiv, map);

    customControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(customControlDiv);
}

function CustomControl(controlDiv, map) {

    // Set CSS for the control border
    var controlUI = document.createElement('div');
    controlUI.style.backgroundColor = '#00454c';
    controlUI.style.color = '#fff';
    controlUI.style.borderStyle = 'solid';
    controlUI.style.borderWidth = '3px';
    controlUI.style.borderColor = '#ccc';
    controlUI.style.height = '50px';
    controlUI.style.marginBottom = '100px';
    controlUI.style.padding = '5px';
    controlUI.style.cursor = 'pointer';
    controlUI.style.textAlign = 'center';
    controlUI.title = 'Click to set the map to Home';
    controlDiv.appendChild(controlUI);

    // Set CSS for the control interior
    var controlText = document.createElement('div');
    controlText.style.fontFamily = 'Arial,sans-serif';
    controlText.style.fontSize = '15px';
    controlText.style.padding = '8px';   
    controlText.innerHTML = 'View Full Map';
    controlUI.appendChild(controlText);

    // Setup the click event listeners
    google.maps.event.addDomListener(controlUI, 'click', function () {
      window.location.replace("search-map.html");
    });

   // Event that closes the Info Window with a click on the map
   google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
   });

   // Finally displayMarkers() function is called to begin the markers creation
   displayMarkers();
}


google.maps.event.addDomListener(window, 'load', initialize);

 
// This function will iterate over markersData array
// creating markers with createMarker function
function displayMarkers(){

   // this variable sets the map bounds according to markers position
   var bounds = new google.maps.LatLngBounds();
   
   // for loop traverses markersData array calling createMarker function for each marker 
   for (var i = 0; i < markersData.length; i++){

      var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
      var name = markersData[i].name;
      var address1 = markersData[i].address1;
      var address2 = markersData[i].address2;
      var postalCode = markersData[i].postalCode;

      createMarker(latlng, name, address1, address2, postalCode);
     
      // marker position is added to bounds variable
      bounds.extend(latlng);  

   }

   // Finally the bounds variable is used to set the map bounds
   // with fitBounds() function
   map.fitBounds(bounds);
}

// This function creates each marker and it sets their Info Window content
function createMarker(latlng, name, address1, address2, postalCode){
 
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: name,
      icon: 'img/mapgray.png'
   });

   // This event expects a click on a marker
   // When this event is fired the Info Window content is created
   // and the Info Window is opened.
   google.maps.event.addListener(marker, 'click', function() {
      // Creating the content to be inserted in the infowindow
      var iwContent ='<div id="iw-container">' +
      '<div class="iw-title" style="padding: 5px 10px; font-weight:700;"><i class="fa fa-square" aria-hidden="true" style="color:green;" data-toggle="tooltip" title="Available"></i> ' + name + '<b class="pull-right" style="color:#fff; font-size: 17px;"> € 130</b> </div>' +
      '<div class="iw-content" style="background: #B7E2F0;">' +
      '<div class="col-md-8">' +
      '<p><b>MBBS - Surgen<br> 15 Years Experience  </b></p>' +
       '<b>Location</b>' +
      '<p>'+ address1 + '<br>' + address2 + 
      '<p> <b>Services</b><br>Nero Surgen, Nurology</p>' +
      '<p style="font-size: 13px; font-weight: 700;"><i class="fa fa-hospital-o" aria-hidden="true" style="color:green;"></i> Clinic | <i class="fa fa-home" aria-hidden="true" style="color:blue;"></i> Home Visit <br> <i class="fa fa-skype" aria-hidden="true" style="color:orange;"></i> Video - Tel</p><a class="btn-xs btn-success" data-toggle="collapse" data-target="#docBook" href="view-page.html"> View Details</a> '+
      '</div><div class="col-md-4"><p><b style="color:red;"> 2.5 Miles</b> <br/><span class="center" style="color:green;"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i></span> </p><p><img src="img/doctor.png" alt="Porcelain Factory of Vista Alegre" height="115"></p></div>' +
      '<div class="iw-bottom-gradient"></div>' +
      '</div></div>'; 

      
    /* var mapdata = document.getElementById("");
     mapdata.innerHTML =  iwContent;*/
     $('#mymapdata').html(iwContent);
      // opening the Info Window in the current map and at the current marker location.
       infoWindow.setContent(iwContent);
     infoWindow.open(map, marker);
     
     this.setIcon('img/mapblue.png');
     
     
   });

}
