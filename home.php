<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php"); ?>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="home.php">Virtech</a></h1>
            <?php
            session_start();
            $name = $_SESSION['name'];
            $id   =  $_SESSION['id'];
            echo  "<p id=\"welcome\">welcome, $name</p>";
            ?>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>Better Connections, Better Results</h1>
                    <h2>Empowering Networks, Simplifying Growth</h2>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <p>
                            Welcome to our website dedicated to providing SDN and NFV services.
                            Our graduation project focuses on creating instances, such as firewalls,
                            tailored to meet the specific needs of users.
                            Get to know our team and learn more about our journey in the world of software-defined networking and network function virtualization.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> Our project focuses on delivering SDN and NFV services that allow users to create customized instances, specifically tailored to their needs. We specialize in providing firewall solutions to enhance network security and meet individual requirements.</li>
                            <li><i class="ri-check-double-line"></i> Our dedicated team comprises skilled individuals with expertise in software-defined networking and network function virtualization. Throughout our project journey, we have encountered and successfully overcome various challenges, enabling us to achieve significant milestones in the field.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <ul>
                            <li><i class="ri-check-double-line"></i> Looking ahead, we have ambitious plans to expand our services and contribute further to the advancement of SDN and NFV technologies. We welcome inquiries, collaborations, and partnerships to drive innovation and explore new possibilities in this exciting domain. For more information or to get in touch, please contact us through the provided contact details</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Us Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Services</h2>
                </div>

                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="100" onclick="location.href='monitor.php';">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-binoculars"></i></div>
                            <h4><a>Monitoring</a></h4>
                            <p>Stay in control of your instances with our comprehensive monitoring system.</p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200" onclick="location.href='services.php';">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-tools"></i></div>
                            <h4><a>Add service</a></h4>
                            <p>Expand your network capabilities with ease by adding new services to your existing instances.</p>
                        </div>
                    </div>
                </div>

            </div>

            </div>
        </section>
        <!-- End Services Section -->

        <div id="contact">
            <?php include("templates/footer.php"); ?>
        </div>

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Scripts-->
        <?php include("templates/js.php"); ?>

</body>

</html>