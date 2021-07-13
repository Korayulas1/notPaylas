<?php 
session_start();
ob_start();
?>
<!doctype html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ders Blog</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
</head>
<body>

	<header>
		<div class="collapse bg-dark" id="navbarHeader">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-md-7 py-4">
						<h4 class="text-white">Hakkımızda</h4>
						<p class="text-muted">Tüm derslerin notlarına buradan ulaşabilirsiniz</p>
					</div>
					<?php 

					if (isset($_SESSION['email'])) {
						?>
						<div class="col-sm-2 mt-3">
							<h4 class="text-white">Hesabım</h4>
							<ul class="list-unstyled">
								<li><a href="guncelle.php?id=<?=$_SESSION["id"]?>" class="text-white">Hesabımı Güncelle</a></li>
								<li><a href="sil.php?id=<?=$_SESSION["id"]?>" class="text-white">Hesabımı Sil</a></li>
								<li><a href="cik.php" class="text-white">Çıkış Yap</a></li>
							</ul>
						</div>
						<?php
					}
					else{
						?>
						<div class="col-sm-1 mt-3">
							<ul class="list-unstyled">
								<li><a href="giris.php" class="text-white">Giriş Yap</a></li>
								<li><a href="kayit.php" class="text-white">Kayıt Ol</a></li>
								
							</ul>
						</div>
						<?php
					}

					?>
				</div>
			</div>
		</div>
		<div class="navbar navbar-dark bg-dark shadow-sm">
			<div class="container">
				<a href="../index.php" class="navbar-brand d-flex align-items-center">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
					<strong>Ders Blog</strong>
				</a>
				<b style="color: white; float: right;" ><?php if(isset($_SESSION['email']))  {echo $_SESSION['email'];}?></b>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</div>
	</header>

	<main>

		<div class="album py-5 bg-light">
			<div class="container ">
				<div class="row  mx-auto col-5">
					<?php 
					include '../diger/veritabani.php';

					$id = $_GET['id'];
					if (!$id) {
						header('Location: ../index.php');
						exit();
					}

					if (isset($_POST['guncelle'])) {

						$email = $_POST['email'] ?? null;
						$sifre = $_POST['sifre'] ?? null;
						$sifre_tekrar = $_POST['sifre_tekrar'] ?? null;

						if (!isset($email)) {
							
							$hata = 'Eposta adresi girmediniz';
						}
						elseif(!isset($sifre)){
							$hata = 'Şifreinizi girmediniz';
						}
						
						else{
							$sorgu = $db->prepare("UPDATE kayit SET
								email = ?,
								sifre = ? WHERE id = $id");
							$kayit = $sorgu->execute(array(
								$email, $sifre
							));
							if ($kayit){
								$_SESSION['email'] = $email;
								$basarili = 'Güncelleme Başarılı Yönlendiriliyorsunuz...';
								header("Refresh: 2; ../index.php");
							}
							else{	
								$hata = 'Bir Sorun Oluştu Tekrar Deneyin';
							}
						}
					}

					if (isset($hata)) {
						?>
						<div class="alert alert-danger" role="alert">
							<?=$hata?>
						</div>
						<?php
					}
					if (isset($basarili)) {
						?>
						<div class="alert alert-success" role="alert">
							<?=$basarili?>
						</div>
						<?php
					}
					?>

					<?php 

					$id = $_GET['id'];
					$query = $db->query("SELECT * FROM kayit WHERE id = $id", PDO::FETCH_ASSOC);
					if ( $query->rowCount() ){
						foreach( $query as $row ){
							?>
							<main class="form-signin">
								<form method="post" action="">

									<h1 class="h3 mb-3 fw-normal">Güncelle</h1>
									<label  class="visually-hidden">Email </label>
									<input type="email" value="<?=$row['email']?>" name="email"  class="form-control" placeholder="Email Adres" required autofocus>
									<label  class="visually-hidden">Şifre</label>
									<input type="password" value="<?=$row['sifre']?>" name="sifre"  class="form-control" placeholder="Şifre" required>
									<button class="w-100 btn btn-lg btn-primary" value="1" name="guncelle" type="submit">Güncelle</button>
								</form>
							</main>
							<?php
						}
					} ?>
				</div>
			</div>
		</div>
	</main>

	<footer class="text-muted py-5">
		<div class="container">
			<p class="float-end mb-1">
				<a href="#">Yukarı Dön</a>
			</p>
			<p class="mb-1">2021 &copy; NotBlog Tüm Hakları Saklıdır.</p>
		</div>
	</footer>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>


</body>
</html>
