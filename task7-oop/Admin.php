<?php 
require 'dbClass.php';
require 'validatorClass.php';

class Admin {
    private $title;
    private $content;


    function __construct($title,$content){
      
       $this->title  = $title;
       $this->content  = $content;
    }



    #start the create function

    public function create(){
        // logic ..... 

        $Validator = new Validator();
        
        $this->title     = $Validator->Clean($this->title);
        $this->content    = $Validator->Clean($this->content);
        
        $errors = [];

        # Validate title .... 
        if(!$Validator->validate($this->title,1)){
            $errors['title'] = "Field Required";
        }elseif(!$Validator->validate($this->title,3)){
            $errors['title'] = "Length Must Be atleast 6 chars";
        }


        # Validate content .... 
        if(!$Validator->validate($this->content,1)){
            $errors['content'] = "Field Required";
        }elseif(!$Validator->validate($this->content,3,20)){
            $errors['content'] = "Length Must Be at least 20 chars";
        }


        # Validate iamge....

        if(!$Validator->validate($_FILES['image']['name'], 1 )){
            $errors['Image'] = 'Field Required';
        }else{
            $tmpPath = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageType = $_FILES['image']['type'];
    
            $exArray = explode('.', $imageName);
            $extension = end($exArray);
    
            $FinalName = rand() . time() . '.' . $extension;
    
            
            if(!$Validator->validate($extension, 5)){
            $errors['image'] = "Invalid image extenstion";
            }
        }

       # Check Errors ..... 
       if(count($errors)>0){
            $_SESSION['Message'] = $errors;
       }else{

        $desPath = '../image/' . $FinalName;

        if (move_uploaded_file($tmpPath, $desPath)) {
        

        $dbObj = new database;
        $sql = "insert into blog (title,content,image) values ('$this->title','$this->content','$FinalName')";
        
        $result = $dbObj->doQuery($sql);

            if($result){
                $message = "Data Inserted";
            }else{
                $message = "Error Try Again";
            }
        }else{
            $message = 'Error In Uploading file';
        }
        $_SESSION['Message'] = ['message' => $message];

        }

    }
    #end the create function
    #start the edit function



    public function edit($data){
        // logic ..... 
            $id = $_GET['id'];

            $Validator = new Validator();
            
            $this->title     = $Validator->Clean($this->title);
            $this->content    = $Validator->Clean($this->content);
            
            $errors = [];

            # Validate title .... 
            if(!$Validator->validate($this->title,1)){
                $errors['Name'] = "Field Required";
            }elseif(!$Validator->validate($this->title,3)){
                $errors['name'] = "Length Must Be atleast 6 chars";
            }


            # Validate content .... 
            if(!$Validator->validate($this->content,1)){
                $errors['content'] = "Field Required";
            }elseif(!$Validator->validate($this->content,3,20)){
                $errors['content'] = "Length Must Be at least 20 chars";
            }


            # Validate iamge....

            if($Validator->validate($_FILES['image']['name'], 1 )){
                
                $tmpPath = $_FILES['image']['tmp_name'];
                $imageName = $_FILES['image']['name'];
                $imageSize = $_FILES['image']['size'];
                $imageType = $_FILES['image']['type'];
        
                $exArray = explode('.', $imageName);
                $extension = end($exArray);
        
                $FinalName = rand() . time() . '.' . $extension;
        
                
                if(!$Validator->validate($extension, 5)){
                $errors['image'] = "Invalid image extenstion";
                }
            }
        

        # Check Errors ..... 
        if(count($errors)>0){
            $_SESSION['Message'] = $errors;
        }else{
            

                    // old Image
                    $OldImage = $data;

                    if ( $Validator->validate($_FILES['image']['name'], 1)) {
                        $desPath = '../image/' . $FinalName;
            
                        if (move_uploaded_file($tmpPath, $desPath)) {
                            unlink('../image/' . $OldImage);
                        }
                    } else {
                        $FinalName = $OldImage;
                    }


            $dbObj = new database;


            $sql = "update blog set title = '$this->title' ,content = '$this->content' ,image = '$FinalName' where id = $id";
            
            $result_u = $dbObj->doQuery($sql);

            if($result_u){
                $message = ['message' => 'Raw Updated'];

                header('Location: ' .$Validator->url('index.php'));
                
            }else{
                $message = "Error Try Again";
            }

            $_SESSION['Message'] = ['message' => $message];

            
        }
    
    
    }
#end of edit funtion
        #start of delete function 
        public function delete(){

            $Validator = new Validator();
            $id =$_GET['id'];
            
            if(!$Validator->validate($id,4)){
                $message =  'Invalid Number';
            }else{
                $dbObj = new database;


                    $sql = "select * from blog where id = $id";
                    
                    $result = $dbObj->doQuery($sql);

                if(mysqli_num_rows($result) == 1){

                    $data = mysqli_fetch_assoc($result);
                    
                    $sql = "delete from blog where id = $id";
                    $result  = $dbObj->doQuery($sql);
                    
                    
                    if($result){
                        
                        unlink('../image/'.$data['image']); 
                    
                        $message = 'raw deleted';
                    }else{
                        $message = 'error Try Again ! '.mysqli_error($con);
                    }
                }else{
                    $message = 'Error In User Id ';
                }
            
            }
            
            $_SESSION['Message'] = ["Message" =>  $message];
            
            header("Location: ".$Validator->url('index.php'));
            
        }
    #end of delete funtion
    #start of read function
    public function read(){

        $dbObj = new database;
        $sql = "select * from blog";
        
        return $result = $dbObj->doQuery($sql);
    }
    #end of read function
}

?>