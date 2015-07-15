<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:33
 */

namespace Lapdoodle;


class printing_printpollinfo {

    public function __construct($poll) {
        $heading = app_controller::$strcln->pr($poll['table_id']);
        $name = app_controller::$strcln->pr($poll['name']);
        ?>
        <p>event name:<?php echo $heading ?></p>
        <p>made by:<?php echo $name ?></p>
        <?php
    }

}