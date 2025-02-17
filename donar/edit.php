<?php
$donor = null;  // Initialize $donor as null

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';

    // Get the form data
    $donar_id = $_POST['donar_id'];  // Include donor ID for the update
    $donar_fullname = $_POST['donar_fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    // Handle photo upload
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    if($photo==null)
    {
        $query = "UPDATE donars SET donarfullname = ?, email = ?, phone = ?, country = ?, address = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssssi", $donar_fullname, $email, $phone, $country, $address, $donar_id);
    }
    else{
        $query = "UPDATE donars SET donarfullname = ?, email = ?, phone = ?, country = ?, address = ?, photo = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssssi", $donar_fullname, $email, $phone, $country, $address, $photo, $donar_id);
    }

    // Prepare SQL query to update the donor
    

    // Execute the query and handle success or error
    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
} else {
    // Get the donor ID from the URL for editing
    if (isset($_GET['id'])) {
        $donar_id = $_GET['id'];
        include_once '../includes/config.php';

        // Fetch the donor's current data
        $query = "SELECT * FROM donars WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $donar_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if donor exists
        if ($result->num_rows > 0) {
            $donor = $result->fetch_assoc();
        } else {
            echo "Donor not found!";
            exit;
        }
        $stmt->close();
    } else {
        echo "Invalid request!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Donor - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include_once('../includes/topnav.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('../includes/sidenav.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Donor</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Donors</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <?php if ($donor): ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="donar_fullname" class="form-label">Donor Full Name</label>
                                        <input type="text" class="form-control" id="donar_fullname" name="donar_fullname" value="<?php echo htmlspecialchars($donor['donarfullname']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($donor['email']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($donor['phone']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($donor['Country']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($donor['address']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                        <!-- Show current photo if available -->
                                        <?php if (!empty($donor['photo'])): ?>
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($donor['photo']); ?>" alt="Donor Photo" style="width: 100px; height: 100px;">
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="donar_id" value="<?php echo $donar_id; ?>">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            <?php else: ?>
                                <p>Donor not found!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
