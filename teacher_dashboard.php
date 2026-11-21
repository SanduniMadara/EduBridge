<?php
session_start();
include 'config.php'; // oya ge db connect file eka

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Teacher'){
    header("Location: login.php");
    exit();
}

$name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Dashboard</title>
<style>
body{font-family:Arial; background:#f4f6f8; margin:0; padding:20px;}
.box{background:white; padding:20px; border-radius:12px; max-width:800px; margin:auto; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
.card{background:#eef2ff; padding:15px; border-radius:10px; margin-top:15px;}
a{color:red; text-decoration:none; font-weight:bold;}
</style>
</head>
<body>
<div class="box">
  <h2>Welcome Teacher, <?php echo $name; ?> 👨‍🏫</h2>
  <p>Role: Teacher</p>

  <div class="card">
    <h3>Students List</h3>
    <?php
    $res = mysqli_query($conn, "SELECT name, email, stream FROM users_edu WHERE role='Student'");
    if(mysqli_num_rows($res) > 0){
      while($row = mysqli_fetch_assoc($res)){
        echo "<p>👤 ".$row['name']." - ".$row['stream']." - ".$row['email']."</p>";
      }
    } else {
      echo "<p>Thama students la na!</p>";
    }
    ?>
  </div>

  <br><a href="logout.php">Logout</a>
</div>
</body>
</html>
