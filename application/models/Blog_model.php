<?php 
class Blog_model extends CI_Model {

    public function getBlogs($limit, $offset)  // nama method, untuk mengambil semua data yang ada di dalam "blog"
    {
        $filter = $this->input->get('find');  // untuk menangkap data "find" data pencarian 
        $this->db->like('title', $filter);    // untuk mencari data yang mirip dengan kata kunci yang di tulis....mengecek filter sudah di SET apa belum
        $this->db->limit($limit, $offset);    // penambahan untuk panigation
        $this->db->order_by('date', 'desc');  // mengurutkan panigation dari artikel yang paling awal 
        return $this->db->get("blog");
    }


    public function getTotalBlogs()          // nama method, untuk mengambil semua data yang ada di dalam "blog"
    {
        $filter = $this->input->get('find'); // fungsi untuk panigation
        $this->db->like('title', $filter);   // fungsi untuk panigation
        return $this->db->count_all_results("blog"); // fungsi mengembalikan angka jumlah Total artikel 
    }  

    public function getSingleBlog($field, $value) // nama method, untuk mengambil data dari satu data saja yaitu data "url"
    {
        $this->db->where($field, $value);   // $query = $this->db->query('SELECT * FROM blog WHERE url = " '.$url.' " ');             
        return $this->db->get('blog');      // $query = $this->db->query('SELECT * FROM blog WHERE url = " '.$url.' " ');
    }

    public function insertBlog($data)
    {
        $this->db->insert('blog', $data);   // merintah mysqli untuk menyimpan atau menambahkan data ke databases
        return $this->db->insert_id();      // perintah untuk mengaembalikan "id" dari yang terahhir di kirim ke databases
    }  

    public function updateBlog($id, $post)
    {
        $this->db->where('id', $id);
        $this->db->update('blog', $post);
        return $this->db->affected_rows(); // mengembalikan data yang dikirim dengan jumlah 1 data 
    }  

    public function deleteBlog($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('blog');
        return $this->db->affected_rows();   // untuk mengecek ada berapa data yang berhasil di hapus
    }

    
}
 