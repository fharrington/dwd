<div class='content'>
<h2>
Welcome to Saysomething <? echo " ". $user->first_name . " "?> you can use the menu on the left to see posts and change who you follow.
</h2>
<br>
<div class='error'><? if($streamerror) { echo "Please follow someone to use your stream!"; } ?></div>
<div class='error'><? if ($mypostserror) { echo "Add some posts to see them in your profile!"; }?></div>
<div id='titleinside'>My Posts</div>
<div id='myposts'>
<div class='postsinside'>
<? foreach($myposts as $key => $post): ?>
	
	<h3><?=$post['first_name']?> <?=$post['last_name']?> posted:</h3>
	<?=$post['content']?>
	<br>
	
<? endforeach; ?>
</div>
</div>
</div>