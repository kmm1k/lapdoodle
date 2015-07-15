<?php

namespace Lapdoodle;
use \mysqli;

include_once(FOLDER."/constants.php");
class database_connect
{

    private static $database = false;

    public static function getDb() {
        if (database_connect::$database === false) {
            database_connect::$database = database_connect::connection();
            echo "i made a connection to the db";
        }
        database_connect::checkConnection(database_connect::$database);
        return database_connect::$database;
    }

	
	public static function connection(){
		return new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_TABLES);
	}

    public static function checkConnection($connection){
		if($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
		}
		return;
	}
	
}
?>