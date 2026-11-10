<?php
session_start();
include 'config.php';
$error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email=$_POST['email']; $pass=$_POST['password'];
  $result=$conn->query("SELECT * FROM users WHERE email='$email'");
  if($result->num_rows>0){
    $user=$result->fetch_assoc();
    if(password_verify($pass,$user['password'])){
      $_SESSION['user_id']=$user['id']; $_SESSION['full_name']=$user['full_name']; $_SESSION['role']=$user['role'];
      header("Location: dashboard.php"); exit();
    } else { $error="Password eka waradi!"; }
  } else { $error="Me email eken account ekak na!"; }
}
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - EduBridge</title>
<link rel="stylesheet" href="css/style.css">
</head><body>
  <div class="navbar-login">
    <a class="logo" href="#"><span class="cap">🎓</span> EduBridge</a>
    <div class="nav-links"><a href="#">Home</a><a href="#">About</a><a href="#">Courses</a><a href="#">Contact</a><a href="register.php" class="btn-orange-nav">Sign Up</a></div>
  </div>
<div class="container">
  <div class="card">
    <div class="left">
      <h2>Welcome Back to<br>EduBridge</h2>
      <p class="desc">Continue your learning journey with thousands of courses and expert mentors.</p>
      <div class="features">
        <div class="feat"><div class="icon">📋</div><div><b>Interactive Learning</b><small>Access live classes, quizzes, and assignments anytime</small></div></div>
        <div class="feat"><div class="icon">📈</div><div><b>Track Your Progress</b><small>Monitor performance and earn certificates as you grow</small></div></div>
        <div class="feat"><div class="icon">🏅</div><div><b>Certified Courses</b><small>Learn from industry experts and get certified</small></div></div>
      </div>
      <div class="trusted">Trusted by 50k+ learners worldwide • 4.8★ rating</div>
    </div>
    <div class="right">
      <h2>Welcome Back</h2><p class="sub">Log in to continue learning with EduBridge</p>
      <?php if($error!="") echo "<div class='alert alert-danger'>$error</div>"; ?>
      <form method="POST">
        <div class="login-field"><label>Email</label><div class="input-wrap"><span class="left-icon">✉️</span><input type="email" name="email" class="login-input" placeholder="you@example.com" required></div></div>
        <div class="login-field"><label>Password</label><div class="input-wrap"><span class="left-icon">🔒</span><input type="password" name="password" id="password" class="login-input" placeholder="••••••••••" required><span class="eye" onclick="togglePass('password')">👁️</span></div></div>
        <div class="remember-row"><label><input type="checkbox"> Remember me</label><a href="#">Forgot Password?</a></div>
        <button type="submit" class="btn-login">Login</button>
        <div class="or-login"><hr>OR<hr></div>
        <button type="button" class="btn-google-login"><span class="g-letter">G</span> Continue with Google</button>
      </form>
    </div>
  </div>
  <p class="bottom">Don't have an account? <a href="register.php">Sign Up</a></p>
</div>
<script>function togglePass(id){var x=document.getElementById(id);x.type=x.type==="password"?"text":"password";}</script>
</body></html>