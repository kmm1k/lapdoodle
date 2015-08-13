<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:31
 */

namespace Lapdoodle;


class printing_printdeletebutton {

    public function __construct(){
        ?>
        <form id="remove_poll_button" class="forms" action="" method="post">
            <input type="submit" class="customButton" value="delete this poll" >
            <input type="hidden" name="poll_id" value ="<?php echo app_controller::$poll_id; ?>">
            <input type="hidden" name="post_type" value="delete_poll">
            <input type="hidden" name="del_poll" value="1">
        </form>
        <?php
    }
}