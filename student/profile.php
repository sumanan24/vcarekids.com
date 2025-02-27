<?php
include_once '../includes/config.php';
include_once '../tcpdf/tcpdf.php';
$student_id;
if ($_GET['id']) {
    $student_id = $_GET['id'];
}
// Fetch student details

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "Student profile not found.";
    exit();
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
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        a {
            text-decoration: none;
            color: gray;
        }
    </style>

    <style>
        /* Table Styling */
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {

            vertical-align: middle;
            padding: 12px;
            border: 1px solid #ddd;
        }

        thead {
            background-color: darkgray;
            color: black;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }



        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
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
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="mt-4">Student Profile</h1>
                        </div>
                        <div class="col-md-2">
                            <br><a href="new.php" class="btn btn-dark mb-3 btn-sm" style="width: 100%;">Add New</a>
                        </div>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                    <div class="profile-container">
                        
                        <a href="download_pdf.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm">
                            Download as PDF
                        </a>
                        <br><br>
                        <table>
                            <tr>
                                <th>Student ID:</th>
                                <td><?php echo htmlspecialchars($student['id']); ?></td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>
                                    <?php if (!empty($student['image'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($student['image']); ?>"
                                            alt="Student Image"
                                            style="width: 300px; ">

                                    <?php else: ?>
                                        <img src="uploads/default.png" alt="Default Profile">
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                            </tr>
                            <tr>
                                <th>Details:</th>
                                <td><?php echo htmlspecialchars($student['Details']); ?></td>
                            </tr>
                            <tr>
                                <th>Case Status:</th>
                                <td><?php echo htmlspecialchars($student['Casestatus']); ?></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><?php echo htmlspecialchars($student['phone']); ?></td>
                            </tr>
                            <tr>
                                <th>Parent Name:</th>
                                <td><?php echo htmlspecialchars($student['parentname']); ?></td>
                            </tr>
                            <tr>
                                <th>Parent Address:</th>
                                <td><?php echo htmlspecialchars($student['parentaddress']); ?></td>
                            </tr>
                            <tr>
                                <th>Permanent Address:</th>
                                <td><?php echo htmlspecialchars($student['permanentaddress']); ?></td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td><?php echo htmlspecialchars($student['dob']); ?></td>
                            </tr>
                            <tr>
                                <th>District:</th>
                                <td><?php echo htmlspecialchars($student['district']); ?></td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td><?php echo htmlspecialchars($student['category']); ?></td>
                            </tr>
                            
                            <tr>
                                <th>Gender:</th>
                                <td><?php echo htmlspecialchars($student['gender']); ?></td>
                            </tr>
                            <tr>
                                <th>Grade:</th>
                                <td><?php echo htmlspecialchars($student['grade']); ?></td>
                            </tr>
                            <tr>
                                <th>School Name:</th>
                                <td><?php echo htmlspecialchars($student['schoolname']); ?></td>
                            </tr>
                            <tr>
                                <th>Family Income:</th>
                                <td><?php echo htmlspecialchars($student['familyincome']); ?></td>
                            </tr>
                            <tr>
                                <th>Parent Job:</th>
                                <td><?php echo htmlspecialchars($student['parentjob']); ?></td>
                            </tr>
                            <tr>
                                <th>Bank Name:</th>
                                <td><?php echo htmlspecialchars($student['bankname']); ?></td>
                            </tr>
                            <tr>
                                <th>Bank Branch:</th>
                                <td><?php echo htmlspecialchars($student['bankbranch']); ?></td>
                            </tr>
                            <tr>
                                <th>Account Number:</th>
                                <td><?php echo htmlspecialchars($student['accountnumber']); ?></td>
                            </tr>
                            <tr>
                                <th>Account Holder Name:</th>
                                <td><?php echo htmlspecialchars($student['holdername']); ?></td>
                            </tr>
                        </table>
                        

                    </div>



                </div>
            </main>

            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>