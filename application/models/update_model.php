<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class update_model extends CI_Model
{

    public $table = 'transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_transaksi', $q);
	$this->db->or_like('kode_transaksi', $q);
    $this->db->or_like('nama_pelanggan', $q);
    $this->db->or_like('alamat', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('status', $q);
    $this->db->or_like('tanggal_delivery', $q);
    $this->db->or_like('tgl_transaksi', $q);
    $this->db->or_like('total_harga', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
    $this->db->or_like('kode_transaksi', $q);
    $this->db->or_like('nama_pelanggan', $q);
    $this->db->or_like('alamat', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('status', $q);
    $this->db->or_like('tanggal_delivery', $q);
    $this->db->or_like('tgl_transaksi', $q);
    $this->db->or_like('total_harga', $q);
    $this->db->from($this->table);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

}

/* End of file Jenis_barang_model.php */
/* Location: ./application/models/Jenis_barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-03 15:15:19 */
/* http://harviacode.com */