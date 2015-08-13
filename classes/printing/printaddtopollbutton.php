<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:25
 */

namespace Lapdoodle;


class printing_printaddtopollbutton {

    public function __construct() {
        ?>
        <form id="add_to_poll_button" class="forms" action="" method="post">
            <input id="dates" type="hidden" name="dates" value="">
            <input type="submit" class="customButton" value="add me to poll" >
            <input type="hidden" name="poll_id" value ="<?php echo app_controller::$poll_id; ?>">
            <input type="hidden" name="post_type" value="add">
        </form>
        <?php
    }

}