<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 05.07.2015
 * Time: 12:47
 */
class printing_printoutpolls {

    function printPoll($data) {
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $table_id = app_controller::$strcln->pr($row['table_id']);
                $name = app_controller::$strcln->pr($row['name']);
                $id = app_controller::$strcln->pr($row['url']);
                echo '<form class="change_poll_button" class="forms" action="" method="POST">
                        poll created by: '.$name.'
                        <input type="hidden" name="poll_id" value="'.$id.'">
                        <input type="submit" name="isbutton" value="'.$table_id.'">
                    </form>';
            }
        }
        $data->data_seek(0);
    }

}