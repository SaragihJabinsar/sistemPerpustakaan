<?php
require '../vendor/autoload.php';

class PDF extends FPDF
{
    function WordWrap(&$text, $maxwidth)
    {
        $text = wordwrap($text, $maxwidth, "\n", true);
        return substr_count($text, "\n") + 1;
    }
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "perpustakaan");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetFillColor(50, 50, 50);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(190, 10, 'Laporan Data Anggota', 1, 1, 'C', true);
$pdf->Ln(5);

// Ambil data dari database
$query = "SELECT idAnggota, nama, jenisKelamin, alamat, status FROM tbanggota";
$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100, 100, 100);
$pdf->SetTextColor(255, 255, 255);

$header = ['No', 'ID Anggota', 'Nama Anggota', 'Jenis Kelamin', 'Alamat', 'Status'];
$widths = [10, 30, 50, 30, 40, 30];

foreach ($header as $key => $col) {
    $pdf->Cell($widths[$key], 10, $col, 1, 0, 'C', true);
}
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$fill = false;
$no = 1;

while ($row = $result->fetch_assoc()) {
    $nama = iconv('UTF-8', 'ISO-8859-1', $row['nama']);
    $alamat = iconv('UTF-8', 'ISO-8859-1', $row['alamat']);

    // Hitung jumlah baris untuk alamat
    $alamatLines = $pdf->WordWrap($alamat, 40);
    $rowHeight = $alamatLines * 6; // Sesuaikan tinggi sel dengan jumlah baris

    $pdf->Cell(10, $rowHeight, $no++, 1, 0, 'C', $fill);
    $pdf->Cell(30, $rowHeight, $row['idAnggota'], 1, 0, 'C', $fill);
    $pdf->Cell(50, $rowHeight, $nama, 1, 0, 'L', $fill);
    $pdf->Cell(30, $rowHeight, $row['jenisKelamin'], 1, 0, 'C', $fill);

    // MultiCell untuk alamat agar turun ke baris bawah jika panjang
    $xAlamat = $pdf->GetX();
    $yAlamat = $pdf->GetY();
    $pdf->MultiCell(40, 6, $alamat, 1, 'L', $fill);
    $pdf->SetXY($xAlamat + 40, $yAlamat); // Kembalikan posisi X ke kolom berikutnya

    $pdf->Cell(30, $rowHeight, $row['status'], 1, 1, 'C', $fill);

    $fill = !$fill;
}

$pdf->Output('I', 'Laporan_Data_Anggota.pdf');
?>