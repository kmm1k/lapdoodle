<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:24
 */

class printing_printpollparts {

    function printDatesWithInput($strcln, $poll, $users) {
        $dates = explode(",", $poll['dates']);
        $number = 0;
        foreach ($dates as $date) {
            $number++;
            $date = $strcln->pr($date);
            echo $date.'<input added_date="'
                .$date
                .'" class="joining-image" type="checkbox" value="'
                .$date.'"><br/>';
            $this->printJoinedUser($strcln, $users, $date);
        }
    }

    function printDates($strcln, $poll, $users) {
        $dates = explode(",", $poll['dates']);
        $number = 0;
        foreach ($dates as $date) {
            $number++;
            $date = $strcln->pr($date);
            echo $date.'<br/>';
            $this->printJoinedUser($strcln, $users, $date);
        }
    }

    function printJoinedUser($strcln, $users, $date) {
        if ($users->num_rows > 0) {
            while ($row = $users->fetch_assoc()) {
                if ($this->isPersonInThisDate($date, $row['dates'])) {
                    echo $strcln->pr($row['name'])." has joined <br/>";
                }
            }
        }
        $users->data_seek(0);
    }

    function isPersonInThisDate($date, $dates) {
        $dates = explode(",", $dates);
        foreach ($dates as $userDate) {
            if ($date == $userDate){
                return TRUE;
            }
        }
        return FALSE;
    }

}