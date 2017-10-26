<!-- Page Info -->
<?php
	$title = "Campus Crush - Create";
	$createddate = "September 19 2017";
	$updateddate = "xxxx xx 2017";
	$filename = "user-update.php";
	$banner = "Campus Crush";
	$description = "Change your Username, Email, or Password";
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
		ob_flush();
	}
?>

<!-- HTML -->

<h3>Update your Account Information</h3>
<p class="content"><?php echo $description; ?></p>

<?php

?>

<hr />

<br />

<!-- Include Footer PHP -->
<?php include 'footer.php'; ?>