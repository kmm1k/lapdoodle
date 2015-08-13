<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 28.07.2015
 * Time: 13:52
 */

namespace Lapdoodle;


class printing_printconfirmbutton {

    function __construct() {
        ?>
            <input type="submit" class="customButton"  value="confirm changes" >
            <input type="hidden" name="poll_id" value ="<?php echo app_controller::$poll_id; ?>">
            <input type="hidden" name="post_type" value="confirm_poll">
        <?php
    }

}