<!DOCTYPE HTML>
<html lang='eng'>
<head>
  <meta charset="utf-8">  
  <title>Template</title>  
  <meta name="description" content="template">  
  <meta name="author" content="html/php">  
  <link rel="stylesheet" href="css/style.css">
<?
date_default_timezone_set('America/New_York');
$day = date("l");
?>  



<?

$rnum = rand(0, 9);
$numlet = rand(0, 1);

if ($numlet = 0){
$r = randletter(); }
else {
$r = rand(0,1);
}

function randLetter()
{
    $int = rand(0,5);
    $A_F = "ABCDEF";
    $rand_letter = $A_F[$int];
    return $rand_letter;
}


$boxes = "";
for($i = 1; $i <= 10; $i++) {
$r = randletter().randletter().randletter().randletter().randletter().randletter();
$width = rand(2, 100);
$height = rand(2, 100);
$margint = rand(2, 100);
$marginl = rand(2, 100);
$boxes = $boxes."<div style='width:{$width}px; height:{$height}px; float:left; margin-top:{$margint}px; margin-left:{$marginl}px; background-color:#{$r};></div>";
usleep(200000);
}

?>
</head>
<?
echo $boxes;
?>


<body>
</body>
</html>