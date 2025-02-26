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

    th, td {
        
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

    img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
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
                            <h1 class="mt-4">Manage Students</h1>
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
                    <form id="filterForm">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="Casestatus" class="form-label">Filter by Status</label>
                                <select id="Casestatus" name="Casestatus" class="form-control">
                                    <option value="">All Students</option>
                                    <option value="Emergency">Emergency</option>
                                    <option value="Not_Emergency">Not Emergency</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="mt-3">
                        <div class="mt-3">
                            <table id="studentsTable" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Full Name</th>
                                        <th>Phone No</th>
                                        <th>District</th>
                                        <th>School</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTableBody"></tbody>
                            </table>
                        </div>

                    </div>




                </div>
            </main>
            <script>
                $(document).ready(function() {
                    function loadStudents(filter = '') {
                        $.ajax({
                            url: 'fetch_students.php',
                            type: 'POST',
                            data: {
                                Casestatus: filter
                            },
                            success: function(response) {
                                $('#studentsTable').DataTable().destroy();
                                $('#studentTableBody').html(response);
                                $('#studentsTable').DataTable({
                                    pageLength: 5,
                                    lengthMenu: [
                                        [5, 10, 25, 50],
                                        [5, 10, 25, 50]
                                    ]
                                });
                            },
                            error: function(xhr, status, error) {
                                console.log("AJAX Error: " + status + " - " + error);
                            }
                        });
                    }

                    // Initial Load
                    loadStudents();

                    // Event Listener for Filter Change
                    $('#Casestatus').change(function() {
                        let selectedFilter = $(this).val();
                        loadStudents(selectedFilter);
                    });
                });
            </script>
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