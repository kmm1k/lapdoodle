<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_TABLES", "lapdoodle");
define("TBL_TABLES", "tables");
/* define your website session variables here, so the plugin works */
define("SESSION_EMAIL", "email");
define("SESSION_NAME", "name");
define("SESSION_ADMIN", "admin");
define("ADMIN_DECLARATION", TRUE);
/*  */
define("FOLDER", $_SERVER['DOCUMENT_ROOT']."/lapdoodle");
define("CLASSES", $_SERVER['DOCUMENT_ROOT']."/lapdoodle/classes");

define("URL", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define("MURL", "http://$_SERVER[HTTP_HOST]/");
?>