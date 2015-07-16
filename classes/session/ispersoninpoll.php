<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 14:15
 */

namespace Lapdoodle;

class session_ispersoninpoll {

    function isInPoll($data, $creds) {
        $count = count($data);
        if ($count > 0) {
            foreach ($data as $user) {
                if ($user['email'] === $creds) return TRUE;
            }
        } else {
            return FALSE;
        }
    }

}