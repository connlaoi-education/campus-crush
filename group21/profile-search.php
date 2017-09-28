<!-- Lab Info Variables -->
<?php
		$title = "Campus Crush - Search";
		$createddate = "September 19 2017";
		$updateddate = "xxxx xx 2017";
		$filename = "profile-search.php";
		$banner = "Campus Crush - User Search";
		$description = "Find your Friends - Or your Crush";
?>
<!--
		Creator:      Connlaoi Smith
        Filename:    <?php echo $filename; ?>
        Created:      <?php echo $createddate; ?>
        Updated:     <?php echo $updateddate; ?>
        Description: <?php echo $description; ?>
-->

<!-- Include Header PHP -->
<?php include 'header.php'; ?>

<!-- HTML -->
<p class="content"><?php echo $description; ?></p>

<br />
<hr />

<?php
$content = file_get_contents('http://loripsum.net/api');
echo("<p>" . $content . "</p>");
?>

<br />



<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>