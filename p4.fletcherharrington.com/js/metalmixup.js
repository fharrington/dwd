$(document).ready(function() { // start doc ready; do not delete this!


  // Create the pile of tiles randomly arranged
  var numbers = [1, 2, 3, 4, 5, 6];
  var colors = [];
  numbers.sort( function() { return Math.random() - .5 } );
 
  for ( var i=0; i<6; i++ ) {
    $('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'tile'+numbers[i] ).attr('class', 'acceptable').appendTo( '#tile-area' ).draggable( {
      containment: '#content',
      stack: '#tile-area div',
      cursor: 'move',
      revert: true
    } );
  }
  
  
  //style the #tile[i] divs with javascript generated inline css (change to external?)
  
  for (var i=0; i<=6; i++) {
	$('#tile' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left").css('background-color', '#FFFFFF');
	}
 
 
  // Create the tile slots able to take a dropped tile snapping it into position
  for ( var i=1; i<=5; i++ ) {
    $("<div></div>").attr('id', 'tileDrop'+[i]).data( 'number', i ).appendTo( '#player' ).droppable( {
      accept: '#tile-area div',
      hoverClass: 'hovered',
      drop: controlTileDrop
    } );	
  }

	currTile = "";
	currSlot = "";
	tileNumber = "";
	
	//array with slot/number
	droplocation = "";
	
 	//make tiles snap into top area properly
	//report tile number and it's current slot
	function controlTileDrop( event, ui ) {
	  ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
	  ui.draggable.draggable( 'option', 'revert', false );
	  var droplocation = Array();
	  droplocation[currSlot] = tileNumber;
	  var tilePos = $(this).position();
	  var slotPos = ui.draggable.position();
	  
	  
	  tileNumber = ui.draggable.data( 'number' ); 
	  console.log(tileNumber);
	  
	  tileName = ui.draggable.attr('id');
	  console.log(tileName);
	  
	  currSlot = $(this).data('number');
	  console.log(currSlot);


	  
	  //if(tilePos = slotPos) { $(ui.draggable).toggle({ }
	  
	}


	$('#tiledrop1').click(function () { 
    if (typeof(droplocation)!='undefined'){ console.log("location defined") }; });
   
   
  //style the #tileDrop[i] divs
  
  for (var i=0; i<=5; i++) {
	$('#tileDrop' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left");
	}
	
	
	$('#tile4').click(function () { console.log(droplocation) });
		
	//single tile players - rewrite to use path/file method used in recursive player
	
	//experimenting with recursive style function for singles-------
	$("#tile1").click(play1).click(highlight);
		
		function highlight (){
		$(this).effect("highlight", {color: "#556270"}, 3300);
		};
	
	// -------
	
	
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


		

	//play sequentially, allow for a callback, if no callback, plays only once
	
	function play(audio, callback) {

	  audio.play();

	  if(callback)
	  {
		  //When the audio object completes it's playback, call the callback
		  //provided      
		  $(audio).on('ended', callback);
	  }
	}
	
	

	//plays "sounds" (sound path/file) passed in, used in function play_all, if no callback must be last file -> stop play
	
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
		
	
	//calls 'play_sound_queue' (and thereby 'play') on given audio files.
	
	function play_all(){
		play_sound_queue([new Audio("audio/sound1.ogg"), new Audio("audio/sound2.ogg"), new Audio("audio/sound3.ogg")])
	}
	
	function play1(){
		play_sound_queue([new Audio("audio/sound1.ogg")]);
		}

	//trigger play_all
	$("#playbutton").click(play_all);

		
		

// start OLD code below, keeping in case needed for reference.		
		
		
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
