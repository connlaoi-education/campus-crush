<?php

  session_start();
  require('includes/constants.php');
  require('includes/functions.php');
  require('includes/db.php');

  if(!isset($_POST['deactivate']))
  {
    header("Location: dashboard.php");
  }
    $connection = db_connect();
    $results = pg_execute($connection, "update_account", array(DISABLED, $_POST['deactivate']));

  header("Location: profile-display.php?user=" . $_POST['deactivate']);
?>