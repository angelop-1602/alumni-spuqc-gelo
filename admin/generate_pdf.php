<?php
require '../vendor/autoload.php'; // Include Composer's autoload
include('db_connect.php');

// Get filter values (if any)
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : '';
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    // Page header
    public function Header() {
        $image_file = 'assets/img/logo-qc.png'; // Path to logo
        $this->Image($image_file, 10, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 15, 'St. Paul University Quezon City - Alumni Tracking System', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(8); // Line break
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Alumni Report', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5); // Line break
        $this->Line(10, 35, 270, 35); // Line below header (adjusted for landscape width)
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $currentDate = date('F j, Y');
        $this->Cell(0, 10, 'Report generated on: ' . $currentDate . ' | Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document (set 'L' for landscape orientation)
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document properties
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alumni Tracking System');
$pdf->SetTitle('List of Alumni');
$pdf->SetSubject('Alumni Report');
$pdf->SetMargins(10, 40, 10); // Adjust margins for more space
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Build query with filters
$query = "SELECT a.*, c.course, CONCAT(a.lastname, ', ', a.firstname, ' ', a.middlename) as name, 
          CASE WHEN a.company != '' OR a.occupation != '' THEN 'Employed' ELSE 'Unemployed' END as employment_status 
          FROM alumnus_bio a 
          INNER JOIN courses c ON c.id = a.course_id";
$conditions = [];
if ($course_id) $conditions[] = "a.course_id = '$course_id'";
if ($gender) $conditions[] = "a.gender = '$gender'";
if ($batch) $conditions[] = "a.batch = '$batch'";
if ($status != '') $conditions[] = "a.status = '$status'";
if ($conditions) $query .= " WHERE " . implode(' AND ', $conditions);
$query .= " ORDER BY a.lastname ASC";

// Fetch data
$alumni = $conn->query($query);

// Start HTML content
$html = '<style>
            th { background-color: #FFD63E; font-weight: bold; text-align: center; padding: 8px; }
            td { padding: 6px; text-align: center; }
            .row-odd { background-color: #f2f2f2; }
         </style>';

$html .= '<table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year of Graduation</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Employment Status</th>
                    <th>Verification Status</th>
                </tr>
            </thead>
            <tbody>';

$row_index = 0;
while ($row = $alumni->fetch_assoc()) {
    $status = $row['status'] == 1 ? 'Verified' : 'Not Verified';
    $row_class = ($row_index++ % 2 == 0) ? 'row-even' : 'row-odd'; // Alternate row colors

    $html .= '<tr class="'.$row_class.'">
                <td>'.ucwords($row['name']).'</td>
                <td>'.$row['course'].'</td>
                <td>'.$row['batch'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['mobileNumber'].'</td>
                <td>'.$row['employment_status'].'</td>
                <td>'.$status.'</td>
              </tr>';
}

$html .= '</tbody></table>';

// Output the HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('alumni_list.pdf', 'I');
?>
