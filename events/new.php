<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../includes/config.php';

    // Get the form data
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $advertisement_image = file_get_contents($_FILES['advertisement_image']['tmp_name']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    // Prepare SQL query to insert the event
    $query = "INSERT INTO events (event_name, event_date, location, advertisement_image, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssss", $event_name, $event_date, $location, $advertisement_image, $created_at, $updated_at);

    // Execute the query and handle success or error
    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
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
    <title>Create Event - Dashboard</title>
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
                    <h1 class="mt-4">Create Event</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="../Dashboard/Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="manage.php">Events</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                    <div class="card mt-4">
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="event_name" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="event_date" class="form-label">Event Date</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                                <div class="mb-3">
                                    <label for="advertisement_image" class="form-label">Advertisement Image</label>
                                    <input type="file" class="form-control" id="advertisement_image" name="advertisement_image" accept="image/*" required>
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
