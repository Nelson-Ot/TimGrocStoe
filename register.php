<?php 
include 'includes/header.php';

//Code for Registration 
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	
	$enc_password= md5($password);
    $sql=mysqli_query($conn,"select id from users where email='$email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
} else{
	$msg=mysqli_query($conn,"insert into users(name,email,phone,password) values('$name','$email','$phone','$enc_password')");

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
<section>
<div class="reg-container">
         <h1>Register</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.html">Login here</a></p> 
    </div>
</section>
   
</body>
</html>
