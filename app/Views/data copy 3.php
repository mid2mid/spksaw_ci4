<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container my-4" style="max-width: 1200px; min-height: 80vh">
	<div class="row">
		<div class="col-12 bg-white rounded p-2 mb-4">
			<a href="<?= route_to('view_kriteria') . '?project=' . $id_project ?>" class="btn btn-warning"><i class="bi bi-card-text me-2"></i> kriteria</a>
			<a href="<?= route_to('view_hasil') . '?project=' . $id_project ?>" class="btn btn-primary" title="Lihat Hasil"><i class="bi bi-graph-up me-2"></i> hasil</a>
		</div>
		<div class="col-12 bg-white rounded p-2 mb-4">
			<div class="tombol d-flex justify-content-end mb-3">
				<button type="button" class="btn btn-success btn-tambah me-auto"><i class="bi bi-plus-square"></i> Tambah Data</button>
				<button type="button" class="btn btn-primary btn-refresh" title="refresh data"><i class="bi bi-arrow-clockwise"></i></button>
			</div>
			<div class="container-fluid justify-content-center align-items-center table-loading" id="spinner" style="height: 100px; display: flex;">
				<div class="spinner-border " role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-middle" style="display: none;">
					<thead class="table-dark">
						<tr>
							<th scope="col">no</th>
							<th scope="col" class="inp">data</th>
							<?php foreach ($kriteria as $i => $v) : ?>
								<th scope="col" class="inp"><?= $v['nama'] ?></th>
							<?php endforeach ?>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody></tbody>
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
						<label>Data</label>
					</div>
					<?php foreach ($kriteria as $i => $v) : ?>
						<div class="form-floating mb-3">
							<input type="number" name="kriteria[<?= $v['id_kriteria'] ?>]" id="tambah-<?= $v['nama'] ?>" class="form-control" placeholder="Ketik di sini" autocomplete="off" />
							<label><?= $v['nama'] ?></label>
						</div>
					<?php endforeach ?>
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
					<input type="hidden" name="id_data" id="ubah-id" value="" />
					<div class="form-floating mb-3">
						<input type="text" name="nama" id="ubah-nama" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Data</label>
					</div>
					<?php foreach ($kriteria as $i => $v) : ?>
						<div class="form-floating mb-3">
							<input type="number" name="kriteria[<?= $v['id_kriteria'] ?>]" id="ubah-<?= $v['nama'] ?>" class="form-control" placeholder="Ketik di sini" autocomplete="off" />
							<label><?= $v['nama'] ?></label>
						</div>
					<?php endforeach ?>
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
					<input type="hidden" name="id_data" id="hapus-id" value="" />
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
<!-- Modal Dummy-->
<div class="modal fade" id="dummy-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body text-center">
			</div>
		</div>
	</div>
</div>
<?= $this->endSection('modal') ?>

<?= $this->section('footer') ?>
<script>
	console.clear()
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
	const response = [{
			"id_data": "1",
			"nama": "aaaaaaaaaaaa",
			"kriteria": {
				"1": "1000",
				"2": "1",
			}
		},
		{
			"id_data": "2",
			"nama": "bbbbbbbbbbbb",
			"kriteria": {
				"1": "2000",
				"2": "2",
			}
		},
		{
			"id_data": "3",
			"nama": "cccccccccccccc",
			"kriteria": {
				"1": "3000",
				"2": "3",
			}
		}
	]

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
			timer: 2000,
		});
	}

	function randomNumber(min, max) {
		return Math.floor(Math.random() * (max - min) + min);
	}

	function getData(id_project = 0) {
		$.ajax({
			url: '/api/v1/data',
			type: 'get',
			data: {
				id_project: id_project,
			},
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Content-Type': 'application/json',
			},
			success: function(data, textStatus, xhr) {
				// console.log(data)
				$('#dummy-modal .modal-body').html('')
				$('#dummy-modal .modal-body').append(data)
				modalDummy.show()
				// console.log(data);
				$('#spinner').hide()
				$('tbody').html('')
				$.each(data.data, function(i, v) {
					$("tbody").append(htmlTbody(v));
				})
				$("table").show()
			},
			error: function(xhr, textStatus, data) {
				console.log('bad request');
				// notifikasi(xhr.responseJSON.pesan, 'warning')
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
				resetModalTambah()
				$("tbody").prepend(htmlTambah(data.id_kriteria, response.nama, response.atribut, response.bobot, response.deskripsi));
				modalTambah.hide();
				notifikasi(data.pesan, 'success')
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
				// console.log(data)
				// $('#dummy-modal .modal-body').html('')
				// $('#dummy-modal .modal-body').append(data)
				// modalDummy.show()
				// console.log(data);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__nama").text(response.nama);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__atribut").text(response.atribut);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__bobot").text(response.bobot);
				$(".kt-" + response.id_kriteria + ":first").find(".kriteria__deskripsi").text(response.deskripsi);
				resetModalUbah();
				modalUbah.hide();
				notifikasi(data.pesan, 'success')
			},
			error: function(xhr, textStatus, data) {
				// console.log(xhr);
				// console.log(xhr.response);
				// console.log(xhr.responseJSON);
				// $('#dummy-modal .modal-body').html('')
				// $('#dummy-modal .modal-body').append(xhr.responseJSON)
				// modalDummy.show()
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
				$(".kt-" + response.id_kriteria + ":first").hide()
				modalHapus.hide();
				notifikasi(data.pesan, 'success')
			},
			error: function(xhr, textStatus, data) {
				resetModalHapus();
				modalHapus.hide();
				notifikasi(xhr.responseJSON.pesan, 'warning')
			},
		})
	}

	function htmlTbody(response, no = true) {
		let html = ''
		// console.log(response);
		html += `<tr class="dt-${response.unik}" data-data="${response.unik}"><th scope="row" class="fit">${'new'}</th>`
		html += `<td class="data__nama">${response.nama}</td>`
		console.log(response.kriteria);
		$.each(response.kriteria, function(i, v) {
			console.log(i + " | " + v);
			// console.log(v);
			// console.log(v.kriteria);
			html += `<td class="data__${i}">${v}</td>`
			// $.each(v.kriteria, function(i2, v2) {
			// });
		});
		html += `<td class="fit"><button type="button" class="btn btn-sm btn-outline-success btn-ubah me-2" title="ubah kriteriac"><i class="bi bi-pencil-square"></i></button><button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button></td></tr>`
		return html
	}

	$(window).ready(function() {
		// $('.table-loading').hide()
		// htmlTbody(response)
		// $('table').show()
		getData()

		$(document).on('click', '.btn-refresh', function(e) {
			getData()
		})
	})

	// tambah
	$(document).on('click', '.btn-tambah', function(e) {
		resetModalTambah()
		modalTambah.show()
	})
	$(document).on("submit", "#tambah-form", function(e) {
		e.preventDefault();
		const response = $(this).serializeJSON();
		response['id_data'] = randomNumber(3, 100)
		htmlTbody([response], false)
		modalTambah.hide();
		notifikasi('berhasil menambahkan kriteria baru', 'success')
		resetModalTambah();
	});
	$(document).on("click", ".tambah-close", function(e) {
		resetModalTambah();
		modalTambah.hide();
		notifikasi('gagal menambahkan kriteria', 'warning')
	});

	// ubah
	$(document).on("click", ".btn-ubah", function(e) {
		const parent = $(this).parent().parent()
		$("#ubah-id").val(parent.data("data"));
		$("#ubah-nama").val(parent.find(".data__nama").text());
		<?php foreach ($kriteria as $i => $v) : ?>
			$('#ubah-<?= $v['nama'] ?>').val(parent.find(".data__<?= $v['nama'] ?>").text())
		<?php endforeach ?>
		modalUbah.show();
	});
	$(document).on("submit", "#ubah-form", function(e) {
		e.preventDefault();
		const response = $(this).serializeJSON();
		const parent = $(".dt-" + response.id_data + ":first")
		parent.find(".data__nama").text(response.nama);
		<?php foreach ($kriteria as $i => $v) : ?>
			parent.find(".data__<?= $v['nama'] ?>").text(response.kriteria.<?= $v['nama'] ?>);
		<?php endforeach ?>
		modalUbah.hide();
		resetModalUbah();
		notifikasi('berhasil merubah data', 'success')
	});
	$(document).on("click", ".ubah-close", function(e) {
		resetModalUbah();
		modalUbah.hide();
		notifikasi('gagal merubah data', 'warning')
	});

	// hapus
	$(document).on("click", ".btn-hapus", function(e) {
		const parent = $(this).parent().parent()
		$("#hapus-id").val(parent.data("data"));
		$("#hapus-nama").val(parent.find(".data__nama").text());
		modalHapus.show();
	});
	$(document).on("submit", "#hapus-form", function(e) {
		e.preventDefault();
		const response = $(this).serializeJSON();
		$(".dt-" + response.id_data + ":first").hide()
		modalHapus.hide();
		notifikasi('berhasil merubah data', 'success')
		resetModalHapus();
	});
	$(document).on("click", ".hapus-close", function(e) {
		resetModalHapus();
		modalHapus.hide();
		notifikasi('gagal menghapus data', 'warning')
	});
</script>
<?= $this->endSection('footer') ?>