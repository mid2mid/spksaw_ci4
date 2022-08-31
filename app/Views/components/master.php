<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="plugins/bootstrap5/css/bootstrap.css" />
	<!-- BOOTSTRAP ICONS -->
	<link rel="stylesheet" href="plugins/bootstrap-icons/bootstrap-icons.css" />
	<!-- CSS -->
	<link rel="stylesheet" href="css/style.css" />

	<title><?= ucwords($page) ?> | App SPK</title>

	<?= $this->renderSection('head') ?>
</head>

<body style="background-color: rgb(100, 98, 98)">

	<?= $this->include('components/navbar') ?>

	<?= $this->renderSection('content') ?>

	<?= $this->include('components/footer') ?>

	<?= $this->renderSection('modal') ?>

	<!-- jquery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- jquery serialize json -->
	<script src="plugins/jquery-serialize-json/jquery-serialize-json.min.js"></script>
	<!-- BOOTSTRAP 5 JS -->
	<script src="plugins/bootstrap5/js/bootstrap.js"></script>
	<!-- Sweet Alert 2 -->
	<script src="plugins/sweet-alert-2/sweet-alert-2.all.min.js"></script>
	<?= $this->renderSection('footer') ?>
</body>

</html>