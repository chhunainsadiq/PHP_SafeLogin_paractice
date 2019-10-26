<?php include_once('header.php'); ?>
    <?php
        if(!func::checkLoginState($dbh)){
            header('location:login.php');
        }
    ?>

    <section class="parent">
        <div class="child">
            <p> Hello Welcome <?php echo '<strong>'. $_COOKIE['username']. '</strong>' ?> to your private section of your page
            Here we have multiple services for you.
            </p>

            <ul>
                <li>Accounts</li>
                <li>Contacts</li>
                <li>Opportunities</li>
                <li>Leads</li>
                <li>Emails</li>
            </ul>
        </div>
    </section>



<?php include_once('footer.php'); ?>