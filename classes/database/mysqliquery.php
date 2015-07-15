<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:57
 */

namespace Lapdoodle;

class database_mysqliquery {
    function getData($query) {
        if ($poll = app_controller::$db->query($query)) {
            return $poll;
        } else {
            //exit("mysql query failed getData");
			app_controller::$err->add('mysql_failed_to_get_data');
            return;
        }
    }
}