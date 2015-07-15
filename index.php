<div id="schedule_app">
<?php


/* error reporting on */
error_reporting(E_ALL);

/* start the session */
session_start();


/* include constants */
include_once("constants.php");

/* these should come from website session */
/* TODO session name constants! */
$_SESSION[SESSION_EMAIL] = "kmmiil95@gmail.com";
$_SESSION[SESSION_NAME] = "Karl-Martin Miil";
/* If you want to be admin of the page */
$_SESSION[SESSION_ADMIN] = FALSE;

/* include javascript and css files*/
include_once(FOLDER . "/includes/header_scripts.php");
?>
<div id="schedule_wrapper">
<?php
/* include the init.php file */
include 'includes/init.php';

/* include javascript and css files*/
include_once(FOLDER . "/includes/footer_scripts.php");
?>
</div>
</div>