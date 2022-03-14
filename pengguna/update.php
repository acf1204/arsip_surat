<?php
session_start();
require '../controllers/users.php';
require '../controllers/config_load_data.php';
if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "<script>
		alert('Data Berhasil Diubah')
		document.location.href='index.php';
		</script>";
    } else {
        echo "<script>
		alert('Data Gagal Diubah')
		document.location.href='index.php';
		</script>";
    }
}

$id_users = $_GET['id_users'];
$users = query("SELECT * FROM users INNER JOIN role ON users.id_role = role.id_role INNER JOIN klasifikasi ON users.id_klasifikasi = klasifikasi.id_klasifikasi WHERE id_users = $id_users")[0];

$role = query("SELECT * FROM role WHERE id_role");
$klasifikasi = query('SELECT * FROM klasifikasi');
?>
<?php $id_user =  $_SESSION['login']['id_users'] ?>
<?php $login = query("SELECT * FROM users WHERE id_users = $id_user ")[0] ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arsip Surat</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-cogs"></i>
                        <span>Pengaturan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="../role/index.php">Role</a>
                            <a class="collapse-item active" href="../pengguna/index.php">Pengguna</a>
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
            <li class="nav-item">
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
                            <marquee>Aplikasi Pengarsipan Surat Masuk dan Surat Keluar Dinas Komunikasi dan Informatika</marquee>
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
                        <h1 class="h3 mb-0 text-gray-800">Update Data Pengguna</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_users" value="<?= $id_users ?>">
                                <input type="hidden" name="fotoLama" value="<?= $users['foto'] ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="exampleInputrole" name="nama_lengkap" value="<?= $users['nama_lengkap'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Masukan Username</label>
                                        <input type="text" class="form-control" id="exampleInputrole" name="username" value="<?= $users['username'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Masukan Email</label>
                                        <input type="email" class="form-control" id="exampleInputrole" name="email" value="<?= $users['email'] ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select id="disabledSelect" class="form-control" name="id_role">
                                            <option value="<?= $users['id_role'] ?>"><?= $users['role'] ?></option>
                                            <?php foreach ($role as $role) : ?>
                                                <?php if ($role['id_role'] != $users['id_role']) : ?>
                                                    <option value="<?= $role['id_role'] ?>"><?= $role['role'] ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <select id="disabledSelect" class="form-control" name="id_klasifikasi">
                                            <option value="<?= $users['id_klasifikasi'] ?>"><?= $users['jabatan'] ?></option>
                                            <?php foreach ($klasifikasi as $klasifikasi) : ?>
                                                <?php if ($klasifikasi['id_klasifikasi'] != $users['id_klasifikasi']) : ?>
                                                    <option value="<?= $klasifikasi['id_klasifikasi'] ?>"><?= $klasifikasi['jabatan'] ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label> <br>
                                        <img src="../upload/<?= $users['foto'] ?>" alt="" class="m-3" width="25%">
                                        <input type="file" class="form-control" id="exampleInputrole" name="foto">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

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


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>