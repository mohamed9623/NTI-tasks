<?php

$file = "text.txt";
$data = file($file);
$line = $_COOKIE['row'];

foreach ($data as $key => $l) {
    if (stristr($l, $line) !== false) {
        unset($data[$key]);
        break;
    }
}
$data = array_values($data);

file_put_contents($file, implode($data));
header("Location:profilePage.php");
?>
