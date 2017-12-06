<!-- Page Info -->
<?php
  $title = "CC - City Select";
  $createddate = "December 4 2017";
  $updateddate = "xxxx xx 2017";
  $filename = "profile-city-select.php";
  $banner = "Campus Crush";
  $description = "Change your Username, Password, First or Last Name, and Email";
?>
<!--
  Creator:      Connlaoi Smith
  Filename:    <?php echo $filename; ?>
  Created:      <?php echo $createddate; ?>
  Updated:     <?php echo $updateddate; ?>
  Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; 

if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
if(isset($_COOKIE["CityCookie"]))
{
	header("Location:profile-search.php");
}
?>

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4xna7qFCxdv7Crc4JsD5JOf_bn9MEb9A"></script>
<script>
var gmarkers1 = [];
var markers1 = [];
var infowindow = new google.maps.InfoWindow({
    content: ''
});

// Our markers
markers1 = [
    ['0', 'Oshawa', 43.904321, -78.865306, '2'],
    ['1', 'Whitby', 43.896311, -78.922331, '4'],
    ['2', 'Ajax', 43.851020, -79.018127, '8'],
    ['3', 'Courtice', 43.910601, -78.786329, '16']
	['4', 'Bowmanville', 43.914413, -78.687901, '32'],
    ['5', 'Out of Town', 44.035622, -78.857054, '64']
];

/**
 * Function to init map
 */

function initialize() {
    var center = new google.maps.LatLng(43.943257, -78.896164);
    var mapOptions = {
        zoom: 10,
        center: center,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    for (i = 0; i < markers1.length; i++) {
        addMarker(markers1[i]);
    }
}

/**
 * Function to add marker to map
 */

function addMarker(marker) {
    var category = marker[4];
    var title = marker[1];
    var pos = new google.maps.LatLng(marker[2], marker[3]);
    var content = marker[1];

    marker1 = new google.maps.Marker({
        title: title,
        position: pos,
        category: category,
        map: map
    });

    gmarkers1.push(marker1);

    // Marker click listener
    google.maps.event.addListener(marker1, 'che', (function (marker1, content) {
        return function () {
            console.log('Gmarker 1 gets pushed');
            infowindow.setContent(content);
            infowindow.open(map, marker1);
            map.panTo(this.getPosition());
            map.setZoom(15);
        }
    })(marker1, content));
}

/**
 * Function to filter markers by category
 */

filterMarkers = function () {
    for (i = 0; i < markers1.length; i++) {
    		marker = gmarkers1[i];
    		if(document.getElementById("city" + (i+1)).checked){
        		marker.setVisible(true);
        } else {
        		marker.setVisible(false);
        }
    }
}

// Init map
initialize();
</script>


<?php include 'footer.php';?>