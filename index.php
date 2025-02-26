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
            background: rgb(250, 250, 0);
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
                <h1 class="fw-bold text-primary m-0"> VanniShangam<span class="text-white">Vcarekids</span></h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="service.php" class="nav-item nav-link">Activites</a>
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

    <!-- Carousel Start -->
    <div class="container-fluid p-0 ">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/sli2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Let's Change The World With Humanity</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/sli1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Let's Save More Lifes With Our Helping Hand</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <hr>
    <div class="container-xxl ">
        <div class="container">
            <!-- event Start -->
            <div class="container my-4">
                <h2 class="text-dark text-center fw-bold">🔥 Emergency Cases 🔥</h2>
                <p class="text-center text-muted">Your donation can provide urgent relief and save lives in emergency situations</p>

                <div class="row justify-content-center">

                    <?php
                    $query = "SELECT * FROM cases ORDER BY id DESC limit 3"; // Fetch all cases, newest first
                    $result = $con->query($query);
                    ?>
                    <?php while ($case = $result->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                            <div class="card shadow-lg p-3 border-dark" style="border-width: 3px; height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-bold"><?php echo htmlspecialchars($case['title']); ?></h5>
                                    <p class="text-muted" style="font-size: 14px;">
                                        <?php echo htmlspecialchars(substr($case['content'], 0, 100)); ?>...
                                    </p>
                                    <a href="donate.php?case_id=<?php echo $case['id']; ?>" class="btn btn-dark">Donate Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- event End -->
    </div>
    </div>

    <!-- Donate Start -->
    <div class="container-fluid donate my-5 py-5" data-parallax="scroll" data-image-src="img/child3.jpg">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-inline-block rounded-pill bg-secondary text-dark py-1 px-3 mb-3">Donate Now</div>
                    <h1 class="display-6 text-white mb-5">Thanks For The Results Achieved With You</h1>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 bg-white p-5">
                        <form>
                            <div class="row g-3">
                                <div class="col-12">
                                    <a href="donate.php" class="btn btn-dark px-5" style="height: 60px;">
                                        Donate Now
                                        <div class="d-inline-flex btn-sm-square bg-dark text-light rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Donate End -->

    <div class="container-xxl ">
        <div class="container">
            <!-- event Start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mx-auto  wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h3 class="">Our Recent Activities</h3>
                    </div>
                    <br>
                    <div class="row g-4 justify-content-center">
                        <?php
                        $sql = "SELECT title, content, link, image FROM news ORDER BY id DESC LIMIT 3 ";
                        $result = $con->query($sql);
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while ($row = $result->fetch_assoc()) {
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
            <!-- event End -->
        </div>
    </div>
    <br>
    <hr>

    <div class="container-xxl">
    <div class="container">
        <!-- Upcoming Events Start -->
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h3 class="">Upcoming Events</h3>
                </div>
                <br>
                <div class="row g-4 justify-content-center">
                    <?php
                    $sql = "SELECT event_name, event_date, location, advertisement_image FROM events ORDER BY event_date ASC LIMIT 3";
                    $result = $con->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="causes-item d-flex flex-column bg-white border-top border-5 rounded-top overflow-hidden h-100">
                                    <div class="text-center p-4 pt-0">
                                        <br>
                                        <h6 class="mb-3"><?php echo htmlspecialchars($row["event_name"]); ?></h6>
                                        <p style="font-size: 14px;"><strong>Date:</strong> <?php echo htmlspecialchars($row["event_date"]); ?></p>
                                        <p style="font-size: 12px;"><strong>Location:</strong> <?php echo htmlspecialchars($row["location"]); ?></p>
                                    </div>
                                    <div class="position-relative mt-auto text-center">
                                        <?php
                                        if (!empty($row['advertisement_image'])) {
                                            $imageData = base64_encode($row['advertisement_image']);
                                            echo "<img src='data:image/jpeg;base64," . $imageData . "' alt='Event Image' class='fixed-size-image' style='height:300px;'>";
                                        } else {
                                            echo "<p>No image available</p>";
                                        }
                                        ?>
                                    </div>
                                    <br>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>No upcoming events found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Upcoming Events End -->
    </div>
</div>
<hr>
<br>
    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="text-center mx-auto  wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h3 class="">Contact Us</h3>
        </div> <br>
     
        <div class="container">
            <div class="row">

                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-inline-block rounded-pill bg-secondary text-dark py-1 px-3 mb-3">Contact Us</div>
                    <section class="contact">
                        <h2>Interested in Donating? Contact Us</h2>
                        <p>If you are interested in supporting any of these initiatives, please reach out to us.</p>
                    </section>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve form data
                        $name = $_POST['name1'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];
                        $status = "unread";

                        // SQL query to insert the data into the database
                        $sql = "INSERT INTO messages (name, email, message, status) VALUES ('$name', '$email', '$message', '$status')";

                        if ($con->query($sql) === TRUE) {
                    ?>
                            <div class="alert alert-success left-icon-alert" role="alert">
                                <strong>Message Sent Success</strong>
                            </div>
                    <?php
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name1" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="phone" class="form-control" id="name" placeholder="Your Phone Number">
                                    <label for="name">Your Phone Number</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 100px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark py-2 px-3 me-3">
                                    Send Message
                                    <div class="d-inline-flex btn-sm-square bg-white text-dark rounded-circle ms-2">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="card">
                        <div class="container">
                            <h3>Support Vanni Changam – Empower Students for a Better Future!</h3>
                            <hr>
                            <section class="donation-section">
                                <h4>🚲 Bicycle Donation Program</h4>
                                <p style="font-size: 14px;">Many students in rural areas struggle with long commutes to school. A bicycle can significantly ease their travel, ensuring they reach their classes on time with less fatigue. Your donation can be a life-changing gift for a student in need.</p>
                            </section>

                            <section class="donation-section">
                                <h4>💻 Computer Donation Program</h4>
                                <p style="font-size: 14px;">Technology is a crucial part of education today. By donating <strong>new or used functional computers</strong>, you can help students gain ICT skills and access online learning resources, opening doors to a brighter future.</p>
                            </section>

                            <section class="donation-section">
                                <h4>🎓 Scholarship Payment Support</h4>
                                <p style="font-size: 14px;">Many talented students face financial difficulties that prevent them from continuing their education. Your contribution to the <strong>Scholarship Fund</strong> will help cover tuition fees, study materials, and other educational expenses, enabling them to focus on learning.</p>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->




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