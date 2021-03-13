<?php
    require_once("header.php");
    require_once("database.php");

  
    //catch delete id
    $delete=isset($_GET['deleteid'])? $_GET['deleteid']:"";
    //echo $delete;

    //delete data
    $query="DELETE FROM datas WHERE ID=$delete";
    $sql=mysqli_query($con,$query);
    if($sql){
        $del="<div class='alert alert-primary' >Data deleted successfully</div>";
    }
?>

<div class="container-fluid">
    <div class="row">
        <?php
        if(isset($del)){
            echo $del;
        }
        ?>
        <a href="index.php" class="btn btn-secondary">Add Data</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>University</th>
                <th>Image</th>
                <th>Gendar</th>
                <th>Jobs</th>
                <th>Actions</th>
            </tr>
            <?php 
                $query="SELECT * FROM datas";
                $sql=mysqli_query($con,$query);//database er sathe connection setup
                while($row=mysqli_fetch_assoc($sql)) :/*{//database er porthekta value alada korbe
                  //  echo "id: " . $row["id"]. " - Name:- " . $row["name"]. " -Email:-" . $row["email"]. " -University:-" . $row["university"] ."<br>";
                  echo "<tr>";
                  echo "<td>" . $row['id'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['email'] . "</td>";
                  echo "<td>" . $row['subject'] . "</td>";
                  echo "<td>" . $row['university'] . "</td>";
                  echo "<td>"."<a class='btn btn-warning'  href="#" style="margin-right:4px">Edit</a><a class='btn btn-danger' href="#">Delete</a></td>";
           
                  echo "</tr>";
                  }*/
                
                $image=$row['image'];
                
                if(empty($image)){
                    $image="uploads/avatar.jpg";
                }else{
                    $image="uploads/".$row['image'];
  
                }
            ?>

            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["subject"]; ?></td>
                <td><?php echo $row["university"]; ?></td>
                <td><img src="<?php echo $image;?>" style="width:150px;height:100px;" alt="image"></td>
                <td><?php echo $row["gendar"]; ?></td>
                <td><?php echo $row["job"]; ?></td>
               <td><a class="btn btn-warning"  href="edit.php?edited=<?php echo $row['id'];?>" style="margin-right:4px">Edit</a>
               <a class="btn btn-danger" href="datas.php?deleteid=<?php echo $row['id'];?>">Delete</a></td>

            </tr>
            <?php 
                endwhile; 

            ?>
            
        </table>
    <div>
</div>

<?php
    require_once("footer.php");
?>