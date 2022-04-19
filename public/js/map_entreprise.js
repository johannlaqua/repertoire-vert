//var mymap = L.map('map').setView([51.505, -0.09], 13);

//sample data values for populate map

var companyId = document.getElementById('map').getAttribute('data-id');
var companyLat = document.getElementById('map').getAttribute('data-lat');
var companyLong = document.getElementById('map').getAttribute('data-long');

console.log("call");

var mymap = new L.Map('map', {zoom: 9, center: new L.latLng(companyLat,companyLong) });	//set center from first location

mymap.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer
var markersLayer = new L.LayerGroup();	//layer contain searched elements

mymap.addLayer(markersLayer);

/*var controlSearch = new L.Control.Search({
    position:'topright',
    layer: markersLayer,
    initial: false,
    zoom: 12,
    marker: false
});

mymap.addControl( controlSearch );

var address = "11 rue des Bains Genève";
var dataAddress = $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q='+address, function(data){
    console.log(data[0].lat, data[0].lon);
});*/



$.ajax({
    url:'/rest/company/'+companyId,
    type: "GET",
    dataType: "json",
    data: {},
    async: true,
    success: function (data)
    {
////////////populate map with markers from sample data

        // place markers
        console.log(data)

        $.each(data, function(i, val) {

            var marker = L.marker([ val.latitude, val.longtitude ]).addTo(mymap);
            marker.bindPopup("<b>" + val.name + "</b>").openPopup();
        });
        //hide loader
        $('#loader').hide();
    }
});