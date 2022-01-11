<?php

$server = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbname = "ntidb";

$conn = mysqli_connect($server,$dbUser,$dbPassword,$dbname);

if ($conn)
    $Message= "connected";
else
    $Message = "error: ".mysqli_connect_error();

$_SESSION['Message'] = $Message;
?>
