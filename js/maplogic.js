// Javascript File that contains the maplogic and interaction with the Leaflet Library

// In total the map has three layers, with one standard and four to choose, those are retrieved and then placed on the map

var standard = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    bounds: [
        [-85.0511287776, -179.999999975],
        [85.0511287776, 179.999999975]
    ],
    minZoom: 2,
    maxZoom: 8
});



var waterColorLayer = L.tileLayer('http://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: 'abcd',
    bounds: [
        [-85.0511287776, -179.999999975],
        [85.0511287776, 179.999999975]
    ],
    minZoom: 2,
    maxZoom: 8,
    ext: 'png'
});

var lightsAtNightLayer = L.tileLayer('http://map1.vis.earthdata.nasa.gov/wmts-webmerc/VIIRS_CityLights_2012/default/{time}/{tilematrixset}{maxZoom}/{z}/{y}/{x}.{format}', {
    attribution: 'Imagery provided by services from the Global Imagery Browse Services (GIBS), operated by the NASA/GSFC/Earth Science Data and Information System (<a href="https://earthdata.nasa.gov">ESDIS</a>) with funding provided by NASA/HQ.',
    bounds: [
        [-85.0511287776, -179.999999975],
        [85.0511287776, 179.999999975]
    ],
    minZoom: 2,
    maxZoom: 8,
    format: 'jpg',
    time: '',
    tilematrixset: 'GoogleMapsCompatible_Level'
});



// determine standard and selectable layers for overlay
var baseMaps = {
    "Standard": standard
};

var overlayMaps = {
    "Water Color": waterColorLayer,
    "Lights at Night": lightsAtNightLayer
};

var map = L.map('map', {
    center: [24.774265, 46.738586],
    bounds: [
        [-85, -179],
        [85, 179]
    ],
    zoom: 3,
    zoomSnap: 0.2,
    layers: [standard]
        // all layers including overlay

});

L.control.layers(baseMaps, overlayMaps).addTo(map);

// using the mapData array that was retrieved through php from the databse and converted to a JSON
// in order to populate the markers and display databsase information the pop up
var marker;
var icon = L.icon({
    iconUrl: 'eye.png'
});
for (item in myData) {


    var marker = L.marker([myData[item].latitude, myData[item].longitude], {
            icon: icon,
            title: myData[item].cityname
        }).addTo(map)
        .bindPopup(
            // giving a classname to the marker, so it can be recognized when clicked and than other actions can be taken based on this
            "<h4> <b class='city-name'> " + myData[item].cityname + "</h4>" +
            "</b><br>  Country <b>" + myData[item].country +
            "</b><br>  Monthly Living Cost: <b>" + myData[item].costofliving +
            "</b><br>  Average Temperature: <b>" + myData[item].temperature +
            "</b><br>  Safety Score: <b>" + myData[item].safety +
            "</b><br>  Data Source: <b>" + myData[item].source +
            "</b><br>  Internet Speed: <b>" + myData[item].internetspeed
        )


}
