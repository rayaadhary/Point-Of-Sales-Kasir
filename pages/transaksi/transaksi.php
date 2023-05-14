<?php
include_once "../../functions.php";
$menu = "transaksi";
$title = "transaksi_tambah";
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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
  <link rel="stylesheet" href="../../dist/jquery/select2-4.1.0-rc.0/dist/css/select2.min.css">
  <script src="../../dist/jquery/moment.js"></script>
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
          <h1>Transaksi</h1>
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
            <!-- <div class="card-header"> -->
            <!-- <h3 class="card-title">DataTable with default features</h3> -->
            <!-- <a href="barang-tambah.php"><button type="button" class="btn btn-primary rounded">Tambah</button></a> -->
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button> -->
            <!-- <h3></h3> -->

            <!-- </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <form action="transaksi-tambah.php" method="post">
                <div class="row mb-4">
                  <div class="col-md-2">
                    <label for="tanggal">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" style="width: 140px;">
                  </div>
                  <div class="col-md-2">
                    <label for="jatuh-tempo">Jatuh Tempo</label>
                    <input type="date" class="form-control" name="jatuh_tempo" id="jatuh-tempo" readonly style="width: 140px;">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <?php
                      $waktu = date_format(date_create(), 'Y-m-d');
                      $kode_faktur = kodeFaktur($waktu);
                      ?>
                      <label for="no-faktur">No Faktur</label>
                      <input type="text" class="form-control" name="no_faktur" id="no-faktur" value="<?= $kode_faktur ?>" readonly style="width: 150px;">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-barang">Nama Barang</label>
                      <select name="nama_barang" id="nama-barang" class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="id-barang">ID Barang</label>
                      <input type="text" class="form-control" name="id_barang" id="id-barang" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-pelanggan">Nama Pelanggan</label>
                      <input type="text" name="nama_pelanggan" id="nama-pelanggan" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="id-pelanggan">ID</label>
                      <input type="text" class="form-control" name="id_pelanggan" id="id-pelanggan" readonly>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="banyak">Banyak</label>
                      <input type="number" class="form-control" name="banyak" id="banyak">
                    </div>
                  </div>
                  <input type="hidden" id="harga">
                  <input type="hidden" id="harga_beli">
                  <input type="hidden" name="no" id="no" value="1">
                  <div class="col-md-2">
                    <div class="d-flex justify-content-end">
                      <a href="#" class="btn btn-primary" id="tambah-transaksi">Tambah</a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="list">
                      <div class="row">
                        <div class="col-md-4">
                          <span>Nama Barang</span>
                        </div>
                        <div class="col-md-2">
                          <span>Harga</span>
                        </div>
                        <div class="col-md-2">
                          <span>Banyak</span>
                        </div>
                        <div class="col-md-3">
                          <span>Subtotal</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                    <div class="row">
                      <span>Total</span>
                      <input type="text" id="stotal" name="total" class="form-control" value="0" readonly>
                      <input type="hidden" id="totalSelisih" name="totalSelisih" class="form-control" value="0" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Potongan</span>
                      <input type="text" id="diskon" name="diskon" class="form-control" value="0">
                    </div>
                    <br>
                    <div class="row">
                      <span>Bayar</span>
                      <input type="text" id="bayar" name="bayar" class="form-control" required>
                    </div>
                    <br>
                    <div class="row">
                      <span>Sisa</span>
                      <input type="text" name="kembalian" id="kembalian" value="0" class="form-control" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Status</span>
                      <input type="text" name="status" id="status" class="form-control" readonly>
                    </div>
                    <br>
                    <div class="d-flex">
                      <div class="justify-content-start">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Simpan
                        </button>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- awal modal tambah -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Surat Jalan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="surat_jalan">Surat Jalan</label>
                            <?php
                            $suratJalan = nomorSuratJalan();
                            ?>
                            <input type="text" class="form-control" name="surat_jalan" id="surat_jalan" value="<?= $suratJalan ?>" readonly>
                          </div>
                          <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telepon" id="telepom" value="08">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" name="alamat_tujuan" id="alamat-tujuan" placeholder="Masukan Alamat Tujuan" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal_kirim" id="tanggal-kirim" required>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- akhir modal tambah -->
              </form>

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
<!-- <footer class=" main-footer">
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


<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>

<!-- Sweetalert -->
<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
  // Use datepicker on the date inputs
  // $("input[type=date]").datepicker({
  //   dateFormat: 'yy-dd-mm',
  //   onSelect: function(dateText, inst) {
  //     $(inst).val(dateText); // Write the value in the input
  //   }
  // });

  // Code below to avoid the classic date-picker
  $("input[type=date]").on('click', function() {
    return false;
  });

  $(document).ready(function() {
    // Mendapatkan tanggal sekarang dengan format yyyy-mm-dd
    var today = moment().format('YYYY-MM-DD');

    // Menetapkan nilai awal input tanggal dan jatuh tempo dengan tanggal sekarang
    $('#tanggal').val(today);
    $('#jatuh-tempo').val(today);
    $('#tanggal-kirim').val(today);

    $('#tanggal-kirim').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true
    });

    $('#tanggal').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      onSelect: function(selectedDate) {
        // Menghitung tanggal jatuh tempo dengan menambahkan satu bulan pada tanggal transaksi
        const tanggal = moment(selectedDate);
        // tanggal.add(1, 'month');
        const jatuhTempo = tanggal.format('YYYY-MM-DD');

        // Menetapkan nilai input jatuh tempo dengan hasil perhitungan
        $('#jatuh-tempo').val(jatuhTempo);
      }
    });
  });


  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi rupiah satuan ribuan
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  function convertToRupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++) {
      if (i % 3 == 0) {
        rupiah += angkarev.substr(i, 3) + '.';
      }
    }
    // Menghilangkan titik terakhir dan menambahkan 'Rp. ' di depan
    return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
  }



  function convertToAngka(rupiah) {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  }


  function del(no) {
    var stotal = convertToAngka($('#subTotal' + no).val());
    var alltotal = convertToAngka($('#stotal').val());
    var newtotal = alltotal - stotal;
    var selisih = convertToAngka($('#selisih' + no).val());
    var totalSelisih = convertToAngka($('#totalSelisih').val());
    var newselisih = totalSelisih - selisih;
    $('#stotal').val(convertToRupiah(newtotal));
    $('#totalSelisih').val(newselisih);
    $('#row' + no).remove();
    var diskon = convertToAngka($('#diskon').val());
    var bayar = convertToAngka($('#bayar').val());
    var kembalian = bayar - (newtotal - diskon >= 0 ? newtotal - diskon : 0);
    if (kembalian >= 0) {
      $('#kembalian').val(convertToRupiah(kembalian));
      $('#status').val('Lunas');
      var tanggal = $('#tanggal').val();
      $('#jatuh-tempo').val(tanggal);
    } else {
      $('#status').val('Utang');
      $('#kembalian').val(convertToRupiah(kembalian));
      jatuhTempo();
    }
  }

  function jatuhTempo() {
    const tanggal = moment($('#tanggal').val());
    tanggal.add(1, 'month');
    const jatuhTempo = tanggal.format('YYYY-MM-DD');

    // Menetapkan nilai input jatuh tempo dengan hasil perhitungan
    $('#jatuh-tempo').val(jatuhTempo);

    // Menerapkan datepicker pada input tanggal dan jatuh tempo
    $('#tanggal').datepicker({
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      onSelect: function(selectedDate) {
        // Menghitung tanggal jatuh tempo dengan menambahkan satu bulan pada tanggal transaksi
        const tanggal = moment(selectedDate);
        tanggal.add(1, 'month');
        const jatuhTempo = tanggal.format('YYYY-MM-DD');

        // Menetapkan nilai input jatuh tempo dengan hasil perhitungan
        $('#jatuh-tempo').val(jatuhTempo);
      }
    });
  }

  $(function() {
    $('#nama-barang').select2({
      theme: "classic",
      placeholder: 'Pilih Nama Barang',
      ajax: {
        url: "<?= BASEURL ?>/pages/transaksi/autocomplete.php",
        type: 'GET',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            term: params.term
          };
        },
        processResults: function(data) {
          var results = [];
          $.each(data, function(index, item) {
            results.push({
              id: item.id_barang,
              text: item.nama_barang,
              harga: item.harga,
              harga_beli: item.harga_beli
            });
          });
          return {
            results: results
          };
        },
        cache: true
      }
    });
    // Fungsi untuk mengambil id barang dari input field terpisah saat user memilih nama barang
    $('#nama-barang').on('select2:select', function(e) {
      var data = e.params.data;
      $('#id-barang').val(data.id);
      $('#harga').val(data.harga);
      $('#harga_beli').val(data.harga_beli);
    });

    $('#nama-pelanggan').autocomplete({
      source: "<?= BASEURL ?>/pages/transaksi/nama-pelanggan.php",
      select: function(event, ui) {
        $('#id-pelanggan').val(ui.item.id_pelanggan);
      }
    });

    $('#tambah-transaksi').on('click', function() {
      var no = $('#no').val();
      // var no = $('.list .row').length;
      var id_barang = $('#id-barang').val();
      var nama_barang = $('#nama-barang option:selected').text();
      var banyak = $('#banyak').val();
      var harga = convertToAngka($('#harga').val());
      var harga_beli = convertToAngka($('#harga_beli').val());
      var total = convertToAngka($('#stotal').val());
      var totalSelisih = convertToAngka($('#totalSelisih').val());
      var subtotal = banyak * harga;
      var total = parseInt(total) + parseInt(subtotal);
      var selisih = (harga - harga_beli) * banyak;
      var html = '<div class="row mb-2" id="row' + no + '">' +
        '<div class="col-md-4">' +
        '<input class="form-control" id="namaBarang' + no + '" name="nama_barang[]" readonly>' +
        '<input type="hidden" id="idBarang' + no + '" name="idBarang[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="hargaBarang' + no + '" name="harga[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="qty' + no + '" name="banyak[]" readonly>' +
        '</div>' +
        '<div class="col-md-3">' +
        '<input class="form-control" id="subTotal' + no + '"  name="subtotal[]" readonly>' +
        '<input type="hidden" id="selisih' + no + '" name="selisih[]" readonly>' +
        '</div>' +
        '<a class="btn btn-sm btn-danger rounded" onClick="del(' + no + ')"> X </a>' +
        '</div>';
      $('.list').append(html);
      $('#stotal').val(convertToRupiah(total));
      $('#namaBarang' + no).val(nama_barang);
      $('#idBarang' + no).val(id_barang);
      $('#hargaBarang' + no).val(convertToRupiah(harga));
      $('#selisih' + no).val(selisih);
      var totalSelisih = parseInt(totalSelisih) + convertToAngka($('#selisih' + no).val());
      $('#totalSelisih').val(totalSelisih);
      $('#qty' + no).val(banyak);
      $('#subTotal' + no).val(convertToRupiah(subtotal));
      $('#banyak').val('');
      var no = (no - 1) + 2;
      $('#no').val(no);
      $('#nama-barang').val(null).trigger('change');
      $('#id-barang').val(null).trigger('change');
    });

    $('#diskon').on('keyup', function() {
      var total = convertToAngka($('#stotal').val());
      var rupiah = formatRupiah($(this).val(), 'Rp. ');
      $(this).val(rupiah);
      var diskon = convertToAngka(rupiah);
      var bayar = convertToAngka($('#bayar').val());
      var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
      if (kembalian >= 0) {
        $('#kembalian').val(convertToRupiah(kembalian));
        $('#status').val('Lunas');
        var tanggal = $('#tanggal').val();
        $('#jatuh-tempo').val(tanggal);
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(convertToRupiah(kembalian));
        jatuhTempo();
      }
    })

    $('#bayar').on('keyup', function() {
      var total = convertToAngka($('#stotal').val());
      var diskon = convertToAngka($('#diskon').val());
      var rupiah = formatRupiah($(this).val(), 'Rp. ');
      $(this).val(rupiah);
      var bayar = convertToAngka(rupiah);
      var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
      if (kembalian >= 0) {
        $('#kembalian').val(convertToRupiah(kembalian));
        $('#status').val('Lunas');
        var tanggal = $('#tanggal').val();
        $('#jatuh-tempo').val(tanggal);
      } else if (total == 0) {
        $('#status').val('');
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(convertToRupiah(kembalian));
        jatuhTempo();
      }
    })
  });
</script>

</body>

</html>