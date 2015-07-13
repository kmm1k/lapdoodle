<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:57
 */

class database_mysqliquery {
    function getData($query) {
        if ($poll = app_controller::$db->query($query)) {
            return $poll;
        } else {
            //exit("mysql query failed getData");
        }
    }
}