<?php

require_once('vendor/autoload.php');

$pdf = new TCPDF();
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Rijaldi');
$pdf->setTitle('Data Penjualan');
$pdf->setHeaderData('', 0, 'Laporan Data Penjualan', 'Top-Up Game Kintil Store');

$pdf->setMargins(15, 27, 15);
$pdf->setHeaderMargin(10);
$pdf->setFooterMargin(10);

$pdf->AddPage();

include 'db.php';
$query = "SELECT * FROM orders";
$data = mysqli_query($conn, $query);

$html = '<h3>Top-Up Store</h3>';
$html .= '<table border="1" cellpadding="5" width="100%">
<thead>
<tr>
<th>No</th>
<th>ID Server</th>
<th>Nama Pelanggan</th>
<th>Nama Game</th>
<th>Jumlah Top-Up</th>
<th>Harga</th>
<th>Bonus Top-Up</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>';

$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
    $html .= '<tr>
<td>' . $no++ . '</td> <!-- Use $no++ here for the row number -->
<td>' . $row['id_server'] . '</td>
<td>' . $row['customer_name'] . '</td>
<td>' . $row['game_name'] . '</td>
<td>' . $row['topup_amount'] . '</td>
<td>' . $row['price'] . '</td>
<td>' . $row['topup_bonus'] . '</td>
<td>' . $row['created_at'] . '</td>
</tr>';
}

$html .= '</tbody></table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('laporan_penjualan.pdf', 'I'); // Output the PDF
