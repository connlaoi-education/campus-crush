<?php

  session_start();
  require('includes/constants.php');
  require('includes/functions.php');
  require('includes/db.php');

  if(!isset($_POST['report']))
  {
    header("Location: dashboard.php");
  }
    $connection = db_connect();
    $results = pg_execute($connection, "insert_offensive", array($_SESSION['username'], $_POST['deactivate'], date("Y-m-d h:i:s", time())));

  header("Location: profile-display.php?user=" . $_POST['deactivate']);
?>