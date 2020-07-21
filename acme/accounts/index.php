<!-- This is the accounts controller -->
<?php
session_start();
require_once '../library/pdo.php';
require_once '../model/acme-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 
 
 $navList = navigate(getCategories());

 if(isset($_COOKIE['firstName'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);
}

 switch ($action){
 case 'login':
  include 'view/login.php';
  break;
  case 'regPage':
  include 'view/register.php';
  break;








  // ------------------- |
  // Register a new user |
  // ------------------- |
  case 'register':
  // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$clientEmail = checkEmail($clientEmail);
$checkPass = checkPassword($clientPassword);

// Check to see if the email is already in use.
$existingEmail = uMail($clientEmail);
// Check for existing email address in the table
if($existingEmail){
 $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
 include 'view/register.php';
 exit;
}


// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)
 || empty($checkPass)){
  $message = '<p>Please provide information for all empty form fields.</p>';
  include 'view/register.php';
  exit; 
 }
 

// Send the data to the model
// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
// Check and report the result
if($regOutcome === 1){
  setcookie('firstName', $clientFirstname, strtotime('+1 year'), '/');
  $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
  include 'view/login.php';
  exit;
 } else {
  $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
  include 'view/register.php';
  exit;
 }
  break;






  // --------------- |
  // Log a client in |
  // --------------- |
  case 'Log':
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $valEmail = checkEmail($clientEmail);
  $valPassword = checkPassword($clientPassword);

  if(empty($valEmail) || empty($valPassword)){
    $message = '<p>Your Email or Password is incorrect. Please try again</p>';
    include 'view/login.php';
    exit;
  }
 // A valid password exists, proceed with the login process
 // Query the client data based on the email address
 $clientData = getClient($clientEmail);
 // Compare the password just submitted against
 // the hashed password for the matching client
 $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
 // If the hashes don't match create an error
 // and return to the login view
 if (!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include 'view/login.php';
  exit; 
 }
 // A valid user exists, log them in
 $_SESSION['loggedin'] = TRUE;
 setcookie('firstName', $clientData['clientFirstname'], strtotime('+1 year'), '/');
 // Remove the password from the array
 // the array_pop function removes the last
 // element from an array
 array_pop($clientData);
 // Store the array into the session
 $_SESSION['clientData'] = $clientData;
 // Send them to the admin view
 include '../view/admin.php'; 
 break;

case 'admin':
include '../view/admin.php';
break;


case 'logout':
session_destroy();
header('Location: /acme/index.php');
exit;
break;

 default:
  include 'view/home.php';
}
exit;
?>