
<?php



echo "<h1> Blog </h1>";

echo "<P>TO DELETE FULL BLOG PRESS ON BUCKET IMG  &#8594 &#8594 </P><a href='delete.php'><img src='css/Delete-Bin-Trash-PNG-Free-Download.png'  width='50px'  height='50px'></a><br>";

$file = fopen('text.txt',"r") or die('unable to open file');
while(!feof($file)) {
    $hassan = fgets($file);
    echo $hassan."<br>";  
    if (!empty($hassan)) {
        //        echo $l . " <a href='test1.php'>Delete Article</a><br>";
                setcookie('row', $hassan, time() + 86400, '/');
                echo "<P>TO DELETE ONE LINE PRESS ON BUCKET IMG  &#8594 &#8594 </P><a href='delete1.php'><img src='css/PikPng.com_trash-png_471206.png'  width='50px'  height='50px'></a><br>";
            }}


fclose($file);
?>
