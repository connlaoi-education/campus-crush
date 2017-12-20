<!-- Page Info -->
<?php
		$title = "CC - Profile";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-create.php";
		$banner = "Campus Crush";
		$description = "What makes you stand out? What are you looking for?";
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

if(!isLoggedIn())
{ 
	header("Location:user-login.php");
	$_SESSION['redirected'] = 'You must login to complete that action!'; 
	ob_flush();
}
?>

<!-- HTML -->

<h3>Define your Campus Presence</h3>
<p class="content"><?php echo $description; ?></p>

<?php
    $error = "";
	$error_2 = "";
	$results = "";
	$results2 = "";
	$completed = "";
	
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		if($_SESSION['account_type'] == INCOMPLETE)
		{
			header("Location:profile-create.php");
			$_SESSION['redirected'] = 'You must complete the rest of your profile before selecting an image!'; 
			ob_flush();
		}
		else
		{
			//create array of user's profile options
			$connection = db_connect();
			$results = pg_execute($connection, "select_user_image", array($_SESSION['username']));
			$imageArray = pg_fetch_array($results);

			//store them in variables to echo
			//$imageID = $imageAddressArray["image"][0];
			$imageAddress = getProperty('images', 'image_address', $imageArray["image"], 'image_id');
		}
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$error="";
		
		if($_FILES['fileToUpload']['error'] !=0)
		{
			$error = "There was a problem uploading your Image!";
		}
		elseif($_FILES['fileToUpload']['size'] > 3000000) //size in bytes
		{
			$error ="The Image you selected is too big! (3MB Max.)";
		}
		elseif($_FILES['fileToUpload']['type'] != "image/jpeg" && $_FILES['fileToUpload']['type'] != "image/pjpeg")
		{
			$error = "Your profile pictures must be a JPEG!";
		}
		else // image is valid to upload
		{
			// query database for user images
			$connection = db_connect();
			$results = pg_execute($connection, "select_user_image", array($_SESSION['username']));
			$catch = pg_fetch_array($results);

			
			$userDirectory = "./images/users/" . $_SESSION['username'];
			
			// if the user does not have a directory
			if(!is_dir($userDirectory))
			{
					// create a new directory with their username
					if(mkdir($userDirectory))
					{
						$uploadFile = $userDirectory  . "/" . $_SESSION['username'] . "_1.jpg";
						// if the users first image does not exist
						if(!file_exists($uploadFile))
						{
							if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile))
							{
								$completed = "File Uploaded Successfully!";
							}
						}
						else
						{
							$error = "That file already exists, please try another!";
						}
					}
					else
					{
						$error = "There was an issue creating your private image directory!";
					}
			}
			else
			{
				$results1 = pg_execute($connection, "count_user_image", array($_SESSION['username']));
				$count = pg_fetch_object($results1);
				$truecount = $count + 1;
				// if user has more than the max images already
				if($count < 4)
				{
					$uploadFile = $userDirectory . "/" . $_SESSION['username'] . "_" . $truecount . ".jpg";
					if(!file_exists($upFile))
					{
						if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile))
						{
							$completed = "File Uploaded Successfully!";

						}
					}
					else
					{
						$error = "That file already exists, please try another!";
					}
				}
				else
				{
					$error = "You must remove an image before uploading another!";
				}
			}
		}
		
		if($error == "")
		{	
			$results3 = pg_execute($connection, "insert_user_image", array($_SESSION['username'], $uploadFile));
		}
	}
?>

<hr />

<p class="highlight" style="color:red;">
	<?php echo($error); ?>
	<?php echo($error_2); ?>
</p>
<p class="highlight" style="color:green;">
	<?php echo($completed); ?>
</p>


<br />

<form id="uploadform" enctype="multipart/form-data" name="input" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
		<tr>
			<td>Select Images</td>
			<td>
				<div class="w3-content w3-display-container" style="width:600px; height:300px;">
				  <img class="mySlides" src="./images/users/<?php echo($_SESSION['username']); ?>/<?php echo($_SESSION['username']); ?>_1.jpg" style="max-width:600px;max-height:300px;" />
				  <img class="mySlides" src="./images/users/<?php echo($_SESSION['username']); ?>/<?php echo($_SESSION['username']); ?>_2.jpg" style="max-width:600px;max-height:300px;" />
				  <img class="mySlides" src="./images/users/<?php echo($_SESSION['username']); ?>/<?php echo($_SESSION['username']); ?>_3.jpg" style="max-width:600px;max-height:300px;" />
				  <img class="mySlides" src="./images/users/<?php echo($_SESSION['username']); ?>/<?php echo($_SESSION['username']); ?>_4.jpg" style="max-width:600px;max-height:300px;" />
				  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
					<div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
					<div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
					<span class="w3-badge togs w3-border w3-transparent w3-hover-green" onclick="currentDiv(0)"></span>
					<span class="w3-badge togs w3-border w3-transparent w3-hover-green" onclick="currentDiv(1)"></span>
					<span class="w3-badge togs w3-border w3-transparent w3-hover-green" onclick="currentDiv(2)"></span>
					<span class="w3-badge togs w3-border w3-transparent w3-hover-green" onclick="currentDiv(3)"></span>
				</div>
				</div>
					<br />
				<input class="btn" style="height:25px; width:260px; background-color:#b6b6b6;" type="file" name="fileToUpload" id="fileToUpload" multiple />
				<input class="btn" style="width: 220px;" type="submit" value="Upload a New Image" />
			</td>
		</tr>	
	</table>
</form>
<br />
<br />
<br />
<style>
.mySlides {display:none}
.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>
<script type="text/javascript">
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("togs");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>