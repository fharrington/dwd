<div class='content'>
<form method='POST' action='/posts/p_add'>

	<strong>New Post:</strong><br><br>
	Speak your mind!
	<br>
	<textarea name='content'></textarea>
	<br><br>
	Select a file from your Soundvault to attach to your post. <br> No uploads yet? Go here <a href = "/file/upload/">Uploads</a>
	<br>
	<select name = 'file'>
	<? foreach ($files as $name) {
	echo "<option value =\"" . $name['file'] . "\">"  . $name['file'] . "</option>";
	}
	?>
	</select>
	
	<br><br>
	<input type='submit'>

</form>
</div>