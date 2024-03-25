<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>
<link href="assets/css/login-style.css" rel="stylesheet">

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index.php">Virtech</a></h1>
    </div>
  </header>
  <!-- End Header -->

  <div class="container-log">
    <div class="box form-box">
      <?php
      session_start();

      $servername = "localhost";
      $username   = "root";
      $password   = "";
      $dbname     = "graduation_project";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if (isset($_POST['submit'])) {
        $name     = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE name='$name' AND password='$password' ") or die("Select Error");
        $row    = mysqli_fetch_assoc($result);

        if (is_array($row) && !empty($row)) {
          $_SESSION['valid']    = $row['email'];
          $_SESSION['name']     = $row['name'];
          $_SESSION['id']       = $row['id'];
          $_SESSION['password'] = $row['password'];
        } else {
          echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
          echo "<a href='index.php'><button class='btn'>Go Back</button>";
        }
        if (isset($_SESSION['valid'])) {
          header("Location: home.php");
        }
      } else {
      ?>
        <header>Login</header>
        <form action="" method="post">
          <div class="field input">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" autocomplete="off" required>
          </div>

          <div class="field input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" required>
          </div>

          <div class="field">

            <input type="submit" class="btn" name="submit" value="Login" required>
          </div>
        </form>
    </div>
  <?php } ?>
  </div>
  
  <div id="preloader"></div>
  <?php include("templates/js.php"); ?>

</body>

</html>