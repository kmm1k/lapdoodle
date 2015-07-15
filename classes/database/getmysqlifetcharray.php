<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:02
 */

namespace Lapdoodle;

class database_getmysqlifetcharray {

    function getData($query) {
        if($poll=mysqli_fetch_array(app_controller::$db->query($query))) {
            return $poll;
        } else {
            return null;
        }
    }

}