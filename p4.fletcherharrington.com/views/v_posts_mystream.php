<div id="title"><h2>Posts from people i'm following</h2></div>
<div id="posts">
<div class="postsinside">
<? foreach($posts as $key => $post): ?>

	<h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>
	<?=$post['content']?>
	<? $audiofile = $post['file']; ?>
	<? if ($audiofile != "") {
		echo "<br><audio controls><source src=\"../../uploads/" . $post['file'] . ".mp3\"></source>Browsernotsupportsound</audio>";
	}
	?>

	
<? endforeach; ?>
</div>
</div>
