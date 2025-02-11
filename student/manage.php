<?php
include_once '../includes/config.php';

$query = "SELECT id, fullname, district, image ,permanentaddress,phone,Details FROM students";
$result = $con->query($query);

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM students WHERE id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Student deleted successfully.";
        } else {
            $message = "Failed to delete student.";
        }
        $stmt->close();
        header("Location: manage.php");
    } else {
        $message = "Database error.";
    }
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
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="mt-4">Students</h1>
                        </div>
                        <div class="col-md-2">
                            <br><a href="new.php" class="btn btn-dark mb-3 btn-sm" style="width: 100%;">Add New</a>
                        </div>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>

                    <?php if (isset($message)) { ?>
                        <div class="alert alert-warning left-icon-alert" role="alert">
                            <strong>Notice:</strong> <?php echo htmlentities($message); ?>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <Th>phone No</Th>
                                <th>Details</th>
                                <th>District</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?= htmlspecialchars($row['fullname']); ?></td>
                                    <td><?= htmlspecialchars($row['phone']); ?></td>
                                    <td><?= htmlspecialchars($row['Details']); ?></td>
                                    <td><?= htmlspecialchars($row['district']); ?></td>
                                    <td>
                                        <?php if (!empty($row['image'])) { ?>
                                            <img src="data:image/jpeg;base64,<?= base64_encode($row['image']); ?>" alt="Student Image" style="width: 60px; height: 60px; border-radius: 90%;">
                                        <?php } else { ?>
                                            No Image
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                            <div>

                                            </div>
                                            <div>
                                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                                <a href="document.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Add Document</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>