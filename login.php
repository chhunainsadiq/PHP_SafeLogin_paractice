<?php include_once("header.php")  ?>

<section class="parent">
    <div class="child">
        <?php
            if(!func::checkLoginState($dbh)){
                if(isset($_POST['username']) && isset($_POST['password'])){
                    
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query="select * from users where users_username=:username AND 
                            users_password =:password;";
                    $stmt=$dbh->prepare($query);
                    $stmt->execute(array(':username'=>$username,':password'=>$password));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['users_id']>0){
                        func::createRecord($dbh,$row['users_id'],$row['users_username']);
                        header('location:login.php');
                        //echo func::createString(32);
                    }

                }else{
                    echo '<form action="login.php" method="post">
                            <label>UserName</label></br>
                            <input type ="text" name="username" /></br>
                            <label> Password</label></br>
                            <input type ="password" name="password" /></br>
                            <input type ="submit" value ="LogIn"/>                          
                          </form>';

                }

            }else{
                header('location:index.php');
            }

            include_once('footer.php');
        ?>
    
    </div>
</section>