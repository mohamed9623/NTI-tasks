<?php
require 'dbConnection.php';
$id = $_GET['id'];
$sql = "select * from blog where id = $id ";
$data = mysqli_query($conn, $sql);

if (mysqli_num_rows($data) == 1) {
    # delete op
    $sql = "delete from blog where id = $id";
    $op = mysqli_query($conn, $sql);
    if ($op) {
        $Message = "Raw Deleted";
    } else {
        $Message = 'Error try Again';
    }
} else {
    $Message = "Invalid Id ";
}

$_SESSION['Message'] = $Message;

header("location: index.php");
