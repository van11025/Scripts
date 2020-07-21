<?php
if(!$_SESSION['loggedin']){
        header('Location: /acme/index.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACME</title>
    <meta name="author" content="Michael Vance">
    <link rel="stylesheet" href="/acme/css/screen.css" media="screen" type="text/css">
</head>


<body>
<div id="page-backing">
    <header id="page-header">
        <?php include('../library/header.php') ?>
    </header>

    <nav id="page-nav">
        <?php include('../library/navigation.php'); ?>
    </nav>

    <main>
        <?php
            $fName = $_SESSION['clientData']['clientFirstname'];
            $lName = $_SESSION['clientData']['clientLastname'];
            $id = $_SESSION['clientData']['clientId'];
            $cEmail = $_SESSION['clientData']['clientEmail'];
            $cLevel = $_SESSION['clientData']['clientLevel'];
            echo '<h1>First Name: '.$fName.'</h1>';
            echo '<ul>';
            echo '<li>Last Name: '.$lName.'</li>';
            echo '<li>ID: '.$id.'</li>';
            echo '<li>User Email: '.$cEmail.'</li>';
            echo '<li>User Level: '.$cLevel.'</li>';

            // If the user is level 2 or higher, display the products link
            if($_SESSION['clientData']['clientLevel'] > 1){
             echo '<a href="/acme/products/index.php?action=admin">Product Management</a>';
            }
            echo '</ul>';
            ?>
    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
    </div>
</body>
</html>