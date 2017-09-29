<!-- Page Info -->
<?php
		$title = "Campus Crush - Dash";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "user-dashboard.php";
		$banner = "Campus Crush - Dashboard";
		$description = "Hello, User Name";

?>
<!--
	Creator:      Jeremy Power
	Filename:    <?php echo $filename; ?>
	Created:      <?php echo $createddate; ?>
	Updated:     <?php echo $updateddate; ?>
	Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>


<!-- HTML -->
<p class="content"><?php 
   echo($_SESSION['output']);
  ?></p>

<br />

<?php
$content = file_get_contents('http://loripsum.net/api');
echo($content);
?>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>