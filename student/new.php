<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';

    // Get form data and trim to remove unnecessary whitespace
    $fullname = trim($_POST['fullname']);
    $Details = trim($_POST['Details']);
    $phone = trim($_POST['phone']);
    $parentname = trim($_POST['parentname']);
    $parentaddress = trim($_POST['parentaddress']);
    $permanentaddress = trim($_POST['permanentaddress']);
    $dob = trim($_POST['dob']);
    $district = trim($_POST['district']);
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    // Validate required fields
    if (
        empty($fullname) || empty($Details) || empty($phone) || empty($parentname) ||
        empty($parentaddress) || empty($permanentaddress) || empty($dob) || empty($district)
    ) {
        die("Error: All fields are required.");
    }

    $query = "INSERT INTO students (fullname, Details, phone, parentname, parentaddress, permanentaddress, dob, district, image, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param(
        'sssssssssss',
        $fullname,
        $Details,
        $phone,
        $parentname,
        $parentaddress,
        $permanentaddress,
        $dob,
        $district,
        $image,
        $created_at,
        $updated_at
    );

    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="Details" content="" />
    <meta name="author" content="" />
    <title>Vcarekids - Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        a {
            text-decoration: none;
            color: gray;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include_once('../includes/topnav.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('../includes/sidenav.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Create Student</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Students</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Details" class="form-label">Details</label>
                                    <textarea class="form-control" id="Details" name="Details" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="Phone Number" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="parentname" class="form-label">Parent Name</label>
                                    <input type="text" class="form-control" id="parentname" name="parentname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="parentaddress" class="form-label">Parent Address</label>
                                    <textarea class="form-control" id="parentaddress" name="parentaddress" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="permanentaddress" class="form-label">Permanent Address</label>
                                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="mb-3">
                                    <label for="district" class="form-label">District</label>
                                    <select name="district" id="districts" class="form-control">
                                        <option value="" selected disabled>Select District</option>
                                        <option value="colombo">Colombo</option>
                                        <option value="gampaha">Gampaha</option>
                                        <option value="kalutara">Kalutara</option>
                                        <option value="kandy">Kandy</option>
                                        <option value="matale">Matale</option>
                                        <option value="nuwara_eliya">Nuwara Eliya</option>
                                        <option value="galle">Galle</option>
                                        <option value="matara">Matara</option>
                                        <option value="hambantota">Hambantota</option>
                                        <option value="jaffna">Jaffna</option>
                                        <option value="kilinochchi">Kilinochchi</option>
                                        <option value="mannar">Mannar</option>
                                        <option value="vavuniya">Vavuniya</option>
                                        <option value="mullaitivu">Mullaitivu</option>
                                        <option value="batticaloa">Batticaloa</option>
                                        <option value="ampara">Ampara</option>
                                        <option value="trincomalee">Trincomalee</option>
                                        <option value="kurunegala">Kurunegala</option>
                                        <option value="puttalam">Puttalam</option>
                                        <option value="anuradhapura">Anuradhapura</option>
                                        <option value="polonnaruwa">Polonnaruwa</option>
                                        <option value="badulla">Badulla</option>
                                        <option value="monaragala">Monaragala</option>
                                        <option value="ratnapura">Ratnapura</option>
                                        <option value="kegalle">Kegalle</option>
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <br>
            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>