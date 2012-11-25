$(document).ready(function() { // start doc ready; do not delete this!

	
	var audio_title_array = new Array("audio[title][title=sound1]", "audio[title][title=sound2]", "audio[title][title=sound3]");
	var length = audio_title_array.length;
	
	

	//make them play sequentially
		$(".blue").click(function() {
		for (var i=0; i <  length; i++)	{	
				
				
				console.log(length-1);
				console.log(i);
				console.log(audio_title_array[i]);

		}
	});
	
	
	
	var audio1 = $("audio[title][title=sound1]")[0];
	var audio2 = $("audio[title][title=sound2]")[0];

	
	//single tile player
	
	$(".red").click(function() {
		audio1.play();		
	});
	
	$(".orange").click(function() {
	audio2.play();
	});
	
	
	//multi-tile player
	
	function playNext () {
		console.log("testing");
		}
	
	$("audio[title=sound1]").on("ended", playNext);
	
	


	

	
	$(".tile, .red").draggable();
	
	$(".tile, .orange").draggable();
	$(".tile, .brown").draggable();	
	$(".tile, .yellow").draggable();	
	$(".tile").draggable( {
		snap: '.tile-drop',
		containment: '#content',
		helper: myHelper
		
	});
	
	function myHelper( event ) {
	return '<div id="draggableHelper">I am a helper - drag me!</div>';
}
	
	
});
