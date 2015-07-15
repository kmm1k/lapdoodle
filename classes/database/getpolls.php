<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 13:13
 */

namespace Lapdoodle;

class database_getpolls {

    function queryPolls($db) {
        $mySqliQuery = new database_mysqliquery();
        $query = "SELECT * FROM tables";
        $data = $mySqliQuery->getData($query);
        return $data;
    }

}