<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
    Name: Jeremy Power
    File: <?php echo "$fileName \n"; ?>
    Date: <?php echo "$date \n"; ?>
    <?php echo "$description \n"; ?>
-->
    <?php require('includes/functions.php') ?>
    <?php ob_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <link rel="stylesheet" href="http://opentech2.durhamcollege.org/webd2201/powerj/css/webd2201.css" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
    <?php
    echo "$title";
    ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="http://opentech2.durhamcollege.org/webd2201/powerj/images/favicon.ico" />
</head>

<body>
    <div id="container">
        <div id="header">
            <img src="http://opentech2.durhamcollege.org/webd2201/powerj/images/logo.gif" alt="powerj" />
            <?php echo "<h1>$banner</h1>";?>
        </div>
        <div id="sites">
            <ul>
                <li><a href="http://opentech2.durhamcollege.org/pufferd/webd2201/">WEBD2201</a></li>
                <li><a href="http://www.w3schools.com">W3Schools</a></li>
                <li><a href="http://validator.w3.org">XHTML Validator</a></li>
                <li><a href="http://jigsaw.w3.org/css-validator/">CSS Validator</a></li>
                <li><a href="http://php.net/manual/en/index.php">PHP Manual</a></li>
                <li><a href="http://www.durhamcollege.ca">Durham College</a></li>
            </ul>
        </div>
        <div id="content-container">
            <div id="navigation">
                <h3>Local Navigation Bar</h3>
                <ul>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/">Home Page</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab1.php">Lab 1: HTML Intro</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab2.php">Lab 2: HTML Tables</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab3.php">Lab 3: Formatting and Layout with Styles</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/termtest1.php">Term Test 1</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab4.php">Lab 4: PHP Chapter Files from textbook</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab5.php">Lab 5: Basic PHP Scripting</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab6.php">Lab 6: Self-referring Forms w/ Data Validation</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab7.php">Lab 7: Database Intro</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/termtest2.php">Term Test 2</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab9.php">Lab 9: Database/PHP Lab - User Login</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/lab10.php">Lab 10: Database/PHP Lab - User Registration</a></li>
                    <li><a href="http://opentech2.durhamcollege.org/webd2201/powerj/termtest3.php">Term Test 3</a></li>
                </ul>
            </div>
            <div id="content">