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
        <div class="page-header">
            <h1><?php echo $heading ?>
                <small>made by:<?php echo $name ?></small>
            </h1>
        </div>

        <?php
    }

}