<?php
include_once "../../functions.php";
$menu  = "transaksi";
$title = "transaksi_utang";
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Putra Subur Makmur</title>


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
          <h1>Transaksi Utang</h1>
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
              <a href="<?= BASEURL ?>/pages/transaksi/transaksi.php" class="btn btn-primary" type="button">Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No Faktur</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Jatuh Tempo</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kurang</th>
                    <th>Lunasi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
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
                <!-- <div class="form-group">
                  <label>Potongan</label>
                  <input type="text" name="diskon" value="0" id="diskon" class="form-control" />
                  <input type="hidden" name="diskon_baru" id="diskon-baru" class="form-control" />
                </div> -->
                <div class="form-group">
                  <label id="keterangan"></label>
                  <input type="text" name="kembalian" id="kembalian" class="form-control" / readonly>
                </div>
                <div class="form-group">
                  <label>Bayar</label>
                  <input type="text" name="bayar" id="bayar" class="form-control" / required>
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
<script src="<?= BASEURL ?>/dist/js/pages/js-rupiah.js"></script>

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
        processing: true,
        serverSide: true,
        "searching": true,
        ajax: {
            url: "getDaftarTransaksiUtang.php", // Ensure this URL is correct
            datatype: "json",
        },
        "pageLength": 10,  
        "lengthMenu": [[10], [10]],
        "columns": [
            { "data": "no_faktur" },
            { "data": "nama_pelanggan" },
            { "data": "tanggal" },
            { "data": "jatuh_tempo" },
            { "data": "total" },
            { "data": "bayar" },
            { "data": "kembali" },
            { "data": "actions" }
        ],
        "order": [
            [0, 'desc'] // Order by the first column (no_faktur)
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json' // Indonesian language support
        },
    });
});
</script>
<script>
  // $(function() {
  //   $("#example1").DataTable({
  //     "responsive": true,
  //     // "lengthChange": false,
  //     "autoWidth": false,
  //     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //     language: {
  //       url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
  //     }
  //   });
  // });

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
          // var diskonAwal = parseInt(data.diskon);
          $('#status').val(data.status);
          $('#bayar').val('0');
          // (diskonAwal == 0 ? $('#diskon').val('0') : $('#diskon').val(convertToRupiah(diskonAwal)));
          // $('#diskon').on('keyup', function() {
          //   var rupiah = formatRupiah($(this).val(), 'Rp. ');
          //   $(this).val(rupiah);
          //   var diskon = convertToAngka(rupiah);
          //   var bayar = convertToAngka($('#bayar').val());
          //   var kembalian = convertToAngka($('#kembalian').val());
          //   var diskonBaru = bayar + diskon - kembali;
          //   var hasilDiskonBaru = diskonAwal + diskon;
          //   if (diskon >= Math.abs(kembalian)) {
          //     $('#kembalian').val(convertToRupiah(diskonBaru));
          //     $('#keterangan').text("Lebih")
          //     $('#status').val("Lunas");
          //   } else {
          //     $('#kembalian').val(convertToRupiah(diskonBaru));
          //     $('#keterangan').text("Kurang");
          //     $('#status').val("Utang");
          //   }
          //   $('#diskon-baru').val(hasilDiskonBaru);
          // })
          $('#bayar').on('keyup', function() {
            var rupiah = formatRupiah($(this).val(), 'Rp. ');
            $(this).val(rupiah);
            var bayar = convertToAngka(rupiah);
            // var diskon = convertToAngka($('#diskon').val());
            var kembalian = convertToAngka($('#kembalian').val());
            var sisaBayar = kembali + bayar;
            if (sisaBayar >= 0) {
              $('#kembalian').val(convertToRupiah(sisaBayar));
              $('#keterangan').text("Lebih")
              $('#status').val("Lunas");
            } else {
              $('#kembalian').val(convertToRupiah(sisaBayar));
              $('#keterangan').text("Kurang");
              $('#status').val("Utang");
            }
            var bayarBaru = bayar + bayarAwal;
            $('#bayar-baru').val(bayarBaru);
          })
          var keterangan = "Kurang";
          $('#keterangan').text(keterangan);
          $('#total').val(convertToRupiah(total));
          // var hasilDiskonBaru = diskonAwal;
          // $('#diskon-baru').val(hasilDiskonBaru);
          $('#kembalian').val(convertToRupiah(kembali));
          $('#update-utang').val("Simpan");
          $('#add_data_Modal').modal('show');
        }
      });
    });
  });
</script>
</body>

</html>