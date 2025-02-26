<?php
include_once '../includes/config.php';

// Retrieve student ID from URL
$studentid = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$studentid) {
    echo "Invalid student ID.";
    exit;
}

// Fetch student details (name and image)
$query = "SELECT fullname, image FROM students WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $studentid);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "Student not found.";
    exit;
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $file = $_FILES['file'];

    // Validate file type
    $allowed_types = ['application/pdf'];
    if (!in_array($file['type'], $allowed_types)) {
        echo "Invalid file type. Only PDF files are allowed.";
        exit;
    }

    // Generate file name and path
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $studentid . '_' . $title . '.' . $extension;
    $filepath = '../documents/' . $filename;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Save file info to the database
        $query = "INSERT INTO student_donations (studentid, title, date, path) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param('isss', $studentid, $title, $date, $filepath);
        $stmt->execute();
        echo "Donation bill uploaded successfully.";
    } else {
        echo "Failed to upload the document.";
    }
}

// Handle document deletion
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Fetch the file path
    $query = "SELECT path FROM student_donations WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Delete file from the folder
        if (file_exists($row['path'])) {
            unlink($row['path']);
        }

        // Delete record from the database
        $delete_query = "DELETE FROM student_donations WHERE id = ?";
        $delete_stmt = $con->prepare($delete_query);
        $delete_stmt->bind_param('i', $id);
        $delete_stmt->execute();

        echo "Donation bill deleted successfully.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download'])) {
    $selected_ids = $_POST['selected_ids'];
    $zip = new ZipArchive();
    $zipname = 'documents.zip';

    if ($zip->open($zipname, ZipArchive::CREATE) === TRUE) {
        foreach ($selected_ids as $id) {
            $query = "SELECT path FROM pdf_documents WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row && file_exists($row['path'])) {
                $zip->addFile($row['path'], basename($row['path']));
            }
        }
        $zip->close();

        // Serve the zip file for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

        // Remove zip file after download
        unlink($zipname);
        exit;
    } else {
        echo "Failed to create zip file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Document Management</title>
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
        <?php include_once('../includes/sidenav.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Donation</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Students</a></li>
                        <li class="breadcrumb-item active">Documents</li>
                    </ol>

                    <div class="d-flex align-items-center mb-4">

                        <h4> Donation Information <?= htmlentities($student['fullname']); ?> </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="card p-3">
                                <form method="post" enctype="multipart/form-data">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" required>
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                    <label for="file">Upload Bill (PDF)</label>
                                    <input type="file" class="form-control" name="file" required>
                                    <button type="submit" class="btn btn-success" name="upload">Upload</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card p-3">
                                <form method="post">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $query = "SELECT id, title, date, path FROM student_donations WHERE studentid = ?";
                                            $stmt = $con->prepare($query);
                                            $stmt->bind_param('i', $studentid);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            $number = 1;
                                            while ($row = $result->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?= $number++; ?></td>
                                                    <td><?= htmlentities($row['title']); ?></td>
                                                    <td><?= htmlentities($row['date']); ?></td>
                                                    <td>
                                                        <a href="<?= $row['path']; ?>" download>Download</a>
                                                        <a href="?id=<?= $studentid; ?>&delete_id=<?= $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                    <button type="submit" name="download" class="btn btn-secondary">Download Selected</button>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php'); ?>
        </div>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>