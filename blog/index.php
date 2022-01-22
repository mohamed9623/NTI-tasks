<?php 
  require "../Admin.php";


  $user = new Admin($title="",$content="");
  $result = $user->read();

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

        <li class="breadcrumb-item active">create post</li>

        <?php } ?>
      </ol>

      <div class="card-body">
        <div class="container">
          <div class="row">
            <?php while ($data = mysqli_fetch_assoc($result)){ ?>
            <div class="card col-4 mx-4" style="width: 18rem;">
              <img src="../image/<?php echo $data['image'];?>" class="card-img-top m-75 w-75" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['title'];?></h5>
                <p class="card-text"><?php echo $data['content'];?></p>
                <a href="./edit.php?id=<?php echo $data['id'];?>" class="card-link btn btn-primary">edit</a>
                <a href="./delete.php?id=<?php echo $data['id'];?>" class="card-link btn btn-danger">delete</a>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
