<?php
session_start();
require_once '../../config/database.php';

$id = $_POST['id_transaksi'];
$kode_transaksi = $_POST['kode_transaksi'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$status = $_POST['status'];
$tanggal_delivery = $_POST['tanggal_delivery'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$total_harga = $_POST['total_harga'];

$update = $db->query("UPDATE transaksi SET kode_transaksi = '$kode_transaksi',
		   nama_pelanggan = '$nama_pelanggan',
		   alamat = '$alamat',
		   email = '$email',
		   status = '$status',
		   tanggal_delivery = '$tanggal_delivery',
		   tgl_transaksi = '$tgl_transaksi',
		   total_harga = '$total_harga'
		   WHERE id_transaksi = '$id_transaksi'");

if ($update) {
  header('Location: ../pesanan_supplier.php');
}