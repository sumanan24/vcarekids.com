<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $link = $_POST['link'];
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    $query = "INSERT INTO news (title, content, link, image, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssss", $title, $content, $link, $image, $created_at, $updated_at);

    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
                    <h1 class="mt-4">News</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">News</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                    <div class="card mt-4">

                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="link" name="link">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>