<div class="remove_but">
	<form id="remove_from_poll_button" class="forms" action="" method="post">
		<input type="submit" value="delete me from poll">
		<input type="hidden" name="poll_id" value="<?php echo app_controller::$poll_id; ?>">
        <input type="hidden" name="post_type" value="delete">
	</form>
</div>