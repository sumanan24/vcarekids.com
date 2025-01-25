<?php
include_once '../includes/config.php';

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $limit;

// Fetch total records
$total_query = "SELECT COUNT(*) AS total FROM donation";
$total_result = $con->query($total_query);
$total_row = $total_result->fetch_assoc();
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// Fetch paginated donation
$query = "SELECT id, fullname, email, amount, image FROM donation ORDER BY id DESC LIMIT ?, ?";
$stmt = $con->prepare($query);
$stmt->bind_param('ii', $start, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM donation WHERE id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Donation deleted successfully.";
        } else {
            $message = "Failed to delete donation.";
        }
        $stmt->close();
        header("Location: manage.php");
    } else {
        $message = "Database error.";
    }
}

// Handle marking as read
if (isset($_POST['mark_read'])) {
    $donation_id = intval($_POST['donation_id']);
    $update_query = "UPDATE donation SET status = 'Read' WHERE id = ?";
    $stmt = $con->prepare($update_query);

    if ($stmt) {
        $stmt->bind_param('i', $donation_id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: manage.php");
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
    <title>Dashboard - Manage donation</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        a {
            text-decoration: none;
            color: gray;
        }
        .donation-image {
            width: 100px;
            height: auto;
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
                    <h1 class="mt-4">Donation</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Donation</li>
                    </ol>

                    <?php if (isset($message)) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo htmlentities($message); ?>
                        </div>
                    <?php } ?>

                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = $start + 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?= htmlentities($row['fullname']); ?></td>
                                    <td><?= htmlentities($row['email']); ?></td>
                                    <td><?= htmlentities($row['amount']); ?></td>
                                    <td>
                                        <?php if ($row['image']) { ?>
                                            <img class="donation-image" src="data:image/jpeg;base64,<?= base64_encode($row['image']); ?>" alt="Donation Image" />
                                        <?php } else { ?>
                                            No Image
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-donation" data-id="<?= $row['id']; ?>" data-fullname="<?= htmlentities($row['fullname']); ?>" data-email="<?= htmlentities($row['email']); ?>" data-amount="<?= htmlentities($row['amount']); ?>" data-image="<?= base64_encode($row['image']); ?>">View</button>
                                        <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this donation?');">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php
                            $pagination_limit = 5;
                            $start_page = max(1, $page - floor($pagination_limit / 2));
                            $end_page = min($total_pages, $start_page + $pagination_limit - 1);

                            if ($end_page - $start_page + 1 < $pagination_limit) {
                                $start_page = max(1, $end_page - $pagination_limit + 1);
                            }

                            if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item <?= $i === $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>

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
            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>

    <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donationModalLabel">Donation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Full Name:</strong> <span id="modalFullname"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Amount:</strong> <span id="modalAmount"></span></p>
                    <p><strong>Image:</strong></p>
                    <img class="donation-image" id="modalImage" alt="Donation Image" />
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="donation_id" id="donationId">
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script>
        document.querySelectorAll('.view-donation').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const fullname = this.dataset.fullname;
                const email = this.dataset.email;
                const amount = this.dataset.amount;
                const image = this.dataset.image;

                document.getElementById('donationId').value = id;
                document.getElementById('modalFullname').innerText = fullname;
                document.getElementById('modalEmail').innerText = email;
                document.getElementById('modalAmount').innerText = amount;
                document.getElementById('modalImage').src = 'data:image/jpeg;base64,' + image;

                new bootstrap.Modal(document.getElementById('donationModal')).show();
            });
        });
    </script>
</body>
</html>
