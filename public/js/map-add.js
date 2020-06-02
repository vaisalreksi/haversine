var myLatLng = {
    lng: $('#singleMap').data('longitude'),
    lat: $('#singleMap').data('latitude'),
};
showPosition();
function showPosition() {
      if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
      } else {
        myLatLng = {
            lng: $('#singleMap').data('longitude'),
            lat: $('#singleMap').data('latitude'),
        };
      }
  }

function successCallback(position) {
    myLatLng = {
        lng: position.coords.longitude,
        lat: position.coords.latitude,
    };
    singleMap();

}

function errorCallback(error) {
  singleMap();
}

function singleMap() {
    var input = document.getElementById('autocomplete-input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    var options = {
        componentRestrictions: {country: 'id'},
        zoom: 14,
        center: input,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    autocomplete.setOptions(options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        myLatLng = {
            lng: lng,
            lat: lat,
        };
        // var link = `https://maps.google.com/maps?q=`+lat+`,`+lng+`&hl=es;z=12&amp;output=embed`;
        // $('.MyMapp').html(`<iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="`+link+`"></iframe>`);
        $("#lat").val(lat);
        $("#long").val(lng);
        singleMap();

    });

    $('#lat').val(myLatLng.lat);
    $('#long').val(myLatLng.lng);

    var single_map = new google.maps.Map(document.getElementById('singleMap'), {
        zoom: 10,
        center: myLatLng,
        scrollwheel: false,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        panControl: false,
        navigationControl: false,
        streetViewControl: false,
        styles: [{
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [{
                "color": "#f2f2f2"
            }]
        }]
    });
    var markerIcon2 = {
        url: 'images/marker.png',
    }
    var marker = new google.maps.Marker({
        position: myLatLng,
        draggable: true,
        map: single_map,
        icon: markerIcon2,
        title: 'Your location'
    });
    var zoomControlDiv = document.createElement('div');
    var zoomControl = new ZoomControl(zoomControlDiv, single_map);

    function ZoomControl(controlDiv, single_map) {
        zoomControlDiv.index = 1;
        single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
        controlDiv.style.padding = '5px';
        var controlWrapper = document.createElement('div');
        controlDiv.appendChild(controlWrapper);
        var zoomInButton = document.createElement('div');
        zoomInButton.className = "mapzoom-in";
        controlWrapper.appendChild(zoomInButton);
        var zoomOutButton = document.createElement('div');
        zoomOutButton.className = "mapzoom-out";
        controlWrapper.appendChild(zoomOutButton);
        google.maps.event.addDomListener(zoomInButton, 'click', function () {
            single_map.setZoom(single_map.getZoom() + 1);
        });
        google.maps.event.addDomListener(zoomOutButton, 'click', function () {
            single_map.setZoom(single_map.getZoom() - 1);
        });
    }
          google.maps.event.addListener(marker, 'dragend', function (event) {
              document.getElementById("lat").value = event.latLng.lat();
              document.getElementById("long").value = event.latLng.lng();
          });
}
var single_map = document.getElementById('singleMap');
if (typeof (single_map) != 'undefined' && single_map != null) {
    google.maps.event.addDomListener(window, 'load', singleMap);
}

// function test() {
//     var input = document.getElementById('autocomplete-input');
//     var autocomplete = new google.maps.places.Autocomplete(input);
//
//       var place = autocomplete.getPlace();
//       console.log(place.geometry.location.lat());
//       // document.getElementById('lat').innerHTML = place.geometry.location.lat();
//       // document.getElementById('long').innerHTML = place.geometry.location.lng();
// }

var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 5000000){
       alert("Max File size must be 5 MB");
       this.value = "";
    };
};
