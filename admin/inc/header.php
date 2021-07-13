<?php 
session_start();
ob_start();

require 'class.upload.php';

require '../diger/veritabani.php';

if (!isset($_SESSION['email'])) {
	header('Location: ../sayfalar/giris.php');
}

 ?>
<!doctype html>
	<html lang="tr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Admin</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

		<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>

	<link href="dashboard.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Ders Notları</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="../sayfalar/cik.php">Çıkış</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
				<div class="sidebar-sticky pt-3">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" href="index.php">
								<span data-feather="home"></span>
								Tüm Notlar 
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="not-ekle.php">
								<span data-feather="file"></span>
								Yeni Not Ekle
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="kategoriler.php">
								<span data-feather="file"></span>
								Kategoriler
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="kategori-ekle.php">
								<span data-feather="file"></span>
								Yeni Kategori Ekle
							</a>
						</li>
						
					</ul>

				</div>
			</nav>