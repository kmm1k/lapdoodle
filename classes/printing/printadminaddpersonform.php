<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 29.07.2015
 * Time: 9:29
 */

namespace Lapdoodle;


class printing_printadminaddpersonform {

    function __construct()
    {
        ?>
        <form>
            <input type="text" placeholder="full name" name="name">
            <input type="text" placeholder="email/auth" name="email">
            <input type="hidden" name="post_type" value="admin_add_person">
            <input type="hidden" name="poll_id" value="<?php echo app_controller::$poll_id; ?>">
            <input type="submit"  class="customButton"  value="add person to poll">
        </form>
    <?php
    }

}