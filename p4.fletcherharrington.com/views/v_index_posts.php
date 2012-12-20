<div id='title'><h1>Public Stream</h1></div>
<div id="posts">
<div class='postsinside'>
<? foreach($posts as $key => $post): ?>
	
	<h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>
	<?=$post['content']?>
	<? $audiofile = $post['file']; ?>
	<? if ($audiofile != "") {
		echo "<br><audio controls><source src=\"../../uploads/" . $post['file'] . ".mp3\"></source>Browsernotsupportsound</audio>";
	}
	?>
	<br>
	
<? endforeach; ?>
</div>
</div>