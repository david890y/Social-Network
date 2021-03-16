<?php
$con = mysqli_connect("localhost", "root", "", "sn");
if ($con->mysqli_errno) {
  echo "Database connection failed";
} else {
  echo "Database connection was successful";
}

$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$username = strip_tags($_POST['username']);
$email = strip_tags($_POST['email']);
$password = $_POST['password'];
$r_password = $_POST['r_password'];
if (isset($_POST['submit'])) {
    if ($password == $r_password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
             if (strlen($username) > 3 && strlen($username) < 32) {
                if (strlen($password) > 8 && strlen($password) < 40) {
                    echo "True";
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
