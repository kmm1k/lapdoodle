<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:25
 */

namespace Lapdoodle;


class printing_printaddtopollbutton {

    public function __construct($isInPoll, $poll, $with_dates, $usersInPoll) {
        $pollPrinter = new printing_printpollparts();
        if ( !$isInPoll ) {
            ?>
            <br/>
            <form id="add_to_poll_button" class="forms" action="" method="post">
                <?php
                if ($with_dates == 1) {
                    echo "dates to choose: <br/>";
                    $pollPrinter->printDatesWithInput(app_controller::$strcln, $poll,
                        $usersInPoll);
                    $usersInPoll->data_seek(0);
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
                $pollPrinter->printDates(app_controller::$strcln, $poll, $usersInPoll);
            }
            new printing_removefrompollbutton();
        }
    }

}