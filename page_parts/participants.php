<?php
include_once("error_reporting.php");
include_once(FOLDER."/classes/database/Connect.php");
$connect = new database_connect();
$connection = $connect->connect();

$query="SELECT * FROM $poll_id";
$table_info = $connection->query($query);
$numrows = $table_info->num_rows;
$isInPoll = 0;
echo "People joined: <br/><br/>";
if($info=mysqli_fetch_array($connection->query($query))){
    while ($row = $table_info->fetch_row()) {
        echo $row[1];
		if(isset($_SESSION[SESSION_EMAIL])){
			if($row[2]===$_SESSION[SESSION_EMAIL]){
				$isInPoll = 1;
				include(FOLDER."/page_parts/remove_from_poll_button.php");
			}	
		}
		?>
		<br/>
		<?php
    }
    $table_info->close();
}
?>