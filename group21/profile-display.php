<!-- Page Info -->
<?php
		$title = "Campus Crush";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-display.php";
		$banner = "Campus Crush";
		$description = "";
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

<!-- HTML -->
<p class="content"><?php echo $description; ?></p>

<br />
<hr />

<?php
	$gender = getProperty('profiles','gender',$_SESSION['gender_type']);
	$gender_sought = getProperty('profiles','gender_sought',$_SESSION['gender_type']);
	$city = getProperty('profiles','city',$_SESSION['city_name']);
	$image = getProperty('profiles','image',$_SESSION['image_address']);
	$headline = getProperty('profiles','headline',$_SESSION['headline']);
		
	

$content = file_get_contents('http://loripsum.net/api');
echo($content);
?>



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>