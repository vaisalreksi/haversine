
//   Init All ------------------
$(function () {
    var single_map = document.getElementById('autocomplete-input');
    if (typeof (single_map) != 'undefined' && single_map != null) {
        google.maps.event.addDomListener(window, 'load', getLocas);
    }
});


function getLocas() {
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

        window.location.href='list-location?lat='+lat+'&long='+lng+'&key='+$('#text_search').val();
        // var link = `https://maps.google.com/maps?q=`+lat+`,`+lng+`&hl=es;z=12&amp;output=embed`;
        // $('.MyMapp').html(`<iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="`+link+`"></iframe>`);
        // $("#textLat").val(lat);
        // $("#textLong").val(lng);


    });
}
