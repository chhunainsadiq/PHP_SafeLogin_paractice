<?php
echo 'inside index.php'."<br>";
include_once("header.php");
?>
<section class="parent">
    <div class="child">
    <?php
            if(!func::checkLoginState($dbh)){
                header('location:login.php');
                exit();
            }
            echo "welcome".' '.$_SESSION['username'].'!';        
        ?>
    </div>
</section>
<?php
include_once("footer.php");
?>