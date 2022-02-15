<?php 
$rs = $data->row();
 ?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
					<th>Inquiry</th>
					<th>:</th>
					<td><?php echo $rs->kode_transaksi; ?></td>
					<th>Email</th>
					<th>:</th>
					<td><?php echo $rs->email; ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<th>:</th>
					<td><?php echo $rs->tgl_transaksi; ?></td>
					<th>Alamat</th>
					<th>:</th>
					<td><?php echo $rs->alamat; ?></td>
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
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Beli</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql = $this->db->query("SELECT * FROM detail_transaksi as a,barang as b where a.kode_barang=b.kode_barang and a.kode_transaksi='$rs->kode_transaksi' ");
				$no = 1;
				foreach ($sql->result() as $row) {
				 ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->kode_barang; ?></td>
					<td><?php echo $row->nama_barang; ?></td>
					
					<td><?php echo $row->harga; ?></td>
					<td><?php echo $row->harga_beli; ?></td>
					<td><?php echo $row->qty; ?></td>

				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>