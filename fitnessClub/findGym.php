<!DOCTYPE html>
<html lang="en">
<head>
<?php
require ('includes/head.php');
?>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gyms</title>

  <style type="text/css">
    #mapDiv{
      width: 50%;
      height: 600px;
      float: left;
     
    }
    #listDiv{
      width: 50%;
      /*height: 600px;*/
      float: left;
      background-image: url('./img/para-01.jpg') no-repeat ;
    }
    }
    #table{
      width: 100%;
    }
    .main-div{
    
      margin-top: 80px;
      background-image: url('../img/para-01.jpg') no-repeat ;
    }
  </style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByVdzDd2TZwqXqFxfoJRPgJJJviizwGdM&callback=initMap&libraries=places,geometry" async defer></script>
<script src="myjavascript_resturants.js" type="text/javascript"></script>

<script type="text/javascript">
getLocation();

  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  // x.innerHTML = "Latitude: " + position.coords.latitude +
  // "<br>Longitude: " + position.coords.longitude;
  document.getElementById('c_lat').value=position.coords.latitude;
  document.getElementById('c_lng').value=position.coords.longitude;
  initMap();
}

//variables
var map;
var lat = sessionStorage.getItem('pyrmontlat');
var lng = sessionStorage.getItem('pyrmontlng');

var pyrmont;
var address;
var marker;
var infoWindow;
var markers = [];
var ttypes; //value of type like 'atm','cafe';
var range = 500;
var filter;
var calval=0;
//initialize Map
function initMap()
{
//lat=33.6240894;lng=73.0602079;

lat = document.getElementById('c_lat').value;
lng = document.getElementById('c_lng').value;
 // alert(lat)
pyrmont = {lat: parseFloat(lat), lng: parseFloat(lng)};
map = new google.maps.Map(document.getElementById('mapDiv'),
{
center: pyrmont,
zoom: 10
});
marker = new google.maps.Marker({
map: map,
draggable: false,
animation: google.maps.Animation.BOUNCE,
title:'My Present Location',
icon: {url:"./images/present.png",scaledSize : new google.maps.Size(40, 40)},
position: {lat: parseFloat(lat), lng: parseFloat(lng)}
});
//update the values of opt options for selection.
//fn_type('opt');
var service = new google.maps.places.PlacesService(map)
service.nearbySearch(
{
location: pyrmont,
radius: range,
type: 'gym',//[ttypes],
name: filter
}, processResults);
function processResults(results,status,pagination)
{
if (status !==google.maps.places.PlacesServiceStatus.OK)
{
var placelist2 = document.getElementById('tbl_places');


// placelist2.innerHTML="";
placelist2.innerHTML = "<tr><td colspan='3'>No Record Found</td><tr>";

;return;
}else
{
  // console.log(results);
createMarker(results);
//if data is more
if (pagination.hasNextPage)
{
var morebut= document.getElementById('More');
morebut.disabled=false;
morebut.addEventListener('click', function()
{
morebut.disabled=true;
pagination.nextPage();
});
}
}
}
function createMarker(places)
{
var placelist2 = document.getElementById('tbl_places');

placelist2.innerHTML = "";
 console.log(places.length);
if(parseInt(places.length)==0){
placelist2.innerHTML = "<tr><td colspan='3'>No Record Found</td><tr>";

}else{

for (var i=0,place;place=places[i];i++)
{

  //console.log("Ratings: "+places[i]['rating']);
calculatedistance(pyrmont.lat,pyrmont.lng,place.geometry.location.lat(),place.geometry.location.lng());
marker = new google.maps.Marker({map:map,position:place.geometry.location,
title:'Distance From My Location: '+calval+' KM. '
})

placelist2.innerHTML +="<tr><td>"+(i+1)+"</td><td>"+place.name+"</td><td>"+place.rating+"</td>";
//document.getElementById("newData").innerHTML = "<div style='color:white'> Place Name : "+place.name+" & Rating : "+place.rating+" </div>";
map.setZoom(14);
}
}

}
//define event of UL.
var disp_mark = document.getElementById('places');
disp_mark.onclick = function(event)
{
//alert(event.target.innerHTML);
data=event.target.innerHTML.split('|');
fn_mark(data);
}
}
function fn_mark(para)
{
//alert(para[2]);
new google.maps.Marker({map:map,position:{lat:parseFloat(para[2]),lng:parseFloat(para[3])},icon:{path:google.maps.SymbolPath.CIRCLE,scale:5}});
}
function fn_type_opt()
{
ttypes = document.getElementById('opt').value;
initMap();
}
function fn_sel(para)
{
if (document.getElementById('range1').checked) range=document.getElementById('range1').value;
if (document.getElementById('range2').checked) range=document.getElementById('range2').value;
if (document.getElementById('range3').checked) range=document.getElementById('range3').value;
if (document.getElementById('range4').checked) range=document.getElementById('range4').value;
initMap();
}
function fn_submit()
{
filter=document.getElementById('filter').value;
initMap();
}
function calculatedistance(s1,s2,e1,e2)
{
var latlngA= new google.maps.LatLng(s1,s2); //Point A
var latlngB= new google.maps.LatLng(e1,e2); //Point B
//Calculate distance in meters between two points A and B.
var dist =google.maps.geometry.spherical.computeDistanceBetween (latlngA, latlngB);
calval=(dist/1000).toFixed(2);
}
</script>
</head>
<body>


<?php
require ('includes/topNav.php'); 
?>
    



<!-- About 
    ================================================== -->

  <main>
  <div class="main-div" >
    <br>
  <div id="mapDiv"></div>
  <div id="listDiv" >
    <br>
   <div id='heading' style="text-align: center; font-size:20px;">Know NearBy GYMs</div>
<div id='subheading'>( Select Range )</div>
<div id='right-window'>
<table >
<!-- <tr>
<td>Select Type: </td><td><select id="opt" name="opt" onchange="fn_type_opt('opt')"/> </td>
</tr> -->
<tr>
<td>Range:</td>
<td>
  <input type="hidden" id="c_lat" name="">
  <input type="hidden" id="c_lng" name="">


<input type="radio" id="range1" name="range" value="500" checked onclick="fn_sel(this)"/>500
<input type="radio" id="range2" name="range" value="1000" onclick="fn_sel(this)"/>1000
<input type="radio" id="range3" name="range" value="5000" onclick="fn_sel(this)"/>5000
<input type="radio" id="range4" name="range" value="9900" onclick="fn_sel(this)"/>9900
</td>
</tr>
<tr>
<td colspan="2">
<ul id="places" ></ul>
</td>

<tr>
<td>Filter:</td><td><input style=" border: 3px solid #555;" id="filter" size="15" ></td>

<td colspan="2"><input type="button" id="submit" value="Submit" onclick="fn_submit()" 
  style="height: 30px; padding-top: 4px; border-radius: 10px;cursor: pointer;"  class="btn btn-capsul btn-aqua"></td>
</tr>
</table>
<br>
<div style="height: 400px; overflow-x: hidden; overflow-y:scroll;">
  

  <table id="table"   class="table table-striped table-dark"> 
  <thead>
    <tr>
      <th scope="col">Sr #</th>
      <th scope="col">Gym Name</th>
      <th scope="col">Rating</th>
    </tr>
  </thead>
  <tbody id="tbl_places">
    
  </tbody>
</table>
</div>
  

</div>
  </div>
 </div> 
</main>





<?php
require ('includes/footer.php'); 
?>


<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery.min.js" ></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/scrollPosStyler.js"></script> 
<script src="js/swiper.min.js"></script> 
<script src="js/isotope.min.js"></script> 
<script src="js/nivo-lightbox.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/core.js"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
