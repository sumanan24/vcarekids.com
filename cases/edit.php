<!DOCTYPE html>
<html lang="en">
<?php
$case = null; // Initialize case variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';

    // Get the form data
    $case_id = $_POST['case_id'];  // Ensure the case ID is included
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Validate inputs
    if (empty($title) || empty($content)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Prepare SQL query to update the case
    $query = "UPDATE cases SET title = ?, content = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $case_id);

    // Execute the query and handle success or error
    if ($stmt->execute()) {
        header("Location: manage.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close resources
    $stmt->close();
    $con->close();
} else {
    // Fetch case details for editing
    if (isset($_GET['id'])) {
        $case_id = $_GET['id'];
        include_once '../includes/config.php';

        $query = "SELECT * FROM cases WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $case_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if case exists
        if ($result->num_rows > 0) {
            $case = $result->fetch_assoc();
        } else {
            echo "Case not found!";
            exit;
        }
        $stmt->close();
        $con->close();
    } else {
        echo "Invalid request!";
        exit;
    }
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Case - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
                    <h1 class="mt-4">Edit Case</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../Dashboard/Dashboard.php" style="text-decoration: none; color:black;">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="../cases/manage.php" style="text-decoration: none; color:black;">Cases</a></li>
                        <li class="breadcrumb-item">Update</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <?php if ($case): ?>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Case Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($case['title']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Case Content</label>
                                        <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($case['content']); ?></textarea>
                                    </div>
                                    <input type="hidden" name="case_id" value="<?php echo $case_id; ?>">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            <?php else: ?>
                                <p>Case not found!</p>
                            <?php endif; ?>
                        </div>
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
