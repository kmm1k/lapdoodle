<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 08.07.2015
 * Time: 12:17
 */

namespace Lapdoodle;

class app_controller {

    public static $db;
    public static $poll_id;
    public static $strcln;
    public static $err;

    public function __construct() {
        app_controller::$err = new errors_collector();
        $connection = new database_connect();
        app_controller::$db = $connection->getDb();
        app_controller::$strcln = new security_sqlinj();
        $pollGetter = new database_getpolls();
        $pollsData = $pollGetter->queryPolls(app_controller::$db);

        if (!$pollsData) exit("mysql could not get polls");
        $pollPrinter = new printing_printoutpolls();

        if (isset($_POST['make_poll'])) {
            $this->makeNewPoll();
        }
        if (isset($_POST['poll_id'])) {
            $this->getPostPollId();
        }
        if (isset($_GET['poll_id'])) {
            app_controller::$poll_id = app_controller::$strcln->esc($_GET['poll_id']);
        }
        echo app_controller::$poll_id;
        if(isset(app_controller::$poll_id) && isset($_SESSION[SESSION_EMAIL])
            && app_controller::$poll_id != null){
            new app_pollpage();
        }else{
            $pollPrinter->printPoll($pollsData);
            new printing_pollform();
        }
    }

    private function makeNewPoll() {
        $makeNewPoll = new app_makenewpoll();
        app_controller::$poll_id = $makeNewPoll->getPollId();
    }

    private function deletePoll() {
        if ($_POST['post_type'] == "delete_poll") {
            $pollDataGetter = new database_selectpolldata();
            $poll_id = app_controller::$strcln->esc($_POST['poll_id']);
            $poll = $pollDataGetter->selectPollDataParam($poll_id);
            $isOwnerOfPoll = new database_isownerofpoll();
            $isAdminOfPoll = new security_isuseradmin();
            if($isOwnerOfPoll->checkOwner($poll['email'])||
                $isAdminOfPoll->isAdmin()) {
                new app_deletepoll($poll['url']);
                app_controller::$poll_id = null;
            }
        }
    }

    private function getPostPollId() {
        if (isset($_POST['post_type'])) {
            if ($_POST['post_type'] == "delete") {
                new app_removepersonfrompoll();
            } else if ($_POST['post_type'] == "add") {
                new app_addpersontopoll();
            } else if ($_POST['post_type'] == "delete_poll") {
                $this->deletePoll();
            }
            if(app_controller::$poll_id == null) return;
        }
        app_controller::$poll_id = app_controller::$strcln->esc($_POST['poll_id']);


    }

}