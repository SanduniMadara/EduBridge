<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Student'){
    header("Location: login.php");
    exit();
}

$name = $_SESSION['user_name'];
$stream = $_SESSION['user_stream'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<style>
body{font-family:Arial; background:#f4f6f8; margin:0; padding:20px;}
.box{background:white; padding:20px; border-radius:12px; max-width:800px; margin:auto; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
.card{background:#e0f7fa; padding:15px; border-radius:10px; margin-top:15px;}
a{color:red; text-decoration:none; font-weight:bold;}
</style>
</head>
<body>
<div class="box">
  <h2>Welcome Student, <?php echo $name; ?> 🎓</h2>
  <p>Your Stream: <b><?php echo $stream; ?></b></p>

  <div class="card">
    <h3>My Subjects</h3>
    <?php
    if($stream == 'Maths'){
      echo "<p>📐 Combined Maths</p><p>⚗️ Chemistry</p><p>⚡ Physics</p>";
    } else if($stream == 'Bio'){
      echo "<p>🧬 Biology</p><p>⚗️ Chemistry</p><p>⚡ Physics</p>";
    } else if($stream == 'Commerce'){
      echo "<p>📊 Accounting</p><p>💼 Business Studies</p><p>📈 Economics</p>";
    } else if($stream == 'Arts'){
      echo "<p>📚 History</p><p>🌍 Geography</p><p>📖 Sinhala</p>";
    } else {
      echo "<p>Stream eka select wela na!</p>";
    }
    ?>
  </div>

  <br><a href="logout.php">Logout</a>
</div>
</body>
</html>