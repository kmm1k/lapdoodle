<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 12:47
 */

namespace Lapdoodle;

class printing_printoutpolls {

    function printPoll($data) {
        //echo "polls: <br/>";
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $table_id = app_controller::$strcln->pr($row['table_id']);
                $name = app_controller::$strcln->pr($row['name']);
                $id = app_controller::$strcln->pr($row['url']);
                echo '<form class="change_poll_button col-md-4" class="forms" action="" method="POST">
                        <input type="hidden" name="poll_id" value="'.$id.'">
                        <input type="submit" class="customButton" name="isbutton" value="'.$table_id.'">
                    </form>';
            }
        }
        $data->data_seek(0);
    }

}