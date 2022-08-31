<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container my-4" style="max-width: 1200px; min-height: 80vh">
	<div class="row">
		<div class="col-12 bg-white rounded p-2 mb-4">
			<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah-modal" title="tambah kriteria"><i class="bi bi-plus-square"></i> Tambah Kriteria</button>
			<a href="hasil.html" class="btn btn-primary" title="Lihat Hasil"><i class="bi bi-check2-circle"></i> Hasil</a>
		</div>
		<div class="col-12 bg-white rounded p-2 mb-4">
			<div class="container-fluid mb-3 p-0 d-flex justify-content-end">
				<button type="button" class="btn btn-sm btn-primary" title="refresh data"><i class="bi bi-arrow-clockwise"></i></button>
			</div>
			<div class="container-fluid justify-content-center align-items-center table-loading" style="height: 100px; display: flex;">
				<div class="spinner-border " role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table align-middle" style="display: none;">
					<thead class="table-dark">
					</thead>
					<tbody>
						<!-- <tr class="data-1" data-id="1" data-project="1">
							<th scope="row" class="fit">1</th>
							<td class="col__data">Harga</td>
							<td class="col__harga">40000</td>
							<td class="col__jumlah">2</td>
							<td class="fit">
								<button type="button" class="btn btn-sm btn-outline-success btn-ubah" title="ubah kriteria"><i class="bi bi-pencil-square"></i></button>
								<button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button>
							</td>
						</tr> -->
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
						<input type="number" maxlength="5" minlength="0" name="bobot" id="tambah-bobot" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Bobot</label>
						<div class="text-danger ms-2">* maksimal nilai bobot 5</div>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="keterangan" id="tambah-keterangan" class="form-control" placeholder="Ketik di sini" autocomplete="off" required />
						<label>Keterangan</label>
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
						<div class="text-danger ms-2">* maksimal nilai bobot 5</div>
					</div>
					<div class="form-floating mb-3">
						<input type="text" name="keterangan" id="ubah-keterangan" class="form-control" placeholder="Ketik di sini" autocomplete=" off" required />
						<label>Keterangan</label>
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
	const response = [{
			"id_data": "1",
			"nama": "aaaaaaaaaaaa",
			"kriteria": {
				"harga": "1000",
				"jumlah": "1",
				"garansi": "1"
			}
		},
		{
			"id_data": "2",
			"nama": "bbbbbbbbbbbb",
			"kriteria": {
				"harga": "2000",
				"jumlah": "2",
				"garansi": "2"
			}
		},
		{
			"id_data": "3",
			"nama": "cccccccccccccc",
			"kriteria": {
				"harga": "3000",
				"jumlah": "3",
				"garansi": "3"
			}
		}
	]
	// const response = [{
	// 		"id_data": "1",
	// 		"nama": "aaaaaaaaaaaa",
	// 		"kriteria": [{
	// 			"harga": "1000",
	// 			"jumlah": "1",
	// 			"garansi": "1"
	// 		}]
	// 	},
	// 	{
	// 		"id_data": "2",
	// 		"nama": "bbbbbbbbbbbb",
	// 		"kriteria": [{
	// 			"harga": "2000",
	// 			"jumlah": "2",
	// 			"garansi": "2"
	// 		}]
	// 	},
	// 	{
	// 		"id_data": "3",
	// 		"nama": "cccccccccccccc",
	// 		"kriteria": [{
	// 			"harga": "3000",
	// 			"jumlah": "3",
	// 			"garansi": "3"
	// 		}]
	// 	}
	// ]

	function htmlThead(response) {
		let html = `<tr><th scope="col">No</th><th scope="col">Data</th>`
		$.each(response, function(i, v) {
			html += `<th scope="col">${i}</th>`
		});
		html += `<th scope="col"></th></tr>`
		$('thead').append(html)
	}

	function htmlTtr() {

	}

	function Ttd(response) {
		$.each(response.kriteria, function(i, v) {
			html += `<td class="data__${i}">${v}</td>`
		});
	}

	function htmlTbody(response) {
		let parent = ''
		// Object.keys(response).forEach(function(v, i) {
		// 	console.log(i);
		// parent += `<tr class="dt-${v.id_data}" data-data="${v.id_data}"><th scope="row" class="fit">${i+1}</th>`
		// console.log(parent);
		// Object.keys(v.kriteria).forEach(function(v2, i2) {
		// 	parent += `<td class="data__${i2}">${v2}</td>`
		// })
		// parent += `<td class="fit"><button type="button" class="btn btn-sm btn-outline-success btn-ubah" title="ubah kriteria"><i class="bi bi-pencil-square"></i></button><button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button></td></tr>`
		// });
		// console.log(parent);
		$.each(response, function(i, v) {
			parent += `<tr class="dt-${v.id_data}" data-data="${v.id_data}"><th scope="row" class="fit">${i+1}</th>`
			parent += `<td class="data__nama">${v.nama}</td>`
			// console.log('======');
			// console.log(v);
			$.each(v.kriteria, function(i2, v2) {
				// console.log(i2);
				// console.log(v2);
				parent += `<td class="data__${i2}">${v2}</td>`
			});
			// console.log('======');
			parent += `<td class="fit"><button type="button" class="btn btn-sm btn-outline-success btn-ubah" title="ubah kriteria"><i class="bi bi-pencil-square"></i></button><button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button></td></tr>`
		});
		$('tbody').append(parent)
	}

	$(window).on('ready', function() {})
	$(window).ready(function() {
		$('.table-loading').hide()
		htmlThead(response[0].kriteria)
		htmlTbody(response)
		$('table').show()

	})
	$(window).on('load', function() {})

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

	function htmlTambah(id, nama, atribut, bobot, keterangan) {
		return `
							<tr class="kt-${id}" data-kriteria="${id}">
								<th scope="row" class="fit">new</th>
								<td class="kriteria__nama">${nama}</td>
								<td class="kriteria__atribut">${atribut}</td>
								<td class="kriteria__bobot">${bobot}</td>
								<td class="kriteria__keterangan d-none">${keterangan}</td>
								<td class="fit">
									<button type="button" class="btn btn-sm btn-outline-success btn-ubah" title="ubah kriteria"><i class="bi bi-pencil-square"></i></button>
									<button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="hapus kriteria"><i class="bi bi-trash"></i></button>
								</td>`;
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

	// tambah
	$(document).on('click', '.btn-tambah', function(e) {
		resetModalTambah()
		modalTambah.show()
	})
	$(document).on("submit", "#tambah-form", function(e) {
		e.preventDefault();
		const response = $(this).serializeJSON();
		$("tbody").prepend(htmlTambah(randomNumber(3, 100), response.nama, response.atribut, response.bobot, response.keterangan));
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
		$("#ubah-id").val($(this).parent().parent().data("kriteria"));
		$("#ubah-nama").val($(this).parent().parent().find(".kriteria__nama").text());
		$("#ubah-atribut").val($(this).parent().parent().find(".kriteria__atribut").text());
		$("#ubah-bobot").val($(this).parent().parent().find(".kriteria__bobot").text());
		$("#ubah-keterangan").val($(this).parent().parent().find(".kriteria__keterangan").text());
		modalUbah.show();
	});
	$(document).on("submit", "#ubah-form", function(e) {
		e.preventDefault();
		const response = $(this).serializeJSON();
		const parent = $(".kt-" + response.id_kriteria + ":first")
		parent.find(".kriteria__nama").text(response.nama);
		parent.find(".kriteria__atribut").text(response.atribut);
		parent.find(".kriteria__bobot").text(response.bobot);
		parent.find(".kriteria__keterangan").text(response.keterangan);
		modalUbah.hide();
		resetModalUbah();
		notifikasi('berhasil merubah kriteria', 'success')
	});
	$(document).on("click", ".ubah-close", function(e) {
		resetModalUbah();
		modalUbah.hide();
		notifikasi('gagal merubah kriteria', 'warning')
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
		const response = $(this).serializeJSON();
		$(".kt-" + response.id_kriteria + ":first").hide()
		modalHapus.hide();
		notifikasi('berhasil merubah kriteria', 'success')
		resetModalHapus();
	});
	$(document).on("click", ".hapus-close", function(e) {
		resetModalHapus();
		modalHapus.hide();
		notifikasi('gagal menghapus kriteria', 'warning')
	});
</script>
<?= $this->endSection('footer') ?>