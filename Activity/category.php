<?php
include_once '../includes/config.php';


// Initialize variables for form
$edit_mode = false;
$category_id = '';
$category_name = '';

// Add Category
if (isset($_POST['add_category'])) {
    $categoryname = mysqli_real_escape_string($con, $_POST['categoryname']);
    $sql = "INSERT INTO activity_categories (categoryname) VALUES ('$categoryname')";
    $_SESSION['success'] = mysqli_query($con, $sql) ? "Category added successfully." : "Error adding category.";
    header("Location: category.php");
    exit();
}

// Update Category
if (isset($_POST['edit_category'])) {
    $category_id = $_POST['category_id'];
    $categoryname = mysqli_real_escape_string($con, $_POST['categoryname']);
    $sql = "UPDATE activity_categories SET categoryname='$categoryname' WHERE id='$category_id'";
    $_SESSION['success'] = mysqli_query($con, $sql) ? "Category updated successfully." : "Error updating category.";
    header("Location: category.php");
    exit();
}

// Delete Category
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM activity_categories WHERE id='$id'";
    $_SESSION['success'] = mysqli_query($con, $sql) ? "Category deleted successfully." : "Error deleting category.";
    header("Location: category.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vcarekids</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <?php include_once('../includes/sidenav.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Activity Categories Management</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="manage.php">Activities</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                    <!-- Flash Messages -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Left Column: Insert / Edit Form -->
                                <div class="col-md-4">
                                    <div class="form-section">
                                        <h5 id="formTitle">Add New Category</h5>
                                        <form method="POST" id="categoryForm">
                                            <input type="hidden" name="category_id" id="category_id">
                                            <div class="mb-3">
                                                <label for="categoryname" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" name="categoryname" id="categoryname" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="add_category" id="addBtn">Add Category</button>
                                            <button type="submit" class="btn btn-success d-none" name="edit_category" id="editBtn">Update Category</button>
                                            <button type="button" class="btn btn-secondary d-none" id="cancelEdit">Cancel</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Right Column: Table -->
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">Category List</div>
                                        <div class="card-body">
                                            <table class="table table-bordered align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Category Name</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM activity_categories ORDER BY id DESC";
                                                    $result = mysqli_query($con, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)):
                                                    ?>
                                                        <tr>
                                                            <td><?= $row['id']; ?></td>
                                                            <td><?= htmlspecialchars($row['categoryname']); ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-success editBtn"
                                                                    data-id="<?= $row['id']; ?>"
                                                                    data-name="<?= htmlspecialchars($row['categoryname']); ?>">
                                                                    Edit
                                                                </button>
                                                                <a href="?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this category?');">
                                                                    Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script>
        $(document).ready(function() {
            $('.editBtn').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#category_id').val(id);
                $('#categoryname').val(name);

                $('#formTitle').text('Edit Category');
                $('#addBtn').addClass('d-none');
                $('#editBtn, #cancelEdit').removeClass('d-none');
            });

            $('#cancelEdit').on('click', function() {
                $('#categoryForm')[0].reset();
                $('#category_id').val('');
                $('#formTitle').text('Add New Category');
                $('#editBtn, #cancelEdit').addClass('d-none');
                $('#addBtn').removeClass('d-none');
            });
        });
    </script>
</body>

</html>