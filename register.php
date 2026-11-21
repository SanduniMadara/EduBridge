<?php
include 'config.php';
$error = "";
$success = "";

if (isset($_POST['register'])) {

    // Oya kiyapu names walinma gannawa!
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $stream = '';


// Teacher nam stream eka ain karanawa!
if ($role == 'Teacher') {
    $stream = ''; 
} else {
    $stream = $_POST['stream']??'';
}
    if ($password != $confirm) {
        $error = "Passwords do not match!";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM users_edu WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Me email eka kalin register wela!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // DB eke full_name column ekata $name eka danawa!
            $sql = "INSERT INTO users_edu (name, email, phone, password, role, stream) 
                    VALUES ('$name', '$email', '$phone', '$hash', '$role', '$stream')";

            if (mysqli_query($conn, $sql)) {
                $success = "Register Successful! Name: $name | Stream: $stream";
            } else {
                $error = "DB Error: " . mysqli_error($conn);
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - EduBridge</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  body{
    background: linear-gradient(rgba(10,15,46,0.55), rgba(10,15,46,0.55)), url('images/login-bg.jpg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
  }
  .register-card{ max-width: 560px; width: 100%; border-radius: 20px; }
  .btn-orange{ background: #F58220; color: white; border-radius: 50px; font-weight: bold; padding: 11px; }
  .btn-orange:hover{ background: #e06f10; color: white; }
  .form-control, .form-select{ border-radius: 10px; padding: 11px; }
  .navbar-bg{ background: #0A0F2E; padding-top: 15px !important; padding-bottom: 15px !important; }
</style>
</head>
<body>

<!-- NAVBAR - LOGIN EKE MA -->
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

<!-- REGISTER FORM - CENTER, LOGIN EKATA WADA LOKU -->
<div class="container d-flex justify-content-center align-items-center py-5" style="min-height: 88vh;">
  <div class="card register-card shadow-lg p-4">
    <div class="card-body">
      <h3 class="text-center fw-bold" style="color:#1E2F6B;">Create Account</h3>
      <p class="text-center text-muted mb-4">Join EduBridge to start learning</p>
<?php if($error != ""){ echo "<div class='alert alert-danger'>$error</div>"; } ?>
<?php if($success != ""){ echo "<div class='alert alert-success'>$success</div>"; } ?>



      <form action="" method="POST">
        <label class="fw-bold mb-1">Full Name</label>
        <input type="text" name="name" class="form-control mb-3" placeholder="Enter your full name" required>

        <label class="fw-bold mb-1">Email</label>
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>

        <label class="fw-bold mb-1">Phone</label>
        <input type="text" name="phone" class="form-control mb-3" placeholder="+1 (123) 456-7890">

        <div class="row">
          <div class="col-md-6">
            <label class="fw-bold mb-1">Password</label>
            <input type="password" name="password" class="form-control mb-3" placeholder="Create a password" required>
          </div>
          <div class="col-md-6">
            <label class="fw-bold mb-1">Confirm Password</label>
            <input type="password" name="confirm" class="form-control mb-3" placeholder="Confirm your password" required>
          </div>
        </div>

         <label class="fw-bold mb-1">Role</label>
        <select name="role" id="role" onchange="checkRole()" class="form-select mb-3">
          <option value="Student">Student</option>
          <option value="Teacher">Teacher</option>
        </select>

 <!-- A/L STREAM - STUDENT TA WITHARAI PENNANE -->
        <div id="streamBox">
          <label class="fw-bold mb-1">A/L Stream</label>
          <select name="stream" class="form-select mb-3">
            <option>Maths</option>
            <option>Bio Science</option>
            <option>Commerce</option>
            <option>Arts</option>
            <option>Technology</option>
          </select>
        </div>

  <button type="submit" name="register" class="btn btn-orange w-100">Create Account</button>
        
        <p class="text-center my-3 text-muted">OR</p>
        <button type="button" class="btn btn-light border w-100 rounded-pill">
          <img src="https://www.google.com/favicon.ico" width="18" class="me-2"> Continue with Google
        </button>
        <p class="text-center mt-3 mb-0">Already have an account? <a href="login.php" class="text-danger fw-bold text-decoration-none">Login</a></p>
      </form>
    </div>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

<!-- ROLE JS - MEKA THAMAI MAIN EKA -->

<script>
function togglePass(id){var x=document.getElementById(id);x.type=x.type==="password"?"text":"password";}


function checkRole(){
  var role = document.getElementById('role').value;
  var streamBox = document.getElementById('streamBox');
  var streamInput = document.getElementById('stream');

  if(role == 'Student'){
    streamBox.style.display = 'block';
    streamInput.disabled = false;
    streamInput.required = true;
  } else {
    streamBox.style.display = 'none';
    streamInput.value = ''; // Maths eka ain karanna
    streamInput.disabled = true; // DB ekata yanna epa
    streamInput.required = false;
  }
}
</script>

</body>
</html>