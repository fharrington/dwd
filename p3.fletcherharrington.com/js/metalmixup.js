$(document).ready(function() { // start doc ready; do not delete this!
	
	/*var SoundTiles = {
		
		playbutton: 0,
		var TileArray[],
		tile_count: 5;
		
		create_tiles function(tile_count) {
		
			for(var i = 0, i > tile_count, i ++) {
				
				tilestring = "<div class = "tile-sound">"
				
		
		}
	
	} */
	
	var audio_title_array = new Array("audio[title][title=sound1]", "audio[title][title=sound2]", "audio[title][title=sound3]");
	var length = audio_title_array.length;
	
	
	
	function playSound () {
			aud.play();
	}
	
		$(".tile-blue").click(function() {
		for (var i=0; i <  audio_title_array.length; i++)	{
				console.log(audio_title_array[0]);
				if (i=0) {
				var a1 = $(audio_title_array[0])[0];
				a1.play;
				} else {
				var a2=$(audio_title_array[i])[0];
				$(audio_title_array[i-1]).on("ended", function(){ $(a2).play(); });
				
			}
		
		}
	});
	
	
	//console.log();
	
	
	var audio1 = $("audio[title][title=sound1]")[0];
	var audio2 = $("audio[title][title=sound2]")[0];

	
	//single tile player
	
	$(".tile-red").click(function() {
		audio1.play();		
	});
	
	$(".tile-orange").click(function() {
	audio2.play();
	});
	
	
	//multi-tile player
	
	//$("audio[title=sound1]").on("ended",function(){ $("audio[title=sound2]")[0].play(); });
	
	


	

	
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
	
	
});
