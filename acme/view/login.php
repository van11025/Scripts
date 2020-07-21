<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACME</title>
    <meta name="author" content="Michael Vance">
    <link rel="stylesheet" href="../css/screen.css" media="screen" type="text/css">
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
    <?php
if (isset($message)) {
 echo $message;
}?>
<form id="loginForm" method='post' action="/acme/accounts/index.php">
<h1>Login to Acme!</h1>
  <label for="clientPassword">Username:</label><br>
  <input type="email" name="clientEmail" id="clientEmail" required
  <?php if (isset($clientEmail)){echo "value='$clientEmail'";}?>><br>
  <label for="clientPassword">Password:</label><br>
  <input type="password" name="clientPassword" id="clientPassword" required
  <?php if (isset($clientPassword)){echo "value='$clientPassword'";}?>><br>
  <button type="submit" name="submit" id="logbtn" value="Log">Login</button><br>
  <br>
  
  <br>
  <p id="newUser">Not a member? <a href="/acme/accounts/index.php?action=regPage">Register</a></p>
  <input type="hidden" name="action" value="Log">
</form>
    </main>
    <footer>
        <?php include('../library/footer.php'); ?>
    </footer>
    </div>
</body>
</html>