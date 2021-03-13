<?php
    session_start();
    require_once("header.php");
    require_once("database.php");
	
    /*$dbuser="admin"; //for testing
    $dbpwd=1234;*/
    $query="SELECT * FROM users WHERE ID=2";
    $sql=mysqli_query($con,$query);//database er sathe connection setup
    $data=mysqli_fetch_assoc($sql);
    $dbuser=$data['username'];
    $dbpwd=$data['password'];

    if(isset( $_SESSION['login']) || isset($_COOKIE['remember'])){   //eta dea hoi jate login kirar pore index pagei thake ,r logout er age login page na jai tai,
        header('location :index.php');// but eta kaj kore na
    }
    if(isset($_POST['login'])){
        $username=isset($_POST['username']) ? $_POST['username']:" ";
        $pwd=isset($_POST['password']) ? $_POST['password']:" "; 
        
        if($dbuser==$username && $dbpwd==md5($pwd)){
            $_SESSION['login']="admin";
            if(isset($_POST['remember'])){
                setcookie('remember','Cookie set',time()+(600));
            }

            header('location:index.php');
        }else{
            $login_error="<div class='alert alert-warning'>username and password does not match</div>";
        }
    }
    
?>
<div class="container">
    <div class="login-form">
        <?php 
            if(isset($login_error)){
                echo $login_error;
            }
        ?>
        <form method="POST">
            <div class="row">
                <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="pwd">Password</label>
                    <input type="password" name="password" id="pwd" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <input type="checkbox" name="remember" value="remember" id="remember" />     
                    <label for="remember">Remember Me</label>
                   
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <button class="btn btn-primary" name="login" >login</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
    require_once("footer.php");
?>