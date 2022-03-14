<?php

require 'config_database.php';

function create($data)
{
    global $conn;
    $id_surat = htmlspecialchars($data["id_surat"]);
    $id_users = htmlspecialchars($data["id_users"]);
    $isi = htmlspecialchars($data['isi']);
    $batas_waktu =  htmlspecialchars($data['batas_waktu']);
    $catatan = htmlspecialchars($data['catatan']);

    $query = "INSERT INTO disposisi
    VALUES 
    ('','$id_surat', '$id_users', '$isi', '$batas_waktu', '$catatan')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id_disposisi = $data["id_disposisi"];
    $id_surat = htmlspecialchars($data["id_surat"]);
    $id_users = htmlspecialchars($data["id_users"]);
    $isi = htmlspecialchars($data['isi']);
    $batas_waktu =  htmlspecialchars($data['batas_waktu']);
    $catatan = htmlspecialchars($data['catatan']);
    $query = "UPDATE disposisi SET
    id_disposisi = '$id_disposisi',
    id_surat = '$id_surat', 
    id_users = '$id_users', 
    isi = '$isi', 
    batas_waktu = '$batas_waktu', 
    catatan = '$catatan' 
    WHERE id_disposisi = $id_disposisi
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function delete($id_disposisi)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM disposisi WHERE id_disposisi = $id_disposisi");
    return mysqli_affected_rows($conn);
}
