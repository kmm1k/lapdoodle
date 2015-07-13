<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 08.07.2015
 * Time: 15:40
 */

class app_pollpage {

    private $usersInPoll;

    public function __construct() {
        $backbutton = new printing_printbackbutton();
        //echo app_controller::$poll_id.' pollpage.php';
        $pollDataGetter = new database_selectpolldata();
        $poll = $pollDataGetter->selectPollData();
        $with_dates = $poll['with_dates'];
        $isOwnerOfPoll = new database_isownerofpoll();
        $isAdminOfPoll = new security_isuseradmin();
        if($isOwnerOfPoll->checkOwner($poll['email']) ||
            $isAdminOfPoll->isAdmin()) {
            $this->printDeleteButton();
        }
        $this->selectPoll();
        $heading = app_controller::$strcln->pr($poll['table_id']);
        $name = app_controller::$strcln->pr($poll['name']);
        echo '<p>event name:'.$heading.'</p>
            <p>made by:'.$name.'</p>';
        $this->isPersonInPoll($poll, $with_dates);
    }

    private function printDeleteButton() {
        ?>
        <form id="remove_poll_button" class="forms" action="" method="post">
            <input type="submit" value="delete this poll" >
            <input type="hidden" name="poll_id" value ="<?php echo app_controller::$poll_id; ?>">
            <input type="hidden" name="post_type" value="delete_poll">
            <input type="hidden" name="del_poll" value="1">
        </form>
        <?php
    }
    private function selectPoll() {
        $poll_id = app_controller::$poll_id;
        $mySqliQuery = new database_mysqliquery();
        $participantPrinter = new printing_printpollparticipants();
        $query = "SELECT * FROM $poll_id";
        $this->usersInPoll = $mySqliQuery->getData($query);
        $participantPrinter->printParticipants(app_controller::$strcln,  $this->usersInPoll);
        $this->usersInPoll->data_seek(0);
    }
    private function isPersonInPoll($poll, $with_dates) {
        $isPersonInPoll = new session_ispersoninpoll();
        $user = $_SESSION[SESSION_EMAIL];
        $isInPoll = $isPersonInPoll->isInPoll($this->usersInPoll, $user);
        $this->usersInPoll->data_seek(0);
        $this->printAddToPollButton($isInPoll, $poll, $with_dates);
    }
    private function printAddToPollButton($isInPoll, $poll, $with_dates) {
        $pollPrinter = new printing_printpollparts();
        if ( !$isInPoll ) {
            ?>
            <br/>
            <form id="add_to_poll_button" class="forms" action="" method="post">
            <?php
            if ($with_dates == 1) {
                echo "dates to choose: <br/>";
                $pollPrinter->printDatesWithInput(app_controller::$strcln, $poll,
                    $this->usersInPoll);
                $this->usersInPoll->data_seek(0);
            }
            ?>
            <input id="dates" type="hidden" name="dates" value="">
            <input type="submit" value="add me to poll" >
            <input type="hidden" name="poll_id" value ="<?php echo app_controller::$poll_id; ?>">
            <input type="hidden" name="post_type" value="add">
            </form>
            <?php
        } else {
            echo "you are in poll <br/>";
            if ($with_dates == 1) {
                $pollPrinter->printDates(app_controller::$strcln, $poll, $this->$usersInPoll);
            }
            include_once(FOLDER . "/page_parts/remove_from_poll_button.php");
        }
    }


}