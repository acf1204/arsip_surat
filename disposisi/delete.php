<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}

require '../controllers/disposisi.php';
$id_disposisi = $_GET["id_disposisi"];
$id_surat = $_GET["id_surat"];

if (delete($id_disposisi) > 0) {
    $_SESSION["pesan"] = "Data Berhasil Dihapus";
    header("location:index.php?id_surat=$id_surat");
} else {
    $_SESSION["pesan"] = "Data Gagal Dihapus";
    header("location:index.php?id_surat=$id_surat");
}
