<?php include_once('header.php') ?>
<footer>
<?php   if(func::checkLoginState($dbh)){
            echo '<a href="index.php">Index</a>  || <a href = "logout.php">Logout</a> ||
            <a href="admin.php">Admin</a>';
        }else{
            echo '<a href="signup.php">SignUP</a>  || <a href = "login.php">LogIn</a>
            || <a href="index.php">Index</a>';
        }

?>
</footer>


</body>
</html>