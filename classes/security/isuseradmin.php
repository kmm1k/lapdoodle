<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 10.07.2015
 * Time: 14:14
 */

namespace Lapdoodle;

class security_isuseradmin {

    public function isAdmin() {
        if ($_SESSION[SESSION_ADMIN]===ADMIN_DECLARATION){
            return true;
        }
        return false;
    }

}