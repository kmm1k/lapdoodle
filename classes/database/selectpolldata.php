<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 09.07.2015
 * Time: 19:19
 */

namespace Lapdoodle;

class database_selectpolldata {

    public function selectPollData($parameterPollId = null) {
        if ($parameterPollId == null) {
            $poll_id = app_controller::$poll_id;
        } else {
            $poll_id = $parameterPollId;
        }
        $poll = $this->selectPollDataParam($poll_id);
        return $poll;

    }
    public function selectPollDataParam($poll_id) {
        $getMysqliArray = new database_getmysqlifetcharray();
        $query  = "SELECT * FROM tables WHERE url='$poll_id'";
        $poll = $getMysqliArray->getData($query);
        if (!$poll) {
			app_controller::$err->add('no_such_poll_with_that_code');
            return;
        }
        return $poll;

    }

}