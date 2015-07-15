<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 13.07.2015
 * Time: 12:30
 */

namespace Lapdoodle;

class errors_collector {

    private static $arr = array();

    public function __construct() {

    }

    public function getErr() {

    }

    public function add($id) {
        array_push(errors_collector::$arr, $id);
        //$this->translate();
    }

    public function translate() {
        /* TODO: Switch to translate error ids */
        foreach (errors_collector::$arr as $error) {
            echo $error;
            $data = explode('_', $error);
            print_r($data);
        }
    }
    public function getErrors() {
        return errors_collector::$arr;
    }
}