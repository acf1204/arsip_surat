<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Surat Masuk.xls");
session_start();
require '../controllers/config_database.php';
// require_once __DIR__ . '/../vendor/autoload.php';
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->AddPage('L');
// ob_start();
require '../controllers/config_load_data.php';
$surat = query('SELECT * FROM disposisi INNER JOIN surat ON disposisi.id_surat = surat.id_surat INNER JOIN users ON disposisi.id_users = users.id_users  INNER JOIN klasifikasi ON users.id_klasifikasi = klasifikasi.id_klasifikasi');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Surat Masuk - PDF</title>
</head>

<body>
    <h1 align="center">Daftar Surat Masuk</h1>
    Tanggal Dicetak : <?= date('d/m/Y') ?>
    <table border="1" width="100%">
        <tr>
            <td align="center" style="padding:10px;">No.Agenda</td>
            <td align="center" style="padding:10px;">Pengirim</td>
            <td align="center" style="padding:10px;">No. Surat</td>
            <td align="center" style="padding:10px;">Isi </td>
            <td align="center" style="padding:10px;">Tanggal Surat</td>
            <td align="center" style="padding:10px;">Tanggal Diterima</td>
            <td align="center" style="padding:10px;">Disposisi</td>
            <td align="center" style="padding:10px;">Keterangan</td>
        </tr>
        <?php $nomor = 1;
        foreach ($surat as $surat) : ?>
            <tr>
                <td align="center" style="padding:10px;"><?= $surat['no_agenda'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['pengirim'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['no_surat'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['isi_ringkasan'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['tanggal_surat'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['tanggal_terima'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['jabatan'] ?></td>
                <td align="center" style="padding:10px;"><?= $surat['keterangan'] ?></td>
            </tr>
        <?php $nomor++;
        endforeach ?>
    </table>
</body>

</html>

</html>
<?php
// $html = ob_get_contents();
// ob_end_clean();
// $mpdf->WriteHTML(utf8_encode($html));
// $mpdf->Output("Surat Masuk.pdf", 'I');

?>