<?php
session_start();
require '../controllers/disposisi.php';
require '../controllers/config_load_data.php';
$id_surat = $_GET['id_surat'];
if (isset($_POST["submit"])) {
    if (create($_POST) > 0) {
        echo "<script>
		alert('Data Berhasil Ditambah')
		document.location.href='index.php?id_surat=$id_surat';
		</script>";
    } else {
        echo "<script>
		alert('Data Gagal Ditambah')
		document.location.href='index.php?id_surat=$id_surat';
		</script>";
    }
}
$disposisi = query("SELECT * FROM disposisi INNER JOIN users ON disposisi.id_users = users.id_users WHERE id_surat = '$id_surat' ");
$surat = query("SELECT * FROM surat WHERE id_surat = '$id_surat' ")[0];
$users = query("SELECT * FROM users WHERE id_role != 1");
?>

<?php $id_users =  $_SESSION['login']['id_users'] ?>
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
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-envelope-square"></i>
                        <span>Surat</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Transaksi Surat:</h6>
                            <a class="collapse-item active" href="../masuk/index.php">Surat Masuk</a>
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
                        <h1 class="h3 mb-0 text-gray-800">Disposisi </h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php if (isset($_SESSION["pesan"])) : ?>
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a><?= $_SESSION["pesan"]; ?>
                                </div>
                            <?php endif; ?>
                            <?php unset($_SESSION["pesan"]); ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah</button>

                            <button type="button" class="btn btn-secondary"><a href="../masuk/index.php" style="text-decoration: none; color: white;"> Kembali </a></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tujuan</th>
                                            <th>Batas Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tujuan</th>
                                            <th>Batas Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($disposisi as $disposisi) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $disposisi['nama_lengkap'] ?></td>
                                                <td><?= $disposisi['batas_waktu'] ?></td>
                                                <td>
                                                    <a href="detail.php?id_disposisi=<?= $disposisi['id_disposisi']; ?>&id_surat=<?= $id_surat ?>" class="btn btn-info" style="color: white;">Detail</a>
                                                    <a href="update.php?id_disposisi=<?= $disposisi['id_disposisi']; ?>&id_surat=<?= $id_surat ?>" class="btn btn-warning" style="color: white;">Edit</a>
                                                    <a href="delete.php?id_disposisi=<?= $disposisi['id_disposisi']; ?>&id_surat=<?= $id_surat ?>" onclick="return confirm('Anda Yakin Ingin Menghapus Data ini?')" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambahkan Surat Masuk</h5>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="id_surat" value="<?= $id_surat ?>">
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pengirim</label>
                                                <input type="text" class="form-control" id="exampleInputrole" name="pengirim" value="<?= $surat['pengirim'] ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tujuan</label>
                                                <select id="disabledSelect" class="form-control" name="id_users" required>
                                                    <?php foreach ($users as $users) : ?>
                                                        <option value="<?= $users['id_users'] ?>"><?= $users['nama_lengkap'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Isi</label>
                                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="isi" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Batas Waktu</label>
                                                <input type="date" class="form-control" id="exampleInputrole" name="batas_waktu" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Catatan</label>
                                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="catatan" required></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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

    !-- Bootstrap core JavaScript-->
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