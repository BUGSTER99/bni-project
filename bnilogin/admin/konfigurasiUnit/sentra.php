<?php 

    require '../../function.php';
    session_start();
	if (empty($_SESSION['username'])) {
		echo "<script>
                alert('Maaf Anda Belum Login');
				document.location = '../../login.php'
            </script>";
	}

    $kodesektor = query("SELECT * FROM ".$prefix."sentra")

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Dashboard</title>

<!-- Bootstrap CSS CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" href="../../assets/DataTables/datatables.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="icon" href="../favicon.ico">


<!-- Font Awesome JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
            <div class="sidebar-brand-icon rotate-n-15" style="font-size: 0,5rem;">
                 <i class="fas fa-bell fa-2x"></i>
            </div>
            <h3 class="sidebar-brand-text mx-3">Program Management System</h3>
        </div>
        </a>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-key"></i> Konfigurasi Unit</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="./sektor.php"><i class="fas fa-fw fa-wrench"></i> Sektor</a>
                    </li>
                    <li>
                        <a href="./divisi.php"><i class="fas fa-fw fa-wrench"></i> Divisi</a>
                    </li>
                    <li>
                        <a href="./wilayah.php"><i class="fas fa-fw fa-wrench"></i> Wilayah</a>
                    </li>
                    <li>
                        <a href="./cabang.php"><i class="fas fa-fw fa-wrench"></i> cabang</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-fw fa-wrench"></i> Sentra Kredit</a>
                    </li>
                    <li>
                        <a href="./risiko.php"><i class="fas fa-fw fa-wrench"></i> Risiko Kredit</a>
                    </li>
                    <li>
                        <a href="./perusahaan.php"><i class="fas fa-fw fa-wrench"></i> Perusahaan Anak</a>
                    </li>
                    <li>
                        <a href="./cabangLn.php"><i class="fas fa-fw fa-wrench"></i> Cabang LN</a>
                    </li>
                </ul>
            </li>
          
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-key"></i> Konfigurasi KPI</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="../konfigurasiKpi/perspective.php"><i class="fas fa-fw fa-cog"></i> Perspective</a>
                    </li>
                    <li>
                        <a href="../konfigurasiKpi/format.php"><i class="fas fa-fw fa-cog"></i> Format Perspective</a>
                    </li>
                    <li>
                        <a href="../konfigurasiKpi/kpiUnit.php"><i class="fas fa-fw fa-cog"></i> KPI Unit Level</a>
                    </li>
                    <li>
                        <a href="../konfigurasiKpi/kpiSub.php"><i class="fas fa-fw fa-cog"></i> KPI Unit Sub Type</a>
                    </li>
                    <li>
                        <a href="../konfigurasiKpi/kelolaan.php"> <i class="fas fa-fw fa-cog"></i> Kelolaan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
            <a href="../../logout.php" >
                            <i class="fas fa-sign-out-alt tm-nav-fa-icon"></i>
                            <span>Logout</span> </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
            </div>
        </nav>

        <table class="table table-stripped table-bordered" id="myTable">
            <thead>
                    <tr>
                        <td>No.</td>
                        <td>ID WILAYAH</td>
                        <td>ID SENTRA</td>
                        <td>KODE SENTRA</td>
                        <td>NAMA SENTRA</td>
                        <td>TIPE SENTRA</td>
                        <td>STATUS</td>
                        <td>AKSI</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($kodesektor as $kode) : ?>
                    <tr>
                        <td> <?= $i;?> </td> 
                        <td><?= $kode["id_wil"];?> </td>
                        <td><?= $kode["id_sentra"];?></td>
                        <td><?= $kode["kd_sentra"];?></td>
                        <td><?= $kode["nm_sentra"];?></td>
                        <td><?= $kode["tipe_sentra"];?></td>
                        <td><?= $kode["status"];?></td>
                        <td><a href="../../clean.php?id=<?= $kode["id"]; ?>" onclick="return confirm('Hapus Data?');"><i class="fa fa-trash" aria-hidden="true"></i></a> | <a href="../../edit.php?id=<?=$kode["id"];?>"> <i class="fas fa-pencil-alt" aria-hidden="true"></i> </a> </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
        </table>
            <br>
            <br>
            <form action="../../tambah.php" method="POST">
                    <!-- Button trigger modal -->
                    <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBox">
                    <i class="fa fa-map-pin"></i>
                   <span>Tambah Sentra</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Sentra Kredit</h5>
                            <button type="button" class="fa fa-window-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Data : <?= $kode["id"];?> </label>
                            </div>
                        <div class="mb-3">
                            <label for="id_wil" class="form-label">ID WILAYAH :</label>
                            <select class="form-select" id="id_wil" name="id_wil" required>
                                    <option value=""><strong>-Pilih WILAYAH-</strong></option>
                                    <option value="601">601 : WMD</option>
                                    <option value="602">602 : WPD</option>
                                    <option value="603">603 : WPL</option>
                                    <option value="604">604 : WBN</option>
                                    <option value="605">605 : WSM</option>
                                    <option value="606">606 : WSY</option>
                                    <option value="607">607 : WMK</option>
                                    <option value="608">608 : WDR</option>
                                    <option value="609">609 : WBJ</option>
                                    <option value="610">610 : WJS</option>
                                    <option value="611">611 : WMO</option>
                                    <option value="612">612 : WJK</option>
                                    <option value="614">614 : WJB</option>
                                    <option value="615">615 : WJY</option>
                                    <option value="616">616 : WPU</option>
                                    <option value="617">617 : WYK</option>
                                    <option value="618">618 : WMA</option>
                            </select>
                            <input type="hidden"  id="table" name="table" value="sentra">
                        </div>
                        <div class="mb-3">
                            <label for="id_sentra" class="form-label">ID SENTRA :</label>
                            <input type="text" class="form-control" id="id_sentra" name="id_sentra" required>
                        </div>
                        <div class="mb-3">
                            <label for="kd_sentra" class="form-label">KODE SENTRA :</label>
                            <input type="text" class="form-control" id="kd_sentra" name="kd_sentra" required>
                        </div>
                        <div class="mb-3">
                            <label for="nm_sentra" class="form-label">NAMA SENTRA :</label>
                            <input type="text" class="form-control" id="nm_sentra" name="nm_sentra" required>
                        </div>
                            <div class="form-group">
                                <label for="tipe_sentra">TIPE SENTRA :</label>
                                <br>
                                <select class="form-select" id="tipe_sentra" name="tipe_sentra" required>
                                    <option value=""><strong>-Pilih Tipe SENTRA-</strong></option>
                                    <option value="SKM">SKM</option>
                                    <option value="SKC">SKC</option>
                                    <option value="LNC">LNC</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
        </form>


        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="../../assets/DataTables/datatables.min.js"></script>
<script src="../js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>