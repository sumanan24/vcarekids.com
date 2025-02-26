<?php
include_once '../includes/config.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access!");
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Prepare the DELETE statement
    $delete_query = "DELETE FROM students WHERE id = ?";
    $stmt = $con->prepare($delete_query);

    if ($stmt) {
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Student deleted successfully.";
        } else {
            $_SESSION['message'] = "Failed to delete student.";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Database error.";
    }

    header("Location: manage.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request.";
    header("Location: manage.php");
    exit();
}
?>
