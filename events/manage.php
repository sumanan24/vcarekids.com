<?php
include_once '../includes/config.php';

// Fetch event records
$query = "SELECT event_id, event_name, event_date, location, advertisement_image FROM events";
$result = $con->query($query);

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM events WHERE event_id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Event deleted successfully.";
        } else {
            $message = "Failed to delete event.";
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
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
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
                            <h1 class="mt-4">Events</h1>
                        </div>
                        <div class="col-md-2">
                            <br><a href="new.php" class="btn btn-dark mb-3 btn-sm" style="width: 100%;">Add New</a>
                        </div>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>

                    <?php if (isset($message)) { ?>
                        <div class="alert alert-warning left-icon-alert" role="alert">
                            <strong>Well done!</strong><?php echo htmlentities($message); ?>
                        </div><?php }
                    ?>

                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Location</th>
                                <th>Advertisement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 1;
                            while ($row = $result->fetch_assoc()) {
                                // Convert BLOB data to base64 encoded string
                                $image_data = base64_encode($row['advertisement_image']);
                                // Get the MIME type of the image (optional, you can adjust based on your image types)
                                $image_type = 'image/jpeg'; // Adjust MIME type if necessary
                            ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?= $row['event_name']; ?></td>
                                    <td><?= $row['event_date']; ?></td>
                                    <td><?= $row['location']; ?></td>
                                    <td>
                                        <img src="data:<?= $image_type ?>;base64,<?= $image_data ?>" alt="Advertisement Image" width="100" height="100">
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['event_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="?delete_id=<?= $row['event_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
