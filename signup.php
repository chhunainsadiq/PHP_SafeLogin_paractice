<section class ="parent">
    <div class="child">
<?php
    include_once('header.php');

    if(!func::checkLoginState($dbh)){
                if( isset($_POST['username']) && isset($_POST['password']) &&
                    isset($_POST['name']) && isset($_POST['email']) && isset($_POST['status']) ){
                    
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $status =$_POST['status'];

                    if($status=='on'){
                        $status=1;
                    }else{
                        $status=0;
                    }

                    try {   
                        $query ="Insert into users (users_name,users_username,users_password,Email,users_status)
                        values (:name,:username,:password,:email,:status);";
                        $stmt=$dbh->prepare($query);
                        $stmt->execute(array(':name'=>$name,':username'=>$username,':password'=>$password,':email'=>$email,':status'=>$status));
                        var_dump($stmt);
                    }
                    catch(PDOException $e){
                            echo "Query failed: " . $e->getMessage();
                    }                       
                    if($stmt){
                        header('location:index.php');
                    }

                }else{
                    echo 
                        '<form action="signup.php" method="post">
                            <label>Name</label></br>
                            <input type ="text" name="name" /></br>
                            <label> Email</label></br>
                            <input type ="text" name="email" /></br>
                            <label>UserName</label></br>
                            <input type ="text" name="username" /></br>
                            <label> Password</label></br>
                            <input type ="password" name="password" /></br>
                            <label> Status</label></br>
                            <input type="checkbox"  name="status" checked></br>                      
                            <input type ="submit" value ="SignUp"/>                          
                          </form>';

                }
    }

include_once('footer.php');
?>
    </div>
</section>