<!DOCTYPE html>

<head>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="/css/users.css">


<script type='text/javascript'>

$(document).ready(function() { // start doc ready; do not delete this!

	$('.full-circle').click(function() {
	  $('.full-circle').animate({
		opacity: 0.25,
		left: '+=50',
		height: 'toggle'
	  }, 5000, function() {
		// Animation complete.
	  });
	});



}); // end doc ready; do not delete this!

</script>

</head>
<body>
<div id = "wrap">
	<div id = "page">
		<div class = "content">
			<div class = "full-circle">
			</div>




		
		</div>
	</div>
</div>
</body>
</html>