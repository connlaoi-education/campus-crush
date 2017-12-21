<!-- Page Info -->
<?php
		$title = "CC - Profile";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-images.php";
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
	$count = "";
	$truecount= "";
	
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
		$count = 0;
		$truecount= "";
		
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
							else
							{
								$error = "An error occurred while uploading your file!";	
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
				$connection = db_connect();
				$results1 = pg_execute($connection, "count_user_image", array($_SESSION['username']));
				$count = (count(scandir($userDirectory)) - 1);
				$truecount = $count + 1;
				
				// if user has more than the max images already
				if($count < 5)
				{
					$uploadFile = $userDirectory . "/" . $_SESSION['username'] . "_" . $count . ".jpg";
					if(!file_exists($uploadFile))
					{
						if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile))
						{
							$completed = "File Uploaded Successfully!";
							header("Location:profile-images.php");
						}
					}
					else
					{
						$error = $truecount . "That file already exists, please try another!";
					}
				}
				else
				{
					$error = "You must remove an image before uploading another! ";
					$error .= (count(scandir($userDirectory)) - 2);
					$error .= "/4 Image Limit";

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
					<?php buildPictureSelect($_SESSION['username']);?>
			</td>
		</tr>
					<br />
		<tr>
			<td></td>
			<td>
				<input class="btn" style="height:25px; width:260px; background-color:#b6b6b6;" type="file" name="fileToUpload" id="fileToUpload" multiple />
				<input class="btn" style="width: 220px;" type="submit" value="Upload a New Image" />
			</td>
		</tr>	
	</table>
</form>
<br />

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>