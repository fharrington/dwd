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
	
	<audio preload='auto' title='sound1'>
	<source src="audio/sound1.wav"></source>
	Browser!supportsound
	</audio>	
	
	
	<audio preload='auto' title='sound2'>
	<source src="audio/sound2.wav"></source>
	Browser!supportsound
	</audio>
	
	<audio preload='auto' title='sound3'>
	<source src="audio/sound3.wav"></source>
	Browser!supportsound
	</audio>
	
	<h1>Metal Mix Up</h1>
	<div class = "content">
		<div id = "player">
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>
			<div class = "tile-drop"></div>		
		</div>
		
		<div id = "tile-area">
			<div class = "tile red"></div>
			<div class = "tile orange"></div>
			<div class = "tile brown"></div>
			<div class = "tile yellow"></div>
			<div class = "tile blue"></div>
		</div>
	</div>
	
</div>
</div>

</body>
</html>