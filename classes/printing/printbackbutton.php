<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 09.07.2015
 * Time: 9:42
 */

class printing_printbackbutton {

    public function __construct() {
        if (isset($_GET['poll_id'])) {
            echo '<a href="?"><button> back </button></a>';
        } else {
            echo '<form id="go_back_to_polls" class="forms">
                    <input type="submit" value="go back to polls">
                </form>';
        }
    }

}