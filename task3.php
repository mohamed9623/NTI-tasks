<?php

    // $Name1=$_POST['name'];
    // echo $Name1;

    if($_SERVER['REQUEST_METHOD']=="POST"){

        // $Name=$_POST['name'];
        // $Email=$_POST['email'];
        // $Password=$_POST['password'];
        // $Address=$_POST['address'];
        // $LinkedinURL=$_POST['linkedinURL'];
    
   
    $Name=($_POST['name']);
    $Email=($_POST['email']);
    $Password=($_POST['password']);
    $Address=($_POST['address']);
   
    $LinkedinURL=($_POST['linkedinURL']);

    echo "Name: ".$Name.'<br>';
    echo "Email: ". $Email.'<br>';
    echo "Password: ".$Password.'<br>';
    echo "Address: ". $Address.'<br>';
    echo "URL: ".$LinkedinURL.'<br>';


    $errors=[];

    # Name Validation
    if(empty($Name)){
        $errors['name']="* Name is Required !";
    }
    elseif(!is_string($Name)){
        $errors['name']="* Invalid Name !";
    }
    elseif(is_numeric($Name)){
        $errors['name']="* Name must be String !";

    }


    #Email 
    if(empty($Email)){
        $errors['email'] = "* Email Required";
    }elseif(empty($Email) || !strstr($Email,'@') || !strstr($Email ,'.com')){
        $errors['email'] = " *Invalid Email";
    }


    #Password Validation
    if(empty($Password)){
        $errors['password']=" *Password is Required !";
    }elseif(strlen($Password)<6){
        $errors['password']="* Password at least 6 characters ! ";
    }


    #Address Validation
    if(empty($Address)){
        $errors['address']=" *Address is Required !";
    }elseif(strlen($Address)<10){
        $errors['address']="* Address at least 10 characters !";
    }


  

    #Linkedin URL Validation
    if(empty($LinkedinURL)){
        $errors['linkedinURL'] = "* Linkedin URL Required !";
    }  if(empty($LinkedinURL)|| !strstr($LinkedinURL,"www.linkedin.com")) {
        $errors['linkedinUrl'] = "Invalid URL must be like this www.linkedin.com";
      
    }


    # Check if there are errors
    if(count($errors)>0){
        foreach($errors as $key => $value){
            echo $key.' : '.$value.'<br>';
        }

    }
    else{
        echo "Valid Data ..";
    }


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Register</h2>
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="POST"   enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputName">Name</label>
    <input type="text"  name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text"   name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password"   name ="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>

  <div class="form-group">
    <label for="exampleInputAddress">Address</label>
    <input type="text"  name="address"  class="form-control" id="exampleInputAddress" aria-describedby="" placeholder="Enter Name">
  </div>


 
  <div class="form-group">
    <label for="exampleInputLinkedinURL">Linkedin URL</label>
    <input type="text"  name="linkedinURL"  class="form-control" id="exampleInputLinkedinURL" aria-describedby="" placeholder="Enter Name">
  </div>

 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>