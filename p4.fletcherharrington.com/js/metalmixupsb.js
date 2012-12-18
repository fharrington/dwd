$(document).ready(function() { // start doc ready; do not delete this!
   
   	/*-------------------------------------------------------------------------------------------------
   	Set up the tile mixer
   	-------------------------------------------------------------------------------------------------*/
	    // Create the pile of tiles randomly arranged (just create 6 for now, should be 10)
	    var numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	
	    // Shuffle numbers
	    numbers.sort(function() {
	        return Math.random() - .5
	    });
	
	    // Generate the tiles
	    // SB: Changed "acceptable" class to "tile"...helped me better understand the pieces
	    for (var i = 0; i < 10; i++) {
	        $('<div>' + (numbers[i]) + '</div>')
	        	.data('number', numbers[i])
	        	.data('file', "audio/sound" + numbers[i] + fileExtension)
	        	.attr('id', 'tile' + numbers[i])
	        	.attr('class', 'tile')
	        	.appendTo('#tile-area')
	        	.draggable({
		            containment: '#content',
		            stack: '#tile-area div',
		            cursor: 'move',
		            revert: true
	        });
	    }
	
	    // SB: Moved tile styling to the ".tile" class in users.css
	
	    // Create the tile slots able to take a dropped tile snapping it into position
	    // SB: Added "slot" class to be stiled in users.css
	    for (var i = 1; i <= 5; i++) {
	        $("<div></div>")
	        .attr('id', 'tileDrop' + [i])
	        .attr('class', 'slot')
	        .data('number', i)
	        .appendTo('#player')
	        .droppable({
	            accept: '#tile-area > *',
	            hoverClass: 'hovered',
	            drop: controlTileDrop,
	            out: controlTileOut,
	        });
	        
	    }

	    // SB: Moved slot styling to the ".slot" class in users.css
    
    
    /*-------------------------------------------------------------------------------------------------
    Global variables
    SB: added "var" to beginning; possible reason they weren't acting globally?
    -------------------------------------------------------------------------------------------------*/
	   
	   	// SB: 
	   	// For testing purposes, I downloaded audio files from dictionary.com of the pronunciation of "one", "two", "three", etc..
	   	// I replaced the metal files with these audio files so I could confirm the right audio files were playing.
	   	// Because the files I got were .mp3s I needed a way to quickly toggle between .ogg and .mp3 so I made it a variable here.
	   	var fileExtension = ".mp3";
	   	
	   	// SB: This is the only other global variable we need. It's an array that keeps track of what tiles are in what slots
	    var dropLocation  = []; // SB: Set this to [] instead of "" so it gets initialized as an array.


    /*-------------------------------------------------------------------------------------------------
    Wire listeners
    -------------------------------------------------------------------------------------------------*/
	    // This is the four little plus signs on the top left
	    $("#playbutton").click(play_all);
	   
	    $("#tile1").click(function() {
	        playSound(1, "#f10000");
	    });
	    
	    $("#tile2").click(function() {
	        playSound(2, "#ff8915");
	    });
	    
	    $("#tile3").click(function() {
	        playSound(3, "#ffff00");
	    });
	    
	    $("#tile4").click(function() {
	        playSound(4, "#99ff00");
	    });
	    
	    $("#tile5").click(function() {
	        playSound(5, "#00ff00");
	    });
	    
	    $("#tile6").click(function() {
	        playSound(6, "#15a73f");
		});
			
		$("#tile7").click(function() {
	        playSound(7, "#33dddd");
	    });
	    
	    $("#tile8").click(function() {
	        playSound(8, "#3388ff");
		});
		
		$("#tile9").click(function() {
	        playSound(9, "#ac33ff");
		});
		
		$("#tile10").click(function() {
	        playSound(10, "#c11188");
		});

			
			
			
	    
	    
	  


    /*-------------------------------------------------------------------------------------------------
    Functions
    -------------------------------------------------------------------------------------------------*/

    

	  	 /**
	     * controlTileDrop
	     * Triggered any time a tile is dropped
	     * Make tiles snap into top area properly
	     * Report tile number and its current slot
	     */
	    function controlTileDrop(event, ui) {
	        
	        // Snaps tile into place (I think?)
	        ui.draggable.position({
	            of: $(this),
	            my: 'left top',
	            at: 'left top'
	        });
	        
	        ui.draggable.draggable('option', 'revert', false);
	       	       
	       	       		
	       	slotNumber = $(this).data('number');
	       	tileNumber = ui.draggable.data('number');
	       	
	       	// Update the dropLocation global array
	       	dropLocation[slotNumber] = tileNumber; 
	       	console.log(dropLocation);
	    } 
	    
	    
	    /**
		* controlTileOut
		* 
		* 
		*/ 
	    function controlTileOut(event, ui) {
	    
	    	var tileNumber = ui.draggable.data('number');
	    	var slotNumber = $(this).data('number');
	    	
	    	// Update the dropLocation global array
	    	dropLocation[slotNumber] = ""; 
	   	    console.log(dropLocation);
    	}
	
	
	    /**
		* playSound
		* 
		* 
		*/   
	    function playSound(tile_number, this_color) {
		    $("#audio" + tile_number)[0].play();
			var aud = new Audio('audio/sound2.wav');
			aud.preload = true;
			var aud1 = aud.duration;
			console.log(aud1);
		    $("#tile" + tile_number).effect("highlight", {color: this_color}, 3300
			);
	    }
	   	  
 
	    /**
		* play
		* 
		* Play sequentially, allow for a callback, if no callback, plays only once
		*/  
	    function play(audio, callback) {
	
	        audio.play();
	
	        // When the audio object completes it's playback, call the callback    
	        if (callback) {
	            $(audio).on('ended', callback);
	        }
	       	    
	    }
	    
	    
	    /**
		* highlight
		* Effect. Used from playSound and 
		* 
		*/   
	    function highlight() {
	        $(this).effect("highlight", {color: "#556270"}, 3300);
	    };

	

	    /**
		* play_all
		* 
		* 
		*/ 
	    function play_all() {
	    	
	    	var queue = [];
	    	
	    	for (var i in dropLocation) {
	    		if(dropLocation[i] != "") {
		    		queue.push(new Audio("audio/sound" + dropLocation[i] + fileExtension));
		    	}
	    	}
	   
	        play_sound_queue(queue);
	    }
	    
	    
	    /**
		* play_sound_queue
		* 
		* plays "sounds" (sound path/file) passed in, used in function play_all, if no callback must be last file -> stop play
		*/ 
	    function play_sound_queue(sounds) {
			    
	        var i = 0;
	
	        function recursive_play() {
	            // If the index is the last of the table, play the sound
	            // without running a callback after          
	            if (i + 1 === sounds.length) {
	                play(sounds[i], null);
	            }
	            else {
	                // Else, play the sound, and when the playing is complete
	                // increment index by one and play the sound in the indexth position of the array
	                play(sounds[i], function() {
	                    i++;
	                    recursive_play();
	                });
	            }
	        }
	
	        // Call the recursive_play for the first time
	        recursive_play();
	    }
	
	

}); // end doc ready