<div>
<?php
if (isset($message)) {
 echo $message;
}
?>
<form id="regForm" method="post" action="/acme/accounts/index.php">
<h1>Welcome to Acme!</h1>
    <label for="clientFirstname">First name:</label>
    <br>
  <input type="text" name="clientFirstname" id="clientFirstname" required>
  <br>
  <label for="clientLastname">Last Name:</label>
  <br>
  <input type="text" name="clientLastname" id="clientLastname" required>
  <br>
  <label for="clientEmail">Email:</label>
  <br>
  <input type="email" name="clientEmail" id="clientEmail required">
  <br>
  <label for="clientPassword">Password:</label>
  <br>
  <input type="password" name="clientPassword" id="clientPassword" required
  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
  <br>
  <br>
  <span>Password must be 8 characters minimum, with 1 uppercase, number, and special character.</span>
  <br>
  <button type="submit" name="submit" id="regbtn" value="Register">Register</button><br>
  <br>
  <input type="hidden" name="action" value="register">
</form>
</div>