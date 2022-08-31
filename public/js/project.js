const projectId = "12";
var modalHapus = new bootstrap.Modal(document.getElementById("hapus-modal"), {
  keyboard: false,
});
var modalTambah = new bootstrap.Modal(document.getElementById("tambah-modal"), {
  keyboard: false,
});
var modalUbah = new bootstrap.Modal(document.getElementById("ubah-modal"), {
  keyboard: false,
});

function resetModalTambah() {
  // $("#tambah-modal .modal-body").find("input, select").val("");
  $("#tambah-form").trigger("reset");
}
function resetModalUbah() {
  // $("#ubah-modal .modal-body").find("input, select").val("");
  $("#ubah-form").trigger("reset");
  $("#ubah-id").text("");
}
function resetModalHapus() {
  // $("#ubah-modal .modal-body").find("input, select").val("");
  $("#hapus-form").trigger("reset");
  $("#hapus-id").text("");
}
function htmlTambah(project, metode, header, desc, link = "#") {
  return `
          <div class="w-100 my-2 px-2 px-md-0 pj-${project}" data-project="${project}" data-metode="${metode}">
            <div class="project__card bg-white rounded p-2 position-relative overflow-hidden">
              <h3 class="project__header"><a href="#" class="text-reset text-decoration-none">${header}</a></h3>
              <p class="project__desc">${desc}</p>
              <div class="d-flex justify-content-end align-content-center project__btn">
                <a href="${link}" class="text-decoration-none btn btn-sm btn-info me-auto">Go To Project</a>
                <button type="button" class="btn btn-sm btn-secondary me-3 btn-ubah"><i class="bi bi-pencil-square"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-hapus"><i class="bi bi-trash"></i></button>
              </div>
            </div>
          </div>`;
}

// Buttons
$(document).on("click", ".btn-hapus", function (e) {
  $("#hapus-id").val($(this).parent().parent().parent().data("project"));
  $("#hapus-project").val($(this).parent().parent().parent().find(".project__header").text());
  modalHapus.show();
});
$(document).on("click", ".btn-ubah", function (e) {
  $("#ubah-id").val($(this).parent().parent().parent().data("project"));
  $("#ubah-project").val($(this).parent().parent().parent().find(".project__header").text());
  $("#ubah-desc").val($(this).parent().parent().parent().find(".project__desc").text());
  modalUbah.show();
});

// hapus
$(document).on("submit", "#hapus-form", function (e) {
  e.preventDefault();
  modalHapus.hide();
  Swal.fire({
    icon: "success",
    title: "berhasil menghapus project",
    timer: 2000,
  });
  resetModalHapus();
});
$(document).on("click", ".ubah-close", function (e) {
  resetModalHapus();
  modalHapus.hide();
  Swal.fire({
    icon: "warning",
    title: "gagal menghapus project",
    timer: 2000,
  });
});

// tambah
$(document).on("submit", "#tambah-form", function (e) {
  e.preventDefault();
  $("#project__wrapper").prepend(htmlTambah("2", $("#tambah-metode").val(), $("#tambah-project").val(), $("#tambah-desc").val()));
  // const a = $(this).serializeJSON();
  modalTambah.hide();
  Swal.fire({
    icon: "success",
    title: "berhasil menambahkan project baru",
    timer: 2000,
  });
  resetModalTambah();
});
$(document).on("click", ".tambah-close", function (e) {
  resetModalTambah();
  modalTambah.hide();
  Swal.fire({
    icon: "warning",
    title: "gagal menambahkan project",
    timer: 2000,
  });
});

// ubah
$(document).on("submit", "#ubah-form", function (e) {
  e.preventDefault();
  let id = $("#ubah-id").val();
  $(".pj-" + id + ":first")
    .find(".project__header")
    .text($("#ubah-project").val());
  $(".pj-" + id + ":first")
    .find(".project__desc")
    .text($("#ubah-desc").val());
  modalUbah.hide();
  Swal.fire({
    icon: "success",
    title: "berhasil merubah project",
    timer: 2000,
  });
  resetModalUbah();
});
$(document).on("click", ".ubah-close", function (e) {
  resetModalUbah();
  modalUbah.hide();
  Swal.fire({
    icon: "warning",
    title: "gagal mengubah project",
    timer: 2000,
  });
});
