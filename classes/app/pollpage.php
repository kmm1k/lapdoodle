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
        $isPersonInPoll = new session_ispersoninpoll();
        $user = $_SESSION[SESSION_EMAIL];
        $isInPoll = $isPersonInPoll->isInPoll($this->usersInPoll, $user);
//new printing_printaddtopollbutton($isInPoll, $poll, $with_dates, $this->usersInPoll);
        $pollPrinter = new printing_printpollparts($poll);
        if ($isInPoll) {
            if ($with_dates == 0) {
                /** print users who are in poll without dates poll */
                $pollPrinter->printPoll($poll);
            } else {
                /** print users who are in poll with dates poll */
                $pollPrinter->printPollWithDates($poll);
            }
            new printing_removefrompollbutton();
        } else {
            if ($with_dates == 0) {
                $pollPrinter->printPoll($poll);
                new printing_printaddtopollbutton();
            } else {
                //exit(print_r($this->usersInPoll));
                new printing_printaddtopollbutton($poll);
            }
        }
    }

}