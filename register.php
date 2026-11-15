<?php
include 'config.php'; $error=""; $success="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $full_name=$_POST['full_name']; $email=$_POST['email']; $phone=$_POST['phone']; $pass=$_POST['password']; $cpass=$_POST['confirm_password'];$al_stream=$_POST['al_stream']; $role=$_POST['role'];
  if($pass!=$cpass){ $error="Your Password is Wrong!"; }
  else{
    $hash=password_hash($pass,PASSWORD_DEFAULT);
    $stmt=$conn->prepare("SELECT id FROM users WHERE email=?"); $stmt->bind_param("s",$email); $stmt->execute();
    if($stmt->get_result()->num_rows>0){ $error="Email is Already Have!"; }
    else{
      $stmt2=$conn->prepare("INSERT INTO users(full_name,email,password,phone,al_stream,role) VALUES(?,?,?,?,?,?)"); $stmt2->bind_param("ssssss",$full_name,$email,$hash,$phone,$al_stream,$role);
      if($stmt2->execute()) $success="Your Account is Successfully Created!.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account - EduBridge</title>
<link rel="stylesheet" href="css/bootstrap.main.css">
<link rel="stylesheet" href="css/style.css">
</head><body>
<nav class="navbar-login ">
 <a class="logo" href="#"><img src="images/logo.png" class="nav-logo-img"> EduBridge</a>
  <div class="nav-links"><a href="#">Home</a><a href="#">About</a><a href="#">Courses</a><a href="#">Contact</a><a href="login.php" class="btn-orange-nav">Login</a></div>
</nav>

<div class="container">
  <div class="auth-card">
    <div class="auth-left">
      <h2>Welcome Back to<br>EduBridge</h2>
      <p class="desc">Continue your learning journey with thousands of courses and expert mentors.</p>
      <div class="features">
        <div class="feat"><div class="icon">📋</div><div><b>Interactive Learning</b><small>Access live classes, quizzes, and assignments anytime</small></div></div>
        <div class="feat"><div class="icon">📈</div><div><b>Track Your Progress</b><small>Monitor performance and earn certificates as you grow</small></div></div>
        <div class="feat"><div class="icon">🏅</div><div><b>Certified Courses</b><small>Learn from industry experts and get certified</small></div></div>
      </div>
      <div class="trusted">Trusted by 50k+ learners worldwide • 4.8★ rating</div>
    </div>
    <div class="auth-right">
      <h2>Create Account</h2>
      <?php if($error!="") echo "<div class='alert alert-danger'>$error</div>"; ?>
      <?php if($success!="") echo "<div class='alert alert-success'>$success <a href='login.php'>Login</a></div>"; ?>
      <form method="POST">
        <div class="reg-row"><label>Full Name</label><input type="text" name="full_name" placeholder="Enter your full name" required></div>
        <div class="reg-row"><label>Email</label><input type="email" name="email" placeholder="Enter your email" required></div>
        <div class="reg-row"><label>Phone</label><input type="text" name="phone" placeholder="+1 (123) 456-7890"></div>
        <div class="reg-row"><label>Password</label><div class="pass-box"><input type="password" name="password" id="p1" placeholder="Create a password" required><b class="eye" onclick="togglePass('p1')">👁️</b></div></div>
        <div class="reg-row"><label>Confirm Password</label><div class="pass-box"><input type="password" name="confirm_password" id="p2" placeholder="Confirm your password" required><b class="eye" onclick="togglePass('p2')">👁️</b></div></div>
       <div class="reg-row"><label>A/L Stream</label>
                <select name="al_stream">
                    <option>Maths</option>
                    <option>science</option>
                    <option>Art</option>
                    <option>Technology</option>
                    <option>Commerce</option>
                </select>
        </div>
        <div class="reg-row"><label>Role</label><select name="role"><option>Student</option><option>Teacher</option></select></div>
        <button class="btn-create">Create Account</button>
        <div class="or"><hr>OR<hr></div>
        <button type="button" class="btn-google"><img src="https://www.google.com/favicon.ico" width="20"> Continue with Google</button>
      </form>
    </div>
  </div>
  <p class="bottom-center">Already have an account? <a href="login.php">Login</a></p>
</div>
<script src="js/bootstrap.bundle.js"></script>
<script>function togglePass(id){var x=document.getElementById(id);x.type=x.type==="password"?"text":"password";}</script>
</body></html>