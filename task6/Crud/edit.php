<?php

require 'dbConnection.php';
include 'allfunctions.php';

$id = $_GET['id'];


$sql = "select * from blog where id = $id ";
$data = mysqli_query($conn, $sql);

if (mysqli_num_rows($data) == 1) {
    # fetch data
    $blog = mysqli_fetch_assoc($data);
} else {
    $Message = 'Invalid Id ';
    $_SESSION['Message'] = $Message;
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = clean_data($_POST['title']);
    $content = clean_data($_POST['content']);
    $date = clean_data($_POST['date']);
    $imgName = clean_data($_FILES['image']['name']);
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];
    $errors = [];

    $errors = data_validate($title, $content, $date, $errors);

    $errors = image_validate($imgName, $imgTempPath, $imgSize, $imgType, $errors);

    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            # code...
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        $finalImgName= $_SESSION['finalImgName'];
        $sql = "update blog set title='$title' , content = '$content', date = '$date', image = '$finalImgName' where id  = $id";
        $op = mysqli_query($conn, $sql);
        if ($op) {
            $Message = "Raw Updated";
        } else {
            $Message = "Error Try Again " . mysqli_error($conn);
        }
        $_SESSION['Message'] = $Message;
        header("Location: index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <h2>Update</h2>

    <form action="edit.php?id=<?php echo $blog['id']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" id="exampleInputName" name="title"
                   value="<?php echo $blog['title']; ?>"
                   aria-describedby="">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name="content"
                   value="<?php echo $blog['content']; ?>">
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date"
                   value="<?php echo $blog['date']; ?>">
        </div>

        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image"">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>


</body>

</html>
