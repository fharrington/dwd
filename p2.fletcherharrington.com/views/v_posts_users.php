<div id='posts'>
<div id='postsinside'>
<form method='POST' action='/posts/p_follow'>
	
	<?foreach($users as $user): ?>
		
		<!--list users firstname lastname -->
		<ul><li><?=$user['first_name'];?> <?=$user['last_name'];?>
		
		<!--if users is followed, show unfollow link -->
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id'];?>'>Unfollow</a></li></ul>
		<!--else show the follow link -->
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a></li></ul>
		<? endif; ?>
	<? endforeach; ?>

</form>
</div>
</div>