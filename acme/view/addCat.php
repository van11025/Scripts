<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
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
    <div>
    <h1>Add a new category</h1>
    <?php if(isset($message)){echo $message;}?>
    <form method='post'>
  <label for="categoryName">Category Name:</label><br>
  <input type="text" name="categoryName" id="categoryName" required
  <?php if (isset($categoryName)){echo "value='$categoryName'";}?>><br><br>
  <button type="submit" name="submit" id="regbtn" value="RegCategory">Add</button><br>
  <br>
  <input type="hidden" name="action" value="newCat">
    </form>
    </div>
    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
    </div>
</body>
</html>