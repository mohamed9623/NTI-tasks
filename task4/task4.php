<?php
// session_start();
// echo $_SESSION['name'];
session_start();


if (isset($_SESSION['name']) && isset($_SESSION['email'])) {

    echo $_SESSION['name'] . '<br>' . $_SESSION['email'];
}
$name = "";
$email = "";
$gender = "";
$password = "";
$address = "";
$linkedinUrl = "";
$image = "";
$userName = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["name"])) {
        $errors['name']   = "Name is required";
    } else {
        $userName = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
            $errors['name']   = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $errors['email']  = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email']  = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $errors['password']  = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $errors['password']  = "Password must be more than 6 characters";
        }
    }

    if (empty($_POST["address"])) {
        $errors['address'] =  "Address is required";
    } else {
        $address = test_input($_POST["address"]);
        if (strlen($address) > 10) {
            $errors['address']  = "Address must be less than 10 characters";
        }
    }

    if (empty($_POST["linkedinUrl"])) {
        $errors['linkedinUrl'] = "Url is required";
    } else {
        $linkedinUrl = test_input($_POST["linkedinUrl"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $linkedinUrl)) {
            $errors['linkedinUrl'] = "Invalid URL";
        }
    }

    if (empty($_POST["gender"])) {
        $errors['gender'] = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (!empty($_FILES['image']['name'])) {
        $imgName = $_FILES['image']['name'];
        $temp = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];
        $type = $_FILES['image']['type'];

        $nameArray =  explode('/', $type);

        $extension =  strtolower($nameArray[1]);

        $FinalName = rand() . time() . '.' . $extension;

        $allowedExt = array('png', 'jpg', 'jpeg');

        if (in_array($extension, $allowedExt)) {
            $folder = "./uploads/";

            $finalPath = $folder . $FinalName;

            if (move_uploaded_file($temp, $finalPath)) {

                echo '';
               
            } else {

                echo 'error try again';
            }
        } else {

            echo 'Invalid Extension';
        }
    } else {

        echo 'File Required';
    }

    if (count($errors) > 0) {

        foreach ($errors as $key => $error) {

            echo '* ' . $key . ' : ' . $error . '<br>';
        }
    } else {
        echo "welcome ", $userName;
        $file = fopen("users.txt", "a")  or die("unable to open file");

        $txt = $userName . ' ' . $email . ' ' . $address . ' ' . $gender . ' ' . $linkedinUrl . ' ' . $name;
        $txt .= "\n";

        fwrite($file, $txt);

        fclose($file);
    
        $_SESSION['user'] = ["name" => $name, "email" => $email, "gender" => $gender, "password" => $password, "address" => $address, "linkedin" => $linkedinUrl, "imageName" => $imgName];
        echo ' || Registered Successfully Data Saved In Session'  . $name;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
    <title>Upload File</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label> <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email"> E-mail: </label><input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password"> password: </label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="address"> address: </label><input type="text" name="address" maxlength="10" class="form-control">
            </div>
            <div class="form-group">
                <label for="gender"> Gender: </label><br>
                <input type="radio" name="gender" value="female">Female <br>
                <input type="radio" name="gender" value="male">Male
            </div>
           
            <div class="form-group">
    <label for="exampleInputLinkedinURL">Linkedin URL</label>
    <input type="text"  name="linkedinUrl"  class="form-control" id="exampleInputLinkedinURL" aria-describedby="" placeholder="Enter Name">
  </div>
            <div class="form-group">
                <label for="image"> Choose Image: </label><input type="file" name="image" class="form-control">

            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
</body>

</html>
<?php


?>
