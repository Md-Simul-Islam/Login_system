<?php 
    session_start();
    require_once("database.php");
    require_once("header.php");
    //echo $_SESSION['login'];
    if(isset($_COOKIE['remember'])){
        echo "cookie value";
    }else{
        echo "no value in cookie";
    }


    if(!isset($_SESSION['login']) and !isset($_COOLKIE['remember'])){
        header('location:login.php');
    }

    //when click submit then catch all data
    if(isset($_POST["submit"])){
      $name=isset($_POST["name"]) ? $_POST["name"]: "";
      $email=isset($_POST["email"]) ? $_POST["email"]: "";
      $subject=isset($_POST["subject"]) ? $_POST["subject"]: "";
      $subject=str_replace("'","\'",$subject);

      $gendar=isset($_POST['gendar']) ? $_POST['gendar'] : "";
      $job=isset($_POST['job']) ? $_POST['job'] : "";
      //var_dump ($job);
      $implode=implode(' ,',$job);//array to string convert kore
 
      
      $university=isset($_POST["university"]) ? $_POST["university"]: "";
      

      $mailselect="SELECT * FROM datas WHERE email='$email'";
      //echo "<pre>";
      //var_dump($image);
     // echo "</pre>";

     //upload imaga
     $upload="uploads";
     $image=isset($_FILES['image']) ? $_FILES['image'] : "";
     $imagename=date('Y-m-d-h-i-s-m-a').$image['name'];
     $tmpname=$image['tmp_name'];
     
     $imageupload=move_uploaded_file($tmpname,"$upload/$imagename");

      $mailquery=mysqli_query($con,$mailselect);
      $count=mysqli_num_rows($mailquery);
      //echo "count=".$count;


      //insert data into database
      $query="INSERT INTO datas(name,email,subject,university,image,gendar,job) VALUES ('$name','$email','$subject','$university','$imagename',' $gendar','$implode')";
      if($count>0){ 
          $mail_error="<div class='alert alert-warning'>this email already exist </div>";
      }else{
       
        $sql=mysqli_query($con, $query);
      }
       if(isset($sql)){
          $insert_success="<div class='alert alert-success'>Data inserted successfully</div>";
       }
   
    }
?>
<div class="container mt-2">
    <div class="row">
        <?php
            if(isset( $insert_success)){
                echo  $insert_success."<br>";
            }
        
            if(isset ( $mail_error)){
                echo   $mail_error."<br>";
            }
        ?>
        <div class="col-md-6">
             <a href="datas.php" class="btn btn-secondary">All Data</a>
        </div>
        <div class="col-md-6">
             <a href="logout.php" class="btn btn-secondary" style="float:right">logout</a>
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" >
            </div>
        </div>
        <div class="row">
            <div class="mb-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required="" >
            </div>
        </div>
        <div class="row">
            <div class="mb-2">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="mb-2">
                <label for="image">Image Upload</label>
                <input type="file" name="image" id="image" class="form-control" required="">
            </div>
        </div>
        <div class="row">
            <div class="mb-2">
                <h5>Gendar</h5>
                <input type="radio" id="male" name="gendar" value="male"><label for="male">Male</label>
                <input type="radio" id="female" name="gendar" value="female"><label for="female">Female</label>
                <input type="radio" id="other" name="gendar" value="other"><label for="other">Other</label>
            </div>
        </div> 
        <div class="row">
            <div class="mb-2">
                <h5>Jobs</h5>
                <input type="checkbox" name="job[]" id="engineer" value="engineer" /><label for="engineer">Engineer</label>
                <input type="checkbox" name="job[]" id="teacher" value="teacher"/><label for="teacher">Teacher</label>
                <input type="checkbox" name="job[]" id="doctor" value="doctor"/><label for="doctor">Doctor</label>
                <input type="checkbox" name="job[]" id="farmar" value="farmar" /><label for="farmar">Farmar</label>
            </div>
        </div>
        
        <div class="row">
            <div class="mb-2">
                <label for="varsity">University</label>
                <input type="text" name="university" id="varsity" class="form-control">  
            </div>
        </div>
        
        <div class="row text-center">
            <div class="mt-2">
            <button class="btn btn-outline-primary" name="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php 
    require_once("footer.php");

?>
