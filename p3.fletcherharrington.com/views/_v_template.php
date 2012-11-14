<!DOCTYPE html>
<html>
<head>
<title><?=$title?></title>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/metalmixup.js"></script>
<link rel="stylesheet" type="text/css" href="/css/users.css">






</head>
<body>
<div id = "wrap">
	<div id = "page">
	
	<?

	?>

	
	<? $audiofiles = Array("c1.wav", "c2.wav"); ?>
	<? $audiotitles = Array("sound1", "sound2"); ?>

	
	<? /*foreach ($audiofiles as $file)
	echo "<audio preload title='{$file}'>
	<source src="audio/c1.wav"></source>
	Browser!supportsound
	</audio>" */
	?>
	
	<audio preload title='sound1'>
	<source src="audio/c1.wav"></source>
	Browser!supportsound
	</audio>	
	
	<audio preload title='sound2'>
	<source src="audio/c2.wav"></source>
	Browser!supportsound
	</audio>
	
	<h1>Metal Mix Up</h1>
	<div class = "content">
		<div id = "tile-drop-area">
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>		
		</div>
		
		<div id = "tile-area">
			<div class = "tile-red"></div>
			<div class = "tile-orange"></div>
			<div class = "tile-brown"></div>
			<div class = "tile-yellow"></div>
			<div class = "tile-blue"></div>
		</div>
	</div>
	
</div>
</div>

</body>
</html>