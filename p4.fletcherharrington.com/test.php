<?php
		$new_token = "null";
		@setcookie("token", $new_token, time()+3600, '/');
		
		if (isset($_COOKIE['token'])) {
		echo 'it worked';
		} else { 
		echo 'nice try';
		}
?>
