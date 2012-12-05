$(document).ready(function() { // start doc ready; do not delete this!


  // Create the pile of tiles
  var numbers = [1, 2, 3, 4, 5, 6];
  var colors = [];
  numbers.sort( function() { return Math.random() - .5 } );
 
  for ( var i=0; i<6; i++ ) {
    $('<div></div>').data( 'number', numbers[i] ).attr( 'id', 'tile'+numbers[i] ).attr('class', 'acceptable').appendTo( '#tile-area' ).draggable( {
      containment: '#content',
      stack: '#tile-area',
      cursor: 'move',
      revert: true
    } );
  }
  
  
  //style the #tile[i] divs
  // SB 12/5: Suggestion: Rather than loop through the ids, you could just give them all the same class and target by that class.
  // Also, since it's not doing anything dynamic with the styles, you could do this straight from your CSS file.
  // Same notes for #tileDrop below
  for (var i=0; i<=6; i++) {
	$('#tile' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left").css('background-color', '#FFFFFF');
	}
 
 
  // Create the tile slots
  for ( var i=1; i<=5; i++ ) {
    $("<div></div>").attr('id', 'tileDrop'+[i]).data( 'number', i ).appendTo( '#player' ).droppable( {
      accept: ".acceptable",
      hoverClass: 'hovered',
      drop: controlTileDrop
    } );
  }
 
 
 
  //style the #tileDrop[i] divs
  
  for (var i=0; i<=5; i++) {
	$('#tileDrop' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left");
	}

	//make tiles snap into top area properly
	function controlTileDrop( event, ui ) {
	  _currSlot = $(this).data('number');
	  _tileNumber = ui.draggable.data( 'number' ); 
	  ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
	  ui.draggable.draggable( 'option', 'revert', false );
  
	}
  
  
 
  
  function test(_tileNumber, _currSlot) {
	$
	_playOrder = Array('','','','','');
	_playOrder[_currSlot] = _tileNumber;
	console.log(_playOrder);
	
	}
	
	$("#playbutton").click(test);
	
  
  
  	var audio_titles = Array('audio1', 'audio2', 'audio3', 'audio4', 'audio5', 'audio6');
	
	//single tile player
	
	$("#tile1").click(function () {
		$("#audio1")[0].play();
		$(this).effect("highlight", {color: "#556270"}, 3300);
		});
		
	$("#tile2").click(function () {
		$("#audio2")[0].play();
		$(this).effect("highlight", {color: "#33CC66"}, 3300);
		});		
		
	$("#tile3").click(function () {
		$("#audio3")[0].play();
		$(this).effect("highlight", {color: "#FFB238"}, 3300);
		});
		
	$("#tile4").click(function () {
		$("#audio4")[0].play();
		$(this).effect("highlight", {color: "#FF7D10"}, 3300);
		});
		
	$("#tile5").click(function () {
		$("#audio5")[0].play();
		$(this).effect("highlight", {color: "#FF005B"}, 3300);
		});
		
	$("#tile6").click(function () {
		$("#audio6")[0].play();
		$(this).effect("highlight", {color: "#49007E"}, 3300);
		});


		
	
	
	/*

	function play_sound_queue(sounds){

		var i = 0;
		function recursive_play()
		{
		  //If the index is the last of the table, play the sound
		  //without running a callback after       
		  if(i+1 === sounds.length)
		  {
			play(sounds[i],null);
		  }
		  else
		  {
			//Else, play the sound, and when the playing is complete
			//increment index by one and play the sound in the 
			//indexth position of the array
			play(sounds[i],function(){i++; 
			recursive_play();});
		}
		}
	}
	*/
	
	
	$("#playbutton").click(play_all);
	
	//function () { $("#audio5")[0].play() });

	//play sequentially
	
	function play(audio, callback) {

	  audio.play();

	  if(callback)
	  {
		  //When the audio object completes it's playback, call the callback
		  //provided      
		  $(audio).on('ended', callback);
	  }
	}
	
	

//Changed the name to better reflect the functionality
	function play_sound_queue(sounds){

		var i = 0;
		function recursive_play()
		{
		  //If the index is the last of the table, play the sound
		  //without running a callback after       
		  if(i+1 === sounds.length)
		  {
			play(sounds[i],null);
		  }
		  else
		  {
			//Else, play the sound, and when the playing is complete
			//increment index by one and play the sound in the 
			//indexth position of the array
			play(sounds[i],function(){i++; recursive_play();});
		  }
		}

	//Call the recursive_play for the first time
	recursive_play();   
	}
		
	
	
	function play_all(){
		play_sound_queue([new Audio("audio/sound1.ogg"), new Audio("audio/sound2.ogg"), new Audio("audio/sound3.ogg")])
		}



/*

	
	var audio_title_array = new Array("audio[title][title=sound1]", "audio[title][title=sound2]", "audio[title][title=sound3]");
	var length = audio_title_array.length;
	
	

	//make them play sequentially
		$(".tile").click(function() {
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
	
	
	function getTileColor {
		$('.tile').click(function() {
			var color = $(this).css('background-color');
			console.log(color);
			
		});
	}
	
	//multi-tile player
	
	function selectNext() {
		console.log("next")
		}
		
	function playNext () {
		console.log("testing");
		}
		
	
	$(".red").click(function() {
	for (i=0; i<length; i++) { 
	console.log(i);
	$(audio_title_array[i]).on("ended", playNext).on("ended", selectNext);
	}
	
	});
	


	

	
	
}
	
*/

});
