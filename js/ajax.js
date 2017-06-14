// JS for ajax that waas eventually not used as it did not work on the UCL server

var submitbutton = document.getElementById('SubmitFilter');
  submitbutton.addEventListener("click", refreshMap);
  console.log("yolo");

function refreshMap() {
  //  console.log("yolo");
    var country = document.getElementById('countryFilter');
    var selectedCountry = country.options[country.selectedIndex].value;
    var temperature = document.getElementById('tempFilter');
    var selectedTemperature = temperature.options[temperature.selectedIndex].value;
    var cost = document.getElementById('costFilter');
    var selectedCost = cost.options[cost.selectedIndex].value;
    console.log(selectedTemperature + ", " + selectedCost);
    var xhr = new XMLHttpRequest();
    //var data = "Country=" + selectedCountry + "&Temperature=" + selectedTemperature + "&Cost=" + selectedCost;
    var data = "Country=" + selectedCountry;
    xhr.open('POST','js/filterRefresh.php',true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);

    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        var testResponse = xhr.responseText;
        console.log(testResponse);
      }
    }
}
