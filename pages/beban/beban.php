<?php
include_once "../../functions.php";
$title = "beban";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<?php
include_once "../layout/header.php"
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <?php flash(); ?>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Beban Usaha</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">DataTable with default features</h3> -->
              <!-- <a href="barang-tambah.php"><button type="button" class="btn btn-primary rounded">Tambah</button></a> -->
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Beban</th>
                    <th>Nama Beban Usaha</th>
                    <th>Tanggal</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data = getAllBeban();
                  foreach ($data as $item) {
                  ?>
                    <tr>
                      <td><?= $item['id_beban']; ?></td>
                      <td><?= $item['nama_beban']; ?></td>
                      <td><?= $item['tanggal']; ?></td>
                      <td><?= $item['biaya']; ?></td>
                      <td>
                        <!-- a href -->
                        <a href="#" type="button" data-toggle="modal" data-target="#myModal<?= $item['id_beban'] ?>" class="btn btn-success btn-circle btn-sm">
                          <i class="fas fa-edit"></i>
                        </a>
                        <!-- a href -->
                        <a href="beban-hapus.php?id_beban=<?= $item['id_beban']; ?>" class="btn btn-danger btn-circle btn-sm hapus">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="myModal<?= $item['id_beban'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Edit Beban</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="beban-edit.php" method="post">
                              <?php
                              $id_beban = $item['id_beban'];
                              $data = getBebanById($id_beban);
                              ?>
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="id_beban">ID Beban</label>
                                  <input type="text" class="form-control" name="id_beban" id="id_beban" value="<?= $data['id_beban'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="nama_beban">Nama Beban Usaha</label>
                                  <input type="text" class="form-control" id="nama_beban" name="nama_beban" placeholder="Masukan Nama Beban Usaha" value="<?= $data['nama_beban'] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="tanggal">Tanggal</label>
                                  <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Tanggal" value="<?= $data['tanggal'] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="biaya">Biaya</label>
                                  <input type="number" class="form-control" id="biaya" name="biaya" placeholder="Masukan Biaya Beban Usaha" value="<?= $data['biaya'] ?>">
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan</button>
                            </div>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Akhir modal -->
                  <?php
                  }
                  ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modal Tambah Data -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Beban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="beban-tambah.php" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="id_beban">ID Beban</label>
              <input type="text" class="form-control" name="id_beban" id="id_beban" placeholder="Masukan ID Beban">
            </div>
            <div class="form-group">
              <label for="nama_beban">Nama Beban Usaha</label>
              <input type="text" class="form-control" id="nama_beban" name="nama_beban" placeholder="Masukan Nama Beban Usaha">
            </div>
            <div class="form-group">
              <label for="biaya">Biaya</label>
              <input type="number" class="form-control" id="biaya" name="biaya" placeholder="Masukan Biaya Beban Usaha">
            </div>
            <div class="form-group">
              <?php
              $waktu = date_format(date_create(), 'Y-m-d');
              ?>
              <label for="tanggal">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" placeholder="Masukan Tanggal Beban Usaha">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir modal -->



<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Sweetalert -->
<script src="<?= BASEURL ?>/dist/js/pages/js-hapus.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>

<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      // "lengthChange": false,
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
      }
    });
  });
</script>
</body>

</html>