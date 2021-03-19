<?php
require_once('includes/connect.php');
if (isset($_POST['login'])) {
  $username = strip_tags($_POST['username']);
  $password = sha1($_POST['password']);

  $user_check = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password' OR email='$username' AND password='$password'");
  $num_rows = $user_check->num_rows;
  if($num_rows == 1) {
    echo "User is valid";
  } else {
    echo "Username or password incorrect";
  }
}

 ?>

 <h1>Login to your account</h1>
 <form action="login.php" method="post">
   <input type="text" name="username" placeholder="Username or email"><br>
   <input type="password" name="password" placeholder="Password" autocomplete="new-password"><br>
   <input type="submit" name="login" placeholder="Login">
 </form>

 <a href="create-account.php">Need an account? Signup here</a>
