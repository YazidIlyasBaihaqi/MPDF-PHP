<?php
include_once "./conn.php";
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $q = "SELECT * FROM mahasiswa WHERE Nik = '$nik' AND Nama = '$nama'";
    $res = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($res);
    $html = '<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h2>Data Mahasiswa  ' . $nama . '</h2>
        <h3>Prodi ' . $row['Jurusan'] . ' </h3>
        <table border="1" cellspacing="0" cellspadding="0" width="100%">
        <thead> 
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Matakuliah</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>';
    $q2 = "SELECT  m.MatkulKode AS Kode, m.NamaMatkul AS Matakuliah, n.Nilai FROM nilai n
    JOIN matkul m ON n.KodeMatkul = m.MatkulKode WHERE Nik = '$nik'";
    $res2 = mysqli_query($conn, $q2);
    $no = 1;
    if ($row > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            $html .= '<tr>
            <td>' . $no . '</td>
            <td>' . $row['Kode'] . '</td>
            <td>' . $row['Matakuliah'] . '</td>
            <td>' . $row['Nilai'] . '</td>';
            $no++;
        }
    }
    $html .= '</tbody></table></body></html>';

    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}
