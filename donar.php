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
            background: rgb(250, 250, 0);
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
    </style>
</head>

<body>
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
                <span class="donor-title">Our Honorable Donors:</span>
                <div class="marquee-container">
                    <div class="marquee-content">
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
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">VanniShangam<span class="text-white">Vcarekids</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link ">About</a>
                    <a href="service.php" class="nav-item nav-link">Activites</a>
                    <a href="donar.php" class="nav-item nav-link active">Donars</a>
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
</body>

</html>