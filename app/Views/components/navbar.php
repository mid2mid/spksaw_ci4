<div class="container-fluid bg-white" id="nav">
	<nav class="navbar navbar-light">
		<div class="container" style="max-width: 1200px;">
			<a class="navbar-brand" href="/">MiD App</a>
			<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="offcanvasNavbarLabel">MiD App</h5>
					<button type="button" class="btn-close text-reset border-0" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
						<li class="nav-item">
							<a class="nav-link  <?= $page === "home" ? 'active' : '' ?>" href="/">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $page === "projects" ? 'active' : '' ?>" href="<?= route_to('view_project') ?>">Project</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $page === "kriteria" ? 'active' : '' ?>" href="<?= route_to('view_kriteria') ?>">Kriteria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $page === "data" ? 'active' : '' ?>" href="<?= route_to('view_data') ?>">Data</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?= $page === "hasil" ? 'active' : '' ?>" href="<?= route_to('view_hasil') ?>">Hasil</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</div>