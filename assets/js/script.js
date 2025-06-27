// CHARTTTT OVERVIEW

document.addEventListener("DOMContentLoaded", function () {
  const dropdownButton = document.querySelector(".dropdown-btn");
  const dropdown = document.querySelector(".dropdown");

  // Tambahkan event listener untuk toggle dropdown
  dropdownButton.addEventListener("click", function () {
    dropdown.classList.toggle("active"); // Menambahkan atau menghapus kelas 'active'
  });
});

document.querySelectorAll(".dd-button").forEach((button) => {
  button.addEventListener("click", function () {
    const dropdown = this.parentElement; // Mengambil parent dari tombol
    const icon = this.querySelector(".dd-icon"); // Menargetkan ikon dalam tombol
    dropdown.classList.toggle("active"); // Menambahkan/menghapus kelas active pada kontainer
    icon.classList.toggle("active"); // Menambahkan/menghapus kelas active pada ikon untuk flip
  });
});
