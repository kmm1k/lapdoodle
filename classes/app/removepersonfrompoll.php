<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 16:15
 */

namespace Lapdoodle;

class app_removepersonfrompoll {

    public function __construct() {
        $checker = new security_checksp();
        if ($checker->CheckPostSession('poll_id')) {
            $doQuery = new database_doquery();
            $this->remove($doQuery);
        }
    }

    private function remove($doQuery) {
        $poll_id = app_controller::$strcln->esc($_POST['poll_id']);
        $email = app_controller::$strcln->esc($_SESSION[SESSION_EMAIL]);
        $pollDataGetter = new database_selectpolldata();
        $poll = $pollDataGetter->selectPollData($poll_id);
        if (!$poll) return;
        $pollData = unserialize($poll['poll']);
        foreach ($pollData as $user) {
            if ($user['email'] == $email) {
                unset($pollData[$email]);
                break;
            }
        }
        $sPollData = serialize($pollData);
        $query = "UPDATE tables SET poll='$sPollData'";
        $doQuery->tryQuery($query);
    }

}
?>