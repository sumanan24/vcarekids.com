<?php
include_once '../includes/config.php'; // Ensure the config file includes DB connection details

// Prepare dummy data
$dummy_data = [
    [
        'fullname' => 'John Doe',
        'description' => 'A sample description for John.',
        'phone' => '0712345678',
        'parentname' => 'Jane Doe',
        'parentaddress' => '123 Main Street, City A',
        'permanentaddress' => '123 Main Street, City A',
        'dob' => '2000-01-01',
        'district' => 'colombo',
        'image' => null, // Set to null or use a placeholder
    ],
    [
        'fullname' => 'Alice Smith',
        'description' => 'A sample description for Alice.',
        'phone' => '0723456789',
        'parentname' => 'Bob Smith',
        'parentaddress' => '456 Another Street, City B',
        'permanentaddress' => '456 Another Street, City B',
        'dob' => '1998-05-12',
        'district' => 'galle',
        'image' => null,
    ],
    [
        'fullname' => 'Mark Lee',
        'description' => 'A sample description for Mark.',
        'phone' => '0734567890',
        'parentname' => 'Lucy Lee',
        'parentaddress' => '789 Beach Road, City C',
        'permanentaddress' => '789 Beach Road, City C',
        'dob' => '1995-10-22',
        'district' => 'jaffna',
        'image' => null,
    ],
    [
        'fullname' => 'Emily Davis',
        'description' => 'A sample description for Emily.',
        'phone' => '0745678901',
        'parentname' => 'Chris Davis',
        'parentaddress' => '321 Park Avenue, City D',
        'permanentaddress' => '321 Park Avenue, City D',
        'dob' => '1997-08-15',
        'district' => 'kandy',
        'image' => null,
    ],
    [
        'fullname' => 'Michael Brown',
        'description' => 'A sample description for Michael.',
        'phone' => '0756789012',
        'parentname' => 'Sara Brown',
        'parentaddress' => '654 Hill Street, City E',
        'permanentaddress' => '654 Hill Street, City E',
        'dob' => '1999-12-01',
        'district' => 'badulla',
        'image' => null,
    ]
];

foreach ($dummy_data as $student) {
    $query = "INSERT INTO students (fullname, description, phone, parentname, parentaddress, permanentaddress, dob, district, image, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);

    // Use current date-time for created_at and updated_at
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    // Bind parameters (note: image is NULL here)
    $stmt->bind_param(
        'sssssssssss',
        $student['fullname'],
        $student['description'],
        $student['phone'],
        $student['parentname'],
        $student['parentaddress'],
        $student['permanentaddress'],
        $student['dob'],
        $student['district'],
        $student['image'], // null for now
        $created_at,
        $updated_at
    );

    if ($stmt->execute()) {
        echo "Inserted: {$student['fullname']}<br>";
    } else {
        echo "Error inserting {$student['fullname']}: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Close the database connection
$con->close();
?>
