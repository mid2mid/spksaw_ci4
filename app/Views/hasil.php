<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container my-4" style="max-width: 1200px; min-height: 80vh">
	<div class="row">
		<div class="col-12 bg-white rounded p-2 mb-4">
			<a href="<?= route_to('view_kriteria') . '?project=' . $id_project ?>" class="btn btn-warning"><i class="bi bi-card-text me-2"></i> kriteria</a>
			<a href="<?= route_to('view_data') . '?project=' . $id_project ?>" class="btn btn-secondary"><i class="bi bi-card-checklist me-2"></i> data</a>
		</div>
		<?php if (isset($gagal)) : ?>
			<div class="col-12 bg-white rounded p-2 mb-4">
				<div class="mb-3" style="border-bottom: 5px solid orange">
					<h5 class="px-4 py-1 m-0 rounded-top" style="font-size: 30px; background-color: orange; width: fit-content">result</h5>
				</div>
				<div class="d-flex justify-content-center align-items-center" style="height: 200px; flex-direction: column;">
					<!-- <p class="text-danger fw-bolder fs-3"><?= $gagal ?></p> -->
					<p class="text-danger fw-bolder fs-3">Belum Bisa Proses Hasil</p>
					<p class="text-danger fw-bolder fs-3">Silakan Cek Kembali data dan kriteria</p>
				</div>
			</div>
		<?php else : ?>
			<div class="col-12 bg-white rounded p-2 mb-4">
				<div class="mb-3" style="border-bottom: 5px solid orange">
					<h5 class="px-4 py-1 m-0 rounded-top" style="font-size: 30px; background-color: orange; width: fit-content">result</h5>
				</div>
				<div class="table-responsive">
					<table class="table align-middle">
						<thead class="table-dark">
							<tr>
								<th scope="col">Ranking</th>
								<th scope="col">Data</th>
								<th scope="col">Skor</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($ranking as $i => $v) : ?>
								<tr>
									<th scope="row" class="fit text-center"><?= $i + 1 ?></th>
									<td><?= $v['nama'] ?></td>
									<td><?= $v['skor'] ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12 bg-white rounded p-2 mb-4">
				<div class="mb-3" style="border-bottom: 5px solid orange">
					<h5 class="px-4 py-1 m-0 rounded-top" style="font-size: 30px; background-color: orange; width: fit-content">analisis</h5>
				</div>
				<div class="accordion accordion-flush" id="analisis-wrapper">
					<div class="accordion-item mb-3" style="border: 2px solid orange">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#analisis-1" aria-expanded="false" aria-controls="analisis-one">Menentukan Kriteria</button>
						</h2>
						<div id="analisis-1" class="accordion-collapse collapse" data-bs-parent="#analisis-wrapper">
							<div class="accordion-body">
								<div class="table-responsive">
									<table class="table align-middle">
										<thead class="table-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Kriteria</th>
												<th scope="col">Atribut</th>
												<th scope="col">Bobot</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($kriteria as $i => $v) : ?>
												<tr>
													<th scope="row" class="fit"><?= $i + 1 ?></th>
													<td><?= $v['nama'] ?></td>
													<td><?= $v['atribut'] ?></td>
													<td><?= $v['bobot'] ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item mb-3" style="border: 2px solid orange">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#analisis-2" aria-expanded="false" aria-controls="analisis-one">Menentukan Data</button>
						</h2>
						<div id="analisis-2" class="accordion-collapse collapse" data-bs-parent="#analisis-wrapper">
							<div class="accordion-body">
								<div class="table-responsive">
									<table class="table align-middle">
										<thead class="table-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">nama</th>
												<?php foreach ($kriteria as $i => $v) : ?>
													<th scope="col"><?= $v['nama'] ?></th>
												<?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($data as $i => $v) : ?>
												<tr>
													<th scope="row" class="fit"><?= $i + 1 ?></th>
													<td><?= $v['nama'] ?></td>
													<?php foreach ($v['kriteria'] as $i2 => $v2) : ?>
														<td><?= $v2 ?></td>
													<?php endforeach; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item mb-3" style="border: 2px solid orange">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#analisis-3" aria-expanded="false" aria-controls="analisis-two">Normalisasi</button>
						</h2>
						<div id="analisis-3" class="accordion-collapse collapse p-3" data-bs-parent="#analisis-wrapper">
							<div class="accordion-body">
								<div class="table-responsive">
									<table class="table align-middle">
										<thead class="table-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">nama</th>
												<?php foreach ($kriteria as $i => $v) : ?>
													<th scope="col"><?= $v['nama'] ?></th>
												<?php endforeach; ?>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($normalisasi as $i => $v) : ?>
												<tr>
													<th scope="row" class="fit"><?= $i + 1 ?></th>
													<td><?= $v['nama'] ?></td>
													<?php foreach ($v['kriteria'] as $i2 => $v2) : ?>
														<td><?= $v2 ?></td>
													<?php endforeach; ?>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item mb-3" style="border: 2px solid orange">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#analisis-4" aria-expanded="false" aria-controls="analisis-tri">Ranking</button>
						</h2>
						<div id="analisis-4" class="accordion-collapse collapse p-3" data-bs-parent="#analisis-wrapper">
							<div class="accordion-body">
								<div class="table-responsive">
									<table class="table align-middle">
										<thead class="table-dark">
											<tr>
												<th scope="col">#</th>
												<th scope="col">Data</th>
												<th scope="col">Rumus</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($ranking_string as $i => $v) : ?>
												<tr>
													<th scope="row" class="fit"><?= $i + 1 ?></th>
													<td><?= $v['nama'] ?></td>
													<td><?= $v['rumus'] ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('head') ?>
<?= $this->endSection('head') ?>

<?= $this->section('footer') ?>
<?= $this->endSection('footer') ?>