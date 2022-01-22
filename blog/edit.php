<?php 
  require "../Admin.php";


  $id = $_GET['id'];
  $dbObj = new database;
  $sql = "select * from blog where id = $id";
  $op = $dbObj->doQuery($sql);





  if (mysqli_num_rows($op) == 1) {
      $data = mysqli_fetch_assoc($op);
  } else {
      $_SESSION['Message'] = ['Message' => 'Access Denied'];
      header('Location: ' . url('/index.php'));
  }


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_REQUEST['title'];
  $content = $_REQUEST['content'];
  
  $user = new Admin($title = $title,$content = $content);
    $user->edit($data['image']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
  <main>
    <div class="container">
      <h1 class="mt-4">Blog</h1>
      <ol class="breadcrumb mb-4">
        <?php 
                    
          if(isset($_SESSION['Message'])){
              foreach($_SESSION['Message'] as $key =>$val){
                echo '<div class="alert alert-danger" role="alert">'.$key.' : '.$val.'</div>';
              } unset($_SESSION['Message']);
          }else{ ?>

        <li class="breadcrumb-item active">edit post</li>

        <?php } ?>
      </ol>

      <div class="card-body">
        <div class="container">
          <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="exampleInputName">Title</label>
              <input type="text" class="form-control" id="exampleInputName" name="title" aria-describedby=""
                placeholder="Enter Title" value="<?php echo $data['title']; ?>" />
            </div>

            <div class="form-group my-4">
              <label for="exampleInputName">content</label>
              <input type="text" class="form-control" id="exampleInputName" name="content" aria-describedby=""
                placeholder="Enter content" value="<?php echo $data['content']; ?>" />
            </div>

            <div class="form-group">
              <label for="exampleInputName">image</label>
              <input type="file" class="form-control" id="exampleInputName" name="image" aria-describedby=""
                placeholder="choose your image" />
            </div>
            <img src="../image/<?php echo $data['image']; ?>" height="80" width="80"><br>

            <button type="submit" class="btn btn-primary my-3">update</button>
          </form>
        </div>
      </div>
    </div>
    </div>
  </main>
</body>

</html>
