
<?php


echo "<h1> Blog </h1>";

echo "<P>TO DELETE FULL BLOG PRESS ON BUCKET IMG  &#8594 &#8594 </P><a href='delete.php'><img src='css/Delete-Bin-Trash-PNG-Free-Download.png'  width='50px'  height='50px'></a><br>";

$file = fopen('text.txt',"r") or die('unable to open file');
while(!feof($file)) {
    $hassan = fgets($file);
    echo $hassan."<br>";
}


fclose($file);
?>
