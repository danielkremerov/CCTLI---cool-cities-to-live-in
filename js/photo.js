// this is a call to the FLickr API, to tetrieve a photo for the city that was clicked: The APi looks for photos with the tag of the city
function displayRandomPhoto(city) {
$(document).ready(function(){

    $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?",
    {
        tags: city,
        tagmode: "any",
        format: "json"

    },
    function(data) {
        var rnd = Math.floor(Math.random() * data.items.length);

        var image_src = data.items[rnd]['media']['m'].replace("_m", "_b");

        $("#photoTitle").text("Random Photo from " + city);
        $('#photo').css('background-image', "url('" + image_src + "')");

    });

});}
