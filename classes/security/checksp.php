<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 16:28
 */

namespace Lapdoodle;

class security_checksp {

    public function CheckPostSession($parameter) {
        if (isset($_SESSION[SESSION_NAME]) && isset($_SESSION[SESSION_EMAIL])) {
            if (isset($_POST[$parameter]) && $_POST[$parameter]!="") {
                return true;
            } else {
                app_controller::$err->add('no_'.$parameter.'_input');
                return false;
            }
        } else {
            app_controller::$err->add('no_session');
            return false;
        }
    }

}