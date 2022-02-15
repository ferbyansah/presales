<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Quatation</title>
	<link rel="stylesheet" type="text/css" href="assets/bootflat-admin/css/bootstrap.min.css">
</head>
<body >
	<div class="container">
	<center>
		<h3><img width="100px" height="100px" src="image/CV1.jpg">CV. DAMAR PUTRA TEKNIK</h3>
		<p>Jl. Melati 3 No.89 Komp. Jati Kramat Indah 1 - Jati Kramat - Jati Asih - Bekasi</p>
		<p>Telp & Fax : (021) 86605523 - Email : damarputrateknik@gmail.com</p>
	</center>
	<?php 
	$rs = $data->row();
	 ?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tr>
					<th>Quatation</th>
					<th>:</th>
					<td><?php echo $rs->kode_transaksi; ?></td>
					<th>Email</th>
					<th>:</th>
					<td><?php echo $rs->email; ?></td>
					<th>Tanggal Delivery</th>
					<th>:</th>
					<td><?php echo $rs->tanggal_delivery; ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<th>:</th>
					<td><?php echo $rs->tgl_transaksi; ?></td>
					<th>Alamat</th>
					<th>:</th>
					<td><?php echo $rs->alamat; ?></td>
					<!-- <th>Status</th>
					<th>:</th>
					<td><?php echo $rs->status; ?></td> -->
				</tr>
				<tr>
					<th>Nama Pelanggan</th>
					<th>:</th>
					<td><?php echo $rs->nama_pelanggan; ?></td>
					<th>Total Harga</th>
					<th>:</th>
					<td>Rp. <?php echo number_format($rs->total_harga); ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered" style="margin-bottom: 10px" >
				<thead>
					<tr>
						<th>No.</th>
						<!-- <th>Kode Barang</th> -->
						<th>Nama Barang</th>
						<!-- <th>Supplier</th> -->
						<th>Qty</th>
						<th>Harga</th>
						<th>Harga Beli</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<p>Attn : <?php echo $rs->nama_pelanggan; ?> </p>
				<p>Dengan Hormat,</p>
				<p>Dengan ini kami berikan penawaran harga untuk barang yang dimaksud sebagai berikut</p>

				<tbody>
					<?php 
					$sql = $this->db->query("SELECT * FROM detail_transaksi as a,barang as b, supplier as s where a.kode_barang=b.kode_barang and b.kode_supplier=s.kode_supplier and a.kode_transaksi='$rs->kode_transaksi' ");
					$no = 1;
					foreach ($sql->result() as $row) {
					 ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<!-- <td><?php echo $row->kode_barang; ?></td> -->
						<td><?php echo $row->nama_barang; ?></td>
						<!-- <td><?php echo $row->nama_supplier; ?></td> -->
						<td><?php echo $row->qty; ?></td>
						
						<td>Rp. <?php echo $row->harga; ?></td>
						<td>Rp. <?php echo $row->harga_beli; ?></td>
						<td>Rp. <?php 
						$totharga = $row->qty*$row->harga;
						echo number_format($totharga);
						 ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="5">Total</td>
						<td>Rp. <?php echo number_format($rs->total_harga) ?></td>
					</tr>
					<!-- <tr>
						<td colspan="5"><b>Diskon Keseluruhan (10%)</b></td>
						<td>
							Rp.
						<?php 
						$diskon = 0;
						if ($rs->total_harga >= 100000) {
							$diskon = 0.1 * $rs->total_harga;
						} else {
							$diskon = 0;
						 
						}
						echo number_format($diskon)

						?>
						</td>
					</tr> -->
					 <tr>
						<td colspan="5"><b>Total Bayar</b></td>
						<!-- <td>Rp. <?php echo number_format($rs->total_harga-$diskon) ?></td> -->
						<td>Rp. <?php echo number_format($rs->total_harga) ?></td>
					</tr>
				</tbody>
			</table>
			<p>Demikian penawaran harga dari kami, terima kasih atas perhatian dan kerjasamanya.</p>
			<b>KETERANGAN :</b>
			<p>Harga Belum Termasuk PPN</p>

			<div style="text-align: right;">
				<p>Jakarta, <?php echo date('d/m/Y') ?></p>
				<p>Hormat Kami,</p>
				<br><br><br><br><br>
				<p>M.Izwan Hadi Prayogo</p>
			</div>
		</div>
	</div>
</div>


<!-- <script src='assets/jspdf.debug.js'></script>
	<script src='assets/html2pdf.js'></script>
	<script>
		var pdf = new jsPDF('l', 'pt', 'A4');
		var canvas = pdf.canvas;
		var width = 1200;
		//canvas.width=8.5*72;
		document.body.style.width=width + "px";

		html2canvas(document.body, {
		    canvas:canvas,
		    onrendered: function(canvas) {
		        var iframe = document.createElement('iframe');
		        iframe.setAttribute('style', 'position:absolute;top:0;right:0;height:100%; width:100%');
		        document.body.appendChild(iframe);
		        iframe.src = pdf.output('datauristring');

		       //var div = document.createElement('pre');
		       //div.innerText=pdf.output();
		       //document.body.appendChild(div);
		    }
		});
     </script> -->


</body>
</html>