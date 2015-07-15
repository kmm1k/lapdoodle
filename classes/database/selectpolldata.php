<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 09.07.2015
 * Time: 19:19
 */

namespace Lapdoodle;

class database_selectpolldata {

    public function selectPollData() {
        $poll_id = app_controller::$poll_id;
        $poll = $this->selectPollDataParam($poll_id);
        return $poll;

    }
    public function selectPollDataParam($poll_id) {
        $getMysqliArray = new database_getmysqlifetcharray();
        $query  = "SELECT * FROM tables WHERE url='$poll_id'";
        $poll = $getMysqliArray->getData($query);
        if (!$poll) {
            exit ("no such poll");
        }
        return $poll;

    }

}