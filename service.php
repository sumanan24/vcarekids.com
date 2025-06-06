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

        .donor-marquee {
            display: flex;
            align-items: center;
            background:  #4f0504;
            padding: 10px;
            white-space: nowrap;
            overflow: hidden;
        }

        .donor-title {
            font-weight: bold;
            flex-shrink: 0;
            /* Keeps title fixed */
            margin-right: 10px;
            /* Spacing between title and scrolling text */
        }

        .marquee-container {
            overflow: hidden;
            flex-grow: 1;
            position: relative;
            display: flex;
            align-items: center;
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
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>Vunitedcare4kids@gmail.com</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <a class="text-white-50 ms-3" href="https://www.facebook.com/vcarekids"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>
        </div>

        <div class="blinking-text">
            <div class="donor-marquee">
                <span class="donor-title" style="color:white;">Our Honorable Donors:</span> <a href="donar.php" style="color:white;" class="btn btn-sm btn-primary">Search</a>
                <div class="marquee-container">
                    <marquee>
                        <div style="color:white; --speed: 1;">
                            <?php
                            $sql = "SELECT donars.donarfullname, COUNT(students.donar_id) AS student_count FROM donars LEFT JOIN students ON students.donar_id = donars.id GROUP BY donars.id, donars.donarfullname;";
                            $result = $con->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row["student_count"] >= 1) {
                                        echo "<b>" . $row["donarfullname"] . " | " . "</b> ";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </marquee>
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
                    <a href="service.php" class="nav-item nav-link active" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 3);">Activites</a>
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
            <h1 class="display-4 text-white animated slideInDown mb-4">Activities</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item text-light active" aria-current="page">Activities</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <div class="container-xxl ">
        <div class="container">
            <!-- Category Filter Start -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="category-filter text-center">
                        <a href="service.php" class="btn <?php echo !isset($_GET['category']) ?> btn-primary btn-outline-primary"; ?>All</a>
                        <?php
                        $cat_sql = "SELECT * FROM activity_categories ORDER BY categoryname";
                        $cat_result = $con->query($cat_sql);
                        while ($cat = $cat_result->fetch_assoc()) {
                            $active = isset($_GET['category']) && $_GET['category'] == $cat['id'] ? 'btn-primary' : 'btn-outline-primary';
                            echo '<a href="service.php?category=' . $cat['id'] . '" class="btn btn-primary btn-outline-primary m-2">' . htmlspecialchars($cat['categoryname']) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Category Filter End -->

            <!-- Activities Start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4 justify-content-center">
                        <?php
                        // Base query
                        $sql = "SELECT n.title, n.content, n.link, n.image, ac.categoryname 
                               FROM news n 
                               LEFT JOIN activity_categories ac ON n.category_id = ac.id";
                        
                        // Add category filter if selected
                        if (isset($_GET['category'])) {
                            $category_id = mysqli_real_escape_string($con, $_GET['category']);
                            $sql .= " WHERE n.category_id = '$category_id'";
                        }
                        
                        $sql .= " ORDER BY ac.categoryname, n.id DESC";
                        $result = $con->query($sql);

                        $current_category = '';
                        
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Display category header if it's a new category
                                if ($current_category != $row['categoryname']) {
                                    $current_category = $row['categoryname'];
                                    echo '<div class="col-12"><h3 class="text-primary mt-4 mb-3">' . htmlspecialchars($current_category ?: 'Uncategorized') . '</h3></div>';
                                }
                        ?>
                                <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="causes-item d-flex flex-column bg-white border-top border-5 rounded-top overflow-hidden h-100">
                                        <div class="text-center p-4 pt-0">
                                            <br>
                                            <h6 class="mb-3"><?php echo $row["title"]; ?></h6>
                                            <p style="font-size: 12px;"><?php echo $row["content"]; ?></p>
                                        </div>
                                        <div class="position-relative mt-auto">
                                            <?php
                                            if (!empty($row['image'])) {
                                                $imageData = base64_encode($row['image']); // Convert binary data to base64
                                                echo "<img src='data:image/jpeg;base64," . $imageData . "' alt='News Image' class='fixed-size-image'>";
                                            } else {
                                                echo "<p>No image available</p>";
                                            }
                                            ?>
                                        </div>
                                        <br>
                                        <a class="btn btn-outline-dark" href=" <?php echo $row["link"]; ?>">Read More</a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<li>No news articles found.</li>";
                        }

                        ?>
                    </div>
                </div>

            </div>
            <!-- Activities End -->
        </div>
    </div>
   
   <!-- Footer Start -->
   <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-4">
                    <h1 class="fw-bold  m-0" style="color:rgb(255, 255, 255);">Vcare<span class="text-white"> Kids</span></h1>
                    <p>Smart Eye is a leading provider of information technology, consulting, and business process services. Our dedicated employees offer strategic insights, technological expertise and industry experience.</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href="https://www.facebook.com/vcarekids"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h5 class="text-light mb-4">Address</h5>
                     <p><i class="fa fa-map-marker-alt me-3"></i>8-3500 McNicoll Ave, Scarborough, ON, Canada, Ontario</p>
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