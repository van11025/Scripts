<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
        header('Location: /acme/index.php');
}

    $catList = "<select name='categoryId' id='categoryId'>";
    foreach ($categories as $category){
        $catList .= "<option value='.$category[categoryId]'";
            if(isset($categoryName)){
                if($category['categoryId'] === $categoryName){
                    $catList .= ' selected ';
                }
            }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
?>
<!DOCTYPE html>
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
    <h1>Add a new Item to the inventory</h1>
    <?php if (isset($message)){ echo $message; }?>
    <form method='post' action='/acme/products/index.php'>
  <label for="invName">Name:</label><br>
  <input type="text" name="invName" id="invName" required <?php if (isset($invName)){echo "value='$invName'";}?>><br>

  <label for="invDescription">Description:</label><br>
  <input type="text" name="invDescription" id="invDescription" required <?php if (isset($invDescription)){echo "value='$invDescription'";}?>><br>

  <label for="invImage">Image URL:</label><br>
  <input type="text" name="invImage" id="invImage" required <?php if (isset($invImage)){echo "value='$invImage'";}?>><br>

  <label for="invThumbnail">Thumbnail URL:</label><br>
  <input type="text" name="invThumbnail" id="invThumbnail" required <?php if (isset($invThumbnail)){echo "value='$invThumbnail'";}?>><br>

  <label for="invPrice">Price:</label><br>
  <input type="number" name="invPrice" id="invPrice" step='any' required <?php if (isset($invPrice)){echo "value='$invPrice'";}?>><br>

  <label for="invStock">Stock:</label><br>
  <input type="number" name="invStock" id="invStock" step='any' required <?php if (isset($invStock)){echo "value='$invStock'";}?>><br>

  <label for="invSize">Size:</label><br>
  <input type="number" name="invSize" id="invSize" step='any' required <?php if (isset($invSize)){echo "value='$invSize'";}?>><br>

  <label for="invWeight">Weight:</label><br>
  <input type="number" name="invWeight" id="invWeight" step='any' required <?php if (isset($invWeight)){echo "value='$invWeight'";}?>><br>

  <label for="invLocation">Location:</label><br>
  <input type="text" name="invLocation" id="invLocation" required <?php if (isset($invLocation)){echo "value='$invLocation'";}?>><br>

  <?php echo $catList;?><br>

  <label for="invVendor">Vendor:</label><br>
  <input type="text" name="invVendor" id="invVendor" required <?php if (isset($invVendor)){echo "value='$invVendor'";}?>><br>

  <label for="invStyle">Style:</label><br>
  <input type="text" name="invStyle" id="invStyle" required <?php if (isset($invStyle)){echo "value='$invStyle'";}?>><br>
  <br>
  
  
  
  <button type="submit" name="submit" id="regbtn" value="RegCategory">Add</button><br>
  <br>
  <input type="hidden" name="action" value="newInv">
    </form>
    
    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
</body>
</html>