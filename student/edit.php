<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';

    // Get form data and trim to remove unnecessary whitespace
    $id = trim($_POST['id']);
    $fullname = trim($_POST['fullname']);
    $Details = trim($_POST['Details']);
    $phone = trim($_POST['phone']);
    $parentname = trim($_POST['parentname']);
    $parentaddress = trim($_POST['parentaddress']);
    $permanentaddress = trim($_POST['permanentaddress']);
    $dob = trim($_POST['dob']);
    $district = trim($_POST['district']);
    $category = trim($_POST['category']);
    $donar_id = trim($_POST['donar_id']);
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    // Validate required fields
    if (
        empty($id) || empty($fullname) || empty($Details) || empty($phone) || empty($parentname) ||
        empty($parentaddress) || empty($permanentaddress) || empty($dob) || empty($district)
    ) {
        die("Error: All fields are required.");
    }

    // Check if a new image is uploaded
    $image = null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    if ($image) {
        $query = "UPDATE students SET fullname = ?, Details = ?, phone = ?, parentname = ?, parentaddress = ?, permanentaddress = ?, dob = ?, district = ?,category=?,donar_id=?, image = ?, updated_at = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param(
            'ssssssssssssi',
            $fullname,
            $Details,
            $phone,
            $parentname,
            $parentaddress,
            $permanentaddress,
            $dob,
            $district,
            $category,
            $donar_id,
            $image,
            $updated_at,
            $id
        );
    } else {
        $query = "UPDATE students SET fullname = ?, Details = ?, phone = ?, parentname = ?, parentaddress = ?, permanentaddress = ?, dob = ?, district = ?,category=?,donar_id=?, updated_at = ? WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param(
            'sssssssssssi',
            $fullname,
            $Details,
            $phone,
            $parentname,
            $parentaddress,
            $permanentaddress,
            $dob,
            $district,
            $category,
            $donar_id,
            $updated_at,
            $id
        );
    }

    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
}

if (!isset($_GET['id'])) {
    die("Error: No ID provided.");
}

include_once '../includes/config.php';
$id = $_GET['id'];
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();


if (!$student) {
    die("Error: Student not found.");
}

$donorQuery = "SELECT id, donarfullname FROM donars";
$donorResult = $con->query($donorQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="Details" content="" />
    <meta name="author" content="" />
    <title>Vcarekids - Edit Student</title>
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
                    <h1 class="mt-4">Edit Student</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Students</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $student['fullname']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $student['phone']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="Details" class="form-label">Details</label>
                                    <textarea class="form-control" id="Details" name="Details" rows="3" required><?php echo $student['Details']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="permanentaddress" class="form-label">Permanent Address</label>
                                    <textarea class="form-control" id="permanentaddress" name="permanentaddress" rows="2" required><?php echo $student['permanentaddress']; ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Parent Name</label>
                                            <input type="text" class="form-control" id="parentname" name="parentname" value="<?php echo $student['parentname']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $student['dob']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="parentaddress" class="form-label">Parent Address</label>
                                    <textarea class="form-control" id="parentaddress" name="parentaddress" rows="2" required><?php echo $student['parentaddress']; ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="<?php echo $student['category'];  ?>" selected ><?php echo $student['category'];  ?></option>
                                                <option value="bicycle_donation">Bicycle Donation</option>
                                                <option value="computer_donation">Computer Donation</option>
                                                <option value="scholarship_payment">Scholarship Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="donar_id" class="form-label">Donor</label>
                                            <select name="donar_id" class="form-control" required>
                                                <?php while ($row = $donorResult->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id']; ?>" <?php echo ($student['donar_id'] == $row['id']) ? 'selected' : ''; ?>><?php echo $row['donarfullname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <select name="district" id="district" class="form-control">
                                                <option value="" disabled>Select District</option>
                                                <?php
                                                $districts = ["colombo", "gampaha", "kalutara", "kandy", "matale", "nuwara_eliya", "galle", "matara", "hambantota", "jaffna", "kilinochchi", "mannar", "vavuniya", "mullaitivu", "batticaloa", "ampara", "trincomalee", "kurunegala", "puttalam", "anuradhapura", "polonnaruwa", "badulla", "monaragala", "ratnapura", "kegalle"];
                                                foreach ($districts as $district) {
                                                    $selected = $district == $student['district'] ? 'selected' : '';
                                                    echo "<option value='$district' $selected>" . ucfirst(str_replace('_', ' ', $district)) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            <?php if ($student['image']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($student['image']); ?>" alt="Student Image" class="img-thumbnail mt-2" width="150">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100%;">Update</button>
                                    </div>
                                </div>
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