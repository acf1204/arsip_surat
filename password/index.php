<?php session_start(); ?>
<?php
require '../controllers/users.php';
require '../controllers/config_load_data.php'; ?>
<?php $id_role_login =  $_SESSION['login']['id_role'] ?>
<?php $id_users =  $_SESSION['login']['id_users'];  ?>
<?php
if (isset($_POST["submit"])) {
    if (update_password($_POST) > 0) {
        echo "<script>
    alert('Data Berhasil Diubah')
    document.location.href = 'index.php';
</script>";
    } else {
        echo "<script>
    alert('Data Gagal Diubah')
    document.location.href = 'index.php';
</script>";
    }
}
?>
<?php $login = query("SELECT * FROM users WHERE id_users = $id_users ")[0] ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arsip Surat</title>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon ">
                    <img src="../img/kominfo.png" style="width: 60px;" alt="">
                </div>
            </a>

            <?php if ($login['id_role'] == 1) : ?>
                <!-- Divider -->
                <hr class="sidebar-divider my-2">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard/index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Admin
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cogs"></i>
                        <span>Pengaturan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../role/index.php">Role</a>
                            <a class="collapse-item" href="../pengguna/index.php">Pengguna</a>
                            <a class="collapse-item" href="../klasifikasi/index.php">Klasifikasi</a>
                            <div class="collapse-divider"></div>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($login['id_role'] == 1) : ?>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Staff
                </div>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-envelope-square"></i>
                        <span>Surat</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Transaksi Surat:</h6>
                            <a class="collapse-item" href="../masuk/index.php">Surat Masuk</a>
                            <a class="collapse-item" href="../keluar/index.php">Surat Keluar</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($login['id_role'] != 1) : ?>
                <!-- Nav Item - profile -->
                <li class="nav-item">
                    <a class="nav-link" href="../disposisi_masuk/index.php">
                        <i class="fas fa-fw fa-inbox"></i>
                        <span>Disposisi Masuk</span></a>
                </li>
            <?php endif; ?>


            <!-- Nav Item - profile -->
            <li class="nav-item">
                <a class="nav-link" href="../user/index.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User Profile</span></a>
            </li>


            <!-- Nav Item - password -->
            <li class="nav-item active">
                <a class="nav-link" href="../password/index.php">
                    <i class="fas fa-fw fa-key"></i>
                    <span>Ubah Password</span></a>
            </li>

            <!-- Nav Item - password -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <h3 style="width: 100%; height: auto; margin-top: 20px;">
                            <marquee>Aplikasi Pengarsipan Surat Masuk dan Surat Keluar Dinas Komunikasi dan Informatika
                            </marquee>
                        </h3>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $login['nama_lengkap'] ?></span>
                                <img class="img-profile rounded-circle" src="../upload/<?= $login['foto'] ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>

                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_users" value="<?= $id_users ?>">
                        <div class="row">
                            <div class="col-6">
                                <label for="inputPassword5" class="form-label">Masukan Password Baru</label>
                                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password" required>

                                <label for="inputPassword5" class="form-label">Ulangi Password Baru</label>
                                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="konfirmasi_password" required>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                        <button type="submit" name="submit" class="btn btn-primary mt-4">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Dinas Komunikasi dan Informatika</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
</body>

</html>