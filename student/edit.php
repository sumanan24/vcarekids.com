<?php
include_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and trim to remove unnecessary whitespace
    $id = $_POST['id']; // Hidden input field for student ID
    $fullname = trim($_POST['fullname']);
    $Details = trim($_POST['Details']);
    $Casestatus = trim($_POST['Casestatus']);
    $file_number = trim($_POST['file_number']);
    $phone = trim($_POST['phone']);
    $whatsapp_number = trim($_POST['whatsapp_number']);
    $parent_phone_number = trim($_POST['parent_phone_number']);
    $parentname = trim($_POST['parentname']);
    $parentaddress = trim($_POST['parentaddress']);
    $permanentaddress = trim($_POST['permanentaddress']);
    $dob = trim($_POST['dob']);
    $district = trim($_POST['district']);
    $category = trim($_POST['category']);
    $donar_id = trim($_POST['donar_id']);
    $gender = trim($_POST['gender']);
    $grade = trim($_POST['grade']);
    $schoolname = trim($_POST['schoolname']);
    $familyincome = trim($_POST['familyincome']);
    $parentjob = trim($_POST['parentjob']);
    $bankname = trim($_POST['bankname']);
    $bankbranch = trim($_POST['bankbranch']);
    $accountnumber = trim($_POST['accountnumber']);
    $holdername = trim($_POST['holdername']);
    $updated_at = date('Y-m-d H:i:s');

    // Validate required fields
    if (
        empty($fullname) || empty($Details) || empty($phone) || empty($whatsapp_number) || empty($parent_phone_number) || empty($parentname) ||
        empty($parentaddress) || empty($permanentaddress) || empty($dob) || empty($district) ||
        empty($category) || empty($donar_id) || empty($gender) || empty($grade) || empty($schoolname) || empty($file_number)
    ) {
        die("Error: All required fields must be filled.");
    }

    // Handle image upload
    $image_query = "";
    $params = [
        &$fullname,
        &$Details,
        &$Casestatus,
        &$file_number,
        &$phone,
        &$whatsapp_number,
        &$parent_phone_number,
        &$parentname,
        &$parentaddress,
        &$permanentaddress,
        &$dob,
        &$district,
        &$category,
        &$donar_id,
        &$gender,
        &$grade,
        &$schoolname,
        &$familyincome,
        &$parentjob,
        &$bankname,
        &$bankbranch,
        &$accountnumber,
        &$holdername,
        &$id
    ];
    $types = str_repeat('s', count($params) - 1) . 'i'; // All strings except last one (id) which is integer

    if ($_FILES['image']['size'] > 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image_query = ", image = ?";
        $params[] = &$image;
        $types .= "b"; // 'b' for blob data
    }

    // Update query
    $query = "UPDATE students SET fullname = ?, Details = ?, Casestatus = ?, file_number = ?, phone = ?, whatsapp_number = ?, parent_phone_number = ?, parentname = ?, 
        parentaddress = ?, permanentaddress = ?, dob = ?, district = ?, category = ?, donar_id = ?, 
        gender = ?, grade = ?, schoolname = ?, familyincome = ?, parentjob = ?, bankname = ?, bankbranch = ?, 
        accountnumber = ?, holdername = ? $image_query WHERE id = ?";

    // Prepare and bind parameters
    $stmt = $con->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param($types, ...$params);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: manage.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}


// Fetch student data for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

// Fetch donors for dropdown
$donorQuery = "SELECT id, donarfullname FROM donars";
$donorResult = $con->query($donorQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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
                    <h1 class="mt-4">Update Student</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Students</a></li>
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <!-- Hidden input for student ID -->
                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                                <!-- 1st row start -->
                                <hr>
                                <h3><b>Category Details</b></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="" selected disabled>Select Category</option>
                                                <option value="bicycle_donation" <?php echo ($student['category'] == 'bicycle_donation') ? 'selected' : ''; ?>>Bicycle Donation</option>
                                                <option value="computer_donation" <?php echo ($student['category'] == 'computer_donation') ? 'selected' : ''; ?>>Computer Donation</option>
                                                <option value="scholarship_payment" <?php echo ($student['category'] == 'scholarship_payment') ? 'selected' : ''; ?>>Scholarship Payment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Status</label>
                                        <select name="Casestatus" class="form-control" required>
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="Emergency" <?php echo ($student['Casestatus'] == 'Emergency') ? 'selected' : ''; ?>>Emergency</option>
                                            <option value="Not_Emergency" <?php echo ($student['Casestatus'] == 'Not_Emergency') ? 'selected' : ''; ?>>Not_Emergency</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="donar_id" class="form-label">Donor</label>
                                            <select name="donar_id" id="donar_id" class="form-control" required>
                                                <option value="" selected disabled>Select Donor</option>

                                                <?php while ($row = $donorResult->fetch_assoc()) {
                                                    if ($student['donar_id'] == 0) {
                                                ?>
                                                        <option value="Not-Assign" selected>Not Assign</option>
                                                    <?php
                                                    }
                                                    ?>

                                                    <option value="<?php echo $row['id']; ?>" <?php echo ($student['donar_id'] == $row['id']) ? 'selected' : ''; ?>><?php echo $row['donarfullname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3><b>Student Personal Details</b></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="file_number" class="form-label">File Number</label>
                                            <input type="text" class="form-control" name="file_number" value="<?php echo $student['file_number']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $student['fullname']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- 1st row end -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $student['phone']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                            <input type="text" class="form-control" name="whatsapp_number" value="<?php echo $student['whatsapp_number']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2nd row start -->
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="Details" class="form-label">Student Info</label>
                                            <textarea class="form-control" id="Details" name="Details" rows="3" required><?php echo $student['Details']; ?></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="permanentaddress" class="form-label">Permanent Address</label>
                                                <textarea class="form-control" id="permanentaddress" name="permanentaddress" rows="3" required><?php echo $student['permanentaddress']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2nd row end -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Gender</label>
                                            <select name="gender" id="" class="form-control" name="gender">
                                                <option value="" selected disabled>Select Gender</option>
                                                <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Study Grade</label>
                                            <input type="text" class="form-control" name="grade" value="<?php echo $student['grade']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="permanentaddress" class="form-label">School/University Name</label>
                                            <textarea class="form-control" id="permanentaddress" name="schoolname" rows="2" required><?php echo $student['schoolname']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $student['dob']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <?php if ($student['image']) : ?>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($student['image']); ?>" alt="Student Image" class="img-thumbnail mt-2" width="150">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <select name="district" id="district" class="form-control" required>
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
                                </div>

                                <h3><b>Parents Details</b></h3>
                                <hr>
                                <!-- 3rd row start -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Parent Name</label>
                                            <input type="text" class="form-control" id="parentname" name="parentname" value="<?php echo $student['parentname']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentaddress" class="form-label">Parent Address</label>
                                            <textarea class="form-control" id="parentaddress" name="parentaddress" rows="2" required><?php echo $student['parentaddress']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3rd row end -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Family Income</label>
                                            <input type="text" class="form-control" name="familyincome" value="<?php echo $student['familyincome']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Parent Job</label>
                                            <input type="text" class="form-control" name="parentjob" value="<?php echo $student['parentjob']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parent_phone_number" class="form-label">Parent Phone Number</label>
                                            <input type="text" class="form-control" name="parent_phone_number" value="<?php echo $student['parent_phone_number']; ?>" required>
                                        </div>
                                    </div>
                                </div>



                                <hr>
                                <h3><b>Bank Details</b></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" name="bankname" value="<?php echo $student['bankname']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Bank Branch</label>
                                            <input type="text" class="form-control" name="bankbranch" value="<?php echo $student['bankbranch']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="accountnumber" value="<?php echo $student['accountnumber']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="parentname" class="form-label">Account Holder Name</label>
                                            <input type="text" class="form-control" name="holdername" value="<?php echo $student['holdername']; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-success" style="width: 100%;">Update</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>