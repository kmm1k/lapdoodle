<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 16:24
 */

namespace Lapdoodle;

class app_addpersontopoll {

    private $doQuery;
    private $checkifinpoll;

    public function __construct() {
        $checker = new security_checksp();
        if ($checker->CheckPostSession('poll_id')){
            $this->doQuery = new database_doquery();
            $this->checkifinpoll = new database_checkifinpoll();
            $this->addToPoll();
        }

    }

    private function addToPoll() {

        $dates = app_controller::$strcln->esc($_POST['dates']);
        app_controller::$poll_id = app_controller::$strcln->esc($_POST['poll_id']);
        $email = app_controller::$strcln->esc($_SESSION[SESSION_EMAIL]);
        $name = app_controller::$strcln->esc($_SESSION[SESSION_NAME]);
        $poll_id = app_controller::$poll_id;

        /** @var pointer to poll data gatherer $pollDataGetter  */
        $pollDataGetter = new database_selectpolldata();
        /** @var data from the database about the polls $poll */
        $poll = $pollDataGetter->selectPollData();
        /** if the poll is empty it means, the poll doesn't exist */
        if (!$poll) {
            return;
        }
        /** @var poll participants and poll choices $pollData */
        $pollData = unserialize($poll['poll']);
        //exit(print_r($pollData));


        if ($this->isInPoll($pollData, $email)) {
            app_controller::$err->add('already_in_poll');
            return;
        } else {
            $userArray['email'] = $email;
            $userArray['name'] = $name;
            array_push($userArray, explode(",", $dates));
            $pollData[$email] = $userArray;
            //exit(print_r($pollData));
            $pollData = serialize($pollData);

            $query = "UPDATE tables SET poll='$pollData' WHERE url='$poll_id'";
            $this->doQuery->tryQuery($query);
        }
    }



    private function isInPoll($upoll, $email) {
        if (count($upoll) > 0) {
            foreach ($upoll as $user) {
                if ($user[0] == $email) {
                    return true;
                }
            }
        }
        return false;
    }



}