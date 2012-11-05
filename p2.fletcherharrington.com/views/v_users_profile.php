<div class='content'>
<h2>
Welcome to Saysomething <? echo " ". $user->first_name . " "?> you can use the menu on the left to see posts and change who you follow.
</h2>
<br>
<div class='error'><? if($streamerror) { echo "Please follow someone to use your stream!"; } ?></div>
</div>

