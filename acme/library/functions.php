<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}


function navigate($categories){
    
 $navList = '<ul>';
 $navList .= "<li><a href='/acme/accounts/index.php' title='View the Acme home page'>Home</a></li>";
   foreach($categories as $category) {
     $navList .= "<li><a href='/acme/products/?action=category&categoryName="
     .urlencode($category['categoryName']).
     "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}


// Build the categories select list 
function buildCategoryList($categories){ 
  $catList = '<select name="categoryId" id="categoryList">'; 
  $catList .= "<option>Choose a Category</option>"; 
  foreach ($categories as $category) { 
   $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
  } 
  $catList .= '</select>'; 
  return $catList; 
 }


//  // Get products by categoryId 
// function getProductsByCategory($categoryId){ 
//   $db = acmeConnect(); 
//   $sql = ' SELECT * FROM inventory WHERE categoryId = :categoryId'; 
//   $stmt = $db->prepare($sql); 
//   $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT); 
//   $stmt->execute(); 
//   $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
//   $stmt->closeCursor(); 
//   return $products; 
//  }

 function buildProductsDisplay($products){
  $pd = '<ul id="prod-display">';
  foreach ($products as $product) {
    $proPrice = number_format($product['invPrice'], 2);
    $invId = $product['invId'];
   $pd .= '<li>';
   $pd .= "<a href='/acme/products/?action=details&invId=$invId'>";
   $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
   $pd .= '<hr>';
   $pd .= "<h2>$product[invName]</h2>";
   $pd .= "<span>$".$proPrice."</span>"; 
   $pd .= "</a>";
   $pd .= '</li>';
  }
  $pd .= '</ul>';
  return $pd;
 }


 function buildProductsDetails($details){
    $pd = '<div id="detailsBox">';
        
        $pd .= '<div id="imgBox" class="col-6">';
        $pd .= '<img  class="prodimage" src='.$details['invImage'].' alt="Image of '.$details['invName'].'" >';
        $pd .= '</div>';


        $pd .= '<div id="prod-detail" class="col-6">';
          $pd .= '<ul id="detail-list">';
          $pd .= '<li>';
          $pd .= '<p><span>Description:</span><br>'.$details['invDescription'].'</p>';
          $pd .= '</li>';
          $pd .= '<li>';
          $pd .= '<p><span>Primary Material:</span> '.$details['invStyle'].'</p>';
          $pd .= '</li>';
          $pd .= '<li>';
          $pd .= '<p><span>Product Weight:</span> '.$details['invWeight'].' lbs</p>';
          $pd .= '</li>';  
          $pd .= '<li>';
          $pd .= '<p><span>Shipping size:</span> '.$details['invSize'] .'inches (W x L x H)</p>';
          $pd .= '</li>';
          $pd .= '<li>';
          $pd .= '<p><span>Ship from:</span> '.$details['invLocation'].'</p>';
          $pd .= '</li>';
          $pd .= '<li>';
          $pd .= '<p><span>Number in Stock:</span> '.$details['invStock'].'</p>';
          $pd .= '</li>';
          $pd .= '</ul>';
        $pd .= '</div>';
    $pd .= '</div>';
  
  return $pd;
 }
?>
