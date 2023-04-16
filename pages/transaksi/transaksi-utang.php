<?php
include_once "../../functions.php";
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
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
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
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Jatuh Tempo</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kurang</th>
                    <th>Lunasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $data = getAllTransaksiUtang();
                  foreach ($data as $item) {
                  ?>
                    <tr>
                      <td><?= $item['no_faktur']; ?></td>
                      <td><?= $item['tanggal']; ?></td>
                      <td><?= $item['jatuh_tempo']; ?></td>
                      <td><?= $item['total']; ?></td>
                      <td><?= $item['bayar']; ?></td>
                      <td><?= $item['kembali']; ?></td>
                      <td align="center">
                        <!-- a href -->
                        <a href="#" type="button" name="utang" value="utang" id="<?= $item["no_faktur"]; ?>" class="btn btn-info piutang">
                          <i class="fas fa-money-check"></i>
                        </a>
                      </td>
                    </tr>
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
      <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Pelunasan Utang</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="post" action="transaksi-pelunasan.php">
                <div class="form-group">
                  <label>No Faktur</label>
                  <input type="text" name="no_faktur" id="no_faktur" class="form-control" / readonly>
                </div>
                <div class="form-group">
                  <label>Total</label>
                  <input type="text" name="total" id="total" class="form-control" / readonly>
                </div>
                <div class="form-group">
                  <label>Potongan</label>
                  <input type="number" name="diskon" value="0" id="diskon" class="form-control" />
                  <input type="hidden" name="diskon_baru" id="diskon-baru" class="form-control" />
                </div>
                <div class="form-group">
                  <label id="keterangan"></label>
                  <input type="number" name="kembalian" id="kembalian" class="form-control" / readonly>
                </div>
                <div class="form-group">
                  <label>Bayar</label>
                  <input type="number" name="bayar" id="bayar" class="form-control" / required>
                  <input type="hidden" name="bayar_baru" id="bayar-baru" / class="form-control">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <input type="text" name="status" id="status" class="form-control" / readonly>
                </div>
                <input type="hidden" name="employee_id" id="employee_id" />
                <div class="d-flex justify-content-end">
                  <input type="submit" name="update_utang" id="update-utang" value="update" class="btn btn-primary" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




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

  $(document).ready(function() {
    $(document).on('click', '.piutang', function() {
      var no_faktur = $(this).attr("id");
      $.ajax({
        url: "ambilDataFaktur.php",
        method: "POST",
        data: {
          no_faktur: no_faktur
        },
        dataType: "json",
        success: function(data) {
          $('#no_faktur').val(data.no_faktur);
          var total = parseInt(data.total);
          var bayarAwal = parseInt(data.bayar);
          var kembali = parseInt(data.kembali);
          var diskonAwal = parseInt(data.diskon);
          $('#status').val(data.status);
          $('#diskon').on('keyup', function() {
            var diskon = parseInt($(this).val());
            var bayar = parseInt($('#bayar').val());
            var diskonBaru = kembali + diskon;
            var hasilDiskonBaru = diskonAwal + diskon;
            var sisa = kembali + hasilDiskonBaru;
            if (hasilDiskonBaru > Math.abs(diskonBaru)) {
              // kembali += hasilDiskonBaru;
              $('#kembalian').val(sisa);
              $('#keterangan').text("Lebih")
              $('#status').val("Lunas");
            } else {
              $('#kembalian').val(diskonBaru);
              $('#keterangan').text("Kurang");
              $('#status').val("Utang");
            }
            // $('#kembalian').val("text");
            $('#diskon-baru').val(hasilDiskonBaru);
          })
          $('#bayar').on('keyup', function() {
            var bayar = parseInt($(this).val());
            var diskon = parseInt($('#diskon').val());
            var sisa = kembali + bayar + diskon;
            $('#kembalian').val(sisa);
            if (bayar > Math.abs(sisa)) {
              $('#keterangan').text("Lebih")
              $('#status').val("Lunas");
            } else {
              $('#keterangan').text("Kurang");
              $('#status').val("Utang");
            }
            var bayarBaru = bayar + bayarAwal;
            $('#bayar-baru').val(bayarBaru);
          })
          var keterangan = "Kurang";
          $('#keterangan').text(keterangan);
          $('#total').val(total);
          $('#bayar').val(bayar);
          $('#diskon').val(diskon);
          var hasilDiskonBaru = diskonAwal;
          $('#diskon-baru').val(hasilDiskonBaru);
          $('#kembalian').val(kembali);
          $('#update-utang').val("Simpan");
          $('#add_data_Modal').modal('show');
        }
      });
    });
  });
</script>
</body>

</html>