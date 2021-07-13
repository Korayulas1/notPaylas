<?php

require '../diger/veritabani.php';

$tablo = $_GET['tablo'];
$sutun = $_GET['sutun'];
$id = $_GET['id'];

$query = $db->prepare('DELETE FROM ' . $tablo . ' WHERE ' . $sutun . ' = :id');
$query->execute([
	'id' => $id
]);

if ($query) {
	header('Location:' . $_SERVER['HTTP_REFERER']);
}