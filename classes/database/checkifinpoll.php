<?php

namespace Lapdoodle;

class database_checkifinpoll{
	function inPoll($email, $poll_id, $db){
		$query="SELECT * FROM $poll_id WHERE email='$email'";
		$table_info = $db->query($query);
		$numrows = $table_info->num_rows;
		if ($numrows>0) {
			return true;
		} else {
			return false;
		}
	}
}
?>