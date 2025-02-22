<?php
include_once "../../functions.php";
$menu = "transaksi";
$title = "transaksi_edit";
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
              <form action="transaksi-ubah.php" method="post">
                <div class="row mb-4">
                  <div class="col-md-2">
                    <div class="form-group">
                      <?php
                      // $waktu = date_format(date_create(), 'Y-m-d');
                      // $kode_faktur = kodeFaktur($waktu);
                      $kode_faktur = $_GET['idTransaksi'];
                      $dataTransaksi = getTransaksiById($kode_faktur);

                      // var_dump($dataTransaksi);
                      ?>
                      <label for="no-faktur">No Faktur</label>
                      <input type="text" class="form-control" name="no_faktur" id="no-faktur" value="<?= $kode_faktur ?>" readonly style="width: 150px;">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label for="tanggal">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $dataTransaksi["tanggal"] ?>" readonly style="width: 140px;">
                  </div>
                  <div class="col-md-2">
                    <label for="jatuh-tempo">Jatuh Tempo</label>
                    <input type="date" class="form-control" name="jatuh_tempo" id="jatuh-tempo" value="<?= $dataTransaksi["jatuh_tempo"] ?>" style="width: 140px;">
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-pelanggan">Nama Pelanggan</label>
                      <input type="text" name="nama_pelanggan" id="nama-pelanggan" class="form-control" value="<?= $dataTransaksi["nama_pelanggan"] ?>" readonly>
                      <input type="hidden" class="form-control" name="id_pelanggan" value="<?= $dataTransaksi["id_pelanggan"] ?>" id="id-pelanggan" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-barang">Nama Barang</label>
                      <select name="nama_barang" id="nama-barang" class="form-control"></select>
                      <input type="hidden" class="form-control" name="id_barang" id="id-barang" readonly>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <div class="form-group">
                      <label for="stok">Stok</label>
                      <input type="number" class="form-control" min="1" name="stok" max="" id="stok" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="harga">Harga</label>
                      <input type="text" class="form-control" min="1" name="harga" max="" id="harga" readonly>
                    </div>
                  </div>

                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="banyak">Qty</label>
                      <input type="number" class="form-control" name="banyak" id="banyak">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="diskon">Diskon</label>
                      <input type="text" id="diskon" name="diskon" class="form-control" value="0">
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
                  <div class="col-md-9">
                    <div class="list">
                      <div class="row">
                        <div class="col-md-3">
                          <span>Nama Barang</span>
                        </div>
                        <div class="col-md-2">
                          <span>Harga</span>
                        </div>
                        <div class="col-md-1">
                          <span>Qty</span>
                        </div>
                        <div class="col-md-3">
                          <span>Diskon</span>
                        </div>
                        <div class="col-md-2">
                          <span>Subtotal</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                    <div class="row">
                      <span>Jumlah</span>
                      <input type="text" id="jumlah" name="jumlah" class="form-control" value="0" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Total Diskon</span>
                      <input type="text" id="totalDiskon" name="totalDiskon" class="form-control" value="<?= $dataTransaksi["totalDiskon"] ?>" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Ongkos Kirim</span>
                      <input type="text" id="ongkosKirim" name="ongkosKirim" value="<?= $dataTransaksi['ongkosKirim'] ?>" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                      <span>Total</span>
                      <input type="text" id="stotal" name="total" class="form-control" value="0" readonly>
                      <input type="hidden" id="totalSelisih" name="totalSelisih" class="form-control" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Bayar</span>
                      <input type="text" id="bayar" name="bayar" value="<?= $dataTransaksi["bayar"] ?>" class="form-control" required>
                    </div>
                    <br>
                    <div class="row">
                      <span>Kembali</span>
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
                            // $suratJalan = nomorSuratJalan();
                            $suratJalan = $dataTransaksi['no_surat_jalan'];
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
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" >
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
    // $('#tanggal').val(today);
    // $('#jatuh-tempo').val(today);
    $('#tanggal-kirim').val(today);


    // $('#nama-pelanggan').val('');

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

    $('#jatuh-tempo').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true,
    });

    const kodeFaktur = $('#no-faktur').val();

    function getTransactionData(kodeFaktur) {
      $.ajax({
        url: 'ambilDataTransaksi.php',
        method: 'POST',
        data: {
          no_faktur: kodeFaktur
        },
        success: function(response) {
          const items = JSON.parse(response);
          displayItems(items);
        }
      });
    }

    function updateTotals() {
      let total = 0;
      let totalDiskon = 0;
      let totalSelisih = 0;
      let ongkosKirim = 0;

      // Loop through all rows
      $('.row').each(function(index) {
        const no = index + 1;
        const harga = convertToAngka($('#hargaBarang' + no).val());
        let qty = convertToAngka($('#qty' + no).val());
        let diskon = convertToAngka($('#diskon' + no).val());

        // diskon = diskon * qty;
        
        
        const hargaBeli = convertToAngka($('#hargaBeli' + no).val());

        const subtotal = (harga * qty) - diskon;
        const selisih = ((harga - hargaBeli) * qty) - diskon;

        $('#subTotal' + no).val(convertToRupiah(subtotal));
        // $('#diskon' + no).val(convertToRupiah(diskon));
        $('#selisih' + no).val(selisih);

        total += subtotal;
        totalDiskon += diskon;
        totalSelisih += selisih;
      });

      // console.log(qty);
      // console.log(harga);
      // console.log(diskon);
      console.log(totalSelisih);

      ongkosKirim = convertToAngka($('#ongkosKirim').val());
      let stotal = total + ongkosKirim;

      $('#jumlah').val(convertToRupiah(total + totalDiskon));
      $('#stotal').val(convertToRupiah(stotal));
      $('#totalDiskon').val(convertToRupiah(totalDiskon));
      $('#totalSelisih').val(convertToRupiah(totalSelisih));

      
      const bayar = convertToAngka($('#bayar').val());
      
      // $('#bayar').val(convertToRupiah(bayar));

      var kembalian = bayar - Math.max(0, stotal);

      // const kembalian = bayar - total;

      $('#kembalian').val(convertToRupiah(kembalian));


      if (kembalian >= 0) {
        $('#kembalian').val(convertToRupiah(kembalian));
        $('#status').val('Lunas');
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(convertToRupiah(kembalian));
      }
    }

    // Helper function to clean Rupiah format
    // function cleanRupiah(rupiahString) {
    //   return rupiahString.replace(/[^\d,-]/g, '').replace(',', '.');
    // }

    function displayItems(items) {
      let no = 1;
      let total = 0;
      let totalDiskon = 0;
      let totalSelisih = 0;

      items.forEach(item => {
        const subtotal = item.subtotal;
        const selisih = ((item.harga - item.harga_beli) * item.banyak) - item.diskon;

        const html = '<div class="row mb-2" id="row' + no + '">' +
          '<div class="col-md-3">' +
          '<input class="form-control" id="namaBarang' + no + '" name="nama_barang[]" value="' + item.nama_barang + '" readonly>' +
          '<input type="hidden" id="idBarang' + no + '" name="idBarang[]" value="' + item.id_barang + '" readonly>' +
          '<input type="hidden" id="idTransaksi' + no + '" name="idTransaksi[]" value="' + (item.id_transaksi || '') + '" readonly>' +
          '<input type="hidden" id="hargaBeli' + no + '" value="' + item.harga_beli + '">' +
          '</div>' +
          '<div class="col-md-2">' +
          '<input class="form-control" id="hargaBarang' + no + '" name="harga[]" value="' + convertToRupiah(item.harga) + '" readonly>' +
          '</div>' +
          '<div class="col-md-1">' +
          '<input class="form-control" readonly id="qty' + no + '" name="banyak[]" value="' + item.banyak + '" data-initial="' + item.banyak + '">' +
          '</div>' +
          '<div class="col-md-3">' +
          '<input class="form-control" readonly id="diskon' + no + '" name="diskon[]" value="' + convertToRupiah(item.diskon) + '">' +
          '</div>' +
          '<div class="col-md-2">' +
          '<input class="form-control" id="subTotal' + no + '" name="subtotal[]" value="' + convertToRupiah(subtotal) + '" readonly>' +
          '<input type="hidden" id="selisih' + no + '" name="selisih[]" value="' + selisih + '" readonly>' +
          '</div>' +
          '<a class="btn btn-sm btn-danger rounded" onClick="del(' + no + ')"> X </a>' +
          '</div>';

        $('.list').append(html);

        total += subtotal;
        totalDiskon += item.diskon;
        totalSelisih += selisih;
        no++;
      });

      // console.log(totalDiskon);

      // Update initial totals
      $('#jumlah').val(convertToRupiah(total + totalDiskon));
      $('#totalDiskon').val(convertToRupiah(totalDiskon));
      $('#totalSelisih').val(convertToRupiah(totalSelisih));
      
      
      const bayar = $('#bayar').val();
      $('#bayar').val(convertToRupiah(bayar));
      const ongkosKirim = $('#ongkosKirim').val();
      $('#stotal').val(convertToRupiah(total + convertToAngka(ongkosKirim)));
      $('#ongkosKirim').val(convertToRupiah(ongkosKirim));
      
      const kembalian = bayar - (total + convertToAngka(ongkosKirim));

      $('#kembalian').val(convertToRupiah(kembalian));


      if (kembalian >= 0) {
        $('#kembalian').val(convertToRupiah(kembalian));
        $('#status').val('Lunas');
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(convertToRupiah(kembalian));
      }

      // Add event listeners for qty and diskon changes
      // $(document).on('input', '.qty-input', function() {
      //   let value = $(this).val().replace(/[^\d]/g, '');
      //   $(this).val(convertToAngka(value));

      //   updateTotals();

      // });

      $(document).on('input', '.qty-input', function() {
        const idBarang = $(this).closest('.row').find('input[name="idBarang[]"]').val(); // Ambil id_barang dari baris terkait
        const qtyInput = $(this); // Referensi ke input saat ini

        // Panggil API untuk mendapatkan stok
        $.ajax({
          url: 'ambilDataStok.php',
          type: 'GET',
          data: {
            id_barang: idBarang
          },
          success: function(response) {
            if (typeof response.stok !== 'undefined') {
              const stok = parseInt(response.stok);
              let banyak = parseInt(qtyInput.val().replace(/[^\d]/g, '')) || 0;
              const initialValue = qtyInput.data('initial');

              if (stok === 0) {
                qtyInput.val(initialValue); // Kembalikan ke nilai awal dari database
                Swal.fire({
                  icon: 'error',
                  title: 'Stok Kosong',
                  text: 'Maaf, stok untuk produk ini tidak tersedia.',
                  confirmButtonText: 'OK',
                });
              } else if (banyak > stok) {
                qtyInput.val(initialValue); // Kembalikan ke nilai awal dari database
                Swal.fire({
                  icon: 'warning',
                  title: 'Perhatian',
                  text: `Jumlah yang dimasukkan tidak boleh lebih dari stok yang tersedia (${stok}).`,
                  confirmButtonText: 'OK',
                });
              } else {
                qtyInput.val(banyak); // Tetapkan nilai input yang valid
              }

              updateTotals();
            } else {
              console.error(response.error || 'Gagal mengambil stok');
            }
          },
          error: function(xhr, status, error) {
            console.error('API Error:', error);
          },
        });
      });



      $(document).on('input', '.diskon-input', function() {
        // Clean and format the discount input
        let value = $(this).val().replace(/[^\d]/g, '');

        $(this).val(convertToRupiah(value));
        updateTotals();
      });
    }

    getTransactionData(kodeFaktur);


    $(document).on('click', '#tambah-transaksi', function(e) {
      e.preventDefault();

      var totalDiskon = 0;
      // Ambil nilai dari input form
      var nama_barang = $('#nama-barang option:selected').text();
      const idBarang = $('#id-barang').val();
      const stok = $('#stok').val();
      const harga = convertToAngka($('#harga').val());
      const hargaBeli = convertToAngka($('#harga_beli').val());
      let qty = parseInt($('#banyak').val());
      let diskon = convertToAngka($('#diskon').val());
      var total = convertToAngka($('#stotal').val());
      var totalSelisih = convertToAngka($('#totalSelisih').val());

      console.log(totalSelisih);


      // Validasi input
      if (!nama_barang || qty <= 0 || harga <= 0) {
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Pastikan semua data valid sebelum menambahkan transaksi',
          confirmButtonText: 'OK'
        });
        return;
      }

      diskon = qty*diskon;

      //   diskon = banyak * diskon;
      var subtotal = (harga * qty) - diskon;

      // Update total
      totalDiskon += diskon;
      var jumlah = total + subtotal + totalDiskon;
      var total = total + subtotal;

      // Update totals in the UI
      $('#totalDiskon').val(convertToRupiah(totalDiskon));
      var selisih = ((harga - hargaBeli) * qty) - diskon;
      totalSelisih += selisih;
      $('#totalSelisih').val(convertToRupiah(totalSelisih));

      $('#jumlah').val(convertToRupiah(jumlah));
      $('#stotal').val(convertToRupiah(total));

      // Hitung subtotal dan selisih
      // const subtotal = (harga * qty) - diskon;
      // const selisih = ((harga - hargaBeli) * qty) - diskon;

      // Hitung nomor baris baru
      const no = $('.list .row').length + 1;

      // Susun HTML untuk baris baru
      const html = `
    <div class="row mb-2" id="row${no}">
      <div class="col-md-3">
        <input class="form-control" id="namaBarang${no}" name="nama_barang[]" value="${nama_barang}" readonly>
        <input type="hidden" id="idBarang${no}" name="idBarang[]" value="${idBarang}" readonly>
        <input type="hidden" id="hargaBeli${no}" value="${hargaBeli}">
      </div>
      <div class="col-md-2">
        <input class="form-control" id="hargaBarang${no}" name="harga[]" value="${convertToRupiah(harga)}" readonly>
      </div>
      <div class="col-md-1">
        <input class="form-control " readonly id="qty${no}" name="banyak[]" value="${qty}">
      </div>
      <div class="col-md-3">
        <input class="form-control " readonly id="diskon${no}" name="diskon[]" value="${convertToRupiah(diskon)}">
      </div>
      <div class="col-md-2">
        <input class="form-control" id="subTotal${no}" name="subtotal[]" value="${convertToRupiah(subtotal)}" readonly>
        <input type="hidden" id="selisih${no}" name="selisih[]" value="${selisih}" readonly>
      </div>
      <a class="btn btn-sm btn-danger rounded" onClick="del(${no})"> X </a>
    </div>
  `;

      // Tambahkan baris baru ke daftar list
      $('.list').append(html);

      // Perbarui total setelah penambahan
      updateTotals();

      // Reset form input
      $('#nama-barang').val('');
      $('#id-barang').val('');
      $('#stok').val('');
      $('#harga').val('');
      $('#banyak').val('');
      $('#diskon').val(0);
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
    if (!rupiah || typeof rupiah !== 'string') return 0;
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
  }


  // function del(no) {
  //   var stotal = convertToAngka($('#subTotal' + no).val());
  //   var alltotal = convertToAngka($('#stotal').val());
  //   var newtotal = alltotal - stotal;

  //   var selisih = convertToAngka($('#selisih' + no).val());
  //   var totalSelisih = convertToAngka($('#totalSelisih').val());
  //   var newselisih = totalSelisih - selisih;

  //   // Mengupdate jumlah total, dengan mengurangi `stotal` dan `diskonItem`
  //   var totalJumlah = convertToAngka($('#jumlah').val());
  //   var diskonItem = convertToAngka($('#diskon' + no).val());
  //   var newJumlah = totalJumlah - stotal - diskonItem;

  //   // Update total diskon
  //   var totalDiskon = convertToAngka($('#totalDiskon').val()) - diskonItem;

  //   // Update nilai di UI
  //   $('#totalDiskon').val(convertToRupiah(totalDiskon));
  //   $('#jumlah').val(convertToRupiah(newJumlah));
  //   $('#stotal').val(convertToRupiah(newtotal));
  //   $('#totalSelisih').val(convertToRupiah(newselisih));

  //   // Hapus baris item
  //   $('#row' + no).remove();

  //   // Perhitungan kembalian
  //   var bayar = convertToAngka($('#bayar').val());
  //   var kembalian = bayar - Math.max(0, newtotal - totalDiskon);

  //   if (kembalian >= 0) {
  //     $('#kembalian').val(convertToRupiah(kembalian));
  //     $('#status').val('Lunas');
  //     var tanggal = $('#tanggal').val();
  //     $('#jatuh-tempo').val(tanggal);
  //   } else {
  //     $('#status').val('Utang');
  //     $('#kembalian').val(convertToRupiah(kembalian));
  //     jatuhTempo();
  //   }
  // }
  function del(no) {
  const elements = {
    row: $(`#row${no}`),
    idTransaksi: $(`#idTransaksi${no}`).val(),
    stotal: convertToAngka($(`#subTotal${no}`).val()),
    diskon: convertToAngka($(`#diskon${no}`).val()),
    selisih: convertToAngka($(`#selisih${no}`).val())
  };

  const totals = {
    all: convertToAngka($('#stotal').val()),
    selisih: convertToAngka($('#totalSelisih').val()),
    jumlah: convertToAngka($('#jumlah').val()),
    diskon: convertToAngka($('#totalDiskon').val()),
    bayar: convertToAngka($('#bayar').val())
  };

  function updateUI(newTotals) {
    $('#stotal').val(convertToRupiah(newTotals.all));
    $('#totalSelisih').val(convertToRupiah(newTotals.selisih));
    $('#jumlah').val(convertToRupiah(newTotals.jumlah));
    $('#totalDiskon').val(convertToRupiah(newTotals.diskon));
    
    const kembalian = totals.bayar - Math.max(0, newTotals.all - newTotals.diskon);
    $('#kembalian').val(convertToRupiah(kembalian));
    
    if (kembalian >= 0) {
      $('#status').val('Lunas');
      $('#jatuh-tempo').val($('#tanggal').val());
    } else {
      $('#status').val('Utang');
      jatuhTempo();
    }
  }

  function calculateNewTotals() {
    return {
      all: totals.all - elements.stotal,
      selisih: totals.selisih - elements.selisih,
      jumlah: totals.jumlah - elements.stotal - elements.diskon,
      diskon: Math.max(0, totals.diskon - elements.diskon)
    };
  }

  function handleDelete() {
    elements.row.remove();
    updateUI(calculateNewTotals());
  }

  if (!elements.idTransaksi) {
    handleDelete();
    return;
  }

  Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah anda yakin ingin menghapus item ini?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  }).then(result => {
    if (!result.isConfirmed) return;

    $.ajax({
      url: 'editHapusTransaksi.php',
      method: 'POST',
      data: { id_transaksi: elements.idTransaksi },
      success: response => {
        const result = JSON.parse(response);
        if (!result.success) {
          Swal.fire('Error!', result.message, 'error');
          return;
        }
        handleDelete();
        Swal.fire('Terhapus!', 'Item berhasil dihapus.', 'success');
      },
      error: () => Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item.', 'error')
    });
  });
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
              text: item.nama_barang, // Hanya menyimpan nama barang
              harga: item.harga,
              harga_beli: item.harga_beli,
              stok: item.stok
            });
          });
          return {
            results: results
          };
        },
        cache: true
      },
      // Menampilkan hasil dengan stok di samping nama barang
      templateResult: function(item) {
        if (item.loading) {
          return item.text;
        }
        // Tampilkan nama barang beserta stok di hasil pencarian
        return $('<span>' + item.text + ' (Stok: ' + item.stok + ')</span>');
      },
      // Menampilkan pilihan yang sudah dipilih (hanya nama barang)
      templateSelection: function(item) {
        return item.text; // Tampilkan hanya nama barang pada pilihan yang dipilih
      }
    });

    // Fungsi untuk mengambil id barang dari input field terpisah saat user memilih nama barang
    $('#nama-barang').on('select2:select', function(e) {
      var data = e.params.data;

      // Cek jika stok 0
      if (parseInt(data.stok) === 0) {
        // Tampilkan SweetAlert
        Swal.fire({
          icon: 'warning',
          title: 'Stok Habis',
          text: 'Barang ini tidak bisa dipilih karena stoknya habis.',
        });

        // Kosongkan pilihan di select2 agar tidak tetap terpilih
        $('#id-barang').val(null).trigger('change');
        $('#nama-barang').val(null).trigger('change');
        $('#harga').val(null).trigger('change');
        $('#stok').val(null).trigger('change');
        return; // Hentikan eksekusi lebih lanjut
      }

      // Jika stok tidak 0, set nilai ke input field
      $('#id-barang').val(data.id);
      var harga = parseInt(data.harga) || 0;
      $('#harga').val(convertToRupiah(harga));
      $('#harga_beli').val(data.harga_beli);
      $('#stok').val(data.stok);
    });

    // $('#nama-pelanggan').autocomplete({
    //   source: "<?= BASEURL ?>/pages/transaksi/nama-pelanggan.php",
    //   select: function(event, ui) {
    //     $('#id-pelanggan').val(ui.item.id_pelanggan);
    //   }
    // });

    $('#nama-pelanggan').autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?= BASEURL ?>/pages/transaksi/nama-pelanggan.php",
          method: "POST",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
            // Mengisi data autocomplete
            response(data);
          }
        });
      },
      select: function(event, ui) {
        $('#id-pelanggan').val(ui.item.id_pelanggan);
        $('#id-supplier').val(ui.item.id_supplier);
        $('#telepon-supplier').val(ui.item.telepon_supplier);
        $('#alamat-supplier').val(ui.item.alamat_supplier);
      }
    });

    $('#nama-pelanggan').on('input', function() {
      var namaPelanggan = $(this).val();

      if (namaPelanggan.trim() === '') {
        $('#id-pelanggan').val('');
        return; // Keluar dari fungsi untuk menghindari permintaan AJAX
      }


      // Lakukan permintaan AJAX untuk mencari ID pelanggan berdasarkan nama pelanggan yang diinput
      $.ajax({
        url: "<?= BASEURL ?>/pages/transaksi/nama-pelanggan.php",
        method: "POST",
        dataType: "json",
        data: {
          term: namaPelanggan // Kirim nama pelanggan yang dimasukkan pengguna
        },
        success: function(data) {
          // Periksa apakah data ditemukan
          if (data.length > 0) {
            // Perbarui nilai #id-pelanggan dengan ID pelanggan yang sesuai
            $('#id-pelanggan').val(data[0].id_pelanggan);
          } else {
            // Jika tidak ditemukan, kosongkan nilai #id-pelanggan
            $('#id-pelanggan').val('');
            // Anda juga dapat memberikan pesan peringatan atau tindakan lain jika diperlukan
            alert('Nama pelanggan tidak ditemukan.');
          }
        }
      });
    });

    var totalDiskon = 0;



    // console.log(kodeFaktur);



    // $('#tambah-transaksi').on('click', function() {
    //   var no = parseInt($('#no').val());
    //   var id_barang = $('#id-barang').val();
    //   var nama_barang = $('#nama-barang option:selected').text();
    //   var banyak = parseInt($('#banyak').val());
    //   var diskon = convertToAngka($('#diskon').val());
    //   var harga = convertToAngka($('#harga').val());
    //   var harga_beli = convertToAngka($('#harga_beli').val());
    //   var total = convertToAngka($('#stotal').val());
    //   var totalSelisih = convertToAngka($('#totalSelisih').val());
    //   diskon = banyak * diskon;
    //   var subtotal = (harga * banyak) - diskon;

    //   // Update total
    //   totalDiskon += diskon;
    //   var jumlah = total + subtotal + totalDiskon;
    //   var total = total + subtotal;

    //   // Update totals in the UI
    //   $('#totalDiskon').val(convertToRupiah(totalDiskon));
    //   var selisih = ((harga - harga_beli) * banyak) - diskon;
    //   totalSelisih += selisih;
    //   $('#totalSelisih').val(convertToRupiah(totalSelisih));

    //   // Create new row in the list
    //   var html = '<div class="row mb-2" id="row' + no + '">' +
    //     '<div class="col-md-3">' +
    //     '<input class="form-control" id="namaBarang' + no + '" name="nama_barang[]" value="' + nama_barang + '" readonly>' +
    //     '<input type="hidden" id="idBarang' + no + '" name="idBarang[]" value="' + id_barang + '" readonly>' +
    //     '</div>' +
    //     '<div class="col-md-2">' +
    //     '<input class="form-control" id="hargaBarang' + no + '" name="harga[]" value="' + convertToRupiah(harga) + '" readonly>' +
    //     '</div>' +
    //     '<div class="col-md-1">' +
    //     '<input class="form-control" id="qty' + no + '" name="banyak[]" value="' + banyak + '" readonly>' +
    //     '</div>' +
    //     '<div class="col-md-3">' +
    //     '<input class="form-control" id="diskon' + no + '" name="diskon[]" value="' + convertToRupiah(diskon) + '" readonly>' +
    //     '</div>' +
    //     '<div class="col-md-2">' +
    //     '<input class="form-control" id="subTotal' + no + '" name="subtotal[]" value="' + convertToRupiah(subtotal) + '" readonly>' +
    //     '<input type="hidden" id="selisih' + no + '" name="selisih[]" value="' + selisih + '" readonly>' +
    //     '</div>' +
    //     '<a class="btn btn-sm btn-danger rounded" onClick="del(' + no + ')"> X </a>' +
    //     '</div>';

    //   $('.list').append(html);

    //   // Update overall totals
    //   $('#jumlah').val(convertToRupiah(jumlah));
    //   $('#stotal').val(convertToRupiah(total));

    //   // Clear input fields
    //   $('#banyak, #nama-barang, #id-barang, #diskon, #harga, #stok').val(null).trigger('change');

    //   // Increment item number
    //   $('#no').val(no + 1);
    // });

    // $('#diskon').on('input', function() {
    //   var total = convertToAngka($('#stotal').val());
    //   var rupiah = formatRupiah($(this).val(), 'Rp. ');
    //   $(this).val(rupiah);
    //   var diskon = convertToAngka(rupiah);
    //   var bayar = convertToAngka($('#bayar').val());
    //   var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
    //   if (kembalian >= 0) {
    //     $('#kembalian').val(convertToRupiah(kembalian));
    //     $('#status').val('Lunas');
    //     var tanggal = $('#tanggal').val();
    //     $('#jatuh-tempo').val(tanggal);
    //   } else {
    //     $('#status').val('Utang');
    //     $('#kembalian').val(convertToRupiah(kembalian));
    //     jatuhTempo();
    //   }
    // })

    $('#diskon').on('input', function() {
      var harga = convertToAngka($('#harga').val());
      var banyak = parseInt($('#banyak').val());
      var totalHarga = harga * banyak;

      var diskonInput = convertToAngka($(this).val());

      if (diskonInput > totalHarga) {
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Diskon melebihi harga transaksi',
          confirmButtonText: 'OK'
        });
        $(this).val(0);
      }

      var rupiah = formatRupiah($(this).val(), 'Rp. ');
      $(this).val(rupiah);
    });

    function setMaxStok() {
      var stok = $('#stok').val(); // Ambil nilai stok
      $('#banyak').attr('max', stok); // Atur atribut max pada elemen input
    }

    setMaxStok();

    $('#stok').on('change', function() {
      setMaxStok();
    });

    $('#banyak').on('input', function() {
      var stok = parseInt($('#stok').val());
      var banyak = parseInt($('#banyak').val());
      if (banyak > stok) {
        // Jika banyak melebihi stok, batasi nilai banyak dengan stok
        $('#banyak').val(stok);
        $('#banyak').attr('max', stok); // Atur atribut max pada elemen input
        // Anda juga bisa memberikan pesan peringatan kepada pengguna
        Swal.fire({
          icon: 'warning',
          title: 'Perhatian',
          text: 'Jumlah yang dimasukkan tidak boleh lebih dari stok yang tersedia (' + stok + ')',
          confirmButtonText: 'OK'
        });
      }
    });

    // $('#bayar').on('keyup', function() {
    //   var total = convertToAngka($('#stotal').val());
    //   var diskon = convertToAngka($('#diskon').val());
    //   var rupiah = formatRupiah($(this).val(), 'Rp. ');
    //   $(this).val(rupiah);
    //   var bayar = convertToAngka(rupiah);
    //   var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
    //   if (kembalian >= 0) {
    //     $('#kembalian').val(convertToRupiah(kembalian));
    //     $('#status').val('Lunas');
    //     var tanggal = $('#tanggal').val();
    //     $('#jatuh-tempo').val(tanggal);
    //   } else if (total == 0) {
    //     $('#status').val('');
    //   } else {
    //     $('#status').val('Utang');
    //     $('#kembalian').val(convertToRupiah(kembalian));
    //     jatuhTempo();
    //   }
    // })


    $('#ongkosKirim').on('input', function() {
      var rupiah = formatRupiah($(this).val(), 'Rp. ');
      $(this).val(rupiah);
      let ongkir = convertToAngka($(this).val().replace('Rp. ', ''));
      let jumlah = convertToAngka($('#jumlah').val().replace('Rp. ', ''));
      let totalDiskon = convertToAngka($('#totalDiskon').val().replace('Rp. ', ''));
      let bayar = convertToAngka($('#bayar').val().replace('Rp. ', ''));
      let totalBersih = jumlah - totalDiskon + ongkir;
      $('#stotal').val(convertToRupiah(totalBersih));
      let kembalian = bayar - totalBersih;
      $('#kembalian').val(convertToRupiah(kembalian));
      $('#status').val(kembalian >= 0 ? 'Lunas' : 'Utang');

      if (kembalian >= 0) {
        $('#status').val('Lunas');
        var tanggal = $('#tanggal').val();
        $('#jatuh-tempo').val(tanggal);
      } else {
        $('#status').val('Utang');
        jatuhTempo();
      }
    });

    $('#bayar').on('input', function() {
      var rupiah = formatRupiah($(this).val(), 'Rp. ');
      $(this).val(rupiah);
      let bayar = convertToAngka($(this).val());
      let total = convertToAngka($('#stotal').val().replace('Rp. ', ''));
      let kembalian = bayar - total;
      $('#kembalian').val(convertToRupiah(kembalian));
      $('#status').val(kembalian >= 0 ? 'Lunas' : 'Utang');


      if (kembalian >= 0) {
        $('#status').val('Lunas');
        var tanggal = $('#tanggal').val();
        $('#jatuh-tempo').val(tanggal);
      } else {
        $('#status').val('Utang');
        jatuhTempo();
      }
    });

  });
</script>

</body>

</html>