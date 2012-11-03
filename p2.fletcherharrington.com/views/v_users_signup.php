<div class="content">
<form method='POST' action='/users/p_signup'>

First Name <br>
<input type='text' name='first_name'>
<br><br>

Last Name <br>
<input type='text' name='last_name'>
<br><br>

Email <br>
<input type='text' name='email'>
<br><br>

Password <br>
<input type='password' name='password'>
<br><br>

<input type='submit' value="Signup!">

	<? if($error): ?>
		<div class='error'>
			Signup failed. Please make sure all fields are filled out!
		</div>
		<br>
	<? endif; ?>


</form>
</div>
