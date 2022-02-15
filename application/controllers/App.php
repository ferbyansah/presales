<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') == "") {
            redirect('app/login');
        }
		$data = array(
			'konten' => 'home',
            'judul' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
	}

	public function history()
	{
		if ($this->session->userdata('id_user') == "") {
            redirect('app/login');
        } 
		$data = array(
			'konten' => 'history',
            'judul' => 'History Diagnosa',
		);
		$this->load->view('v_index', $data);
	}

	public function registrasi()
	{

		$this->load->view('reg_user');
	}

	public function login()
	{

		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek_user = $this->db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
			$cek_supplier = $this->db->query("SELECT * FROM supplier WHERE username='$username' and password='$password'");
			$cek_user1 = $this->db->query("SELECT * FROM user WHERE username='$username' and password='$password' ");
			if ($cek_user->num_rows() == 1) {
				foreach ($cek_user->result() as $row) {
					$sess_data['id_user'] = $row->id_user;
					$sess_data['nama'] = $row->nama_user;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = $row->level;
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			}elseif ($cek_supplier->num_rows() == 1) {
				foreach ($cek_supplier->result() as $row) {
					$sess_data['id_user'] = $row->kode_supplier;
					$sess_data['nama'] = $row->nama_supplier;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = 'supplier';
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			}elseif ($cek_user1->num_rows() == 1) {
				foreach ($cek_user1->result() as $row) {
					$sess_data['id_user'] = $row->id_user;
					$sess_data['nama'] = $row->nama;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = 'user';
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			} else {
				?>
				<script type="text/javascript">
					alert('Username dan password kamu salah !');
					window.location="<?php echo base_url('app/login'); ?>";
				</script>
				<?php
			}

		}
	}

	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('app/login');
	}

	public function simpan_reg()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => $password,
			'level' => 'user',
		);

		$this->db->insert('user', $data);
		?>
		<script type="text/javascript">
			alert('Pendaftaran Berhasil, Silahkan Login');
			window.location = '<?php echo base_url('app/login'); ?>'
		</script>
		<?php
	}

	public function cek_barang()
	{
        $kode_barang = $this->input->post('kode_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE kode_barang='$kode_barang'")->row();
		$data = array(
			'harga_beli' => $cek->harga_beli,
			'harga' => $cek->harga,
			'kode_barang' => $cek->kode_barang,
			'nama_barang' => $cek->nama_barang,
		);
		echo json_encode($data);
	}

	public function tambah_penjualan()
	{
		$this->load->model('No_urut');

		$data = array(
			'konten' => 'form_penjualan',
			'judul' => 'Inquiry',
			'kodeurut' => $this->No_urut->buat_kode_penjualan(),
		);
		$this->load->view('v_index',$data);
	}

	public function hapus_penjualan($kode_penjualan)
	{
		
        $this->db->where('kode_transaksi', $kode_penjualan);
		$this->db->delete('transaksi');
		$this->db->where('kode_transaksi', $kode_penjualan);
		$this->db->delete('detail_transaksi');
		?>
		<script type="text/javascript">
			alert('Berhasil Hapus Data');
			window.location='<?php echo base_url('app/penjualan') ?>';
		</script>
		<?php
	}

	public function hapus_penjualan_cust($kode_penjualan)
	{
		
        $this->db->where('kode_transaksi', $kode_penjualan);
		$this->db->delete('transaksi');
		$this->db->where('kode_transaksi', $kode_penjualan);
		$this->db->delete('detail_transaksi');
		?>
		<script type="text/javascript">
			alert('Berhasil Hapus Data');
			window.location='<?php echo base_url('app/penjualan_cust') ?>';
		</script>
		<?php
	}

	public function cetak_penjualan($kode_penjualan)
	{
		
        $data = array(
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_penjualan'"),
		);
		$this->load->view('cetak_penjualan',$data);
	}

	public function cetak_penjualan_sup($kode_penjualan)
	{
		
        $data = array(
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_penjualan'"),
		);
		$this->load->view('cetak_penjualan_sup',$data);
	}

	public function detail_penjualan($kode_penjualan)
	{
		
		$data = array(
			'konten' => 'detail_penjualan',
			'judul' => 'Detail Inquiry',
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_penjualan'"),
		);
		$this->load->view('v_index',$data);
	}


	public function simpan_penjualan()
	{
        $kode_penjualan = $this->input->post('kode_penjualan');
        $total_harga = $this->input->post('total_harga');
        $tgl_penjualan = $this->input->post('tgl_penjualan');
        $pelanggan = $this->input->post('pelanggan');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $tanggal_delivery = $this->input->post('tanggal_delivery');
        $status = $this->input->post('status');

        foreach ($this->cart->contents() as $items) {
        	$kode_barang = $items['id'];
        	$qty = $items['qty'];
        	$d = array(
        		'kode_transaksi' => $kode_penjualan,
        		'kode_barang' => $kode_barang,
        		'qty' => $qty,
        	);
        	$this->db->insert('detail_transaksi', $d);
        	//$this->db->query("UPDATE menu SET satuan=satuan-'$qty' WHERE kode_menu='$kode_barang'");
        }

        $data = array(
        	'nama_pelanggan' => $pelanggan,
        	'alamat' => $alamat,
        	'email' => $email,
            'kode_transaksi'=> $kode_penjualan,
            'total_harga'=> $total_harga,
            'tgl_transaksi'=> $tgl_penjualan,
            'tanggal_delivery' => $tanggal_delivery,
            'status' => $status,
        );
        $this->db->insert('transaksi', $data);
        $this->cart->destroy();
        redirect('app/penjualan_cust');
	}

	public function simpan_cart()
	{
		
        $data = array(
            'id'    => $this->input->post('kode_barang'),
            'qty'   => $this->input->post('jumlah'),
            'price' => $this->input->post('harga'),
            'priceb' => $this->input->post('harga_beli'),
            'name'  => $this->input->post('nabar'),

        );
        $this->cart->insert($data);
        redirect('app/tambah_penjualan');
	}

	public function hapus_cart($id)
	{
		
        $data = array(
            'rowid'    => $id,
            'qty'   => 0,
        );
        $this->cart->update($data);
        redirect('app/tambah_penjualan');
	}
	

	public function penjualan()
	{
		$data = array(
			'konten' => 'penjualan',
			'judul' => 'Data Inquiry',
		);
		$this->load->view('v_index',$data);
	}

	public function ubah()
	{
		$data = array(
			'konten' => 'update_penjualan',
			'judul' => 'Update',
		);
		$this->load->view('v_index',$data);
	}

	public function penjualan_cust()
	{
		$data = array(
			'konten' => 'penjualan_cust',
			'judul' => 'Inquiry',
		);
		$this->load->view('v_index',$data);
	}

	public function pemesanan_supplier()
	{
		$data = array(
			'konten' => 'pesanan_supplier',
			'judul' => 'Data Inquiry',
		);
		$this->load->view('v_index',$data);
	}


}
