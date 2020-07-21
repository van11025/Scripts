<?php
session_start();
require '../library/pdo.php';
require 'D:\Web Developement\XAMPP\htdocs\acme\model\producs-model.php';
require_once '../library/functions.php';


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

$navList = navigate(getCategories());
$categories = getCategories();

switch ($action){
  case 'addCat':
   include '../view/addCat.php';
   break;
   case 'addProduct':
   include '../view/addProd.php';
   break;
  case 'newCat':
  //When trying to add a category
  $newCat = filter_input(INPUT_POST, 'categoryName');
  if(empty($newCat)){
    $message = '<p>You must enter a name for the category.</p>';
    include '../view/addCat.php';
    exit;
  }
  $regOutcome = addCategory ($newCat);
  if($regOutcome === 1){
    $message = "<p>$newCat was added to the list.</p>";
    include '../view/addCat.php';
    exit;
   } else {
    $message = "<p>$newCat could not be added. Please try again.</p>";
    include '../view/addCat.php';
    exit;
   }
  break;
  
  case 'newInv':
  //When trying to create a new inventory item
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
  if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) 
  || empty($invPrice) || empty($invSize) || empty($invWeight) || empty($invLocation)
  || empty($categoryId) || empty($invVendor) || empty($invStyle) || empty($invStock)
  ){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/addProd.php';
    exit; 
   }

   // Send the data to the model
$regOutcome = addInvetoryItem($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock,
$invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
// Check and report the result
if($regOutcome === 1){
  $message = "<p>New item $invName added.</p>";
  include '../view/addProd.php';
  exit;
 } else {
  $message = "<p>Product $invName could not be added. Please try again.</p>";
  include '../view/addProd.php';
  exit;
 }
  break;




/* * ********************************** 
* Get Inventory Items by categoryId 
* Used for starting Update & delete process 
* ********************************** */ 
case 'getInventoryItems': 
 // Get the categoryId 
 $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
 // Fetch the products by categoryId from the DB 
 $productsArray = getProductsByCategory($categoryId); 
 // Convert the array to a JSON object and send it back 
 echo json_encode($productsArray); 
 break;



 case 'mod':
 $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if(count($prodInfo)<1){
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/prod-update.php';
 exit;
break;



case 'updateProd':
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
 $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
 $invImg = filter_input(INPUT_POST, 'invImg', FILTER_SANITIZE_STRING);
 $invThumb = filter_input(INPUT_POST, 'invThumb', FILTER_SANITIZE_STRING);
 $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
 $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
 $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
 $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
 $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
 $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

 if (empty($catType) || empty($invName) || empty($invDescription) 
 || empty($invImg) || empty($invThumb) || empty($invPrice) 
 || empty($invStock) || empty($invSize) || empty($invWeight) 
 || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
  $message = '<p>You cannot update a product with an empty field.</p>';
  include '../view/prod-update.php';
  exit;
 }
 $updateResult = updateProduct($catType, $invName, $invDescription, 
  $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, 
  $invLocation, $invVendor, $invStyle, $invId);
 if ($updateResult) {
  $message = "<p>$invName was successfully changed.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
  } else {
   $message = "<p>Error. Could not modify product.</p>";
   include '../view/prod-update.php';
   exit;
 }
 break;


 case 'category':
 $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($categoryName);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }
 include '../view/category.php';
 break;

  default:
  $categoryList = buildCategoryList($categories);
  include '\Web Developement\XAMPP\htdocs\acme\view\prodView.php';
}
?>