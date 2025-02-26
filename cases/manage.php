<!DOCTYPE html>
<html lang="en">
<style>
    a {
        text-decoration: none;
        color: gray;
    }
</style>
<?php
include_once '../includes/config.php';

// Fetch case records
$query = "SELECT id, title, content FROM cases";
$result = $con->query($query);

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM cases WHERE id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Case deleted successfully.";
        } else {
            $message = "Failed to delete case.";
        }
        $stmt->close();
        header("Location: manage_cases.php");
    } else {
        $message = "Database error.";
    }
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Cases - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
                    <div class="row">
                        <div class="col-md-10">
                            <h1 class="mt-4">Cases</h1>
                        </div>
                        <div class="col-md-2">
                            <br><a href="new.php" class="btn btn-dark mb-3 btn-sm" style="width: 100%;">Add New</a>
                        </div>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php" style="text-decoration: none; color:black;">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cases</li>
                    </ol>

                    <?php if (isset($message)) { ?>
                        <div class="alert alert-warning left-icon-alert" role="alert">
                            <strong>Well done!</strong> <?php echo htmlentities($message); ?>
                        </div><?php }
                                ?>

                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 1;
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?= htmlentities($row['title']); ?></td>
                                    <td><?= htmlentities($row['content']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this case?');">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php include_once('../includes/footer.php') ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="../assets/demo/chart-area-demo.js"></script>
            <script src="../assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
        </div>
    </div>
</body>

</html>