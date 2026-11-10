<?php
include 'config.php';
$error=""; $success="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $full_name=$_POST['full_name']; $email=$_POST['email']; $phone=$_POST['phone'];
  $pass=$_POST['password']; $cpass=$_POST['confirm_password']; $role=$_POST['role'];
  if($pass != $cpass){ $error="Passwords match wenne na!"; }
  else{
    $hash=password_hash($pass, PASSWORD_DEFAULT);
    $check=$conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows>0){ $error="Me email eka already thiyenawa!"; }
    else{
      $sql="INSERT INTO users(full_name,email,password,phone,role) VALUES('$full_name','$email','$hash','$phone','$role')";
      if($conn->query($sql)){ $success="Account eka haduna! Dan Login wenna."; }
      else{ $error="Error: ".$conn->error; }
    }
  }
}
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account - EduBridge</title>
<link rel="stylesheet" href="css/style.css">
</head><body>
     <div class="navbar-login">
    <a class="logo" href="#"><span class="cap">🎓</span> EduBridge</a>
    <div class="nav-links"><a href="#">Home</a><a href="#">About</a><a href="#">Courses</a><a href="#">Contact</a><a href="login.php" class="btn-orange-nav">Sign In</a></div>
  </div>
<div class="container">
 
  <div class="card">
    <div class="left">
      <h2>Create Your Account</h2><h4>Join EduBridge</h4>
      <div class="features">
        <div class="feat"><div class="icon">✓</div><b>Access 500+ Courses</b></div>
        <div class="feat"><div class="icon">🔖</div><b>Learn from Industry Experts</b></div>
        <div class="feat"><div class="icon">🎓</div><b>Track Progress & Certificates</b></div>
      </div>
      <div class="trusted">Trusted by 10k+ Learners Worldwide</div>
    </div>
    <div class="right">
      <h2>Create Account</h2>
      <?php if($error!="") echo "<div class='alert alert-danger'>$error</div>"; ?>
      <?php if($success!="") echo "<div class='alert alert-success'>$success <a href='login.php'>Login</a></div>"; ?>
      <form method="POST">
        <div class="reg-row"><label>Full Name</label><input type="text" name="full_name" placeholder="Enter your full name" required></div>
        <div class="reg-row"><label>Email</label><input type="email" name="email" placeholder="Enter your email" required></div>
        <div class="reg-row"><label>Phone</label><input type="text" name="phone" placeholder="+1 (123) 456-7890"></div>
        <div class="reg-row"><label>Password</label><div class="pass-box"><input type="password" name="password" id="password" placeholder="Create a password" required><span class="eye" onclick="togglePass('password')">👁️</span></div></div>
        <div class="reg-row"><label>Confirm Password</label><div class="pass-box"><input type="password" name="confirm_password" id="cpassword" placeholder="Confirm your password" required><span class="eye" onclick="togglePass('cpassword')">👁️</span></div></div>
        <div class="reg-row"><label>Role</label><select name="role"><option value="Student">Student</option><option value="Teacher">Teacher</option></select></div>
        <button type="submit" class="btn-create">Create Account</button>
        <div class="or-reg"><hr>OR<hr></div>
        <button type="button" class="btn-google-reg"><span class="g-letter">G</span> Continue with Google</button>
      </form>
    </div>
  </div>
  <p class="bottom">Already have an account? <a href="login.php">Login</a></p>
</div>
<script>function togglePass(id){var x=document.getElementById(id);x.type=x.type==="password"?"text":"password";}</script>
</body></html>