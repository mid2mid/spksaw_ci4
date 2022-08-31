<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container my-4" style="max-width: 1200px; min-height: 70vh" id="project">
	<div class="row">
		<div class="col-12 bg-white rounded p-2 mb-4 d-flex justify-content-end">
			<button type="button" class="btn btn-success btn-tambah me-auto" title="tambah kriteria"><i class="bi bi-plus-square"></i> Tambah Project</button>
			<button type="button" class="btn btn-primary btn-refresh" title="refresh kriteria"><i class="bi bi-arrow-clockwise"></i></button>
		</div>
		<div class="col-12 mb-4 text-white mx-sm-0 px-sm-0">
			<h6>Daftar Project</h6>
		</div>
		<div class="col-12 project__spinner bg-white justify-content-center align-items-center" style="width: 100%; height: 100px;display: flex;">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
		<div class="col-12 m-0 p-0" id="project__wrapper">
		</div>
	</div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('head') ?>
<?= $this->endSection('head') ?>

<?= $this->section('modal') ?>
<!-- Modal Tambah-->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="tambah-modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Project</h5>
			</div>
			<div class="modal-body">
				<form action="#" method="get" data-action="tambah" id="tambah-form">
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="tambah-nama" class="form-control" placeholder="ketik di sini" autocomplete="off" required />
						<label>Nama Project</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="deskripsi" id="tambah-deskripsi" class="form-control" placeholder="ketik di sini" autocomplete="off" required />
						<label>Deskripsi Project</label>
					</div>
					<div class="form-floating mb-3">
						<select class="form-select" id="tambah-metode" name="metode" aria-label="Atribut Kriteria" required>
							<option value="">Silakan Pilih Metode</option>
							<?php foreach ($metode as $i => $v) : ?>
								<option value="<?= $v['singkatan'] ?>"><?= $v['nama'] ?></option>
							<?php endforeach; ?>
						</select>
						<label>Metode Project</label>
					</div>
					<div class="d-flex justify-content-evenly">
						<button type="submit" class="btn btn-success w-25" id="tambah-btn">Tambah</button>
						<button type="button" class="btn btn-secondary w-25 tambah-close">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ubah-->
<div class="modal fade" id="ubah-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal Ubah</h5>
			</div>
			<div class="modal-body">
				<form action="#" data-action="ubah" id="ubah-form">
					<input type="hidden" name="id_project" id="ubah-id" value="" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="ubah-nama" class="form-control" placeholder="ketik di sini" autocomplete="off" />
						<label>Nama Project</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="deskripsi" id="ubah-deskripsi" class="form-control" placeholder="ketik di sini" autocomplete="off" />
						<label>Deskripsi</label>
					</div>
					<div class="d-flex justify-content-evenly">
						<button type="submit" class="btn btn-primary w-25" id="ubah-btn">Ubah</button>
						<button type="button" class="btn btn-secondary w-25 ubah-close">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Delete-->
<div class="modal fade" id="hapus-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center">
				<form action="#" data-action="hapus" id="hapus-form">
					<input type="hidden" name="id_project" id="hapus-id" value="" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="hapus-nama" class="form-control" placeholder="ketik di sini" autocomplete="off" value="" readonly />
						<label>Project</label>
					</div>
					<p class="">Yakin Ingin Menghapus Project ini ?</p>
					<div class="mt-4">
						<button type="submit" class="btn btn-danger">hapus</button>
						<button type="button" class="btn btn-secondary hapus-close">cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal dummy-->
<div class="modal fade" data-bs-keyboard="false" id="dummy-modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Project</h5>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>
<?= $this->endSection('modal') ?>

<?= $this->section('footer') ?>
<!-- <script src="js/project.js"></script> -->
<script>
	var modalHapus = new bootstrap.Modal(document.getElementById("hapus-modal"), {
		keyboard: false,
	});
	var modalTambah = new bootstrap.Modal(document.getElementById("tambah-modal"), {
		keyboard: false,
	});
	var modalUbah = new bootstrap.Modal(document.getElementById("ubah-modal"), {
		keyboard: false,
	});
	// var modalDummy = new bootstrap.Modal(document.getElementById("dummy-modal"), {
	// 	keyboard: false,
	// });

	function resetModalTambah() {
		$("#tambah-form").trigger("reset");
	}

	function notifikasi(title, icon) {
		Swal.fire({
			title: title,
			icon: icon,
			timer: 3000,
		});
	}

	function resetModalUbah() {
		$("#ubah-form").trigger("reset");
		$("#ubah-id").val("");
	}

	function resetModalHapus() {
		$("#hapus-form").trigger("reset");
		$("#hapus-id").val("");
	}

	function htmlTambah(id, metode, nama, desc) {
		return `
          <div class="w-100 my-2 px-2 px-md-0 pj-${id}" data-project="${id}" data-metode="${metode}">
            <div class="project__card bg-white rounded p-2 position-relative overflow-hidden">
              <h3 class="project__nama"><a href="#" class="text-reset text-decoration-none">${nama}</a></h3>
              <p class="project__deskripsi">${desc}</p>
              <div class="d-flex justify-content-end align-content-center project__btn">
                <a href="<?= route_to('view_kriteria') . "?project=" ?>${id}" class="text-decoration-none btn btn-sm btn-info me-auto">Go To Project</a>
                <button type="button" class="btn btn-sm btn-secondary me-3 btn-ubah"><i class="bi bi-pencil-square"></i></button>
                <button type="button" class="btn btn-sm btn-danger btn-hapus"><i class="bi bi-trash"></i></button>
              </div>
            </div>
          </div>`;
	}

	function getProject() {
		$.ajax({
			url: '/api/v1/project',
			type: 'get',
			// data: JSON.stringify($(this).serializeJSON()),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data, textStatus, xhr) {
				$('.project__spinner').hide()
				$.each(data.data, function(i, v) {
					$("#project__wrapper").append(htmlTambah(v.id_project, v.metode, v.nama, v.deskripsi));
				})
			},
			error: function(xhr, textStatus, data) {
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		});
	}

	function postProject(response) {
		$.ajax({
			url: '/api/v1/project',
			type: 'post',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data, textStatus, xhr) {
				resetModalTambah()
				modalTambah.hide();
				$("#project__wrapper").prepend(htmlTambah(data.id_project, response.metode, response.nama, response.deskripsi));
				notifikasi('berhasil menambahkan project baru', 'success')
			},
			error: function(xhr, textStatus, data) {
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		});
	}

	function putProject(response) {
		$.ajax({
			url: '/api/v1/project',
			type: 'put',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data) {
				// console.log(data)
				// $('#dummy-modal .modal-body').html('')
				// $('#dummy-modal .modal-body').append(data)
				// console.log(data);
				$(".pj-" + response.id_project).find(".project__nama").text(response.nama);
				$(".pj-" + response.id_project).find(".project__deskripsi").text(response.deskripsi);
				resetModalUbah();
				modalUbah.hide();
				notifikasi(data.pesan, 'success')
			},
			error: function(xhr, textStatus, data) {
				// console.log(xhr.responseJSON);
				// console.log(textStatus);
				// console.log(data);
				// $('#dummy-modal .modal-body').html('')
				// $('#dummy-modal .modal-body').append(data)
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		})
	}

	function deleteProject(response) {
		$.ajax({
			url: '/api/v1/project',
			type: 'delete',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data) {
				resetModalHapus();
				modalHapus.hide();
				$(".pj-" + response.id_project + ":first").hide()
				notifikasi(data.pesan, 'success')
			},
			error: function(xhr, textStatus, data) {
				resetModalHapus();
				modalHapus.hide();
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		})
	}
	$(document).ready(function() {
		getProject()

		// tambah
		$(document).on('click', '.btn-tambah', function(e) {
			resetModalTambah()
			modalTambah.show()
		})
		$(document).on("submit", "#tambah-form", function(e) {
			e.preventDefault();
			postProject($(this).serializeJSON());
		});
		$(document).on("click", ".tambah-close", function(e) {
			resetModalTambah();
			modalTambah.hide();
		});

		// ubah
		$(document).on("click", ".btn-ubah", function(e) {
			$("#ubah-id").val($(this).parent().parent().parent().data("project"));
			$("#ubah-nama").val($(this).parent().parent().parent().find(".project__nama").text());
			$("#ubah-deskripsi").val($(this).parent().parent().parent().find(".project__deskripsi").text());
			modalUbah.show();
		});
		$(document).on("submit", "#ubah-form", function(e) {
			e.preventDefault();
			putProject($(this).serializeJSON())
		});
		$(document).on("click", ".ubah-close", function(e) {
			resetModalUbah();
			modalUbah.hide();
		});

		// hapus
		$(document).on("click", ".btn-hapus", function(e) {
			$("#hapus-id").val($(this).parent().parent().parent().data("project"));
			$("#hapus-nama").val($(this).parent().parent().parent().find(".project__nama").text());
			modalHapus.show();
		});
		$(document).on("submit", "#hapus-form", function(e) {
			e.preventDefault();
			deleteProject($(this).serializeJSON())
		});
		$(document).on("click", ".hapus-close", function(e) {
			resetModalHapus();
			modalHapus.hide();
		});

		// refresh
		$(document).on("click", ".btn-refresh", function(e) {
			$('#project__wrapper').html('')
			$('.project__spinner').show()
			getProject()
		});
	})


	console.clear()
</script>
<?= $this->endSection('footer') ?>