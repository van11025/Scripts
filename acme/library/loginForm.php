<div>
<?php
if (isset($message)) {
 echo $message;
}?>
<form id="loginForm" method="post">
<h1>Login to Acme!</h1>
  <label for="clientPassword">Username:</label><br>
  <input type="email" name="clientEmail" id="clientEmail" required><br>
  <label for="clientPassword">Password:</label><br>
  <input type="password" name="clientPassword" id="clientPassword" required><br>
  <button type="submit" name="submit" id="logbtn" value="Log">Login</button><br>
  <br>
  <input type="hidden" name="action" value="log">
  <br>
  <p id="newUser">Not a member? <a href="/acme/accounts/index.php?action=regPage">Register</a></p>
</form>
</div>