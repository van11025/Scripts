<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
        header('Location: /acme/index.php');
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACME</title>
    <meta name="author" content="Michael Vance">
    <link rel="stylesheet" href="../css/product.css" media="screen" type="text/css">
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
        <div id='catSelect'>
        <h1>Product Management</h1>
    
    </div>
        <br>
    <a href="/acme/products/index.php?action=addCat">Add a category</a>
        <br>
    <a href="/acme/products/index.php?action=addProduct">Add a product</a>
    <a href="/acme/products/index.php?action=modProduct"></a>


    <?php
        if (isset($message)) { 
        echo $message; 
        } 
        if (isset($categoryList)) { 
        echo '<h2>Products By Category</h2>'; 
        echo '<p>Choose a category to see those products</p>'; 
        echo $categoryList; 
        }
    ?>
    <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="productsDisplay"></table>


    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
    </div>
    <script src="../js/products.js"></script>
</body>
</html>
<?php unset($_SESSION['message']);?>