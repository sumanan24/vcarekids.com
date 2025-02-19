<!DOCTYPE html>
<html lang="en">
<?php include('includes/config.php') ?>

<head>
    <meta charset="utf-8">
    <title>Vcare Kids</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="Details">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap1.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .apply-section {
            padding: 15px;
            background: #c8e6c9;
            border-left: 5px solid #388e3c;
            border-radius: 5px;
            margin: 10px 0;
        }

        .apply-section ul {
            list-style: none;
            padding: 0;
        }

        .apply-section li {
            font-size: 16px;
            margin: 5px 0;
        }

        .apply-section a {
            text-decoration: none;
            font-weight: bold;
            color: #388e3c;
        }

        .apply-section a:hover {
            text-decoration: underline;
        }

        .fixed-size-image {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .img1 {
            width: 50%;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .donor-marquee {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            background-color: yellow;
            padding: 10px;
            text-transform: capitalize;
            font-size: 20px;
            color: black;
            animation: blink-border 1s infinite alternate;
        }

        .donor-marquee span {
            display: inline-block;
            animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        @keyframes blink-border {
            0% {
                border-color: red;
            }

            50% {
                border-color: blue;
            }

            100% {
                border-color: green;
            }
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-phone me-2"></i>+1-416-644-1113</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@vcarekids.org</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-white-50 ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <div class="blinking-text">
            <!-- <p style="text-align: center; font-size: 18px;" class="p-2">Our Donars</p> -->
            <div class="donor-marquee">
                <span>Our Honorable Donors:
                    <?php
                    $sql = "SELECT donarfullname FROM donars";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo  "<b>" . $row["donarfullname"] . "</b> ( 02 Students ) |  ";
                        }
                    }
                    ?>

                </span>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0"> VanniShangam<span class="text-white">Vcarekids</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link active">Activites</a>
                    <a href="donar.php" class="nav-item nav-link">Donars</a>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn btn-outline-secondary py-2 px-3" href="donate.php">
                        Donate Now
                    </a>&nbsp;
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Donars Information</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item text-light active" aria-current="page">Donars</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container">
    <?php
    $categories = ["bicycle_donation", "computer_donation", "scholarship_payment"];

    foreach ($categories as $category) {
        // Fetch donors based on category
        $sql = "SELECT d.donarfullname, d.Country, d.photo, COUNT(s.id) AS studentcount 
                FROM donars d 
                JOIN students s ON d.id = s.donar_id 
                WHERE s.category = '$category' 
                GROUP BY d.id 
                ORDER BY COUNT(s.id) DESC;";

        $result = $con->query($sql);

        // Display category only if there are donors
        if ($result->num_rows > 0) {
    ?>
            <h3 class='text-dark my-4'><?php echo $category; ?></h3>
            <div class='row g-4 justify-content-center'>
                <?php

                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card shadow-lg text-center p-3" style=" height: 350px; width: 100%;">
                            <!-- Donor Image (Circular) -->
                            <div class="d-flex justify-content-center">
                                <img src="<?php echo !empty($row['photo']) ? 'data:image/jpeg;base64,' . base64_encode($row['photo']) : 'default-donor.jpg'; ?>"
                                    alt="Donor Image"
                                    class="rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #ddd;">
                            </div>

                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['donarfullname']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($row['Country']); ?></p>
                                <span class="badge bg-dark">Sponsored Students: <?php echo $row['studentcount']; ?></span>
                            </div>
                        </div>
                    </div>
        <?php
                }
                echo "</div>"; // Close row
            }
        }
        ?>
    </div>


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-4">
                        <h1 class="fw-bold text-primary m-0">Vcare<span class="text-white">kids</span></h1>
                        <p>Smart Eye is a leading provider of information technology, consulting, and business process services. Our dedicated employees offer strategic insights, technological expertise and industry experience.</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square me-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square me-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square me-1" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h5 class="text-light mb-4">Address</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>8-3500 McNicoll Ave,Scarborough,ON,Canada,M1V 4C7</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+1-416-644-1113</p>
                        <p><i class="fa fa-envelope me-3"></i>info@vcarekids.org</p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <h5 class="text-light mb-4">Quick Links</h5>
                        <a class="btn btn-link" href="">Home</a>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Donation</a>
                    </div>

                </div>
            </div>
            <div class="container-fluid copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a href="#">vcarekids</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="">SICODE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-sm btn-dark btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/parallax/parallax.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>