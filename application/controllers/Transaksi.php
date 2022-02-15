<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('update_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'transaksi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transaksi/index.html';
            $config['first_url'] = base_url() . 'transaksi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->update_model->total_rows($q);
        $barang = $this->update_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi' => $transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'pesanan_supplier',
            'judul' => 'Pesanan',
        );
        $this->load->view('v_index', $data);
    }
    Public function read($id) 
    {
        $row = $this->update_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id_transaksi' => $row->id_transaksi,
        'kode_transaksi' => $row->kode_transaksi,

        );
            $this->load->view('pesanan_supplier', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan_supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->update_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
        'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),        
		'kode_transaksi' => set_value('kode_transaksi', $row->kode_transaksi),
		'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
		'alamat' => set_value('alamat', $row->alamat),
        'email' => set_value('email', $row->email),
        'status' => set_value('status', $row->status),
        'tanggal_delivery' => set_value('tanggal_delivery', $tanggal_delivery),
		'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
		'total_harga' => set_value('total_harga', $row->total_harga),
        'konten' => 'update_penjualan',
            'judul' => 'Update',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pesanan_supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
        if ($_FILES == '') {
            
            $data = array(  	
        'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
        'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        'email' => $this->input->post('email',TRUE),
        'status' => $this->input->post('status',TRUE),
        'tanggal_delivery' => $this->input->post('tanggal_delivery',TRUE),
        'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
        'total_harga' => $this->input->post('total_harga',TRUE),
        );

            $this->update_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));

        } else {

             $data = array(
        'id_transaksi' => $this->input->post('id_transaksi',TRUE),     	
        'kode_transaksi' => $this->input->post('kode_transaksi',TRUE),
        'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        'email' => $this->input->post('email',TRUE),
        'status' => $this->input->post('status',TRUE),
        'tanggal_delivery' => $this->input->post('tanggal_delivery',TRUE),
        'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
        'total_harga' => $this->input->post('total_harga',TRUE),
        );

            $this->update_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
        }

           
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('kode_transaksi', 'kode_transaksi', 'trim|required');
    $this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('status', 'status', 'trim|required');
    $this->form_validation->set_rules('tanggal_delivery', 'tanggal_delivery', 'trim|required');
    $this->form_validation->set_rules('tgl_transaksi', 'tgl_transaksi', 'trim|required');
    $this->form_validation->set_rules('total_harga', 'total_harga', 'trim|required');

    $this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}