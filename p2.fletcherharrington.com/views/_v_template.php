<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/users.css">
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<!--<?php echo @$client_files; ?>-->
	
</head>


<body>	


<div id='wrap'>
<div id='page'>
	<div id='header'>

		<div id='logo'><a href="/"><img src="/image/logo.png"></a></img></div>
	
	
	
		<div id='accountfunctions'>
		<? if(isset($user->user_id) AND strstr($_SERVER['REQUEST_URI'], '/users/profile/')): ?>
			<? foreach($profilenav as $key => $value): ?>
			<ul><li><a href='<?=$value?>'><?=$key?></a></li></ul>
			<? endforeach; ?>
		<? elseif(isset($user->user_id)): ?>
			<? foreach($loggedin as $key => $value): ?>
				<ul><li><a href='<?=$value?>'><?=$key?></a></li></ul>
			<? endforeach; ?>
		<? elseif(!isset($user->user_id)): ?>
			<? foreach($loggedout as $key => $value): ?>
				<ul><li><a href='<?=$value?>'><?=$key?></a></li></ul>
			<? endforeach; ?>
		<? endif; ?>
		</div>
	</div>
	
	<div id='mainnav'>
	<? if(isset($user->user_id)): ?>
		<? foreach($navigation as $key => $value): ?>
			<ul><li><a class='<? if(strstr($_SERVER['REQUEST_URI'], $value)) { echo "active"; } ?>' href='<?=$value?>'><?=$key?></a></li></ul><br>
		<? endforeach; ?>
	<? elseif(!isset($user->user_id)): ?>
		<? foreach($navigationout as $key => $value): ?>
			<ul><li><a class='<? if(strstr($_SERVER['REQUEST_URI'], $value)) { echo "active"; } ?>' href='<?=$value?>'><?=$key?></a></li></ul>
		<? endforeach; ?>
	<? endif; ?>
	</div>
	

	<?=$content;?>
<div class = 'bgpusher'></div>
	
<div class='clear'></div>
</div>
</div>


</body>
</html>