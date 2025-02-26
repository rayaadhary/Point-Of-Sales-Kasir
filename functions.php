<?php
session_start();

define('BASEURL', 'http://point-of-sales-kasir.test/');

const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'kasir';
const DB_HOST = 'localhost';

function waktu()
{
  date_default_timezone_set('Asia/Jakarta');
  return date('Y-d-m', time());
}


function dbConnect()
{
  $db = mysqli_connect('localhost', 'root', '', 'kasir');
  return $db;
}

function logout()
{
  session_start();
  session_destroy();
  header("Location: index.php");
}


function kodeFaktur($waktu)
{
  $db = dbConnect();

  $bulan_sekarang = date('m');
  $tahun_sekarang = date('Y');

  $query = $db->query("SELECT MAX(no_faktur) as kodeTerbesar FROM transaksi WHERE SUBSTRING(no_faktur, 6, 2) = '$bulan_sekarang' AND SUBSTRING(no_faktur, 8, 4) = '$tahun_sekarang'");
  $data = $query->fetch_assoc();
  $kode_faktur = $data['kodeTerbesar'];

  if ($kode_faktur === null) {
    // Tidak ada faktur untuk bulan dan tahun ini, set urutan menjadi 1
    $urutan = 1;
  } else {
    $urutan_terakhir = (int) substr($kode_faktur, -4);
    $urutan = $urutan_terakhir + 1;
  }

  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dmY');
  $huruf = "INV";
  $kode_faktur = $huruf . $waktu_formatted . sprintf("%04s", $urutan);

  $query->free();
  $db->close();

  return $kode_faktur;
}



function kodePembelian($waktu)
{
  $db = dbConnect();
  $query = $db->query("SELECT max(no_pembelian) as kodeTerbesar FROM masuk");
  $data = $query->fetch_assoc();
  $kode_pembelian = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_pembelian, 7, 3);
  $urutan++;
  $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
  $waktu_formatted = date_format($waktu_formatted, 'dm');
  $huruf = "INV";
  $kode_pembelian = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
  $query->free();
  $db->close();
  return $kode_pembelian;
}

// function nomorSuratJalan()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(no_surat_jalan) as kodeTerbesar FROM pengiriman");
//   $data = $query->fetch_assoc();
//   $surat_jalan = $data['kodeTerbesar'];
//   $urutan = (int) substr($surat_jalan, 3, 5);
//   $urutan++;
//   $huruf = "DOM";
//   $surat_jalan = $huruf . sprintf("%05s", $urutan);
//   $query->free();
//   $db->close();
//   return $surat_jalan;
// }

function nomorSuratJalan()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(no_surat_jalan) as kodeTerbesar FROM pengiriman");
    $data = $query->fetch_assoc();
    $surat_jalan = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($surat_jalan)) {
        $urutan = 1; // Start numbering from 1 if no existing records
    } else {
        $urutan = (int) substr($surat_jalan, 3, 5); // Extract the numeric portion
        $urutan++;
    }

    $huruf = "DOM"; // Prefix for the surat jalan
    $surat_jalan = $huruf . sprintf("%05s", $urutan); // Format as DOMxxxxx (e.g., DOM00001)
    $query->free();
    $db->close();
    return $surat_jalan;
}


// function barangMasuk($waktu)
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT no_barang_masuk as kodeTerbesar FROM barang_masuk order by id_barang_masuk desc limit 1");
//   $data = $query->fetch_assoc();
//   $kode_faktur = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_faktur, 7, 3);
//   $urutan++;
//   $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
//   $waktu_formatted = date_format($waktu_formatted, 'dm');
//   $huruf = "BRM";
//   $kode_faktur = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_faktur;
// }


function barangMasuk($waktu)
{
    $db = dbConnect();
    $query = $db->query("SELECT no_barang_masuk as kodeTerbesar FROM barang_masuk ORDER BY id_barang_masuk DESC LIMIT 1");
    
    // Handle empty result set
    $kode_faktur = null;
    if ($query && $query->num_rows > 0) {
        $data = $query->fetch_assoc();
        $kode_faktur = $data['kodeTerbesar'];
    }

    // Ensure $kode_faktur is not null before processing
    if ($kode_faktur) {
        $urutan = (int) substr($kode_faktur, 7, 3);
    } else {
        $urutan = 0; // Start from 0 if no data exists
    }
    
    $urutan++;
    
    // Format the date
    $waktu_formatted = date_create_from_format('Y-m-d', $waktu);
    if ($waktu_formatted) {
        $waktu_formatted = date_format($waktu_formatted, 'dm');
    } else {
        $waktu_formatted = '0000'; // Fallback if date parsing fails
    }
    
    $huruf = "BRM";
    $kode_faktur = $huruf . $waktu_formatted . sprintf("%03s", $urutan);
    
    // Clean up and return the result
    if ($query) {
        $query->free();
    }
    $db->close();
    
    return $kode_faktur;
}


// function kodePelanggan()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(id_pelanggan) as kodeTerbesar FROM pelanggan");
//   $data = $query->fetch_assoc();
//   $kode_pelanggan = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_pelanggan, 1, 4);
//   $urutan++;
//   $huruf = "P";
//   $kode_pelanggan = $huruf . sprintf("%04s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_pelanggan;
// }

function kodePelanggan()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(id_pelanggan) as kodeTerbesar FROM pelanggan");
    $data = $query->fetch_assoc();
    $kode_pelanggan = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($kode_pelanggan)) {
        $urutan = 1; // Start numbering from 1 if no existing pelanggan found
    } else {
        $urutan = (int) substr($kode_pelanggan, 1, 4); // Extract the numeric portion
        $urutan++;
    }

    $huruf = "P"; // Prefix for pelanggan
    $kode_pelanggan = $huruf . sprintf("%04s", $urutan); // Format as Pxxxx (e.g., P0001)
    $query->free();
    $db->close();
    return $kode_pelanggan;
}



function kodePengguna()
{
  $db = dbConnect();
  $query = $db->query("SELECT max(id_pengguna) as kodeTerbesar FROM pengguna");
  $data = $query->fetch_assoc();
  $kode_pengguna = $data['kodeTerbesar'];
  $urutan = (int) substr($kode_pengguna, 4, 4);
  $urutan++;
  $huruf = "USER";
  $kode_pengguna = $huruf . sprintf("%04s", $urutan);
  $query->free();
  $db->close();
  return $kode_pengguna;
}

// function kodeSupplier()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(id_supplier) as kodeTerbesar FROM supplier");
//   $data = $query->fetch_assoc();
//   $kode_supplier = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_supplier, 2, 4);
//   $urutan++;
//   $huruf = "PT";
//   $kode_supplier = $huruf . sprintf("%04s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_supplier;
// }

function kodeSupplier()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(id_supplier) as kodeTerbesar FROM supplier");
    $data = $query->fetch_assoc();
    $kode_supplier = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($kode_supplier)) {
        $urutan = 1;
    } else {
        $urutan = (int) substr($kode_supplier, 2, 4);
        $urutan++;
    }

    $huruf = "PT";
    $kode_supplier = $huruf . sprintf("%04s", $urutan);
    $query->free();
    $db->close();
    return $kode_supplier;
}


// function kodeBeban()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(id_beban) as kodeTerbesar FROM beban");
//   $data = $query->fetch_assoc();
//   $kode_beban = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_beban, 2, 4);
//   $urutan++;
//   $huruf = "IB";
//   $kode_beban = $huruf . sprintf("%04s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_beban;
// }

function kodeBeban()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(id_beban) as kodeTerbesar FROM beban");
    $data = $query->fetch_assoc();
    $kode_beban = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($kode_beban)) {
        $urutan = 1; // Start numbering from 1 if no existing records
    } else {
        $urutan = (int) substr($kode_beban, 2, 4); // Extract the numeric portion
        $urutan++;
    }

    $huruf = "IB"; // Prefix for the beban ID
    $kode_beban = $huruf . sprintf("%04s", $urutan); // Format as IBxxxx (e.g., IB0001)
    $query->free();
    $db->close();
    return $kode_beban;
}


// function kodePrive()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(id_prive) as kodeTerbesar FROM prive");
//   $data = $query->fetch_assoc();
//   $kode_prive = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_prive, 2, 4);
//   $urutan++;
//   $huruf = "IP";
//   $kode_prive = $huruf . sprintf("%04s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_prive;
// }

function kodePrive()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(id_prive) as kodeTerbesar FROM prive");
    $data = $query->fetch_assoc();
    $kode_prive = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($kode_prive)) {
        $urutan = 1; // Start numbering from 1 if no existing records
    } else {
        $urutan = (int) substr($kode_prive, 2, 4); // Extract the numeric portion
        $urutan++;
    }

    $huruf = "IP"; // Prefix for the prive ID
    $kode_prive = $huruf . sprintf("%04s", $urutan); // Format as IPxxxx (e.g., IP0001)
    $query->free();
    $db->close();
    return $kode_prive;
}


// function kodeModal()
// {
//   $db = dbConnect();
//   $query = $db->query("SELECT max(id_modal) as kodeTerbesar FROM modal");
//   $data = $query->fetch_assoc();
//   $kode_modal = $data['kodeTerbesar'];
//   $urutan = (int) substr($kode_modal, 2, 4);
//   $urutan++;
//   $huruf = "MD";
//   $kode_modal = $huruf . sprintf("%04s", $urutan);
//   $query->free();
//   $db->close();
//   return $kode_modal;
// }

function kodeModal()
{
    $db = dbConnect();
    $query = $db->query("SELECT max(id_modal) as kodeTerbesar FROM modal");
    $data = $query->fetch_assoc();
    $kode_modal = $data['kodeTerbesar'];

    // Handle null case
    if (is_null($kode_modal)) {
        $urutan = 1; // Start numbering from 1 if no existing records
    } else {
        $urutan = (int) substr($kode_modal, 2, 4); // Extract the numeric portion
        $urutan++;
    }

    $huruf = "MD"; // Prefix for the modal ID
    $kode_modal = $huruf . sprintf("%04s", $urutan); // Format as MDxxxx (e.g., MD0001)
    $query->free();
    $db->close();
    return $kode_modal;
}


function gantiPassword($username, $password)
{
  $db = dbConnect();
  $password = password_hash($password, PASSWORD_DEFAULT);
  $res = mysqli_query($db, "UPDATE pengguna SET password = '$password' WHERE username = '$username'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getAllPelanggan()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan LIMIT 100");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBarang()
{
  $db = dbConnect();
  $res = mysqli_query($db, "select * from barang, barang_masuk, supplier where barang.id_barang = barang_masuk.id_barang AND supplier.id_supplier = barang_masuk.id_supplier GROUP BY barang.id_barang, barang_masuk.id_barang_masuk, supplier.id_supplier ORDER BY tanggal_beli DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllBeban($filter_tanggal_awal = '', $filter_tanggal_akhir = '')
{
    // Menghubungkan ke database
    $db = dbConnect();
    
    // Jika ada filter tanggal
    if ($filter_tanggal_awal && $filter_tanggal_akhir) {
        // Query untuk rentang tanggal
        $query = "SELECT * FROM beban WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal DESC";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $filter_tanggal_awal, $filter_tanggal_akhir);
    } else {
        // Query tanpa filter tanggal, membatasi hasil menjadi 50
        $query = "SELECT * FROM beban ORDER BY tanggal DESC LIMIT 50";
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->free_result();
    $stmt->close();
    $db->close();

    return $data;
}




function getAllPrive($filter_tanggal_awal = '', $filter_tanggal_akhir = '')
{
    // Menghubungkan ke database
    $db = dbConnect();
    
    // Jika ada filter tanggal
    if ($filter_tanggal_awal && $filter_tanggal_akhir) {
        // Query untuk rentang tanggal
        $query = "SELECT * FROM prive WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal DESC";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $filter_tanggal_awal, $filter_tanggal_akhir);
    } else {
        // Query tanpa filter tanggal, membatasi hasil menjadi 50
        $query = "SELECT * FROM prive ORDER BY tanggal DESC LIMIT 50";
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->free_result();
    $stmt->close();
    $db->close();

    return $data;
}


function getAllModal($filter_tanggal_awal = '', $filter_tanggal_akhir = '')
{
    // Menghubungkan ke database
    $db = dbConnect();
    
    // Jika ada filter tanggal
    if ($filter_tanggal_awal && $filter_tanggal_akhir) {
        // Query untuk rentang tanggal
        $query = "SELECT * FROM modal WHERE tanggal_modal BETWEEN ? AND ? ORDER BY tanggal_modal DESC";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $filter_tanggal_awal, $filter_tanggal_akhir);
    } else {
        // Query tanpa filter tanggal, membatasi hasil menjadi 50
        $query = "SELECT * FROM modal ORDER BY tanggal_modal DESC LIMIT 50";
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->free_result();
    $stmt->close();
    $db->close();

    return $data;
}


function getAllSupplier()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM supplier");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllPengguna()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT *,  SUM(banyak) as jumlahBanyak, subtotal / banyak AS hargaTransaksi FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan GROUP BY t.no_faktur, t.id_transaksi, p.id_pelanggan ORDER BY tanggal DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getAllTransaksiUtang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM transaksi, pelanggan WHERE pelanggan.id_pelanggan = transaksi.id_pelanggan AND status = 'utang' GROUP BY no_faktur, id_transaksi, pelanggan.id_pelanggan");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getTotalTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(totalTransaksi) as totalTransaksi 
FROM 
    (SELECT DISTINCT no_faktur, total 
    AS totalTransaksi 
    FROM transaksi GROUP BY no_faktur, id_transaksi) 
AS unique_total_transaksi");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalTransaksi'];
}
function getTotalTransaksiTanggal($bulan)
{

    list($tahun, $bulan) = explode('-', $bulan);
    // Get database connection
    $db = dbConnect();

    $query = "SELECT SUM(totalTransaksi) as totalTransaksi 
              FROM (
                  SELECT DISTINCT no_faktur, total AS totalTransaksi 
                  FROM transaksi 
                  WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?
                  GROUP BY no_faktur, id_transaksi
              ) AS unique_total_transaksi";

    // Prepare the statement
    if ($stmt = $db->prepare($query)) {
        $stmt->bind_param("ii", $tahun, $bulan);

        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if (!$data) {
            throw new Exception("No results found for the given year and month.");
        }

        $result->free();
        $stmt->close();
    } else {
        throw new Exception("Query preparation failed: " . $db->error);
    }

    // Close the database connection
    $db->close();

    // Return the total or 0 if no result or it's NULL
    return $data['totalTransaksi'] ?? 0;
}

function getTotalTransaksiBetweenTanggal($tanggalAwal, $tanggalAkhir)
{
    // Pastikan format tanggalAwal dan tanggalAkhir sesuai format YYYY-MM-DD
    $db = dbConnect();

    $query = "SELECT SUM(totalTransaksi) as totalTransaksi 
              FROM (
                  SELECT DISTINCT no_faktur, total AS totalTransaksi 
                  FROM transaksi 
                  WHERE tanggal BETWEEN ? AND ?
                  GROUP BY no_faktur, id_transaksi
              ) AS unique_total_transaksi";

    // Prepare the statement
    if ($stmt = $db->prepare($query)) {
        // Bind parameter tanggalAwal dan tanggalAkhir
        $stmt->bind_param("ss", $tanggalAwal, $tanggalAkhir);

        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if (!$data) {
            throw new Exception("No results found for the given date range.");
        }

        $result->free();
        $stmt->close();
    } else {
        throw new Exception("Query preparation failed: " . $db->error);
    }

    // Close the database connection
    $db->close();

    // Return the total or 0 if no result or it's NULL
    return $data['totalTransaksi'] ?? 0;
}

function getTotalTransaksiComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(totalTransaksi) as totalTransaksi 
              FROM (
                  SELECT DISTINCT no_faktur, total AS totalTransaksi 
                  FROM transaksi 
                  WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?
              ) AS unique_total_transaksi";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalTransaksi'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalTransaksi'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    } 
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}


function getTotalBarangMasukComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(total) AS totalBarangMasuk
FROM (
    SELECT DISTINCT no_barang_masuk, total
    FROM barang_masuk
                  WHERE YEAR(tanggal_beli) = ? AND MONTH(tanggal_beli) = ?
              ) AS unique_barangMasuk";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalBarangMasuk'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalBarangMasuk'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }
    else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}


function getTotalBarangMasuk()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(total) AS totalBarangMasuk
FROM (
    SELECT DISTINCT no_barang_masuk, total
    FROM barang_masuk
) AS unique_barangMasuk
  ");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBarangMasuk'];
}

function getKeuntunganPerBulanSetahun($tahun) {


    // Loop untuk setiap bulan dalam setahun
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        // Format bulan menjadi dua digit
        $bulanFormatted = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $tanggal = "{$tahun}-{$bulanFormatted}";

        // Dapatkan data untuk setiap komponen
        $dataTypes = [
            'transaksi' => getTotalTransaksiTanggal($tanggal),
            'barangMasuk' => getTotalBarangMasukTanggal($tahun,$bulan),
            'beban' => getTotalBebanTanggal($tahun,$bulan),
            'modal' => getTotalModalTanggal($tahun,$bulan),
            'prive' => getTotalPriveTanggal($tahun,$bulan)
        ];

        // Hitung keuntungan
        $keuntungan = 
            $dataTypes['transaksi'] - 
            $dataTypes['barangMasuk'] - 
            $dataTypes['beban'] - 
            ($dataTypes['prive'] + $dataTypes['modal']);

        if($tahun == ''){
          $keuntunganPerBulan = [];
        } else {
        // Simpan dalam array dengan nama bulan
        $keuntunganPerBulan[] = [
            'bulan' => date('F', mktime(0, 0, 0, $bulan, 10)),
            'keuntungan' => $keuntungan
        ];
      }

   
        
    }

    return $keuntunganPerBulan;
}

function getTotalBarangMasukTanggal($tahun = null, $bulan = null)
{
  $db = dbConnect();
  $query = "SELECT SUM(totalBarangMasuk) AS totalBarangMasuk
            FROM (
              SELECT DISTINCT no_barang_masuk, total AS totalBarangMasuk 
              FROM barang_masuk 
              WHERE 1=1";

  if ($tahun) {
    $query .= " AND YEAR(tanggal_beli) = '$tahun'";
  }
  if ($bulan) {
    $query .= " AND MONTH(tanggal_beli) = '$bulan'";
  }

  $query .= ") AS unique_barangMasuk";

  $res = $db->query($query);
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBarangMasuk'];
}


function getTotalBebanTanggal($tahun = null, $bulan = null)
{
  $db = dbConnect();
  $query = "SELECT SUM(totalBeban) AS totalBeban
            FROM (
              SELECT DISTINCT id_beban, SUM(biaya) AS totalBeban 
              FROM beban 
              WHERE 1=1";

  if ($tahun) {
    $query .= " AND YEAR(tanggal) = '$tahun'";
  }
  if ($bulan) {
    $query .= " AND MONTH(tanggal) = '$bulan'";
  }

  $query .= " GROUP BY id_beban
            ) AS unique_beban";

  $res = $db->query($query);
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBeban'];
}



function getTotalBebanComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(totalBeban) AS totalBeban
FROM (
   SELECT DISTINCT id_beban, SUM(biaya) AS totalBeban 
    FROM beban
                  WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?
              ";

$query .= "GROUP BY id_beban
) AS unique_beban";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalBeban'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalBeban'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }
    else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}



function getTotalPriveComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(totalPrive) AS totalPrive
FROM (
   SELECT DISTINCT id_prive, SUM(biaya) AS totalPrive 
    FROM prive
                  WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?";

    $query .= " GROUP BY id_prive
    ) AS unique_prive";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalPrive'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalPrive'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }
    else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}

function getTotalSelisihComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(totalSelisih) AS totalSelisih
            FROM (
              SELECT DISTINCT no_faktur, totalSelisih 
              FROM transaksi 
                  WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?
              ) AS unique_selisih";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalSelisih'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalSelisih'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }
    else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}

function getKeuntunganPeriodeBefore($bulan = '0') {
  $dataTypes = [
      'selisih' => getTotalSelisihComparison($bulan),
      'beban' => getTotalBebanComparison($bulan)
  ];

  $totalSelisih = (float) $dataTypes['selisih']['lastMonthTotal'];
  $totalBeban = (float) $dataTypes['beban']['lastMonthTotal'];

  // Perhitungan keuntungan
  return $totalSelisih - $totalBeban;
  // return $dataTypes;
}

function getProfitPeriodeBefore($bulan = '0') {
  $dataTypes = [
      'transaksi' => getTotalTransaksiComparison($bulan),
      'barangMasuk' => getTotalBarangMasukComparison($bulan),
      'beban' => getTotalBebanComparison($bulan),
      'modal' => getTotalModalComparison($bulan),
      'prive' => getTotalPriveComparison($bulan),
  ];

  $totalTransaksi = (float) $dataTypes['transaksi']['lastMonthTotal'];
  $totalBarangMasuk = (float) $dataTypes['barangMasuk']['lastMonthTotal'];
  $totalBeban = (float) $dataTypes['beban']['lastMonthTotal'];
  $totalPrive = (float) $dataTypes['prive']['lastMonthTotal'];
  $totalModal = (float) $dataTypes['modal']['lastMonthTotal'];

  // Perhitungan keuntungan
  return $totalTransaksi - $totalBarangMasuk - $totalBeban - ($totalPrive + $totalModal);
  // return $dataTypes;
}


function getTotalModalComparison($bulan = '0')
{
    // Jika bulan tidak diisi, set nilai default
    if (!$bulan || $bulan === '0') {
        return [
            'currentTotal' => 0,
            'lastMonthTotal' => 0,
            'changePercentage' => 0,
            'direction' => 'same', // Default arah "same" jika tidak ada perubahan
        ];
    }

    // Memecah bulan dan tahun
    list($tahun, $bulan) = explode('-', $bulan);

    // Koneksi ke database
    $db = dbConnect();

    // Query untuk transaksi bulan saat ini
    $query = "SELECT SUM(biaya) as totalModal 
            FROM modal 
                  WHERE YEAR(tanggal_modal) = ? AND MONTH(tanggal_modal) = ?";

    // Persiapkan statement untuk bulan saat ini
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahun, $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $currentTotal = $currentData['totalModal'] ?? 0;

    $stmt->close();

    // Hitung bulan sebelumnya
    $bulanSebelumnya = $bulan - 1;
    $tahunSebelumnya = $tahun;

    // Jika bulan sebelumnya kurang dari 1, mundur ke tahun sebelumnya
    if ($bulanSebelumnya < 1) {
        $bulanSebelumnya = 12;
        $tahunSebelumnya--;
    }

    // Persiapkan statement untuk bulan sebelumnya
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $tahunSebelumnya, $bulanSebelumnya);
    $stmt->execute();
    $result = $stmt->get_result();
    $lastMonthData = $result->fetch_assoc();
    $lastMonthTotal = $lastMonthData['totalModal'] ?? 0;

    $stmt->close();
    $db->close();

    // Hitung persentase perubahan
    if ($lastMonthTotal > 0) {
        $changePercentage = (($currentTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
    }
    else if($lastMonthTotal == $currentTotal){
      $changePercentage = 0; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }
    else {
        $changePercentage = 100; // Jika bulan sebelumnya 0, anggap kenaikan 100%
    }

    // Tentukan arah perubahan
    $direction = 'same';
    if ($currentTotal > $lastMonthTotal) {
        $direction = 'up';
    } elseif ($currentTotal < $lastMonthTotal) {
        $direction = 'down';
    }

    // Kembalikan hasil
    return [
        'currentTotal' => $currentTotal,
        'lastMonthTotal' => $lastMonthTotal,
        'changePercentage' => $changePercentage,
        'direction' => $direction,
    ];
}

function getTotalPriveTanggal($tahun = null, $bulan = null)
{
  $db = dbConnect();
  $query = "SELECT SUM(totalPrive) AS totalPrive 
            FROM (
              SELECT DISTINCT id_prive, SUM(biaya) AS totalPrive 
              FROM prive 
              WHERE 1=1";

  if ($tahun) {
    $query .= " AND YEAR(tanggal) = '$tahun'";
  }
  if ($bulan) {
    $query .= " AND MONTH(tanggal) = '$bulan'";
  }

  $query .= " GROUP BY id_prive
            ) AS unique_prive";

  $res = $db->query($query);
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalPrive'];
}

function getTotalSelisihTanggal($tahun = null, $bulan = null)
{
  $db = dbConnect();
  $query = "SELECT SUM(totalSelisih) AS totalSelisih
            FROM (
              SELECT DISTINCT no_faktur, totalSelisih 
              FROM transaksi 
              WHERE 1=1";

  if ($tahun) {
    $query .= " AND YEAR(tanggal) = '$tahun'";
  }
  if ($bulan) {
    $query .= " AND MONTH(tanggal) = '$bulan'";
  }

  $query .= ") AS unique_transactions";

  $res = $db->query($query);
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalSelisih'];
}

function getTotalModalTanggal($tahun = null, $bulan = null)
{
  $db = dbConnect();
  $query = "SELECT SUM(biaya) as totalModal 
            FROM modal 
            WHERE 1=1";

  if ($tahun) {
    $query .= " AND YEAR(tanggal_modal) = '$tahun'";
  }
  if ($bulan) {
    $query .= " AND MONTH(tanggal_modal) = '$bulan'";
  }

  $res = $db->query($query);
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalModal'];
}

function getTotalBeban()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(totalBeban) AS totalBeban
          FROM (
              SELECT DISTINCT id_beban, SUM(biaya) AS totalBeban
              FROM beban
              GROUP BY id_beban
          ) AS unique_beban;
          ");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalBeban'];
}

function getTotalPrive()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(totalPrive) AS totalPrive 
FROM (
    SELECT DISTINCT id_prive, SUM(biaya) AS totalPrive 
    FROM prive
    GROUP BY id_prive
) AS unique_prive");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalPrive'];
}

function getTotalSelisih()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(totalSelisih) AS totalSelisih
FROM (
    SELECT DISTINCT no_faktur, totalSelisih
    FROM transaksi
) AS unique_transactions
");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalSelisih'];
}

function getTotalModal()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(biaya) as totalModal FROM modal");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['totalModal'];
}

function hitungTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(DISTINCT no_faktur) AS jumlahTransaksi FROM transaksi");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahTransaksi'];
}

function hitungBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_barang) AS jumlahBarang FROM barang");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahBarang'];
}

function hitungPelanggan()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_pelanggan) AS jumlahPelanggan FROM pelanggan");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahPelanggan'];
}

function hitungSupplier()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(id_supplier) AS jumlahSupplier FROM supplier");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data['jumlahSupplier'];
}

function getAllBarangMasuk()
{
  $db = dbConnect();
  $res = $db->query("SELECT *, SUM(banyak) as jumlahBanyak FROM barang_masuk bm JOIN supplier s ON bm.id_supplier = s.id_supplier GROUP BY no_barang_masuk, id_barang_masuk ORDER BY tanggal_beli DESC");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}


function getAllBarangMasukUtang($filter_tanggal_awal = '', $filter_tanggal_akhir = '')
{
    // Menghubungkan ke database
    $db = dbConnect();
    
    // Jika ada filter tanggal
    if ($filter_tanggal_awal && $filter_tanggal_akhir) {
        // Query untuk rentang tanggal
        $query = "SELECT 
            * 
        FROM 
            barang_masuk
        JOIN 
            barang ON barang.id_barang = barang_masuk.id_barang
        JOIN 
            supplier ON supplier.id_supplier = barang_masuk.id_supplier
        WHERE 
            status = 'utang' 
            AND barang_masuk.tanggal_beli BETWEEN ? AND ? 
        GROUP BY 
            barang_masuk.id_barang_masuk, barang_masuk.no_barang_masuk, barang.id_barang, supplier.id_supplier 
        ORDER BY 
            barang_masuk.tanggal_beli DESC";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $filter_tanggal_awal, $filter_tanggal_akhir);
    } else {
        // Query tanpa filter tanggal, membatasi hasil menjadi 50
        $query = "SELECT * FROM barang_masuk, barang, supplier WHERE barang.id_barang = barang_masuk.id_barang AND supplier.id_supplier = barang_masuk.id_supplier AND status = 'utang' GROUP BY barang_masuk.id_barang_masuk, barang_masuk.no_barang_masuk, barang.id_barang, supplier.id_supplier ORDER BY barang_masuk.tanggal_beli DESC LIMIT 50";
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->free_result();
    $stmt->close();
    $db->close();

    return $data;
}

function getGroupBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT * FROM barang GROUP BY id_barang, nama_barang");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}



function getJumlahBarang()
{
  $db = dbConnect();
  $res = $db->query("SELECT SUM(stok) AS jumlah_barang FROM barang GROUP BY nama_barang");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getGroupTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT tanggal AS tanggal_transaksi FROM transaksi GROUP BY tanggal");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getGroupProfit()
{
  $tahun_ini = date('Y');
  $db = dbConnect();
  $res = $db->query("SELECT 
    bulan,
    totalSelisih,
    beban,
    (totalSelisih) - (beban) AS total
FROM (
    SELECT 
        MONTH(t1.tanggal) AS bulan,
        SUM(t1.totalSelisih) AS totalSelisih,
        (SELECT SUM(biaya) FROM beban WHERE MONTH(beban.tanggal) 
        = MONTH(t1.tanggal)) AS beban
    FROM 
        (SELECT DISTINCT no_faktur, totalSelisih, tanggal FROM transaksi) AS t1 
    WHERE 
        YEAR(t1.tanggal) = '$tahun_ini'
    GROUP BY 
        MONTH(t1.tanggal)
) AS subquery
GROUP BY 
    bulan
ORDER BY 
    bulan;");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getJumlahTransaksi()
{
  $db = dbConnect();
  $res = $db->query("SELECT COUNT(no_faktur) AS jumlah_transaksi FROM transaksi GROUP BY tanggal");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  $db->close();
  return $data;
}

function getBarangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getTransaksiUtangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM transaksi WHERE no_faktur = '$id' AND status = 'utang'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getBarangMasukUtangById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM barang_masuk WHERE no_barang_masuk = '$id' AND status = 'utang'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getBebanById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM beban WHERE id_beban = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPriveById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM prive WHERE id_prive = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getModalById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM modal WHERE id_modal = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}


function getPengirimanById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengiriman WHERE no_surat_jalan = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getSupplierById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM supplier WHERE id_supplier = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getTransaksiById($id)
{
    $db = dbConnect();

    // Ensure all selected columns that are not aggregated are included in the GROUP BY clause
    $res = mysqli_query($db, "SELECT 
            t.tanggal,
            t.jatuh_tempo,
            t.no_faktur, 
            t.total,
            t.diskon,
            t.bayar,
            t.totalDiskon,
            t.kembali,
            t.id_barang, 
            p.id_pelanggan,
            t.no_surat_jalan,
            p.nama_pelanggan, 
            SUM(t.banyak) AS jumlahBanyak, 
            SUM(t.subtotal) AS totalSubtotal,
            SUM(t.subtotal) / SUM(t.banyak) AS hargaTransaksi,
            t.ongkosKirim
        FROM 
            transaksi t 
        JOIN 
            pelanggan p ON t.id_pelanggan = p.id_pelanggan  
        WHERE 
            t.no_faktur = '$id'  
        GROUP BY 
            t.no_faktur, 
            t.id_barang, 
            p.nama_pelanggan,
             t.tanggal,
                  t.total,
            t.diskon,
          t.totalDiskon,
            t.bayar,
            t.no_surat_jalan,
            p.id_pelanggan,
            t.kembali,
            t.jatuh_tempo,
            t.ongkosKirim
    ");

    $data = $res->fetch_assoc();
    $res->free();
    $db->close();
    return $data;
}

function convertDateFormat($date) {
  $dateObj = DateTime::createFromFormat('d/m/Y', $date);
  if ($dateObj) {
      return $dateObj->format('Y-m-d');
  } else {
      throw new Exception("Format tanggal tidak valid.");
  }
}


function insertDataBarang($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO barang VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_barang'], $data['nama_barang'], $data['beli'], $data['stok']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataBeban($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO beban VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_beban'], $data['nama_beban'], $data['tanggal'], convert_to_number($data['biaya']));
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPrive($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO prive VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_prive'], $data['nama_prive'], $data['tanggal'], convert_to_number($data['biaya']));
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataModal($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO modal VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_modal'], $data['nama_modal'], $data['tanggal'], convert_to_number($data['biaya']));
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataSupplier($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO supplier VALUES (?, ?, ?, ?)");
  $res->bind_param("ssss", $data['id_supplier'], $data['nama_supplier'], $data['telepon_supplier'], $data['alamat_supplier']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPelanggan($data)
{
  $db = dbConnect();
  $res = $db->prepare("INSERT INTO pelanggan VALUES (?, ?)");
  $res->bind_param("ss", $data['id_pelanggan'], $data['nama_pelanggan']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function insertDataPengguna($data)
{
  $db = dbConnect();
  $password = password_hash($data['password'], PASSWORD_DEFAULT);
  $res = $db->prepare("INSERT INTO pengguna VALUES (?, ?, ?, ?, ?)");
  $res->bind_param("sssss", $data['id_pengguna'], $data['username'], $password, $data['role'], $data['nama']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

// function updateDataBarang($data)
// {
//   $db = dbConnect();
//   $res = $db->prepare("UPDATE barang SET nama_barang=?, harga_jual=?, stok=? WHERE id_barang=?");
//   $res->bind_param("ssss",  $data['nama_barang'], $data['harga_jual'], $data['stok'], $data['id_barang']);
//   $res->execute();

//   $cekStok = $db->prepare("SELECT stok FROM barang WHERE id_barang = ?");
//   $cekStok->execute([$data['id_barang']]);
//   $stok = $cekStok->fetchColumn();
//   if ($res) {
//     return 1;
//   } else {
//     return 0;
//   }
//   $db->close();
// }

function updateDataBarang($data)
{
  // Start database connection
  $db = dbConnect();
  
  // Start a transaction
  mysqli_begin_transaction($db);
  
  // Escape input data
  $nama_barang = mysqli_real_escape_string($db, $data['nama_barang']);
  $harga_jual = mysqli_real_escape_string($db, $data['harga_jual']);
  $harga_jual = convert_to_number($harga_jual);
  $stok = mysqli_real_escape_string($db, $data['stok']);
  $id_barang = mysqli_real_escape_string($db, $data['id_barang']);
  
  // Fetch current stock and purchase price
  $cekStok = mysqli_query($db, "SELECT stok, harga_beli FROM barang WHERE id_barang = '$id_barang'");
  $ambilDataBarang = mysqli_fetch_array($cekStok);
  $stok_lama = $ambilDataBarang['stok'];
  $harga_beli = $ambilDataBarang['harga_beli'];
  
  $result = false;
  $result2 = false;
  $result3 = false;

  try {
    // Check if stock has changed
    if ($stok != $stok_lama) {
      // Update the barang table
      $query = "UPDATE barang SET nama_barang='$nama_barang', harga_jual='$harga_jual', stok='$stok' WHERE id_barang='$id_barang'";
      $result = mysqli_query($db, $query);
      if (!$result) {
        throw new Exception("Failed to update barang");
      }

      // Fetch previous transaction data from barang_masuk
      $transaksiLama = mysqli_query($db, "SELECT no_barang_masuk, subtotal, total, bayar FROM barang_masuk WHERE id_barang = '$id_barang'");
      $ambilDataTransaksi = mysqli_fetch_array($transaksiLama);
      $total_lama = $ambilDataTransaksi['total'];
      $subtotal_lama = $ambilDataTransaksi['subtotal'];
      $no_barang_masuk = $ambilDataTransaksi['no_barang_masuk'];
      $bayar_lama = $ambilDataTransaksi['bayar'];
      
      // Calculate new subtotal, total, and change (kembali)
      $subtotalBaru = $stok * $harga_beli;
      $subtotalDiff = $subtotalBaru - $subtotal_lama;
      $totalBaru = $total_lama + $subtotalDiff;
      $kembali_baru = $bayar_lama - $totalBaru;
      $statusBaru = ($kembali_baru < 0) ? 'Hutang' : 'Lunas';

      // Update barang_masuk table for stock and subtotal
      $query = "UPDATE barang_masuk SET banyak='$stok', subtotal='$subtotalBaru' WHERE id_barang = '$id_barang'";
      $result2 = mysqli_query($db, $query);
      if (!$result2) {
        throw new Exception("Failed to update barang_masuk for stock and subtotal");
      }

      // Update barang_masuk table for total, change, and status
      $query1 = "UPDATE barang_masuk SET total='$totalBaru', kembali='$kembali_baru', status='$statusBaru' WHERE no_barang_masuk = '$no_barang_masuk'";
      $result3 = mysqli_query($db, $query1);
      if (!$result3) {
        throw new Exception("Failed to update barang_masuk for total, change, and status");
      }
    } else {
      // If stock hasn't changed, just update the name and price
      $query = "UPDATE barang SET nama_barang='$nama_barang', harga_jual='$harga_jual' WHERE id_barang='$id_barang'";
      $result = mysqli_query($db, $query);
      if (!$result) {
        throw new Exception("Failed to update barang for name and price");
      }
    }

    // Commit the transaction if all queries were successful
    mysqli_commit($db);
    mysqli_close($db);
    return 1;  // Success
  } catch (Exception $e) {
    // Rollback the transaction if any query fails
    mysqli_rollback($db);
    mysqli_close($db);
    return 0;  // Failure
  }
}


function updateDataPrive($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE prive SET nama_prive=?, tanggal=?, biaya=? WHERE id_prive=?");
  $res->bind_param("ssss",  $data['nama_prive'], $data['tanggal'], convert_to_number($data['biaya']), $data['id_prive']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataModal($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE modal SET nama_modal=?, tanggal_modal=?, biaya=? WHERE id_modal=?");
  $res->bind_param("ssss",  $data['nama_modal'], $data['tanggal_modal'], convert_to_number($data['biaya']), $data['id_modal']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataSupplier($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE supplier SET nama_supplier=?, telepon_supplier=?, alamat_supplier=? WHERE id_supplier=?");
  $res->bind_param("ssss",  $data['nama_supplier'], $data['telepon_supplier'], $data['alamat_supplier'], $data['id_prive']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataBeban($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE beban SET nama_beban=?, tanggal=?, biaya=? WHERE id_beban=?");
  $res->bind_param("ssss",  $data['nama_beban'], $data['tanggal'], convert_to_number($data['biaya']), $data['id_beban']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataPelanggan($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE pelanggan SET nama_pelanggan=? WHERE id_pelanggan=?");
  $res->bind_param("ss",  $data['nama_pelanggan'],  $data['id_pelanggan']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function updateDataPengguna($data)
{
  $db = dbConnect();
  $res = $db->prepare("UPDATE pengguna SET username=?, role=?, nama=?  WHERE id_pengguna=?");
  $res->bind_param("ssss",  $data['username'], $data['role'], $data['nama'],   $data['id_pengguna']);
  $res->execute();
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}


function getDeleteBarang($id_barang, $no_barang_masuk)
{
    $db = dbConnect();
    
    $res1 = mysqli_query($db, "UPDATE barang_masuk SET status_enable = 'false' WHERE no_barang_masuk = '$no_barang_masuk'");
    if ($res1) {
        $res2 = mysqli_query($db, "UPDATE barang SET status_enable = 'false' WHERE id_barang = '$id_barang'");
        if ($res2) {
            $db->close();
            return 1; // Success
        }
    }
    
    $db->close();
    return 0; // Failure
}

function restoreBarang($id_barang, $no_barang_masuk)
{
    $db = dbConnect();
    
    // Update status_enable to 'true' in barang_masuk
    $res1 = mysqli_query($db, "UPDATE barang_masuk SET status_enable = 'true' WHERE no_barang_masuk = '$no_barang_masuk'");
    if ($res1) {
        // Update status_enable to 'true' in barang
        $res2 = mysqli_query($db, "UPDATE barang SET status_enable = 'true' WHERE id_barang = '$id_barang'");
        if ($res2) {
            $db->close();
            return 1; // Success
        }
    }
    
    $db->close();
    return 0; // Failure
}




function getDeleteBeban($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM beban WHERE id_beban = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePrive($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM prive WHERE id_prive = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeleteModal($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM modal WHERE id_modal = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeleteSupplier($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM supplier WHERE id_supplier = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePelanggan($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM pelanggan WHERE id_pelanggan = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeletePengguna($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "DELETE FROM pengguna WHERE id_pengguna = '$id'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
  $res->free();
  $db->close();
}

function getDeleteTransaksi($transaksi, $pengiriman)
{
  $db = dbConnect();
  $db->autocommit(FALSE);
  $query_stok = "SELECT id_barang, banyak FROM transaksi WHERE no_faktur = '$transaksi'";
  $result_stok = $db->query($query_stok);
  if ($result_stok->num_rows > 0) {
    // Jika ada data stok barang, tambahkan stok pada tabel barang
    while ($row_stok = $result_stok->fetch_assoc()) {
      $id_barang = $row_stok['id_barang'];
      $banyak = $row_stok['banyak'];
      $query_barang = "UPDATE barang SET stok = stok + $banyak WHERE id_barang = '$id_barang'";
      $result_barang = $db->query($query_barang);
      if (!$result_barang) {
        // Jika gagal memperbarui stok barang, lakukan rollback dan keluar dari fungsi
        $db->rollback();
        $db->close();
        return 0;
      }
    }
  }

  $id_barang = getTransaksiById($transaksi)['id_barang'];
  $banyak = getTransaksiById($transaksi)['banyak'];
  $query1 = "DELETE FROM transaksi WHERE no_faktur = '$transaksi'";
  $result1 = $db->query($query1);
  $query2 = "DELETE FROM pengiriman WHERE no_surat_jalan = '$pengiriman'";
  $result2 = $db->query($query2);


  if ($result1 && $result2) {
    $db->commit();
    $db->close();
    return 1;
  } else {
    $db->rollback();
    $db->close();
    return 0;
  }
}


function getPelangganById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
$data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPenggunaById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function getPenggunaByUsername($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE username = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  $db->close();
  return $data;
}

function tombolHapus($id)
{
  $db = dbConnect();
  $sql = "SELECT * FROM barang WHERE id_barang='$id' AND NOT EXISTS (SELECT * FROM transaksi, barang_masuk WHERE transaksi.id_barang = barang.id_barang AND barang_masuk.id_barang = barang.id_barang)";
  $result = mysqli_query($db, $sql);
  $res = $result->num_rows;
  return $res;
  $result->free();
  $db->close();
}

function bisa($db, $query)
{
  $db = mysqli_query($db, $query);

  if ($db) {
    return 1;
  } else {
    return 0;
  }
  $db->close();
}

function convert_to_number($number_string) {
  return (int) preg_replace('/[^0-9\-]/', '', $number_string);
}

function setFlash($pesan, $aksi, $tipe)
{
  $_SESSION['flash'] = [
    'pesan' => $pesan,
    'aksi' => $aksi,
    'tipe' => $tipe
  ];
}

function flash()
{
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
      Data <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
    unset($_SESSION['flash']);
  }
}
