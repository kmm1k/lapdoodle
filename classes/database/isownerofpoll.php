<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 08.07.2015
 * Time: 11:58
 */


namespace Lapdoodle;

class database_isownerofpoll {

    public function __construct() {

    }

    public function checkOwner($email) {
        if ($email == $_SESSION[SESSION_EMAIL]) {
            return true;
        }
        return false;
    }

}