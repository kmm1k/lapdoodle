<?php

namespace Lapdoodle;

class security_sqlinj {

	public function esc($string) {
        $cleanedString = app_controller::$db->real_escape_string($string);
		return $cleanedString;
	}

    public function pr($string) {
        return htmlspecialchars($string);
    }

}
?>