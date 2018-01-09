<?php

  session_start();
  require('../includes/constants.php');
  require('../includes/db.php');
  require('../includes/functions.php');

  if(!isset($_GET['delete']))
  {
    header("Location: ../dashboard.php");
  }

  $checkTotal = sumCheckBox($_GET["delImage"]);

  $connection = db_connect();
  $resImages = pg_execute($connection, "select_user_image", array($_SESSION['username']));
  $dataArray = pg_fetch_all($resImages);


  $results = pg_execute($connection, "select_all_profile", array($_SESSION['username']));
  $profArray = pg_fetch_assoc($results);



  for ($i=0; $i < pg_num_rows($resImages); $i++) { 
    if(isBitSet($dataArray[$i]["image_id"], $checkTotal))
    {
      if($dataArray[$i]["image_id"] == $profArray['image'])
      {
        pg_execute($connection,"update_user_default_image", array(DEFAULT_IMAGEID, $_SESSION['username']));
      }

      unlink($dataArray[$i]["image_address"]);
      pg_execute($connection, "delete_user_image", array($dataArray[$i]["image_id"]));
    }
  }

header("Location: ../profile-images.php");
?>