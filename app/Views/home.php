<?= $this->extend('components/master') ?>

<?= $this->section('content') ?>
<div class="container welcome" id="welcome">
	<div class="d-flex flex-column align-items-center justify-content-center w-100 text-white text-center" style="height: 80vh; min-height: 400px; max-height: 600px">
		<header class="welcome__header">
			<h1 class="mb-2">App SpKu</h1>
		</header>
		<div class="welcome__body">
			<h5 class="mt-2">Selamat Datang</h5>
			<a href="<?= route_to('view_project') ?>" class="btn btn-sm btn-primary">Project Ku</a>
		</div>
	</div>
</div>
<div class="container mb-5">
	<div class="bg-white rounded p-3 text-center mb-5">
		<p class="m-0">SPK adalah Aplikasi ini di buat untuk menyelesaikan sistem pendukung keputusan</p>
	</div>
	<div class="metode mb-5" id="metode">
		<header class="metode__header text-center text-white mb-3">
			<h6>Metode Yang Tersedia</h6>
		</header>
		<div class="metode__body">
			<div class="row">
				<div class="col-12 col-sm-6 p-2">
					<div class="card p-2" style="width: 100%">
						<div class="card-image">
							<img src="images/Logo-proffitto.png" class="card-img-top" alt="images/Logo-proffitto.png" />
						</div>
						<div class="card-body text-center">
							<h6 class="card-text">SAW</h6>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 p-2">
					<div class="card p-2" style="width: 100%">
						<div class="card-image">
							<img src="images/Logo-proffitto.png" class="card-img-top" alt="images/Logo-proffitto.png" />
						</div>
						<div class="card-body text-center">
							<h6 class="card-text">SAW</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="about mb-5 p-2" id="about">
		<header class="about__header text-center text-white mb-4">
			<h6>About Me</h6>
		</header>
		<div class="about__body">
			<div class="row">
				<div class="col-12">
					<div class="about__card row">
						<div class="col-auto about__img rounded-circle bg-white p-1 me-2">
							<img src="images/IMG-20190730-WA0003.jpg" alt="" class="d-block w-100 rounded-circle" srcset="" />
						</div>
						<div class="col about__desc bg-white rounded p-3">
							<h5>Penulis</h5>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, sunt? Lorem, ipsum dolor sit amet consectetur adipisici</p>
						</div>
						<!-- <div class="about__img rounded-circle bg-white p-1 me-2">
                </div>
                <div class="about__desc bg-white rounded p-3">
                </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('head') ?>
<?= $this->endSection('head') ?>

<?= $this->section('footer') ?>
<?= $this->endSection('footer') ?>