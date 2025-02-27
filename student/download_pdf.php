<?php 
include_once '../includes/config.php';
include_once '../tcpdf/tcpdf.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$student_id = intval($_GET['id']);

// Fetch student details
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    die("Student profile not found.");
}

// Create a new PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('VCare Kids');
$pdf->SetTitle('Student Profile');
$pdf->SetSubject('Student Details');
$pdf->SetMargins(15, 25, 15);
$pdf->AddPage();

// Add Letterhead
$letterhead = '../img/letterhead.png'; // Change this to your actual letterhead image path
if (file_exists($letterhead)) {
    $pdf->Image($letterhead, 10, 5, 190, 40, 'PNG'); // Adjust dimensions as needed
}

// Move cursor below letterhead
$pdf->SetY(50);

// Title (Centered)
$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 12, 'Student Profile', 0, 1, 'C');
$pdf->Ln(5);

// Student Image Handling (Centered)
if (!empty($student['image'])) {
    $imageData = imagecreatefromstring($student['image']);
    if ($imageData !== false) {
        $imagePath = tempnam(sys_get_temp_dir(), 'image');
        imagejpeg($imageData, $imagePath, 100);
        imagedestroy($imageData);
        
        // Centering image
        $pdf->Image($imagePath, 85, 70, 40, 40, 'JPG');
        unlink($imagePath);
    } else {
        $pdf->Image('uploads/default.png', 85, 70, 40, 40, 'PNG');
    }
} else {
    $pdf->Image('uploads/default.png', 85, 70, 40, 40, 'PNG');
}

$pdf->Ln(70); // Space after image

// Table Styling (Centered)
$pdf->SetFont('helvetica', '', 12);
$html = '
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }
    td {
        border: 1px solid #000;
        padding: 8px;
        font-size: 11px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
        border: 1px solid #000;
        padding: 8px;
        font-size: 12px;
        font-weight: bold;
        text-align: left;
    }
</style>
<table>
    <tr><th>Field</th><th>Details</th></tr>';

$fields = [
    "Student ID" => $student['id'],
    "Full Name" => $student['fullname'],
    "Date of Birth" => $student['dob'],
    "Phone" => $student['phone'],
    "Parent Name" => $student['parentname'],
    "Parent Address" => $student['parentaddress'],
    "Permanent Address" => $student['permanentaddress'],
    "District" => $student['district'],
    "Category" => $student['category'],
    "Gender" => $student['gender'],
    "Grade" => $student['grade'],
    "School Name" => $student['schoolname'],
    "Family Income" => $student['familyincome'],
    "Parent Job" => $student['parentjob'],
    "Bank Name" => $student['bankname'],
    "Bank Branch" => $student['bankbranch'],
    "Account Number" => $student['accountnumber'],
    "Account Holder Name" => $student['holdername']
];

foreach ($fields as $key => $value) {
    $html .= '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
}

$html .= '</table>';

// Print Table
$pdf->writeHTML($html, true, false, false, false, 'C');

// Output the PDF file
$pdf->Output('student_profile_' . $student_id . '.pdf', 'D'); // 'D' forces download
