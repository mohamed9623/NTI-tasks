<?php
require 'dbConnection.php';
$sql = "select * from blog";
$objData = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="page-header">
        <h1>Read blogs </h1>
        <br>
        <?php
        if (isset($_SESSION['Message'])) {
            echo $_SESSION['Message'];
            unset($_SESSION['Message']);
        }
        ?>
    </div>

    <a href="create.php" class='btn btn-danger m-r-1em'>Add Blog</a>

    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Date</th>
            <th>Image</th>
        </tr>

        <?php
        while ($data = mysqli_fetch_assoc($objData)) {
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['title']; ?></td>
                <td><?php echo $data['content']; ?></td>
                <td><?php echo $data['date']; ?></td>
                <td><?php echo $data['image']; ?></td>

                <td>
                    <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>
<!-- end .container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- confirm delete record will be here -->

</body>
</html>
