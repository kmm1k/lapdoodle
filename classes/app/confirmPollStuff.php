<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 28.07.2015
 * Time: 14:37
 */

namespace Lapdoodle;


class app_confirmPollStuff {

    function __construct() {
        //echo "some thing ";
        $poll_id = app_controller::$strcln->esc($_POST['poll_id']);
        $pollDataGetter = new database_selectpolldata();
        $poll = $pollDataGetter->selectPollData($poll_id);
        if (!$poll) {
            return;
        }
        $options = unserialize($poll['custom']);
        $count = 0;
        $newOptions = Array();
        foreach ($options as $option) {
            $cleanOptions = app_controller::$strcln->esc($_POST['option'.$count]);
            if ($cleanOptions != "") {
                array_push($newOptions, $cleanOptions);
            }
            $count++;
        }
        if (isset($_POST['option'.$count])){
            $cleanOptions = app_controller::$strcln->esc($_POST['option'.$count]);
            if ($cleanOptions != "") {
                array_push($newOptions, $cleanOptions);
            }
        }
        $sNewOptions = serialize($newOptions);
        //exit(print_r($newOptions));
        $doQuery = new database_doquery();
        $sql = "UPDATE tables SET custom='$sNewOptions' WHERE url='$poll_id'";
        $doQuery->tryQuery($sql);


        $users = unserialize($poll['poll']);
        $colCount = count($options);
        $rowCount = 0;
        foreach ($users as $user) {
            $rowCount++;
            $userCount = 0;
            $inPoll = false;
            foreach ($users as $user) {
                $userCount++;
                if (isset($_POST['user_'.$userCount])) {
                    $delUserValue = app_controller::$strcln->esc($_POST['user_' . $userCount]);
                    if ($delUserValue === $user['email']) {
                        $inPoll = true;
                        break;
                    }
                }
            }
            if($inPoll === true) {
                unset($users[$user['email']]);
                continue;
            }
            $newArray = Array();
            for ($i = 1; $i <= $colCount; $i++) {
                if (isset($_POST['usr_'.$rowCount.'_'.$i])) {
                    array_push($newArray, $_POST['usr_'.$rowCount.'_'.$i]);
                }
            }
            $users[$user['email']][0] = $newArray;
            //array_replace($user[0], $newArray);
        }

        $sChoices = serialize($users);
        $sql = "UPDATE tables SET poll='$sChoices' WHERE url='$poll_id'";
        $doQuery->tryQuery($sql);

        /*
        $options = unserialize($poll['custom']);
        $optionsCount = count($options);
        $count = 0;
        $data = Array();
        foreach ($options as $option) {
            $count++;
            for ($i = 0; $i < $optionsCount; $i++) {
                $item = $_POST['usr_'.$count.'_'.$i];
                array_push($data, $item);
            }
        }
        exit(print_r($data));
        */
    }

}