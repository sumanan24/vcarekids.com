<?php
include('includes/config.php');

$query = isset($_POST['query']) ? $_POST['query'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';

$sql = "SELECT DISTINCT donars.donarfullname, donars.Country, donars.photo, 
               (SELECT COUNT(*) FROM students WHERE students.donar_id = donars.id) AS studentcount 
        FROM donars 
        WHERE donars.id IN (SELECT DISTINCT donar_id FROM students)
        AND donars.donarfullname LIKE ?";

if (!empty($category)) {
    $sql .= " AND donars.id IN (SELECT donar_id FROM students WHERE category = ?)";
}

$sql .= " ORDER BY studentcount DESC";

$stmt = $con->prepare($sql);
$searchTerm = "%" . $query . "%";

if (!empty($category)) {
    $stmt->bind_param("ss", $searchTerm, $category);
} else {
    $stmt->bind_param("s", $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-3 col-md-6 col-sm-12'>";
        echo "<div class='donor-card shadow-lg'>";
        echo "<img src='" . (!empty($row['photo']) ? 'data:image/jpeg;base64,' . base64_encode($row['photo']) : 'default-donor.jpg') . "' alt='Donor Image'>";
        echo "<h5 class='fw-bold mt-3'>" . htmlspecialchars($row['donarfullname']) . "</h5>";
        echo "<p class='text-muted'>" . htmlspecialchars($row['Country']) . "</p>";
        echo "<span class='badge bg-dark'>Sponsored Students: " . $row['studentcount'] . "</span>";
        echo "</div></div>";
    }
} else {
    echo "<p class='text-center text-danger'>No donors found.</p>";
}

$stmt->close();
$con->close();
?>
