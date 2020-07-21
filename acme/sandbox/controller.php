<?php
require_once '../library/pdo.php';
require_once 'sandboxModel.php';

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

   $stuffs = getStuff();
 $pracStuff = '<ul>';
   foreach($stuffs as $stuff) {
     $pracStuff .= "<li>$stuff</li>";
   }
   $pracStuff .= '</ul>';


 switch ($action){
 case 'something':
  break;
 default:
  include 'D:\Web Developement\XAMPP\htdocs\acme\sandbox\view.php';
}
exit;
?>