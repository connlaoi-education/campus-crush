<?php

  session_start();
  require('../includes/constants.php');
  require('../includes/db.php');
  require('../includes/functions.php');


  if(!isset($_GET['main']))
  {
    header("Location: ../dashboard.php");
  }

$connection = db_connect();
$results = pg_execute($connection, "update_user_default_image", array($_GET['mainImage'], $_SESSION['username']));


header("Location:../profile-images.php");
?>