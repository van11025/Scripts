<div id="site-header" class="col-12">
    <div class="col-8">
        <a>
        <img id="site-brand" src="/acme/images/site/logo.gif" alt="Acme. Buy here, eat roadrunner">
        </a>
    </div>
        <div id="login" class="col-4">
        <?php if(isset($cookieFirstname)){
            echo "<span>Welcome $cookieFirstname</span><br>";
        } 
        if(isset($_SESSION['loggedin'])){
            if($_SESSION['loggedin']){
            echo '<a href="/acme/accounts/index.php?action=logout">Logout</a>';}
            if ($_SESSION['clientData']['clientLevel'] > 1){
                echo '<br><a href="/acme/products/index.php">Product Management</a>';
            }
        }
        else{
            echo '<a href="/acme/accounts/index.php?action=login"><img id="login-button" src="/acme/images/site/account.gif" alt="Folder Icon">My Account</a><br>';
        }
        ?>
    </div>
</div>