<?php
include 'database.php';
session_start();

if(isset($_POST['login'])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "select * from customer where cus_email='$email' and cus_password='$password'";
    $sql_a = "select * from admin where admin_email='$email' and admin_password='$password'";

    $result = mysqli_query($mysqli,$sql);
    $result_a = mysqli_query($mysqli,$sql_a);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        $_SESSION["ID"] = $row['id']  ;
		    $_SESSION["Cu_Name"] = $row['cus_name'] ;
        mysqli_close($mysqli);
        header("Location: customer/index.php");
        
    }
    else if(mysqli_num_rows($result_a)>0){
      $_SESSION["ID"] = $row['id']  ;
      $_SESSION["Cu_Name"] = $row['cus_name'] ;
      mysqli_close($mysqli);
      header("Location: admin/dashboard.php");
      
    }
    else{
      $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Epic Car Rental</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
        <img src="login.jpg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <img src="reg.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          <form action="" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email"  name="email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password" class="password">
                <i class='bx bx-hide eye-icon'></i>
              </div><?php if (isset($error)) { echo $error; } ?>
              <div class="text"><a href="forgotpass and login page\forgotpassword2.php">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Sign up</div>
        <form method="POST" action="reg.php">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your  full name"  name ="name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your username" name="username" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" pattern="[A-Za-z0-9]+@[A-Za-z0-9]+.com" name="email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" oninput="strengthChecker()" placeholder="Enter your password" class="password" name="password" required>
                <i class='bx bx-hide eye-icon'></i>
              </div>
              <div id="strength-bar"></div>
              <p id="message"></p>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirm" oninput="strengthChecke()" placeholder="Comfirm your password" class="password" name="confirm" required>
                <i class='bx bx-hide eye-icon'></i>
              </div>
              <div id="streng-bar"></div>
              <p id="messages"></p>
              <div class="button input-box">
                <input type="submit" onclick="checkPassword()" value="Sumbit">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>