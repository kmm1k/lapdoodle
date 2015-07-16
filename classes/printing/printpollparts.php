<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:24
 */

namespace Lapdoodle;

class printing_printpollparts {


    function printDatesWithInput($poll) {
        $this->printPollWithDates($poll, TRUE);
    }

    function printPollWithDates($poll, $withInput = FALSE) {
        ?>
        <table>
        <?php
        if ($poll['with_dates'] == 1){
            $dates = explode(",", $poll['dates']);
        } else {
            $dates = unserialize($poll['custom']);
        }
        $this->printJoinedUsers($poll);
        $number = 0;
        ?>
        <?php
        foreach ($dates as $date) {
            $number++;
            $date = app_controller::$strcln->pr($date);
            ?>
            <tr>
                <td>
                    <?php
                    echo $date;
                    if ($withInput) {
                        ?>
                        <input added_date="<?php echo $date; ?>"
                               class="joining-image" type="checkbox"
                               value="<?php echo $date; ?>">
                        <?php
                    }
                    ?>
                    <br/>
                </td>
                <td>
                <?php
                $uPollData = unserialize($poll['poll']);
                foreach ($uPollData as $data) {
                    foreach ($data[0] as $joinedDate) {
                        if ($joinedDate == $date){
                            echo "v";
                        }
                    }
                }
                ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }


    function printJoinedUsers($poll) {
        $uPollData = unserialize($poll['poll']);
        if (count($uPollData) > 0) {
            ?>
            <tr>
                <td> dates: </td>
            <?php
            foreach ($uPollData as $user) {
                ?>
                <td>
                    <?php
                    echo $user['name'];
                    ?>
                </td>
                <?php
            }
            ?>
            </tr>
            <?php
        }
    }

    function printPoll($poll) {
        $uPollData = unserialize($poll['poll']);
        ?>
        <table>
            <th>people joined:</th>
            <?php
            foreach ($uPollData as $user) {
                ?>
                <tr>
                    <td>
                    <?php
                    echo $user['name'];
                    ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <?php
    }


}