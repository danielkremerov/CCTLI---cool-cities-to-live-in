// Using Morris JS libray to create a three Bar charts based on the json array that was returned from the database in chartdata.php

config2 = {
    data: costOfLiving,
    xkey: ["cityname"],
    ykeys: ["costofliving"],
    labels: ["costofliving"],

    fillOpacity: 0.6,
    behaveLikeLine: true,
    resize: true,
    gridTextColor: "green",
    barColors: function(row, series, type) {
        return "#8E44AD";
    },

    //hideHover: 'auto',
    // stacked:true,
    pointFillColors: ['#ffffff'],
    pointStrokeColors: ['black'],
    lineColors: ['gray', 'red']
};

config2.element = 'CostChart';
Morris.Bar(config2);

config3 = {
    data: safety,
    xkey: ["cityname"],
    ykeys: ["safety"],
    labels: ["safety"],

    fillOpacity: 0.6,
    behaveLikeLine: true,
    resize: true,
    gridTextColor: "green",
    barColors: function(row, series, type) {
        return "#2E86C1";
    },

    //hideHover: 'auto',
    // stacked:true,
    pointFillColors: ['#ffffff'],
    pointStrokeColors: ['black'],
    lineColors: ['gray', 'red']
};

config3.element = 'SafetyChart';
Morris.Bar(config3);

config4 = {
    data: internetspeed,
    xkey: ["cityname"],
    ykeys: ["internetspeed"],
    labels: ["internetspeed"],

    fillOpacity: 0.6,
    behaveLikeLine: true,
    resize: true,
    gridTextColor: "green",
    barColors: function(row, series, type) {
        return "#F39C12";
    },
    pointFillColors: ['#ffffff'],
    pointStrokeColors: ['black'],
    lineColors: ['gray', 'red']
};
//  var costofLvingnew = JSON.stringify(hdi); for debugging
//  console.log(costofLvingnew);

config4.element = 'InternetChart';
Morris.Bar(config4);

// Using Morris JS libray to create a Line Graph based on HDI data json array that was returned from the database in chartdata.php
// this graph requires a selection by the user and afterwards the function showHDI() is called

function showHDI() {
    var country1 = document.getElementById("countryOne");
    var coutry1value = country1.options[country1.selectedIndex].value;
    var coutry1label = country1.options[country1.selectedIndex].text;
    var country2 = document.getElementById("countryTwo");
    var country2value = country2.options[country2.selectedIndex].value;
    var country2label = country2.options[country2.selectedIndex].text;
    var years = ["1990", "2000", "2010", "2011", "2012", "2013", "2014", "2015"];
    var country3 = document.getElementById("countryThree");
    var coutry3value = country3.options[country3.selectedIndex].value;
    var coutry3label = country3.options[country3.selectedIndex].text;
    config1 = {
        data: hdi,
        xkey: "year",
        ykeys: [coutry1value, country2value, coutry3value],
        labels: [coutry1label, country2label, coutry3label],
        xLabels: years,

        fillOpacity: 0.8,
        behaveLikeLine: true,
        resize: true,
        gridTextColor: "green",
        //hideHover: 'auto',
        // stacked:true,
        pointFillColors: ['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors: ['darkgreen', 'red', 'orange']
    };


}
$(document).ready(function() {
    $("#showHDI").click(function() {
        showHDI();
        $("#showHDI").hide();
        $("#hideHDI").show();
    });
    $("#hideHDI").click(function() {
        $("#showHDI").show();
        $("#hideHDI").hide();
        location.reload()
    });
});
