<?php
session_start();
error_reporting(0);
include("connect.php");
if(isset($_POST['login']))
{
  $adminemail=$_POST['email'];
  $pass=md5($_POST['password']);
$ret=mysqli_query($conn,"SELECT * FROM admins WHERE email='$adminemail' and password='$pass'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="admin-dashboard.php";
$_SESSION['login']=$num['name'];
$_SESSION['id']=$num['id'];
$_SESSION['email']=$num['email'];
echo "<script>window.location.href='".$extra."'</script>";
exit();
}
else
{
    echo "<script> alert('wrong credentials!');  </script>";
}
$extra="login.php";
echo "<script>window.location.href='".$extra."'</script>";
exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="login-registration">
        <div class="login-form">
            <h2>Admin Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register Here</a></p>
        </div>

    </div>

</body>

</html>