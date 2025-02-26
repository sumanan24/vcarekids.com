<?php
include_once '../includes/config.php';
session_start();
$filter = isset($_POST['Casestatus']) ? $_POST['Casestatus'] : '';

$query = "SELECT id, fullname, district, image, permanentaddress, phone, Details, schoolname FROM students";
$params = [];
$types = '';

if ($filter !== '') {
    $query .= " WHERE Casestatus = ?";
    $params[] = $filter;
    $types .= 's';
}

$stmt = $con->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$x = 1;

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$x}</td>
            <td>" . htmlspecialchars($row['fullname']) . "</td>
            <td>" . htmlspecialchars($row['phone']) . "</td>
            <td>" . htmlspecialchars($row['district']) . "</td>
            <td>" . htmlspecialchars($row['schoolname']) . "</td>
            <td>";
    if (!empty($row['image'])) {
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Student Image' style='width: 60px; height: 60px; border-radius: 50%;'>";
    } else {
        echo "No Image";
    }
    echo "</td>";

    if ($_SESSION['role'] == 'admin') {
        echo "<td>
                <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a>
                <a href='delete_student.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this student?\");'><i class='fa fa-trash'></i></a>
                <a href='document.php?id={$row['id']}' class='btn btn-info btn-sm'><i class='fa fa-file'></i></a>
                <a href='donation.php?id={$row['id']}' class='btn btn-primary btn-sm'><i class='fa fa-hand-holding-dollar'></i></a>
              </td>";
    } else {
        echo "<td>
        <a href='document.php?id={$row['id']}' class='btn btn-info btn-sm'>Add Document</a>
        <a href='donation.php?id={$row['id']}' class='btn btn-info btn-sm'>Donation</a>
        </td>";
    }

    echo "</tr>";
    $x++;
}

$stmt->close();
