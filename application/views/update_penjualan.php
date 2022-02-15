<?php 
 
$host = "localhost";
$user = "root";
$password = "";
$database = "presales";
 
$koneksi = mysqli_connect($host,$user,$password,$database);

$id         = $_GET['id'];
$transaksi  = mysqli_query($koneksi, "select * from transaksi where id_transaksi='$id'");
$row        = mysqli_fetch_array($transaksi);

?>

<div class="row">
	<div class="col-md-12">

    <!-- <?php
    //$transaksi = $db->query("SELECT * FROM transaksi WHERE id_transaksi = '" .$_GET['id_transaksi']. "'");
    //$data = $transaksi->fetch_assoc();
    ?> -->

	<form action="update.php" method="POST">
		<div class="form-group">
            <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
            <label>Kode Pemesanan </label>
            <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" value="<?php echo $row['kode_transaksi']; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="int">Status </label>
            <select name="status" class="form-control" value="<?php echo $row['status']; ?>">
                <option>Submit</option>
                <option>Proses</option>
                <option>Di Kirim</option>
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
	</form>
	</div>
</div>