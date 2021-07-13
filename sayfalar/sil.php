<?php
session_start();
ob_start();
include '../diger/veritabani.php';

if (!isset($_GET['id']) ) {
	header('Location: ../index.php');
	exit();
}


$query = $db->prepare("DELETE FROM kayit WHERE id = :id");
$delete = $query->execute(array(
	'id' => $_GET['id']
));

if ($delete) {
	session_destroy();
	header('Location: giris.php?i=1');
}