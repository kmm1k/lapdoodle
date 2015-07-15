<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 09.07.2015
 * Time: 19:11
 */

namespace Lapdoodle;

class app_deletepoll {
    public function __construct($poll_url) {
        $query = "DROP TABLE $poll_url";
        $querytwo = "DELETE FROM tables WHERE url='$poll_url'";
        $querymaker = new database_doquery();
        $querymaker->tryQuery($query, $querytwo);
    }
}