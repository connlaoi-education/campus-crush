<!-- Page Info -->
<?php
	$title = "Campus Crush";
	
	$createddate = "May 9 2017";
	$updateddate = "Sep 24 2017";
	$filename = "index.php";
	$banner = "Campus Crush";
	$description = "Find Comfort<br /><i>During your College Experience</i>";
?>
<!--
	Creator:      Minh Tri, Ly - Group 21
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>

	<p class="highlight" style="color:red;">
	<?php
		if(isset($error))
		{
			echo($error);
			unset($error);
		}
		if(isset($error_2))
		{
			echo($error_2);
			unset($error_2);
		}
		if(isset($_SESSION["redirected"]))
		{
			echo($_SESSION["redirected"]);
			unset($_SESSION["redirected"]);
		}
	?>
	</p>
	<p class="highlight" style="color:green;">
		<?php
		if(isset($completed))
		{
			echo($completed);
			unset($completed);
		}
		?>
	</p>
	
	<h1><b><?php echo $description; ?></b></h1>
	<p>Don't let your dreams be dreams... Reach out to your Campus Crush now!</p>
	<img class="w3-animate-zoom index" src="./images/index_north_oshawa.png" alt="North Oshawa Campus"/>
	
<?php include 'footer.php'; ?>
