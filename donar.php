<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vcare Kids - Donors</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .img1 {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .donor-card {
            height: 350px;
            width: 100%;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .donor-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #ddd;
            border-radius: 50%;
        }
        .donor-marquee {
            display: flex;
            align-items: center;
            background: #4f0504;
            padding: 10px;
            white-space: nowrap;
            overflow: hidden;
        }
        .donor-search {
            margin-bottom: 20px;
        }
        .marquee-container {
            overflow: hidden;
            flex-grow: 1;
            position: relative;
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
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

        .text-outline-stroke {
            font-size: 46px;
            font-weight: bold;
            color: white;
            -webkit-text-stroke: 1px black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 3);
        }

        @media screen and (max-width: 768px) {
            .text-outline-stroke {
                font-size: 25px;
                font-weight: bold;
                color: white;
                -webkit-text-stroke: 1px black;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-phone me-2"></i>+1-416-644-1113</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>Vunitedcare4kids@gmail.com</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <a class="text-white-50 ms-3" href="https://www.facebook.com/vcarekids"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>
        </div>

        <div class="blinking-text">
            <!-- <p style="text-align: center; font-size: 18px;" class="p-2">Our Donars</p> -->
            <div class="donor-marquee">
                <span class="donor-title" style="color:white;">Our Honorable Donors:</span>
                <div class="marquee-container">
                    <div class="marquee-content" style="color:white;">
                        <?php
                        $sql = "SELECT donars.donarfullname, COUNT(students.donar_id) AS student_count FROM donars LEFT JOIN students ON students.donar_id = donars.id GROUP BY donars.id, donars.donarfullname;";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["student_count"] >= 1) {
                                    echo "<b>" . $row["donarfullname"] . "</b> (" . $row["student_count"] . " Students) | ";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold m-0 text-outline-stroke" style="color: white;"> VanniShangam<span class="text-white">Vcarekids</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link " >About</a>
                    <a href="service.php" class="nav-item nav-link">Activites</a>
                    <a href="donar.php" class="nav-item nav-link active" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 3);">Donars</a>
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Honorable Donors</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-light active" aria-current="page">Donars</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container mt-5">
       

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" id="searchDonar" class="form-control donor-search" placeholder="Search Donors by Name...">
            </div>
            <div class="col-md-6">
                <select id="studentCategory" class="form-select">
                    <option value="">All Categories</option>
                    <?php
                    $categoryQuery = "SELECT DISTINCT category FROM students";
                    $categoryResult = $con->query($categoryQuery);
                    while ($categoryRow = $categoryResult->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($categoryRow['category']) . "'>" . htmlspecialchars($categoryRow['category']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div id="donorResults" class="row g-4 justify-content-center">
            <!-- Filtered donor list will be loaded here -->
        </div>
    </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-4">
                    <h1 class="fw-bold  m-0" style="color: white;">Vcare<span class="text-white"> Kids</span></h1>
                    <p>Smart Eye is a leading provider of information technology, consulting, and business process services. Our dedicated employees offer strategic insights, technological expertise and industry experience.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href="https://www.facebook.com/vcarekids"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-light mb-4">Address</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>8-3500 McNicoll Ave,Scarborough,ON,Canada,M1V 4C7</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+1-416-644-1113</p>
                    <p><i class="fa fa-envelope me-3"></i>Vunitedcare4kids@gmail.com</p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="index.php">Home</a>
                    <a class="btn btn-link" href="about.php">About Us</a>
                    <a class="btn btn-link" href="donar.php">Donars</a>
                    <a class="btn btn-link" href="service.php">Activities</a>
                    <a class="btn btn-link" href="contact.php">Contact Us</a>
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

    <script>
        $(document).ready(function() {
            function fetchDonors(query = '', category = '') {
                $.ajax({
                    url: "search_donars.php",
                    method: "POST",
                    data: {
                        query: query,
                        category: category
                    },
                    success: function(data) {
                        $('#donorResults').html(data);
                    }
                });
            }

            fetchDonors();

            $('#searchDonar, #studentCategory').on('input change', function() {
                let query = $('#searchDonar').val();
                let category = $('#studentCategory').val();
                fetchDonors(query, category);
            });
        });
    </script>
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