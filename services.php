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


$sql = "SELECT * 
from services";
$result = $conn->query($sql);

function convertToGB($megabytes)
{
    if ($megabytes < 1024) {
        return $megabytes . " MB";
    } else {
        $gigabytes = $megabytes / 1024;
        return number_format($gigabytes, 1) . " GB";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="home.php">Virtech</a></h1>
            <?php
            $name = $_SESSION['name'];
            $id   =  $_SESSION['id'];
            echo  "<p id=\"welcome\">welcome, $name</p>";
            ?>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="home.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="home.php">Home</a></li>
                    <li>Add services</li>
                </ol>
                <h2>Add services</h2>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= pricing ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $name      = $row["name"];
                            $cpu       = $row["cpu"];
                            $RAM       = $row["RAM"];
                            $price     = $row["price"];
                            $RAM       = convertToGB($RAM);
                            $hard_disk = $row["hard_disk"];


                            echo "<div id=\"gap\" class=\"col-lg-4\">";
                            echo "<div class=\"box\">";
                            echo "<h3 style=\"font-size: 24px;\">$name</h3>";

                            echo "<ul>";
                            echo "<li><i class=\"bx bx-check\"></i>CPU: $cpu</li>";
                            echo "<li><i class=\"bx bx-check\"></i>RAM: $RAM</li>";
                            echo "<li><i class=\"bx bx-check\"></i>Hard disk: $hard_disk GB</li>";
                            echo "<li><i class=\"bx bx-check\"></i>Price: $price $</li>";
                            echo "</ul>";

                            echo "<div id=\"loading-overlay\">";
                            echo "<div id=\"loading-circle\"></div>";
                            echo "</div>";

                            echo "<a href=\"#\" class=\"buy-btn\" onclick=\"handleClick($id)\" id=\"add-btn\">Add</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                </div>
        </section>
        <!-- End Pricing Section -->

    </main>
    <!-- End #main -->

    <div id="contact">
        <?php include("templates/footer.php"); ?>
    </div>


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Scripts-->
    <?php include("templates/js.php"); ?>

</body>

</html