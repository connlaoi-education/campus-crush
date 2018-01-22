<!-- Page Info -->
<?php
  $title = "CC - Cities";
  $createddate = "December 4 2017";
  $updateddate = "xxxx xx 2017";
  $filename = "profile-city-select.php";
  $banner = "Campus Crush";
  $description = "Select at least one City to Continue";
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
// if the user is not logged in
if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
?>

<form class="w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	<div class="w3-card w3-round w3-row">
		<header class="w3-container" style="background-color: #4A7C59;">
			<h3 class="profileCardHeader">City Selection</h3>
		</header>
		<div id="map"></div>
		<script>
		  var gmarkers1 = [];
		  var markers1 = [];
		  var map;
		  var infowindow = new google.maps.InfoWindow({
			  content: ''
		  });

		  // Our markers
		  var markers1 = [
			  ['0', 'Ajax', 43.851020, -79.018127, '8'],
			  ['1', 'Whitby', 43.896311, -78.922331, '4'],
			  ['2', 'Oshawa',43.904321, -78.865306, '2'],
			  ['3', 'Courtice', 43.9109, -78.7884, '16'],
			  ['4', 'Bowmanville', 43.914413, -78.687901, '32'],
			  ['5', 'Out of Town', 44.034110, -78.869608, '64']
		  ];

		  function initMap() {
		  var markers1 = [
			  ['0', 'Ajax', 43.851020, -79.018127, '8'],
			  ['1', 'Whitby', 43.896311, -78.922331, '4'],
			  ['2', 'Oshawa',43.904321, -78.865306, '2'],
			  ['3', 'Courtice', 43.9109, -78.7884, '16'],
			  ['4', 'Bowmanville', 43.914413, -78.687901, '32'],
			  ['5', 'Out of Town', 44.034110, -78.869608, '64']
		  ];
			var durham = {lat: 43.943257, lng: -78.896164};
			map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 10,
			  center: durham,
			  mapTypeId: google.maps.MapTypeId.TERRAIN
			});
	  console.log(markers1.length);
			for (i = 0; i < markers1.length; i++) {
	  console.log("test3");
			  addMarker(markers1[i]);
		}
		filterMarkers();
		  }
	/**
	 * Function to filter markers by category
	 */

	function filterMarkers () {
		  var markers1 = [
			  ['0', 'Ajax', 43.851020, -79.018127, '8'],
			  ['1', 'Whitby', 43.896311, -78.922331, '4'],
			  ['2', 'Oshawa',43.904321, -78.865306, '2'],
			  ['3', 'Courtice', 43.9109, -78.7884, '16'],
			  ['4', 'Bowmanville', 43.914413, -78.687901, '32'],
			  ['5', 'Out of Town', 44.034110, -78.869608, '64']
		  ];
		for (i = 0; i < markers1.length; i++) {
			marker = gmarkers1[i];
			if(document.getElementById("city" + (i+1)).checked){
				marker.setVisible(true);
			} else {
				marker.setVisible(false);
			}
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

		var marker1 = new google.maps.Marker({
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
			};
		})(marker1, content));
	}
		</script>
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkWOL_lN6UafQv_TqmYuASWPwPkJOhIOc&callback=initMap">
		</script>
	</div>
	<div class="w3-row" style="padding-left:15%;">
	<?php
		if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			if(isset($_COOKIE["CityCookie"]))
			{
				setcookie("CityCookie", "", time() - COOKIE_DURATION);
			}
			if(isset($_COOKIE["CityCookie"]))
			{
				buildMapCheckBox("city", "cities", "city_name", sumCheckBox(unserialize($_COOKIE["CityCookie"])), true);
			}
			else
			{
				buildMapCheckBox("city", "cities", "city_name", 126, true);
			}
		}
		elseif($_SERVER["REQUEST_METHOD"] == "POST")
		{
		  if(!isset($_POST["city"]))
		  {
				echo("<h2>Please select at least one city before continuing</h2>");
				
				if(isset($_COOKIE["CityCookie"]))
				{
					buildMapCheckBox("city", "cities", "city_name", sumCheckBox(unserialize($_COOKIE["CityCookie"])), true);
				}
				else
				{
					buildMapCheckBox("city", "cities", "city_name", 126, true);
				}
			}
			else
			{
				//cookie is NOT set
				if(!isset($_COOKIE["CityCookie"]))
				{
					//but post is set
					if(isset($_POST["city"]))
					{
						//create cookie using post
						$search = $_POST["city"];
						setcookie("CityCookie", serialize($search), time() + COOKIE_DURATION);
						//direct to search selection/results page
						header("Location:profile-search.php"); //redirect
					}
				}
				//cookie IS set
				else
				{
					//direct to search selection/results page
					header("Location:profile-search.php"); //redirect
				}
			}
		}
	?>
	</div>
	<div class="w3-row">
		<button style="margin-left:45%;" type="submit" value="Continue" class="btn">Continue</button>
	</div>
	
<hr />


	</form>	

  
<?php include 'footer.php';?>