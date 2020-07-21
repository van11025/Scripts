<?php
session_start();
require_once 'library/pdo.php';
require_once 'model/acme-model.php';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 
 
 $categories = getCategories();
 $navList = '<ul>';
 $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
   foreach($categories as $category) {
     $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
   }
   $navList .= '</ul>';

if(isset($_COOKIE['firstName'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);
}

 switch ($action){
 case 'something':
  break;
 default:
  include 'view/home.php';
}
exit;
?>