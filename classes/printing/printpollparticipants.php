<?php
/**
 * Created by PhpStorm.
 * User: kmmii
 * Date: 04.07.2015
 * Time: 13:38
 */

namespace Lapdoodle;


class printing_printpollparticipants {

    function printParticipants($strcln, $data) {

        echo "People joined: <br/><br/>";

        if ($data->num_rows > 0) {
            while($row = $data->fetch_assoc()) {
                echo $strcln->pr($row["name"]). " - date joined: "
                    .$strcln->pr($row["reg_date"])."<br/>";
            }
        } else {
            echo "no one has joined";
        }
    }

}