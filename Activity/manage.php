<?php
include_once '../includes/config.php';

// Fetch news records
$category_filter = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$query = "SELECT n.id, n.title, n.content, n.link, n.created_at, n.updated_at, c.categoryname as category_name 
          FROM news n 
          LEFT JOIN activity_categories c ON n.category_id = c.id";
if ($category_filter > 0) {
    $query .= " WHERE n.category_id = " . $category_filter;
}
$result = $con->query($query);

// Get all categories for filter
$cat_query = "SELECT id, categoryname FROM activity_categories ORDER BY categoryname";
$cat_result = $con->query($cat_query);

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM news WHERE id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "News deleted successfully.";
        } else {
            $message = "Failed to delete news.";
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
    <title>Vcarekids</title>
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
                            <h1 class="mt-4">Activities</h1>
                        </div>
                        <div class="col-md-2">
                            <br><a href="new.php" class="btn btn-dark mb-3 btn-sm" style="width: 100%;">Add New</a>
                        </div>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Activities</li>
                    </ol>

                    <?php if (isset($message)) { ?>
                        <div class="alert alert-waring left-icon-alert" role="alert">
                            <strong>Well done!</strong><?php echo htmlentities($message); ?>
                        </div><?php }
                                ?>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <form method="GET" class="form-inline">
                                <select class="form-control" name="category_id" onchange="this.form.submit()">
                                    <option value="0">All Categories</option>
                                    <?php
                                    while ($cat = $cat_result->fetch_assoc()) {
                                        $selected = ($category_filter == $cat['id']) ? 'selected' : '';
                                        echo "<option value=\"" . $cat['id'] . "\" $selected>" . htmlspecialchars($cat['categoryname']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </form>
                        </div>
                    </div>

                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Link</th>
                                <th>Category</th>
                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                ?>
                                    <th>Actions</th>
                                <?php
                                }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?= $row['title']; ?></td>
                                    <td><?= substr($row['content'], 0, 50); ?>...</td>
                                    <td><a href="<?= $row['link']; ?>" target="_blank">Link</a></td>
                                    <td><?= htmlspecialchars($row['category_name']); ?></td>
                                    <?php
                                    if ($_SESSION['role'] == 'admin') {
                                    ?>
                                        <td>
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="?delete_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?');">Delete</a>
                                        </td>
                                    <?php
                                    }
                                    ?>
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