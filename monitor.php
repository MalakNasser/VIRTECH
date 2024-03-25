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
$user_id =  $_SESSION['id'];

$sql     = "SELECT instance_id FROM users_services where user_id = $user_id";
$result  = $conn->query($sql);
$sql2    = "SELECT id FROM users_firewall where user_id = $user_id";
$result2 = $conn->query($sql2);

$array_id = array();
while ($row  = $result->fetch_assoc()) {
    array_push($array_id, 'PC' . $row['instance_id']);
}
while ($row2 = $result2->fetch_assoc()) {
    array_push($array_id, 'firewall' . $row2['id']);
}

// URL to send the request to
$url = "http://192.168.0.5:5000/listOFinstances";

// Initialize cURL
$curl = curl_init();

$queryParams   = http_build_query($array_id);
$urlWithParams = $url . '?' . $queryParams;

// Set the request options
curl_setopt($curl, CURLOPT_URL, $urlWithParams);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($curl);
$responseData = array();

// Check for errors
if ($response === false) {
    $error = curl_error($curl);
    // Handle the error
    // ...
} else {
    // Decode the JSON response
    $responseData = json_decode($response, true);
}

// Close the cURL session
curl_close($curl);
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
                    <li>Monitoring</li>
                </ol>
                <h2>Monitoring</h2>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= pricing ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <?php
                    if (empty($responseData)) {
                        echo "<div class=\"col-12\">";
                        echo "<p>You have nothing to monitor.</p>";
                        echo "</div>";
                    } else {
                        foreach ($responseData as $param => $row) {
                            $name  = $row[0];
                            $state = $row[1];
                            if (substr($name, 0, 2) === "PC") {

                                echo "<div class=\"col-lg-4\">";
                                echo "<div class=\"box\">";
                                echo "<h3 style=\"font-size: 24px;\">$name</h3>";
                                echo "<ul>";
                                if ($state === 'ACTIVE') {
                                    $action  = 'Turn Off';
                                    echo "<li><i class=\"bx bx-check\"></i>State: ON</li>";
                                } elseif ($state === 'SHUTOFF') {
                                    $action = 'Turn On';
                                    echo "<li><i style=\" color: rgb(196, 6, 6);\" class=\"bx bx-x\"></i>State: OFF</li>";
                                }
                                echo "</ul>";
                                echo "<a href=\"#\" class=\"buy-btn\" id=\"add-btn\">$action</a>";
                                echo "</div>";
                                echo "</div>";
                            } else {
                                $firewall_id = substr($name, -1);
                                $firewall_id = intval($firewall_id);
                                $sql3    = "SELECT ip FROM users_firewall where id = $firewall_id";
                                $result3 = $conn->query($sql3);
                                $row3    = $result3->fetch_assoc();
                                $ip      = $row3['ip'];

                                echo "<div class=\"col-lg-4\">";
                                echo "<div class=\"box\">";
                                echo "<h3 style=\"font-size: 24px;\">Firewall</h3>";

                                echo "<ul>";
                                if ($state === 'ACTIVE') {
                                    $action  = 'Turn Off';
                                    echo "<li><i class=\"bx bx-check\"></i>State: ON</li>";
                                } elseif ($state === 'SHUTOFF') {
                                    echo "<ul>";
                                    $action = 'Turn On';
                                    echo "<li><i style=\" color: rgb(196, 6, 6);\" class=\"bx bx-x\"></i>State: OFF</li>";
                                }
                                echo "<li><i class=\"bx bx-check\"></i>IP: $ip</li>";
                                echo "</ul>";

                                echo "<a href=\"#\" class=\"buy-btn\" id=\"add-btn\">$action</a>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>
                </div>
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

</html>