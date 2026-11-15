<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - EduBridge</title>
<link rel="stylesheet" href="css/bootstrap.main.css">
<link rel="stylesheet" href="css/style.css">
</head><body>

<nav class="navbar-login">
  <a class="logo" href="#"><img src="images/logo.png" class="nav-logo-img"> EduBridge</a>
  <div class="nav-links"><a href="#">Home</a><a href="#">About</a><a href="#">Courses</a><a href="#">Contact</a><a href="register.php" class="btn-orange-nav">Sign Up</a></div>
</nav>

<div class="container">
  <!-- MEKA THAMA IMAGE CARD EKA -->
  <div class="image-card">
    <!-- EKE UDATA LOGIN FORM EKA -->
    <div class="login-on-image">
      <h2>Welcome Back</h2>
      <p class="sub">Log in to continue learning with EduBridge</p>
      <form method="POST">
        <div class="field"><label>Email</label><div class="input-wrap"><span>✉️</span><input type="email" name="email" placeholder="you@example.com" required></div></div>
        <div class="field"><label>Password</label><div class="input-wrap"><span>🔒</span><input type="password" name="password" id="password" placeholder="••••••••••" required><b class="eye" onclick="togglePass('password')">👁️</b></div></div>
        <div class="remember-row"><label><input type="checkbox"> Remember me</label><a href="#">Forgot Password?</a></div>
        <button class="btn-login">Login</button>
        <div class="or"><hr>OR<hr></div>
        <button type="button" class="btn-google"><img src="https://www.google.com/favicon.ico" width="20"> Continue with Google</button>
      </form>
      <p class="bottom">Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
  </div>
</div>
<script>function togglePass(id){var x=document.getElementById(id);x.type=x.type==="password"?"text":"password";}</script>
</body></html>