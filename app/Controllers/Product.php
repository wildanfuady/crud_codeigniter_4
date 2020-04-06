<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;

class Product extends Controller
{

    public function __construct() {

        // Mendeklarasikan class ProductModel menggunakan $this->product
        $this->product = new ProductModel();
        /* Catatan:
        Apa yang ada di dalam function construct ini nantinya bisa digunakan
        pada function di dalam class Product 
        */
    }

	public function index()
	{
        $data['product'] = $this->product->getProduct();
        echo view('product/index', $data);
    }
    
    public function create()
    {
        return view('product/create');
    }

    public function store()
    {
        // Mengambil value dari form dengan method POST
        $name = $this->request->getPost('product_name');
        $desc = $this->request->getPost('product_description');

        // Membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'product_name' => $name,
            'product_description' => $desc
        ];

        /* 
        Membuat variabel simpan yang isinya merupakan memanggil function 
        insert_product dan membawa parameter data 
        */
        $simpan = $this->product->insert_product($data);

        // Jika simpan berhasil, maka ...
        if($simpan)
        {
            // Deklarasikan session flashdata dengan tipe success
            session()->setFlashdata('success', 'Created product successfully');
            // Redirect halaman ke product
            return redirect()->to(base_url('product')); 
        }
    }

    public function edit($id)
    {
        // Memanggil function getProduct($id) dengan parameter $id di dalam ProductModel dan menampungnya di variabel array product
        $data['product'] = $this->product->getProduct($id);
        // Mengirim data ke dalam view
        return view('product/edit', $data);
    }

    public function update($id)
    {
        // Mengambil value dari form dengan method POST
        $name = $this->request->getPost('product_name');
        $desc = $this->request->getPost('product_description');

        // Membuat array collection yang disiapkan untuk insert ke table
        $data = [
            'product_name' => $name,
            'product_description' => $desc
        ];

        /* 
        Membuat variabel ubah yang isinya merupakan memanggil function 
        update_product dan membawa parameter data beserta id
        */
        $ubah = $this->product->update_product($data, $id);
        
        // Jika berhasil melakukan ubah
        if($ubah)
        {
            // Deklarasikan session flashdata dengan tipe info
            session()->setFlashdata('info', 'Updated product successfully');
            // Redirect ke halaman product
            return redirect()->to(base_url('product')); 
        }
    }

    public function delete($id)
    {
        // Memanggil function delete_product() dengan parameter $id di dalam ProductModel dan menampungnya di variabel hapus
        $hapus = $this->product->delete_product($id);

        // Jika berhasil melakukan hapus
        if($hapus)
        {
                // Deklarasikan session flashdata dengan tipe warning
            session()->setFlashdata('warning', 'Deleted product successfully');
            // Redirect ke halaman product
            return redirect()->to(base_url('product'));
        }
    }

}
