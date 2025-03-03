<?php
// Include database configuration
include_once '../includes/config.php';

// Initialize pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Calculate the starting index

// Query to get total number of records
$total_query = "SELECT COUNT(*) AS total FROM messages";
$total_result = $con->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit); // Total pages required

// Query to fetch messages with pagination
$query = "SELECT id, name, email, message, status, created_at FROM messages where status='unread' ORDER BY created_at DESC LIMIT ?, ?";
$stmt = $con->prepare($query);

$sql = "SELECT COUNT(*) AS total_students FROM students";
$result = $con->query($sql);
$rowstu = $result->fetch_assoc();
$total_students = $rowstu['total_students'];

$sql1 = "SELECT COUNT(*) AS total_donars FROM donars";
$result = $con->query($sql1);
$rowdonar = $result->fetch_assoc();
$total_donars = $rowdonar['total_donars'];

$sql2 = "SELECT COUNT(*) AS total_news FROM news";
$result = $con->query($sql2);
$rownews = $result->fetch_assoc();
$total_news = $rownews['total_news'];


$sql3 = "SELECT COUNT(*) AS total_events FROM events";
$result = $con->query($sql3);
$rowevent = $result->fetch_assoc();
$total_events = $rowevent['total_events'];

if (!$stmt) {
    die('Prepare failed: ' . $con->error);
}

// Bind parameters and execute query
$stmt->bind_param('ii', $start, $limit);
if (!$stmt->execute()) {
    die('Execute failed: ' . $stmt->error);
}

$result = $stmt->get_result();
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
</head>

<body class="sb-nav-fixed">
    <?php include_once('../includes/topnav.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('../includes/sidenav.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Students</h5>
                                    <h2><?php echo $total_students; ?></h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../student/manage.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Donars</h5>
                                    <h2><?php echo $total_donars; ?></h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../donar/manage.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Activities</h5>
                                    <h2><?php echo $total_news; ?></h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../Activity/manage.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">
                                <h5 class="card-title">Events</h5>
                                <h2><?php echo $total_events; ?></h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="../events/manage.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DataTable Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Messages
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        $x = $start + 1; // Row counter based on pagination
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $x++; ?></td>
                                                <td><?= htmlentities($row['name']); ?></td>
                                                <td><?= htmlentities($row['email']); ?></td>
                                                <td><?= htmlentities($row['status']); ?></td>
                                                <td>
                                                    <button class="btn btn-info btn-sm view-message"
                                                        data-id="<?= $row['id']; ?>"
                                                        data-name="<?= htmlentities($row['name']); ?>"
                                                        data-email="<?= htmlentities($row['email']); ?>"
                                                        data-message="<?= htmlentities($row['message']); ?>"
                                                        data-status="<?= htmlentities($row['status']); ?>">View</button>
                                                    <a href="?delete_id=<?= $row['id']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">No messages found.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Section -->
                    <!-- Pagination Section -->
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php
                            $pagination_limit = 5; // Number of page links to display
                            $start_page = max(1, $page - floor($pagination_limit / 2));
                            $end_page = min($total_pages, $start_page + $pagination_limit - 1);

                            // Adjust start page if the end page is less than the limit
                            if ($end_page - $start_page + 1 < $pagination_limit) {
                                $start_page = max(1, $end_page - $pagination_limit + 1);
                            }

                            // Previous Button
                            if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- Page Links -->
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item <?= $i === $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">Next &raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>