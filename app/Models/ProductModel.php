<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table;

    public function __construct() {

        parent::__construct();
        // Memanggil class Database
        $db = \Config\Database::connect();
        // Menginisialisasi $this->table untuk menampung data table product
        $this->table = $this->db->table('product');
    }

    public function get_product()
    {
        // Mengembalikan nilai data product disertail dengan output result array
        return $this->table->get()->getResultArray();
    }

    public function insert_product($data)
    {
        // Melakukan insert data ke dalam table
        return $this->table->insert($data);
    }

    public function edit_product($id)
    {
        // Menampilkan data di dalam table berdasarkan primary key dan single output getRowArray()
        return $this->table->where('product_id', $id)->get()->getRowArray();
    }

    public function update_product($data, $id)
    {
        // Set data dalam bentuk array
        $this->table->set($data);
        // Ubah data yang sudah di set berdasarkan product_id
        $this->table->where('product_id', $id);
        // Melakukan update data
        return $this->table->update(); 
    }

    public function delete_product($id)
    {
        // Hapus data yang sudah di set berdasarkan product_id
        $this->table->where('product_id', $id);
        // Melakukan delete data
        return $this->table->delete();
    }
}