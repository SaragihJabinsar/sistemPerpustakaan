<?php
require '../vendor/autoload.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "perpustakaan");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Header Judul
$pdf->SetFillColor(50, 50, 50);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(190, 8, 'Laporan Data Buku', 1, 1, 'C', true);
$pdf->Ln(4);

// Query Data Buku
$query = "SELECT idBuku, judulBuku, kategori, pengarang, penerbit, status FROM tbbuku";
$result = $conn->query($query);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(100, 100, 100);
$pdf->SetTextColor(255, 255, 255);
$header = ['No', 'ID Buku', 'Judul Buku', 'Kategori', 'Pengarang', 'Penerbit', 'Status'];
$widths = [8, 18, 45, 35, 30, 30, 18];

foreach ($header as $key => $col) {
    $pdf->Cell($widths[$key], 8, $col, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi Tabel
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$fill = false;
$no = 1;

while ($row = $result->fetch_assoc()) {
    $pdf->SetFillColor($fill ? 230 : 255, $fill ? 230 : 255, $fill ? 230 : 255);
    
    $judulLines = explode("\n", wordwrap($row['judulBuku'], 25, "\n", true));
    $kategoriLines = explode("\n", wordwrap($row['kategori'], 25, "\n", true));
    $penerbitLines = explode("\n", wordwrap($row['penerbit'], 25, "\n", true));
    
    $maxLines = max(count($judulLines), count($kategoriLines), count($penerbitLines));
    $rowHeight = $maxLines * 5;

    $pdf->Cell(8, $rowHeight, $no++, 1, 0, 'C', $fill);
    $pdf->Cell(18, $rowHeight, $row['idBuku'], 1, 0, 'C', $fill);
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(45, 5, $row['judulBuku'], 1, 'L', $fill);
    $pdf->SetXY($x + 45, $y);
    
    $x = $pdf->GetX();
    $pdf->MultiCell(35, 5, $row['kategori'], 1, 'L', $fill);
    $pdf->SetXY($x + 35, $y);
    
    $pdf->Cell(30, $rowHeight, $row['pengarang'], 1, 0, 'L', $fill);
    
    $x = $pdf->GetX();
    $pdf->MultiCell(30, 5, $row['penerbit'], 1, 'L', $fill);
    $pdf->SetXY($x + 30, $y);
    
    $pdf->Cell(18, $rowHeight, $row['status'], 1, 1, 'C', $fill);

    $fill = !$fill;
}

$pdf->Output('I', 'Laporan_Data_Buku.pdf');
?>