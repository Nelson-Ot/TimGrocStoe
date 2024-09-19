<?php 
include 'includes/header.php';

//Code for Registration 
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $pass=md5($_POST['password']);
$ret=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' and password='$pass'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="users-dashboard.php";
$_SESSION['login']=$num['name'];
$_SESSION['id']=$num['id'];
$_SESSION['email']=$num['email'];
echo "<script>window.location.href='".$extra."'</script>";
exit();
}
else
{
    echo "<script> alert('wrong credentials!');  </script>";
    $extra="login.php?error";
echo "<script>window.location.href='".$extra."'</script>";
exit();
}

}

?>
<section>
<div class="reg-container">
         <h1>Login</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Already have an account? <a href="register.php">Register here</a></p> 
    </div>
</section>
   
</body>
</html>
