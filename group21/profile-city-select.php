<!-- Page Info -->
<?php
	$title = "CC - City";
	$createddate = "September 19 2017";
	$updateddate = "October 20 2017";
	$filename = "profile-city-select.php";
	$banner = "Campus Crush";
	$description = "Select the Cities you wish to Search";
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
?>


<script type="text/javascript">
      function initMap() {
        var durhamCollege = {lat: 43.942724, lng: -78.896196};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: durhamCollege,
          map: map,
          title: 'Durham Region'
        });
      }
</script>


<!-- HTML -->
<h3>Search for People - Old Friends, and New!</h3>
<p class="content"><?php echo $description; ?></p>

<hr />

<form class="w3-card w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

      <div class="w3-row">
		  <div id="map"><script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0DklPzVEeSj0XTUgmA19Dh6rtdJq2b_s&callback=initMap">
</script></div>
		  <input style="margin-left:45%; margin-right:45%;" type="submit" value="Refine Search" class="btn" />
	  </div>
      
</form>
<?php
	// SELECT * FROM users WHERE first_name = 'carol';
		// create array from select statement
		// for each row in the array
			// create a new table row
				// create a new table div for each property value in the row
				// make the userid clickable -> redirect to profile-display using GET (?user=csmith) for sharing purposes
	
	$prompt = "<h3 style='text-align:center;'>Select the cities of interest to you!</h3>";
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{ 
		if(isset($_COOKIE["Search"]["City"]))
		{
			header("Location: profile-search.php");
        }
		else
		{
			buildCheckBox("city", "cities", "city_name", $_COOKIE["Search"]["Cities"], "Cities");
		}
	}
	else if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//buildImageMap(0);
	}
	else
	{
		echo($prompt);
	}
?>

<hr />

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>