<?php

////function to print the next character of the specific character//////
function charIncrement($char) {
    
 $next_char=++$char;
 if (strlen($next_char) > 1) { 
    $next_char = $next_char[0];
   }
 echo $next_char;
 echo '<br>';
}

charIncrement('a'); // call the function with 'a' character
charIncrement('z'); // call the function with 'z' character

?>