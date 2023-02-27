<?php

define('BASEURL', 'http://localhost/kasir/admin');



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

function gantiPassword($username, $password)
{
  $db = dbConnect();
  $res = mysqli_query($db, "UPDATE pengguna SET password = '$password' WHERE username = '$username'");
  if ($res) {
    return 1;
  } else {
    return 0;
  }
}

function getAllPelanggan()
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan");
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $res->free();
  return $data;
}

function getPelangganById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pelanggan WHERE id = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  return $data;
}

function getPenggunaById($id)
{
  $db = dbConnect();
  $res = mysqli_query($db, "SELECT * FROM pengguna WHERE username = '$id'");
  $data = $res->fetch_assoc();
  $res->free();
  return $data;
}

function bisa($db, $query)
{
  $db = mysqli_query($db, $query);

  if ($db) {
    return 1;
  } else {
    return 0;
  }
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
