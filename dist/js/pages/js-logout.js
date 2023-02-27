$(".logout").on("click", function (e) {
  e.preventDefault();
  var getLink = $(this).attr("href");

  Swal.fire({
    title: "Keluar?",
    text: "Tekan keluar jika anda ingin keluar dari sistem",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Keluar",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  });
  const notifikasi = $(".info-data").data("infodata");

  if (notifikasi == "Disimpan" || notifikasi == "Dihapus") {
    Swal.fire({
      icon: "success",
      title: "Sukses",
      text: "Data Berhasil " + notifikasi,
    });
  } else if (notifikasi == "Gagal Disimpan" || notifikasi == "Gagal Dihapus") {
    Swal.fire({
      icon: "error",
      title: "GAGAL",
      text: "Data " + notifikasi,
    });
  } else if (notifikasi == "Kosong") {
  }
});
