<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 15.07.2015
 * Time: 13:36
 */

namespace Lapdoodle;


class printing_pollform {

    public function __construct() {
        ?>
        <form id="make_new_poll_button" class="forms" activity="" method="post">
            <input type="text" rows="5" class="col-xs-12" placeholder="Enter your poll question here!"
                   name="pollname" size="45">
            <div class="col-xs-12">
            <?php
            if (POLLS_WITH_DATES) {
                ?>
                doodle with dates?
                <input type="checkbox" name="with_dates" id="doodle_checkbox" data-switch-somestuff>
                <?php
            }
            if (POLLS_WITH_CUSTOM_DATA) {
                ?>
                doodle with custom data?
                <input type="checkbox" name="with_custom" id="custom_checkbox">
                <?php
            }
            ?>
            </div>
            <input type="submit"  class="customButton" value="Make new poll" ><br/>
            <div class="form-control date dates_poll" ></div>
            <input id="doodle_dates" type="hidden" name="doodle_dates" value="">
            <input id="doodle_custom" type="hidden" name="doodle_custom" value="">
            <input id="make_poll" type="hidden" name="make_poll" value="1">
        </form>
        <?php
    }

}