<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 15:02
 */

namespace Lapdoodle;

class app_makenewpoll {

    private $doQuery;
    private $fineDates = "";

    public function __construct() {
        $checker = new security_checksp();
        if ($checker->CheckPostSession('pollname')) {
            $this->doQuery = new database_doquery();
            $this->makeNew();
        }
    }

    private function makeNew() {
        if (isset($_POST['with_dates'])) {
            $withDates = 1;
            $this->parseDateOptions($withDates);
        } else if (isset($_POST['with_custom'])) {
            $withDates = 2;
            $this->parseCustomOptions($withDates);
        } else {
            $withDates = 0;
            $this->makeQuery($withDates);
        }
    }

    /** TODO: koodikordus fixida */
    private function parseCustomOptions($withDates) {
        if (empty($_POST['doodle_custom'])) {
            app_controller::$err->add('post_empty_doodleCustom');
            return;
        }
        $fineDates = "";
        $custom_strings = $_POST['doodle_custom'];
        //exit(print_r($custom_strings));
        $custom_array = json_decode($custom_strings);
        //exit(print_r($custom_array));
        $pollname = app_controller::$strcln->esc($_POST['pollname']);
        $email = app_controller::$strcln->esc($_SESSION[SESSION_EMAIL]);
        $name = app_controller::$strcln->esc($_SESSION[SESSION_NAME]);
        $url = $this->makeUrl();
        $pollStructure = Array();
        $sPollStructure = serialize($pollStructure);
        $sCustom = app_controller::$strcln->esc(serialize($custom_array));
        $query = "insert into tables (table_id, email,
             name, url, with_dates, dates, poll, custom) values
             ('$pollname', '$email', '$name', '$url', '$withDates', '$fineDates', '$sPollStructure', '$sCustom');";
        $this->doQuery->tryQuery($query);
    }

    private function parseDateOptions($withDates) {
        $this->fineDates = "";
        if (empty($_POST['doodle_dates'])) {
            app_controller::$err->add('post_empty_doodleDates');
            return;
        }
        $date_string = app_controller::$strcln->esc($_POST['doodle_dates']);
        //exit($date_string);
        $date_array = explode(",", $date_string);
        //exit(print_r($date_array));
        $this->fineDates = "";
        $date_array_count = count($date_array);
        $date_array_counter = 0;
        foreach ($date_array as $date){
            $date_array_counter++;
            if (!($parsed_date = date_parse($date))) {
				app_controller::$err->add('date_parser_failed');
				return;
			}
            $this->fineDates .= $parsed_date['day']."."
                .$parsed_date['month']."."
                .$parsed_date['year'];
            if ($date_array_count === $date_array_counter) {
            } else {
                $this->fineDates .= ",";
            }
        }
        $this->makeQuery($withDates);
    }

    private function makeQuery($withDates) {
        $pollname = app_controller::$strcln->esc($_POST['pollname']);
        $email = app_controller::$strcln->esc($_SESSION[SESSION_EMAIL]);
        $name = app_controller::$strcln->esc($_SESSION[SESSION_NAME]);
        $url = $this->makeUrl();
        $withDates = app_controller::$strcln->esc($withDates);
        $fineDates = app_controller::$strcln->esc($this->fineDates);
        $pollStructure = Array();
        $sPollStructure = serialize($pollStructure);
        $query = "insert into tables (table_id, email,
             name, url, with_dates, dates, poll) values
             ('$pollname', '$email', '$name', '$url', '$withDates', '$fineDates', '$sPollStructure');";

        $this->doQuery->tryQuery($query);
    }

    private function makeUrl() {
        $url = "poll_";
        $hash = hash('sha256', uniqid());
        $url .= substr($hash, 5);
        app_controller::$poll_id = $url;
        return $url;
    }

    public static function getPollId() {
        return app_controller::$poll_id;
    }

}