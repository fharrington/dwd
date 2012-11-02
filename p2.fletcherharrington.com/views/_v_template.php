<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
</head>


<body>	
	
	<? if(isset($_user) AND isset($loggedin)): ?>
		<? foreach($loggedin as $key => $value): ?>
			<ul><li><a href='<?=$value?>'><?=$key?></a></li></ul>
		<? endforeach; ?>
	<? elseif(!isset($_user) AND isset($loggedout)): ?>
		<? foreach($loggedout as $key => $value): ?>
			<ul><li><a href='<?=$value?>'><?=$key?></a></li></ul><br>
		<? endforeach; ?>
	<? endif; ?>
	
	<? if(isset($_user) AND isset($navigation)): ?>
		<? foreach($navigation as $key => $value): ?>
			<ul><li><a class='<? if(strstr($_SERVER['REQUEST_URI'], $value)) echo "active" ?>' href='<?=$value?>'><?=$key?></a></li></ul><br>
		<? endforeach; ?>
	<? elseif(!isset($_user) AND isset($navigationout)): ?>
		<? foreach($navigationout as $key => $value): ?>
			<ul><li><a class='<? if(strstr($_SERVER['REQUEST_URI'], $value)) echo "active" ?>' href='<?=$value?>'><?=$key?></a></li></ul><br>
		<? endforeach; ?>
	<? endif; ?>
	
	<?=$logout;?>

	<?=$content;?>

</body>
</html>