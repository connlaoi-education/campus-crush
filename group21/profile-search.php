<!-- Page Info -->
<?php
	$title = "CC - Search";
	$createddate = "September 19 2017";
	$updateddate = "October 20 2017";
	$filename = "profile-search.php";
	$banner = "Campus Crush";
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
<?php include 'header.php';

if(!isLoggedIn()) { 
  header("Location:user-login.php");
  ob_flush();
}
  ?>

<!-- HTML -->
<h3>Search for People - Old Friends, and New!</h3>
<p class="content"><?php echo $description; ?></p>

<hr />

<form class="w3-card w3-mobile" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

      <div class="w3-row">
		  <input class="w3-center" style="margin-top:10px; margin-left:25%; margin-right:25%; width:50%;" type="text" name="search" placeholder="Enter a first name..." />

        <?php 
    //build gender checkbox
    if(isset($_POST["gender"]))
    {
      buildCheckBox("gender", "genders", "gender_type", sumCheckBox($_POST["gender"]), "Genders");
    }
    elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["genders"]))
    {
      $array = unserialize($_COOKIE["SearchCookie"]);
      buildCheckBox("gender", "genders", "gender_type", $array["genders"], "Genders");
    }
    else
    {
      buildCheckBox("gender", "genders", "gender_type", 0, "Genders");
    }

    //build relationship checkbox
    if(isset($_POST["relationship"]))
    {
      buildCheckBox("relationship", "relationships", "relationship_type", sumCheckBox($_POST["relationship"]), "Relationship Sought");
    }
    elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["relationships"]))
    {
      $array = unserialize($_COOKIE["SearchCookie"]);
      buildCheckBox("relationship", "relationships", "relationship_type", $array["relationships"], "Relationship Sought");
    }
    else
    {
      buildCheckBox("relationship", "relationships", "relationship_type", 0, "Relationship Sought");
    }

    //build religion checkbox
    if(isset($_POST["religion"]))
    {
      buildCheckBox("religion", "religions", "religion_name", sumCheckBox($_POST["religion"]), "Religion");
    }
    elseif(isset($_COOKIE['SearchCookie']) && isset(unserialize($_COOKIE["SearchCookie"])["religions"]))
    {
      $array = unserialize($_COOKIE["SearchCookie"]);
      buildCheckBox("religion", "religions", "religion_name", $array["religions"], "Religion");
    }
    else
    {
      buildCheckBox("religion", "religions", "religion_name", 0, "Religion");
    }

    ?>
		  <input style="margin-left:45%; margin-right:45%;" type="submit" value="Search" class="btn" />
	  </div>

<hr />

<?php
	
	// SELECT * FROM users WHERE first_name = 'carol';
		// create array from select statement
		// for each row in the array
			// create a new table row
				// create a new table div for each property value in the row
				// make the userid clickable -> redirect to profile-display using GET (?user=csmith) for sharing purposes
    $input = "";
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
    $genderFromCookie = "";
	}
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
      //gender index of cookie
      if(isset($_POST["gender"])){
        $search["genders"] = sumCheckBox($_POST["gender"]);
      } else {
        $search["genders"] = 0;
      }
      //relationship index of cookie
      if(isset($_POST["relationship"])){
        $search["relationships"] = sumCheckBox($_POST["relationship"]);
      } else {
        $search["relationships"] = 0;
      }

      //religion index of cookie
      if(isset($_POST["religion"])){
        $search["religions"] = sumCheckBox($_POST["religion"]);
      } else {
        $search["religions"] = 0;
      }

      //build final cookie
      print_r(unserialize($_COOKIE["SearchCookie"]));
      setcookie("SearchCookie", serialize($search), time() + COOKIE_DURATION);
      if(isset($_POST["search"]))
      {
        $input = $_POST["search"];
      }
      if($input != "")
      {
        // add logic for user exists (count results array, == 0, display No Results prompt)
        buildSearchResults(strtolower(htmlspecialchars($input)));
      }
      else
      {
        echo('<h3 style="text-align:center;">Enter a <b>First Name</b> above to look someone  up!</h3>');
      }
      echo('</form>');
      }
      else
      {
          echo('<h3 style="text-align:center;">Enter a <b>First Name</b> above to look someone  up!</h3>');
        echo('</form>');
    }
?>

<!-- Include Footer PHP -->
 <?php include 'footer.php'; ?>