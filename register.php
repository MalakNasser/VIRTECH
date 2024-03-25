<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>
<link href="assets/css/login-style.css" rel="stylesheet">

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.php">Virtech</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        </div>
    </header>
    <!-- End Header -->

    <div class="container-log" style="margin-top: 50px;">
        <div class="box form-box">
            <?php

            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "graduation_project";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                //verifying the unique email

                $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {

                    mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$username','$email','$password')") or die("Error Occured");

                    echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button>";
                }
            } else {
                $conn->close();
            ?> 

                <header>Sign Up</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Register" required>
                    </div>

                    <div class="links">
                        Already a member? <a href="index.php">Sign In</a>
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>

    <div id="preloader"></div>
    <?php include("templates/js.php"); ?>

</body>

</html>