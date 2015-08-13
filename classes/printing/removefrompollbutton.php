<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:29
 */

namespace Lapdoodle;


class printing_removefrompollbutton {

    public function __construct(){
        ?>
        <div class="remove_but">
            <form id="remove_from_poll_button" class="forms" action="" method="post">
                <input type="submit" class="customButton" value="delete me from poll">
                <input type="hidden" name="poll_id" value="<?php echo app_controller::$poll_id; ?>">
                <input type="hidden" name="post_type" value="delete">
            </form>
        </div>
        <?php
    }

}