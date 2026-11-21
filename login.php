<?php
session_start();
include 'config.php';

$error = "";
$success = "";

if (isset($_GET['success'])) {
    $success = "Account created successfully! Please login.";
}

if (isset($_POST['login'])) {
  
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users_edu WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];
            $_SESSION['user_email'] = $row['email'];
             $_SESSION['user_stream'] = $row['stream'];

            // Redirect based on Role
            if ($row['role'] == 'Teacher') {
                header("Location: teacher_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
            exit();
        } else {
            $error = "Incorrect password. Please try again.";
        }
    } else {
        $error = "No user found with this email address.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - EduBridge</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  body{
  background-image: linear-gradient(rgba(10, 15, 46, 0.55), rgba(10, 15, 46, 0.55)), url('images/login-bg.jpg');
  background-repeat: no-repeat;
  background-position: center center;
  background-attachment: fixed;
  background-size: cover;
  min-height: 100vh;
}
  .login-card{ max-width: 430px; width: 100%; border-radius: 20px; }
  .btn-orange{ background: #F58220; color: white; border-radius: 50px; font-weight: bold; padding: 11px; }
  .btn-orange:hover{ background: #e06f10; color: white; }
  .form-control{ border-radius: 10px; padding: 11px; }
  .navbar-bg{ background: #0A0F2E; padding-top: 15px; padding-bottom: 15px; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-bg">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="#">
      <img src="images/logo.png" width="32" class="me-2 rounded-circle"> EduBridge
    </a>
    <div class="ms-auto d-none d-lg-flex align-items-center gap-4">
      <a href="#" class="text-white text-decoration-none">Home</a>
      <a href="#" class="text-white text-decoration-none">About</a>
      <a href="#" class="text-white text-decoration-none">Courses</a>
      <a href="#" class="text-white text-decoration-none">Contact</a>
      <a href="register.php" class="btn btn-danger btn-sm px-4 fw-bold">Sign Up</a>
    </div>
  </div>
</nav>

<!-- CENTER FORM -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 88vh;">
  <div class="card login-card shadow-lg p-4">
    <div class="card-body">
      <h3 class="text-center fw-bold" style="color:#1E2F6B;">Welcome Back</h3>
      <p class="text-center text-muted mb-4">Log in to continue learning with EduBridge</p>

      <?php if($error != ""){ ?>
      <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php } ?>

    <?php if($success != ""){ ?>
      <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php } ?>



      <form action="login.php" method="POST">
        <label class="fw-bold mb-1">Email</label>
        <div class="input-group mb-3">
          <span class="input-group-text">📧</span>
          <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
        </div>

        <label class="fw-bold mb-1">Password</label>
        <div class="input-group mb-2">
          <span class="input-group-text">🔒</span>
          <input type="password" name="password" class="form-control" placeholder="********" required>
        </div>

        <div class="d-flex justify-content-between mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <a href="#" class="text-decoration-none text-danger small">Forgot Password?</a>
        </div>

        <button type="submit"  name="login"class="btn btn-orange w-100">Login</button>
        <p class="text-center my-3 text-muted">OR</p>
        <button type="button" class="btn btn-light border w-100 rounded-pill">
          <img src="https://www.google.com/favicon.ico" width="18" class="me-2"> Continue with Google
        </button>
        <p class="text-center mt-3 mb-0">Don't have an account? <a href="register.php" class="text-danger fw-bold text-decoration-none">Sign Up</a></p>
      </form>
    </div>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>