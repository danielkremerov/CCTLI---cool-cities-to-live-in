//File that created the HDI GeoJSon Layer

function GeoJson() {


    // intialize the background layer
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        minZoom: 2,
        maxZoom: 6,
        maxBounds: [
            //North West
            [80.344623, -153.992188],
            //South East
            [-53.17, 169.1]
        ],
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.light'
    }).addTo(map);



    // control that shows state info on hover
    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        this._div.innerHTML = '<h4>Human Development Index (HDI)</h4>' + (props ?
            '<b>' + ' HDI 2015' + '</b><br />' + props.name + '</b><br />' + props.hdi :
            'Hover over a country');
    };

    info.addTo(map);


    // get color depending on HDI
    function getColor(d) {
        return d > 0.9 ? '#006400' :
            d > 0.8 ? '#00FF00' :
            d > 0.7 ? '#99ff00' :
            d > 0.6 ? '#FFFF00' :
            d > 0.5 ? '#ff9900' :
            d > 0.3 ? '#ff6600' :
            d > 0 ? '#FF0000' :
            '#696969';
    }

    function style(feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColor(feature.properties.hdi)
        };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    var geojson;

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    geojson = L.geoJson(Data, {
        style: style,
        onEachFeature: onEachFeature
    }).addTo(map);



    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {



        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 0.3, 0.5, 0.6, 0.7, 0.8, 0.9],
            labels = [],
            from, to;

        for (var i = 0; i < grades.length; i++) {
            from = grades[i];
            to = grades[i + 1];

            labels.push(
                '<i style="background:' + getColor(from) + '"></i> ' +
                from + (to ? '&ndash;' + to : '+'));
        }

        div.innerHTML = labels.join('<br>');
        return div;
    };

    legend.addTo(map);


}
