<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
    Name: Jeremy Power
    File: <?php echo "$fileName \n"; ?>
    Date: <?php echo "$date \n"; ?>
    <?php echo "$description \n"; ?>
-->
    <?php 
	require_once('includes/constants.php')
	require_once('includes/db.php')
	require_once('includes/functions.php') 
	?>
    <?php ob_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="http://opentech2.durhamcollege.org/webd3201/group21/css/crushstyle.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
    <?php
    echo "$title";
    ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="http://opentech2.durhamcollege.org/webd3201/group21/images/favicon.ico" />
</head>

<body>
    <div id="container">
        <div id="header">
            <img src="http://opentech2.durhamcollege.org/webd3201/group21/images/logo.gif" alt="Campus Crush" />
            <?php echo "<h1>$banner</h1>";?>
        </div>
        <div id="content-container">
            <div id="navigation">
                <ul>
                    <li><a href="http://opentech2.durhamcollege.org/webd3201/group21/index.php">Home</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd3201/group21/login.php">Login</a></li>
                </ul>
            </div>
            <div id="content">