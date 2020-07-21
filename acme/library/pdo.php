<?php
function acmeConnect(){
 $server = 'localhost:3307';
 $dbname= 'acme';
 $username = 'iClient';
 $password = 'P68IpGANgd1ehuhK';
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
 } catch(PDOException $e) {
  header('Location: /acme/view/500.php');
  exit;
 }
}
?>