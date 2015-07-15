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
        $with_dates = $poll['with_dates'];
        $isOwnerOfPoll = new database_isownerofpoll();
        $isAdminOfPoll = new security_isuseradmin();
        if($isOwnerOfPoll->checkOwner($poll['email']) ||
            $isAdminOfPoll->isAdmin()) {
            new printing_printdeletebutton();
        }
        $this->selectPoll();
        if (!$this->usersInPoll) {
            app_controller::$err->add('no_poll');
            return;
        }
        new printing_printpollinfo($poll);
        $this->isPersonInPoll($poll, $with_dates);
    }
    private function selectPoll() {
        $poll_id = app_controller::$poll_id;
        $mySqliQuery = new database_mysqliquery();
        $participantPrinter = new printing_printpollparticipants();
        $query = "SELECT * FROM $poll_id";
        $this->usersInPoll = $mySqliQuery->getData($query);
        if (!$this->usersInPoll) {
            return;
        }
        $participantPrinter->printParticipants(app_controller::$strcln,  $this->usersInPoll);
        $this->usersInPoll->data_seek(0);
    }
    private function isPersonInPoll($poll, $with_dates) {
        $isPersonInPoll = new session_ispersoninpoll();
        $user = $_SESSION[SESSION_EMAIL];
        $isInPoll = $isPersonInPoll->isInPoll($this->usersInPoll, $user);
        $this->usersInPoll->data_seek(0);
        new printing_printaddtopollbutton($isInPoll, $poll, $with_dates, $this->usersInPoll);
    }

}