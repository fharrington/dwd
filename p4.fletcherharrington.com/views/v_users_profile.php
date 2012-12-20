<div class='content'>
<h2>
Welcome to SoundLoft <? echo " ". $user->first_name . " "?> you can use the menu on the left to see posts and change who you follow.
</h2>
<br>
<div class='error'><? if($streamerror) { echo "Please follow someone to use your stream!"; } ?></div>
<div class='error'><? if ($mypostserror) { echo "Add some posts to see them in your profile!"; }?></div>
<? if (!$noposts):?>
<div id='titleinside'>My Posts</div>
<div id='myposts'>
<div class='postsinside'>
<? foreach($myposts as $key => $post): ?>
	
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
<div id='titleinside'>My Sound Vault</div>
<div class='uploads'>
	<ul>
	<? foreach ($files as $name) {
	echo "<li>" 
		. $name['file'] . 
		"<audio preload=\"auto\" id = \"><source src=\"../../uploads/" 
		. $name['file'] . 
		".mp3\"></source>Browsernotsupportsound</audio></li><br>";
	}
	?>
	</ul>
</div>

</div>
<? endif; ?>