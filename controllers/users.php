<?php

require 'config_database.php';

function create($data)
{
    global $conn;
    $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
    $email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars($data['username']);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
    $username = htmlspecialchars($data['username']);
    $result_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result_username)) {
        echo "<script>
		alert('Username Telah Terdaftar. Silahkan Gunakan Username yang Lain')
		document.location.href='index.php';
		</script>";
        return false;
    }
    if ($password !== $konfirmasi_password) {
        echo "<script>
		alert('Konfirmasi Password Anda Salah')
		document.location.href='index.php';
		</script>";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $id_role =  htmlspecialchars($data['id_role']);
    $id_klasifikasi = htmlspecialchars($data['id_klasifikasi']);
    $foto = 'undraw_profile.svg';

    $query = "INSERT INTO users
    VALUES 
    ('','$nama_lengkap', '$email', '$username', '$password', '$id_role', '$id_klasifikasi', '$foto')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id_users = $data["id_users"];
    $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
    $email = htmlspecialchars($data["email"]);
    $username = htmlspecialchars($data['username']);
    $id_role =  htmlspecialchars($data['id_role']);
    $id_klasifikasi = htmlspecialchars($data['id_klasifikasi']);

    $fotoLama = htmlspecialchars($data["fotoLama"]);
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_foto();
    }
    $query = "UPDATE users SET
    id_users = '$id_users',
    nama_lengkap = '$nama_lengkap', 
    email = '$email', 
    username = '$username', 
    id_role = '$id_role', 
    id_klasifikasi = '$id_klasifikasi', 
    foto = '$foto'  
    WHERE id_users = $id_users
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function update_password($data)
{
    global $conn;
    $id_users = $data["id_users"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
    if ($password !== $konfirmasi_password) {
        $_SESSION["pesan"] = "Konfirmasi Password Anda Salah.";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET
    id_users = '$id_users',
    password = '$password'
    WHERE id_users = $id_users
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id_users)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_users = $id_users");
    return mysqli_affected_rows($conn);
}

function upload_foto()
{
    $File = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
		alert('Silahkan Upload Kapal Terlebih Dahulu');
		</script>
		";
        return false;
    }

    $ekstensiGambarValid = ['png', 'jpg', 'doc', 'docx', 'pdf', 'jpeg'];
    $ekstensiGambar = explode('.', $File);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
		alert('Silahkan Upload Foto Kapal dengan format jpg atau png doc atau docx atau pdf');
		</script>
		";
        return false;
    }

    if ($ukuranFile > 2000000000000) {
        echo "<script>
		alert('Silahkan Upload Foto Kapal dengan size max 2MB');
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
