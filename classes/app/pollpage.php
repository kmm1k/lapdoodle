<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 08.07.2015
 * Time: 15:40
 */

namespace Lapdoodle;

class app_pollpage {

    private $usersInPoll;

    public function __construct() {
        new printing_printbackbutton();
        //echo app_controller::$poll_id.' pollpage.php';
        $pollDataGetter = new database_selectpolldata();
        $poll = $pollDataGetter->selectPollData();
        if (!$poll) {
            return;
        }
        $with_dates = $poll['with_dates'];
        $isOwnerOfPoll = new database_isownerofpoll();
        $isAdminOfPoll = new security_isuseradmin();
        if($isOwnerOfPoll->checkOwner($poll['email']) ||
            $isAdminOfPoll->isAdmin()) {
            new printing_printdeletebutton();
        }
        $this->selectPollUsers($poll);
        new printing_printpollinfo($poll);
        $this->isPersonInPoll($with_dates, $poll);
    }
    private function selectPollUsers($poll) {
        $this->usersInPoll = unserialize($poll['poll']);
    }
    private function isPersonInPoll($with_dates, $poll) {
        $isAdmin = FALSE;
        if ($_SESSION[SESSION_ADMIN] == ADMIN_DECLARATION) $isAdmin = TRUE;
        $isPersonInPoll = new session_ispersoninpoll();
        $user = $_SESSION[SESSION_EMAIL];
        $isInPoll = $isPersonInPoll->isInPoll($this->usersInPoll, $user);
//new printing_printaddtopollbutton($isInPoll, $poll, $with_dates, $this->usersInPoll);
        new printing_printpollparts($poll, $isInPoll, $with_dates, $isAdmin);
    }

}