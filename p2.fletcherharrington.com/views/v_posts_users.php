<?foreach($users as $key => $user); ?>
	
	<?=$user['first_name'];?> <?=$user['first_name'];?>
	<a href='/posts/follow/<?=$user['user_id'];?>'>Follow</a>
	<a href='/posts/unfollow/<?=$user['user_id'];?>'>Unfollow</a>
	
<? endforeach; ?>