<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 14:15
 */

class session_ispersoninpoll {

    function isInPoll($data, $user) {
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                if ($user === $row["email"]) return TRUE;
            }
        } else {
            return FALSE;
        }
    }

}