$(document).ready(function() { // start doc ready; do not delete this!



	var audio = $("audio[title][title=sound1]")[0];
	var audio2 = $("audio[title][title=sound2]")[0];

	
	$(".tile-red").click(function() {
	audio.play();
	});
	
	$(".tile-orange").click(function() {
	audio2.play();
	});


}); // end doc ready; do not delete this!

