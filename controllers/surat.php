<?php

require 'config_database.php';

function create($data)
{
    global $conn;
    $no_agenda = htmlspecialchars($data["no_agenda"]);
    $pengirim = htmlspecialchars($data["pengirim"]);
    $no_surat = htmlspecialchars($data["no_surat"]);
    $isi_ringkasan = htmlspecialchars($data["isi_ringkasan"]);
    $tanggal_surat = htmlspecialchars($data['tanggal_surat']);
    $tanggal_terima = htmlspecialchars($data['tanggal_terima']);
    $keterangan =  $data["keterangan"];
    $tipe_surat =  $data["tipe_surat"];
    $bulan =  $data["bulan"];
    $tahun =  $data["tahun"];
    $jenis_surat = $data["jenis_surat"];
    if ($_FILES['file']['error'] === 4) {
        $_SESSION["pesan"] = "Silahkan Upload Foto surat.";
        return false;
    } else {
        $file = upload_file();
    }
    $query = "INSERT INTO surat
    VALUES 
    ('','$no_agenda', '$pengirim', '$no_surat', '$isi_ringkasan', '$tanggal_surat', '$tanggal_terima', '$keterangan', '$tipe_surat', '$bulan', '$tahun', '$file', '$jenis_surat')
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id_surat = $data["id_surat"];
    $no_agenda = htmlspecialchars($data["no_agenda"]);
    $pengirim = htmlspecialchars($data["pengirim"]);
    $no_surat = htmlspecialchars($data["no_surat"]);
    $isi_ringkasan = htmlspecialchars($data["isi_ringkasan"]);
    $tanggal_surat = htmlspecialchars($data["tanggal_surat"]);
    $tanggal_terima = htmlspecialchars($data["tanggal_terima"]);
    $keterangan =  $data["keterangan"];
    $tipe_surat =  $data["tipe_surat"];
    $bulan =  $data["bulan"];
    $tahun =  $data["tahun"];
    $jenis_surat = $data["jenis_surat"];
    $fileLama = htmlspecialchars($data["fileLama"]);
    if ($_FILES['file']['error'] === 4) {
        $file = $fileLama;
    } else {
        $file = upload_file();
    }
    $query = "UPDATE surat SET
    id_surat = '$id_surat',
    no_agenda = '$no_agenda',
    pengirim = '$pengirim',
    no_surat = '$no_surat',
    isi_ringkasan = '$isi_ringkasan',
    tanggal_surat = '$tanggal_surat', 
    tanggal_terima = '$tanggal_terima',  
    keterangan = '$keterangan',  
    tipe_surat = '$tipe_surat', 
    bulan = '$bulan', 
    tahun = '$tahun', 
    file = '$file', 
    jenis_surat = '$jenis_surat' 
    WHERE id_surat = $id_surat
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function delete($id_surat)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM surat WHERE id_surat = $id_surat");
     mysqli_query($conn, "DELETE FROM disposisi WHERE id_surat = $id_surat");
    return mysqli_affected_rows($conn);
}


function upload_file()
{
    $File = $_FILES['file']['name'];
    $ukuranFile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpName = $_FILES['file']['tmp_name'];

    if ($error === 4) {
        echo "<script>
		alert('Silahkan Upload surat Terlebih Dahulu');
		</script>
		";
        return false;
    }

    $ekstensiGambarValid = ['png', 'jpg', 'doc', 'docx', 'pdf', 'jpeg'];
    $ekstensiGambar = explode('.', $File);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
		alert('Silahkan Upload Foto surat dengan format jpg atau png doc atau docx atau pdf');
		</script>
		";
        return false;
    }

    if ($ukuranFile > 2000000000000) {
        echo "<script>
		alert('Silahkan Upload Foto surat dengan size max 2MB');
		</script>
		";
        return false;
    }

    $FileBaru = uniqid();
    $FileBaru .= '.';
    $FileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../upload/' . $FileBaru);
    return $FileBaru;
}
