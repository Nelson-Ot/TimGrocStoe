<?php 
session_start();
 require_once('connect.php');
// require_once('dbconnect.php');
//Code for Registration 
if(isset($_POST['submit']))
{
	$fname=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$enc_password= md5($password);
    $sql=mysqli_query($conn,"select id from admins where email='$email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
} else{
	$msg=mysqli_query($conn,"insert into admins(name,email,password) values('$fname','$email','$enc_password')");

if($msg)
{
	echo "<script>
                    alert('Account created successfully!');
                    window.location.href = 'login.php';
                  </script>";
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-registration">

    
    <div class="registration-form">
        <h2>Admin Registration</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
    </div>
</body>
</html>
