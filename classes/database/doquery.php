<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 16:51
 */

namespace Lapdoodle;

class database_doquery {

    //only in php 5.6
    public function tryQuery(...$querys) {
        foreach ($querys as $query) {
            if(app_controller::$db->query($query)){
            }else{
                exit("query failed");
            }
        }
    }

}