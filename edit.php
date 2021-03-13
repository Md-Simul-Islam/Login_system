<?php
    require_once('header.php');
    require_once('database.php');

    

    //catch all data
    if(isset($_POST["update"])){
        $name=isset($_POST["name"]) ? $_POST["name"]: "";
        $email=isset($_POST["email"]) ? $_POST["email"]: "";
        $subject=isset($_POST["subject"]) ? $_POST["subject"]: "";
        $subject=str_replace("'","\'",$subject);
        $university=isset($_POST["university"]) ? $_POST["university"]: "";
        $gendar=isset($_POST['gendar']) ? $_POST['gendar'] : "";
        $job=isset($_POST['job']) ? $_POST['job'] : "";
        $jobstring=implode(",",$job);

        $id=isset($_GET['edited'])?$_GET['edited']:"";

        //image update
        $upload="uploads";
        $image=isset($_FILES['image']) ? $_FILES['image'] : "";
        $imagename=date('Y-m-d-h-i-s-m-a').$image['name'];
        $tmpname=$image['tmp_name'];
        $imageupload=move_uploaded_file($tmpname,"$upload/$imagename");

        if($imageupload){
            $query="UPDATE datas SET name='$name', email='$email',subject='$subject', 
            image='$imagename',university='$university',gendar='$gendar',job='$jobstring' WHERE ID=$id";
            $sql=mysqli_query($con, $query);
        }else{
            $query="UPDATE datas SET name='$name', email='$email',subject='$subject', 
          university='$university',gendar='$gendar',job='$jobstring' WHERE ID=$id";
            $sql=mysqli_query($con, $query);
            }


        if($sql){
            $update_success="<div class='alert alert-success'>Data updated successfully</div>";
        }else{
            $update_error="<div class='alert alert-warning'>something worng</div>";
        }
     
      }
?>

<div class="container mt-6">
    <div class="row">
    <?php 
        if(isset( $update_success)){
            echo  $update_success;
        }

        if(isset ($update_error)){
            echo  $update_error;
        }
    
    ?>
        <a href="datas.php" class="btn btn-secondary">All Data</a>

    </div>
    <div class="row">

    <?php 
        $id=isset($_GET['edited'])?$_GET['edited']:"";
       
        $query="SELECT * FROM datas WHERE ID=$id";
        $sql=mysqli_query($con,$query);//database er sathe connection setup
        $single=mysqli_fetch_assoc($sql);
            $image=$single['image'];
            $job=$single['job'];
            $job_array=explode(",",$job);
           
         
           if(empty($image)){
               $image="uploads/avatar.jpg";
           }else{
               $image="uploads/".$single['image'];
           }
           $gendar=$single['gendar'];
           if($gendar){
               //echo $gendar;
           }
    ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" name="name" value=<?php echo $single['name'];?> id="name" class="form-control" />
            </div>
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email"  name="email" value=<?php echo $single['email'];?>  id="email" class="form-control" />
            </div>
            <div class="mb-4">
                <label for="subject">Subject</label>
                <input type="subject"  name="subject"  value=<?php echo $single['subject'];?>  id="subject" class="form-control" />
            </div>
            <div class="row">
                <div class="mb-2">
                    <label for="image" >Image update</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <img src="<?php echo $image;?>"  style="width:150px;height:100px;" alt="image"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-2">
                    <h5>Gendar</h5>
                    <input type="radio" <?php if($gendar=='male'){ echo "checked=checked";} ?> id="male" name="gendar"  value="male"><label for="male">Male</label>
                    <input type="radio" <?php if($gendar=='female'){ echo "checked=checked";} ?> id="female" name="gendar" value="female"><label for="female">Female</label>
                    <input type="radio" <?php if($gendar=='other'){ echo "checked=checked";} ?>  id="other" name="gendar" value="other"><label for="other">Other</label>
                </div>
            </div>
            <div class="row">
            <div class="mb-2">
                <h5>Jobs</h5>
                <input type="checkbox"<?php if(in_array('engineer',$job_array)){echo "checked=checked";}?> name="job[]" id="engineer" value="engineer" /><label for="engineer">Engineer</label>
                <input type="checkbox"<?php if(in_array('teacher',$job_array)){echo "checked=checked";}?>  name="job[]" id="teacher" value="teacher"/><label for="teacher">Teacher</label>
                <input type="checkbox"<?php if(in_array('doctor',$job_array)){echo "checked=checked";}?>  name="job[]" id="doctor" value="doctor"/><label for="doctor">Doctor</label>
                <input type="checkbox" <?php if(in_array('farmar',$job_array)){echo "checked=checked";}?> name="job[]" id="farmar" value="farmar" /><label for="farmar">Farmar</label>
            </div>
        </div> 
            <div class="mb-4">
                <label for="varisty">University</label>
                <input type="text"  name="university"  value=<?php echo $single['university'];?>  id="varsity" class="form-control" />
            </div>
            <div class="mt-5 text-center">
            <button class="btn btn-outline-primary" name="update" >Update</button>
            <div>
        </form>
    </div>


</div>

<?php

    require_once('footer.php');

?>