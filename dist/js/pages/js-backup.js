$("#backup").on("click", function (e) {
  e.preventDefault();
  var getLink = $(this).attr("href");

  Swal.fire({
    title: "Yakin ingin mencadangkan database?",
    showDenyButton: true,
    confirmButtonText: "Yakin",
    denyButtonText: `Tidak`,
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  });
});
