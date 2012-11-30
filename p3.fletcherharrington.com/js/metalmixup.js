$(document).ready(function() { // start doc ready; do not delete this!




  // Create the pile of tiles
  var numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
  var colors = [];
  numbers.sort( function() { return Math.random() - .5 } );
 
  for ( var i=0; i<10; i++ ) {
    $('<div></div>').data( 'number', numbers[i] ).attr( 'id', 'tile'+numbers[i] ).attr('class', 'acceptable').appendTo( '#tile-area' ).draggable( {
      containment: '#content',
      stack: '#tile-area',
      cursor: 'move',
      revert: true
    } );
  }
  
  //style the #tile[i] divs
  
  for (var i=0; i<=10; i++) {
	$('#tile' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left");
	}
 
 
  // Create the tile slots
  var words = [ 'red', 'green', 'blue', 'brown', 'yellow', 'purple', 'orange', 'pink', 'gray', 'white' ];
  for ( var i=1; i<=5; i++ ) {
    $('<div>?</div>').attr('id', 'tileDrop'+[i]).data( 'number', i ).appendTo( '#player' ).droppable( {
      accept: ".acceptable",
      hoverClass: 'hovered',
      drop: controlTileDrop
    } );
  }
 
 
 
  //style the #tileDrop[i] divs
  
  for (var i=0; i<=10; i++) {
	$('#tileDrop' + [i]).css('width', "80px").css('height', "80px").css('border', "1px solid").css('margin', "5px").css('float', "left");
	}

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
  
  
  	var audio_titles = Array('audio1', 'audio2', 'audio3', 'audio4', 'audio5', 'audio6');
	
	//single tile player
	
	$("#tile1").click(function () {
		$("#audio1")[0].play();
		$(this).effect("highlight", {color: "#FFFDFD"}, 3300);
		});
		
	$("#tile2").click(function () {
		$("#audio2")[0].play();
		$(this).effect("highlight", {color: "#F46FFF"}, 3300);
		});		
		
	$("#tile3").click(function () {
		$("#audio3")[0].play();
		$(this).effect("highlight", {color: "#2FAF1F"}, 3300);
		});
		
	$("#tile4").click(function () {
		$("#audio4")[0].play();
		$(this).effect("highlight", {color: "#F3FBFD"}, 3300);
		});
		
	$("#tile5").click(function () {
		$("#audio5")[0].play();
		$(this).effect("highlight", {color: "#FBC8F4"}, 3300);
		});
		
	$("#tile6").click(function () {
		$("#audio6")[0].play();
		$(this).effect("highlight", {color: "#A3F3BF"}, 3300);
		});


		
	
	
	

	









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
	
	
	function play_sound_queue(sounds){

    var i = 0;
    function recursive_play()
    {
      //If the index is the last of the table, play the sound
      //without running a callback after       
      if(index+1 === sounds.length)
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
