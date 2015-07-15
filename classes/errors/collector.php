<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 13.07.2015
 * Time: 12:30
 */

namespace Lapdoodle;

class errors_collector {

    private static $arr;

    public function __construct() {

    }

    public function getErr() {

    }

    public function add($id) {
        array_push($this->arr, $id);
    }

    public function translate($array) {
        /* TODO: Switch to translate error ids */
        foreach ($array as $error) {
            echo $error;
            $data = explode('_', $error);
            print_r($data);
            exit();
        }
    }

    public function printErrors() {
    }
}