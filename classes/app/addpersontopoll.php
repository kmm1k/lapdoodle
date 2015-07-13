<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 16:24
 */
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
        if ($this->checkifinpoll->inPoll($email, $poll_id, app_controller::$db)===true) {
            exit("already in poll");
        } else {
            $query = "insert into $poll_id (name, email, dates) values ('$name', '$email', '$dates');";
            $this->doQuery->tryQuery($query);
        }
    }



}