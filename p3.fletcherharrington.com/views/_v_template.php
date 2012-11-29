<!DOCTYPE html>
<html>
<head>
<title><?=$title?></title>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/metalmixup.js"></script>
<link rel="stylesheet" type="text/css" href="/css/users.css">


<!--<script type="text/javascript">
$(document).ready(function() { // start doc ready; do not delete this!


tile_test.aud1.set_tile;


}); // end doc ready; do not delete this!
</script>
-->

</head>
<body>
<div id = "wrap">
	<div id = "page">
	
	<?

	?>

	
	<? $audiofiles = Array("sound1", "sound2", "sound3"); ?>


	
	<? /*foreach ($audiofiles as $file)
	echo "<audio preload title='{$file}'>
	<source src="audio/c1.wav"></source>
	Browser!supportsound
	</audio>" */
	?>
	
	<audio preload="auto" title="sound1" id="audio1">
	<source src="audio/sound1.wav"></source>
	<source src="audio/sound1.ogg"></source>
	<source src="audio/sound1.mp3"></source>
	Browsernotsupportsound
	</audio>	
	
	
	<audio preload='auto' title='sound2' id="audio3>
	<source src="audio/sound2.wav"></source>
	<source src="audio/sound2.ogg"></source>
	<source src="audio/sound2.mp3"></source>
	Browser!supportsound
	</audio>
	
	<audio preload='auto' title='sound3' id="audio3>
	<source src="audio/sound3.wav"></source>
	Browser!supportsound
	</audio>
	
	<h1>Metal Mix Up</h1>
	<div class = "content">

	<div id = "player"></div>
		
	<div id = "tile-area"></div>
	
</div>
</div>

</body>
</html>