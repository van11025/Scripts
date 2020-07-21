<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2){
        header('Location: /acme/index.php');
}

    // Build the categories option list
 $catList = '<select name="catType" id="catType">';
 $catList .= "<option>Choose a Category</option>";
 foreach ($categories as $category) {
  $catList .= "<option value='$category[categoryId]'";
  if(isset($catType)){
   if($category['categoryId'] === $catType){
    $catList .= ' selected ';
   }
  } elseif(isset($prodInfo['categoryId'])){
   if($category['categoryId'] === $prodInfo['categoryId']){
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
    <title><?php if(isset($prodInfo['invName'])){ 
      echo "Modify $prodInfo[invName] ";} 
      elseif(isset($invName)) { echo $invName; }?> | Acme</title>
    <meta name="author" content="Michael Vance">*
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
    <h1><?php if(isset($prodInfo['invName'])){ 
       echo "Modify $prodInfo[invName] ";} 
       elseif(isset($invName)) { echo $invName; }?></h1>
    <?php if (isset($message)){ echo $message; }?>


    <form method='post' action='/acme/products/index.php'>
  <label for="invName">Name:</label><br>
  <input type="text" name="invName" id="invName" required 
        <?php if (isset($invName)){echo "value='$invName'";}
            elseif(isset($prodInfo['invName'])) {
            echo "value='$prodInfo[invName]'"; }?>><br>

  <label for="invDescription">Description:</label><br>
  <input type="text" name="invDescription" id="invDescription" required 
  <?php if (isset($invDescription)){echo "value='$invDescription'";}
            elseif(isset($prodInfo['invDescription'])) {
            echo "value='$prodInfo[invDescription]'"; }?>><br>

  <label for="invImage">Image URL:</label><br>
  <input type="text" name="invImage" id="invImage" required 
        <?php if (isset($invImage)){echo "value='$invImage'";}
            elseif(isset($prodInfo['invImage'])) {
            echo "value='$prodInfo[invImage]'"; }?>><br>

  <label for="invThumbnail">Thumbnail URL:</label><br>
  <input type="text" name="invThumbnail" id="invThumbnail" required 
        <?php if (isset($invThumbnail)){echo "value='$invThumbnail'";}
            elseif(isset($prodInfo['invThumbnail'])) {
            echo "value='$prodInfo[invThumbnail]'"; }?>><br>

  <label for="invPrice">Price:</label><br>
  <input type="number" name="invPrice" id="invPrice" step='any' required 
        <?php if (isset($invPrice)){echo "value='$invPrice'";}
            elseif(isset($prodInfo['invPrice'])) {
            echo "value='$prodInfo[invPrice]'"; }?>><br>

  <label for="invStock">Stock:</label><br>
  <input type="number" name="invStock" id="invStock" step='any' required 
        <?php if (isset($invStock)){echo "value='$invStock'";}
            elseif(isset($prodInfo['invStock'])) {
            echo "value='$prodInfo[invStock]'"; }?>><br>

  <label for="invSize">Size:</label><br>
  <input type="number" name="invSize" id="invSize" step='any' required 
        <?php if (isset($invSize)){echo "value='$invSize'";}
            elseif(isset($prodInfo['invSize'])) {
            echo "value='$prodInfo[invSize]'"; }?>><br>

  <label for="invWeight">Weight:</label><br>
  <input type="number" name="invWeight" id="invWeight" step='any' required 
        <?php if (isset($invWeight)){echo "value='$invWeight'";}
            elseif(isset($prodInfo['invWeight'])) {
            echo "value='$prodInfo[invWeight]'"; }?>><br>

  <label for="invLocation">Location:</label><br>
  <input type="text" name="invLocation" id="invLocation" required
        <?php if (isset($invLocation)){echo "value='$invLocation'";}
             elseif(isset($prodInfo['invLocation'])) {
            echo "value='$prodInfo[invLocation]'"; }?>><br>

  <?php echo $catList;?><br>

  <label for="invVendor">Vendor:</label><br>
  <input type="text" name="invVendor" id="invVendor" required 
  <?php if (isset($invVendor)){echo "value='$invVendor'";}
            elseif(isset($prodInfo['invVendor'])) {
            echo "value='$prodInfo[invVendor]'"; }?>><br>

  <label for="invStyle">Style:</label><br>
  <input type="text" name="invStyle" id="invStyle" required 
  <?php if (isset($invStyle)){echo "value='$invStyle'";}
  elseif(isset($prodInfo['invStyle'])) {
    echo "value='$prodInfo[invStyle]'"; }?>><br>
  <br>
  
  
  
  <button type="submit" name="submit" id="updatebtn" value="updateProd">Update</button><br>
  <br>
  <input type="hidden" name="action" value="updateProd">
  <input type="hidden" name="invId" 
 value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
 elseif(isset($invId)){ echo $invId; } ?>">
    </form>
    
    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
</body>
</html>