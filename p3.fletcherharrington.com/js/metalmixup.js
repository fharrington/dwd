$(document).ready(function() { // start doc ready; do not delete this!
	
	var SoundTiles = {
		
		playbutton: 0,
		var TileArray[],
		tile_count: 5;
		
		create_tiles function(tile_count) {
		
			for(var i = 0, i > tile_count, i ++) {
				
				tilestring = "<div class = "tile-sound">"
				
		
		}
	
	}


	var audio = $("audio[title][title=sound1]")[0];
	var audio2 = $("audio[title][title=sound2]")[0];

	
	$(".tile-red").click(function() {
	audio.play();
	});
	
	$(".tile-orange").click(function() {
	audio2.play();
	});
	
	$(".tile-red").draggable();
	
	$(".tile-orange").draggable();
	$(".tile-brown").draggable();	
	$(".tile-yellow").draggable();	
	$(".tile-blue").draggable( {
		snap: '.tile-drop',
		containment: '#content',
		helper: myHelper
		
	});
	
	function myHelper( event ) {
	return '<div id="draggableHelper">I am a helper - drag me!</div>';
}
	
	
}); // end doc ready; do not delete this!

