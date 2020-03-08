<?php
      function ColorScaleRedGreen($percent){
        if (($percent >= 0) && ($percent < 50)) {
            $red = 225 + round(.4 * $percent);
            $green = 125 + round(1.8 * $percent);
            $blue = 115 - round(.3 * $percent);
       }
       elseif (($percent >= 50) && ($percent <= 100)) {
        $red = 245 - round(1.8 * ($percent-50));
        $green = 215 - round(.3 * ($percent-50));
        $blue = 100 + round(.5 * ($percent-50));
        }
    
    $red=dechex($red);
    $green=dechex($green);
    $blue=dechex($blue);
    $shadecolor = '#'.$red.$green.$blue;
    
    return $shadecolor;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Rainbow Score</title>
  </head>
   <body>
	<div class="container">
     	<h1>Rainbow Score</h1>

	</div>
 <table>
 <tr>
<?php 
for ($x = 0; $x <= 100; $x++) { 
 echo"<td bgcolor=".ColorScaleRedGreen($x).">".$x."<br></td>";
}
?>
 </tr></table>
   </body>
</html>