<?php

/** TODO: replace define with const, because of the namsepace thing! */


  /** ----------------- */
 /** database settings */
/** ----------------- */

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_TABLES", "lapdoodle");
define("TBL_TABLES", "tables");


  /** ------------------------------------------ */
 /** define your website session variables here */
/** ------------------------------------------ */

/** email is the main way to id users here,
 * if you use usernames change it here.
 */
define("SESSION_EMAIL", "email");

/** this name will be displayed in the poll
 * who made the poll, who is in the poll.
 */
define("SESSION_NAME", "name");

/** here you should put your admin session id e.g.
 * $_SESSION['admin'] <- this holds admin session
 */
define("SESSION_ADMIN", "admin");

/** to check if someone is admin or not
 * for example if your admin session is set up like:
 * 1 = is admin of the site: ($_SESSION['admin'] === 1) is admin
 * 0 = is not admin of the site
 * then you should set ADMIN_DECLARATION to 1
 */
define("ADMIN_DECLARATION", FALSE);


  /** ------------- */
 /** poll settings */
/** ------------- */

/** if admins can only make polls */
define("ADMIN_CAN_MAKE_POLLS", FALSE);

/** if you want to make polls with custom choices */
define("POLLS_WITH_CUSTOM_DATA", TRUE);

/** if you want to make polls with dates */
define("POLLS_WITH_DATES", TRUE);

/** if admin can add people to polls */
define("ADMIN_CAN_ADD_PEOPLE", TRUE);


  /** ------------------- */
 /** folder/url settings */
/** ------------------- */

define("FOLDER", $_SERVER['DOCUMENT_ROOT']."/lapdoodle");
define("CLASSES", $_SERVER['DOCUMENT_ROOT']."/lapdoodle/classes");
define("URL", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define("MURL", "http://$_SERVER[HTTP_HOST]/");
?>