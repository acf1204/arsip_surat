<?php

require 'config_database.php';

function create($data)
{
    global $conn;
    $jabatan = htmlspecialchars($data["jabatan"]);

    $query = "INSERT INTO klasifikasi
    VALUES 
    ('','$jabatan')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id_klasifikasi = $data["id_klasifikasi"];
    $jabatan = htmlspecialchars($data["jabatan"]);

    $query = "UPDATE klasifikasi SET
    id_klasifikasi = '$id_klasifikasi',
    jabatan = '$jabatan'
    WHERE id_klasifikasi = $id_klasifikasi
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id_klasifikasi)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM klasifikasi WHERE id_klasifikasi = $id_klasifikasi");
    return mysqli_affected_rows($conn);
}
