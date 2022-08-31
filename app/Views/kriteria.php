<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container my-4" style="max-width: 1200px; min-height: 70vh">
	<div class="row">
		<div class="col-12 bg-white rounded p-2 mb-4">
			<a href="<?= route_to('view_data') . '?project=' . $id_project ?>" class="btn btn-secondary"><i class="bi bi-card-checklist me-2"></i> data</a>
			<a href="<?= route_to('view_hasil') . '?project=' . $id_project  ?>" class="btn btn-primary" title="Lihat Hasil"><i class="bi bi-graph-up me-2"></i> hasil</a>
		</div>
		<div class="col-12 bg-white rounded p-2 mb-4">
			<div class="tombol d-flex justify-content-end mb-3">
				<button type="button" class="btn btn-success btn-tambah me-auto"><i class="bi bi-plus-square"></i> Tambah Kriteria</button>
				<button type="button" class="btn btn-primary btn-refresh" title="refresh data"><i class="bi bi-arrow-clockwise"></i></button>
			</div>
			<p class="text-danger bobot-alert fw-bolder fs-3" style="display: none;">* jumlah bobot wajib = 100</p>
			<div class="col-12 notif-spinner bg-white" style="display: block;">
				<div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100px;display: flex;">
					<div class="spinner-border text-primary" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>
			<div class="col-12 notif-error bg-white " style="display: none;">
				<div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 100px;display: flex;">
					<p class="text-center fw-bolder text-danger">belum ada data</p>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-middle" style="display: none;">
					<thead class="table-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Kriteria</th>
							<th scope="col">Atribut</th>
							<th scope="col">Bobot</th>
							<th scope="col" class="d-none"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody id="kriteria__wrapper">
					</tbody>
				</table>
			</div>
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
				<h5 class="modal-title">Tambah Kriteria</h5>
			</div>
			<div class="modal-body">
				<form action="#" method="get" data-action="tambah" id="tambah-form">
					<input type="hidden" name="id_project" value="<?= $id_project ?>" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="tambah-nama" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Kriteria</label>
					</div>
					<div class="form-floating mb-3">
						<select class="form-select" aria-label="Atribut Kriteria" id="tambah-atribut" name="atribut" required>
							<option value="">Silkan Pilih</option>
							<option value="cost">Cost</option>
							<option value="benefit">Benefit</option>
						</select>
						<label>Atribut Kriteria</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" name="bobot" id="tambah-bobot" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Bobot</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="deskripsi" id="tambah-deskripsi" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Deskripsi</label>
					</div>
					<div class="d-flex justify-content-evenly">
						<button type="submit" class="btn btn-success w-25 tambah-btn">Tambah</button>
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
					<input type="hidden" name="id_project" value="<?= $id_project ?>" />
					<input type="hidden" name="id_kriteria" id="ubah-id" value="" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="ubah-nama" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Kriteria</label>
					</div>
					<div class="form-floating mb-3">
						<select class="form-select" aria-label="Atribut Kriteria" id="ubah-atribut" name="atribut" required>
							<option value="">Silkan Pilih</option>
							<option value="cost">Cost</option>
							<option value="benefit">Benefit</option>
						</select>
						<label>Atribut Kriteria</label>
					</div>
					<div class="form-floating mb-3">
						<input type="number" maxlength="5" minlength="0" name="bobot" id="ubah-bobot" class="form-control" placeholder="Ketik di sini" autocomplete=" off" required />
						<label>Bobot</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="deskripsi" id="ubah-deskripsi" class="form-control" placeholder="Ketik di sini" autocomplete=" off" required />
						<label>deskripsi</label>
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
					<input type="hidden" name="id_project" value="<?= $id_project ?>" />
					<input type="hidden" name="id_kriteria" id="hapus-id" value="" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="hapus-nama" class="form-control" placeholder="Ketik di sini" autocomplete="off" value="" readonly required />
						<label>Kriteria</label>
					</div>
					<p class="">Yakin Ingin Menghapus Kriteria ?</p>
					<div class="mt-4">
						<button type="submit" class="btn btn-danger">hapus</button>
						<button type="button" class="btn btn-secondary hapus-close">cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- modal Dummy -->
<div class="modal fade" id="dummy-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>
<?= $this->endSection('modal') ?>

<?= $this->section('footer') ?>
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
	var modalDummy = new bootstrap.Modal(document.getElementById("dummy-modal"), {
		keyboard: false,
	});
	const id = "<?= $id_project ?>"

	function resetModalTambah() {
		$("#tambah-form").trigger("reset");
	}

	function resetModalUbah() {
		$("#ubah-form").trigger("reset");
		$('#ubah-id').val('')
	}

	function resetModalHapus() {
		$("#hapus-form").trigger("reset");
		$('#hapus-id').val('')
	}

	function notifikasi(title, icon) {
		Swal.fire({
			title: title,
			icon: icon,
			timer: 3000,
		});
	}

	function showError(text = 'belum ada kriteria') {
		$('table').hide()
		$('.notif-spinner').hide()
		$('.notif-error p').text(text)
		$('.notif-error').show()
	}

	function showLoading() {
		$('table').hide()
		$('.notif-error').hide()
		$('.notif-spinner').show()
	}

	function showTable() {
		$('.notif-error').hide()
		$('.notif-spinner').hide()
		$('table').show()
	}

	function htmlTambah(id, nama, atribut, bobot, deskripsi, i = false) {
		return `
							<tr class="kt-${id}" data-kriteria="${id}">
								<th scope="row" class="fit">${i==false ?'new':i}</th>
								<td class="kriteria__nama">${nama}</td>
								<td class="kriteria__atribut">${atribut}</td>
								<td class="kriteria__bobot">${bobot}</td>
								<td class="kriteria__deskripsi d-none">${deskripsi}</td>
								<td class="fit">
									<button type="button" class="btn btn-sm btn-outline-success btn-ubah" title="ubah kriteria"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button>
								</td>`;
	}

	function getKriteria(id_project = 0) {
		$.ajax({
			url: '/api/v1/kriteria?project=' + id_project,
			type: 'get',
			// headers: {
			// 	'X-Requested-With': 'XMLHttpRequest',
			// 	'Content-Type': 'application/json',
			// },
			// data: {
			// 	project:id_project,
			// },
			success: function(data, textStatus, xhr) {
				$.each(data.kriteria, function(i, v) {
					$("#kriteria__wrapper").append(htmlTambah(v.id_kriteria, v.nama, v.atribut, v.bobot, v.deskripsi, i + 1));
				})
				showTable()
				checkBobot()
			},
			error: function(xhr, textStatus, data) {
				showError()
			},
		});
	}

	function postKriteria(response) {
		$.ajax({
			url: '/api/v1/kriteria',
			type: 'post',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data, textStatus, xhr) {
				showTable()
				resetModalTambah()
				$("tbody").prepend(htmlTambah(data.id_kriteria, response.nama, response.atribut, response.bobot, response.deskripsi));
				modalTambah.hide();
				notifikasi(data.pesan, 'success')
				checkBobot()
			},
			error: function(xhr, textStatus, data) {
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		});
	}

	function putKriteria(response) {
		$.ajax({
			url: '/api/v1/kriteria',
			type: 'put',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data) {
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__nama").text(response.nama);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__atribut").text(response.atribut);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__bobot").text(response.bobot);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__deskripsi").text(response.deskripsi);
				resetModalUbah();
				modalUbah.hide();
				notifikasi(data.pesan, 'success')
				checkBobot()
			},
			error: function(xhr, textStatus, data) {
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		})
	}

	function deleteKriteria(response) {
		$.ajax({
			url: '/api/v1/kriteria',
			type: 'delete',
			data: JSON.stringify(response),
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data) {
				resetModalHapus();
				$(".kt-" + response.id_kriteria + ":first").remove()
				modalHapus.hide();
				notifikasi(data.pesan, 'success')
				checkBobot()
			},
			error: function(xhr, textStatus, data) {
				resetModalHapus();
				modalHapus.hide();
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		})
	}

	function checkBobot() {
		let bobot = 0
		$('.kriteria__bobot').each(function(i, v) {
			bobot += parseInt($(this).text())
		})
		if (bobot == 100) {
			$('.bobot-alert').hide()
		} else {
			$('.bobot-alert').show()
		}
	}

	$(document).ready(function() {
		getKriteria(id)

		// tambah
		$(document).on('click', '.btn-tambah', function(e) {
			resetModalTambah()
			modalTambah.show()
		})
		$(document).on("submit", "#tambah-form", function(e) {
			e.preventDefault();
			postKriteria($(this).serializeJSON());
		});
		$(document).on("click", ".tambah-close", function(e) {
			resetModalTambah();
			modalTambah.hide();
		});

		// ubah
		$(document).on("click", ".btn-ubah", function(e) {
			$("#ubah-id").val($(this).parent().parent().data("kriteria"));
			$("#ubah-nama").val($(this).parent().parent().find(".kriteria__nama").text());
			$("#ubah-atribut").val($(this).parent().parent().find(".kriteria__atribut").text());
			$("#ubah-bobot").val($(this).parent().parent().find(".kriteria__bobot").text());
			$("#ubah-deskripsi").val($(this).parent().parent().find(".kriteria__deskripsi").text());
			modalUbah.show();
		});
		$(document).on("submit", "#ubah-form", function(e) {
			e.preventDefault();
			putKriteria($(this).serializeJSON());
		});
		$(document).on("click", ".ubah-close", function(e) {
			resetModalUbah();
			modalUbah.hide();
		});

		// hapus
		$(document).on("click", ".btn-hapus", function(e) {
			const parent = $(this).parent().parent()
			$("#hapus-id").val(parent.data("kriteria"));
			$("#hapus-nama").val(parent.find(".kriteria__nama").text());
			modalHapus.show();
		});
		$(document).on("submit", "#hapus-form", function(e) {
			e.preventDefault();
			deleteKriteria($(this).serializeJSON());
		});
		$(document).on("click", ".hapus-close", function(e) {
			resetModalHapus();
			modalHapus.hide();
		});

		// refresh
		$(document).on('click', '.btn-refresh', function(e) {
			$('tbody').html('')
			showLoading()
			getKriteria(id)
		})

	})

	console.clear()
</script>
<?= $this->endSection('footer') ?>