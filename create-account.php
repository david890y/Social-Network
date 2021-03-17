<?php
$con = mysqli_connect("localhost", "root", "", "sn");
if ($con->mysqli_errno) {
  echo "Database connection failed";
}

if (isset($_POST['submit'])) {
  $fname = strip_tags($_POST['fname']);
  $lname = strip_tags($_POST['lname']);
  $username = strip_tags($_POST['username']);
  $email = strip_tags($_POST['email']);
  $password = $_POST['password'];
  $r_password = $_POST['r_password'];
  $username_check = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
  $usernamerows = $username_check->num_rows;
  if ($usernamerows == 0) {
    if (preg_match('/^[A-Za-z0-9]/', $username)) {
      if ($password == $r_password) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               if (strlen($username) > 3 && strlen($username) < 32) {
                  if (strlen($password) > 8 && strlen($password) < 40) {
                      $newpassword = sha1($password);
                      mysqli_query($con, "INSERT INTO users(first_name, last_name, username, password, email) VALUES('$fname', '$lname', '$username', '$newpassword', '$email')");
                      echo "User successfully added";
                  } else {
                      echo "Invalid Password!";
                  }
               } else {
                   echo "Invalid Username!";
               }
          } else {
              echo "Invalid Email!";
          }
      } else {
          echo "Passwords do not match!";
      }
    } else {
      echo "Your username can only contain letters and numbers";
    }
  } else {
    echo "Username already in use";
  }
}

?>
<h1>Create Account</1><br><br>
<form action="create-account.php" method="post">
    <input type="text" name="fname" value="" placeholder="First name"><br>
    <input type="text" name="lname" value="" placeholder="Last name"><br>
    <input type="text" name="username" value="" placeholder="Username"><br>
    <input type="email" name="email" value="" placeholder="Email"><br>
    <input type="password" name="password" value="" placeholder="Password"><br>
    <input type="password" name="r_password" value="" placeholder="Repeat Password"><br>
    <input type="submit" name="submit" value="Create Account">
</form>
