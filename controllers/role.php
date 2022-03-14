<?php

require 'config_database.php';

function create($data)
{
    global $conn;
    $role = htmlspecialchars($data["role"]);

    $query = "INSERT INTO role
    VALUES 
    ('','$role')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id_role = $data["id_role"];
    $role = htmlspecialchars($data["role"]);

    $query = "UPDATE role SET
    id_role = '$id_role',
    role = '$role'
    WHERE id_role = $id_role
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id_role)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM role WHERE id_role = $id_role");
    return mysqli_affected_rows($conn);
}
