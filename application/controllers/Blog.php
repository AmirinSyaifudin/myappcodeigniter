<?php 

class Blog extends CI_Controller {
        public function __construct()    // perintah untuk mengupload databases jadi satu perintah 
        {
                parent:: __construct();                
                // $this->load->database(); // di pindahkan di config, autoload , [library] = array (databases);
               //  $this->load->helper('url'); // sudah di daftarkan di folder config, autoload, helper array('url','form')
                // $this->load->helper('form'); // hanya bisa di guanakn di controller "Blog saja" ,,,,menggunakan form helper, sekali di load bisa menggunakan semua fungsi di controller
                $this->load->model('Blog_model');
                $this->load->library('session'); // pemanggilan session di load controller
        } 

        public function index($offset = 0) // "0" data paling awal yang di ambil,,      //nama method untuk menangkap data dari URL panigation 
        {
                $this->load->library('pagination');

                $config['base_url'] = site_url('blog/index'); // halaman untuk pagination 
                $config['total_rows'] = $this->Blog_model->getTotalBlogs();  // angka untuk jumlah pagination
                $config['per_page'] = 3;
                $this->pagination->initialize($config);

       $query = $this->Blog_model->getBlogs( $config['per_page'], $offset);   // $query = $this->db->query("SELECT * FROM blog");
       $data['blogs'] = $query->result_array();  // result_array => mengambil beberapa baris 
    
        $this->load->view('blog', $data);
        } 

        public function detail($url)    // nama method
        {
               $query = $this->Blog_model->getSingleBlog('url',$url);
                $data['blog'] = $query->row_array();  // mengambil satu baris dari database "url"      
                $this->load->view('detail', $data);
        }

        public function add()
        {
                $this->form_validation->set_rules('title','Judul','required');  // menggunakan library form validasion,, untuk mengecek data sudah di isi atau belum
                $this->form_validation->set_rules('url','URL','required|alpha_dash'); // menggunakan alpha dash untuk url , sek di situs
                $this->form_validation->set_rules('content','Content','required');
                               
                 if($this->form_validation->run() === TRUE){    // untuk mengecek data ,,jika TRUEE di simpan dan jika false tidak ti simpan  
                        $data['title'] = $this->input->post('title');
                        $data['content'] = $this->input->post('content');
                        $data['url'] = $this->input->post('url');
                
                        $config['upload_path']          = './uploads/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 100;
                        $config['max_width']            = 1024 ;
                        $config['max_height']           = 768;

                        $this->load->library('upload', $config);

                        if ( ! $this->upload->do_upload('cover')) // untuk menangkap file yang telah di upload
                        {
                                echo $this->upload->display_errors();       
                        }
                        else
                        {
                                $data['cover'] = $this->upload->data()['file_name'];     
                        }

                        
                        $id = $this->Blog_model->insertBlog($data); // merintah mysqli untuk menyimpan atau menambahkan data ke databases
                
                        if($id) {
                                $this->session->set_flashdata("message",'<div class="alert alert-success">Data berhasil di simpan</div>'); // penggunakan session ,,, emanmbahkan pesan dengan flas data 
                                redirect('/'); // jikan data berhasil di simpan maka akan kembali di halaman home
                        }
                                else {
                                $this->session->set_flashdata("message",'<div class="alert alert-success">Data gagal di simpan</div>'); // untuk mengbungkus pesan berhasil atau error
                                redirect('/');
                                }
                        }     
                         $this->load->view('form_add'); 
        }


        public function edit($id)
        {
                $query = $this->Blog_model->getSingleBlog('id', $id);
                $data['blog'] = $query->row_array(); // query untuk menyimpan data edit

                $this->form_validation->set_rules('title','Judul','required');
                $this->form_validation->set_rules('url','URL','required|alpha_dash');
                $this->form_validation->set_rules('content','Konten','required');

                        $post['title'] = $this->input->post('title');
                        $post['content'] = $this->input->post('content');
                        $post['url'] = $this->input->post('url|alpha_dash');
                        
                if($this->form_validation->run() === TRUE){
                        $config['upload_path']          = './uploads/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 100;
                        $config['max_width']            = 1024 ;
                        $config['max_height']           = 768;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('cover'); // kode untuk memperbaiki kode upload pertemuan ke 5
                              
                             if (!empty($this->upload->data()['file_name']))  {         // digunakan untuk mengupload foto kalo tidak ada foto yang di upload sistem tetap kosong dan tidak eror
                               $post[ 'cover'] = $this->upload->data()['file_name'];     
                         } 
                        $id = $this->Blog_model->updateBlog($id, $post); // merintah mysqli untuk menyimpan atau menambahkan data ke databases
                        if($id) {
                                $this->session->set_flashdata("message",'<div class="alert alert-success">Data berhasil di simpan</div>'); // penggunakan session ,,, emanmbahkan pesan dengan flas data 
                                redirect('/'); // jikan data berhasil di simpan maka akan kembali di halaman home
                        }
                                else {
                                $this->session->set_flashdata("message",'<div class="alert alert-success">Data gagal di simpan</div>'); // untuk mengbungkus pesan berhasil atau error
                                redirect('/');
                                }
                        }
                $this->load->view('form_edit', $data);
        }
         
        public function delete($id)
        {
                $result = $this->Blog_model->deleteBlog($id);
                if($result)
                $this->session->set_flashdata("message",'<div class="alert alert-success">Data berhasil di Hapus</div>'); // penggunakan session ,,, emanmbahkan pesan dengan flas data 
        else 
                $this->session->set_flashdata("message",'<div class="alert alert-success">Data gagal di Hapus</div>'); // penggunakan session ,,, emanmbahkan pesan dengan flas data 
                redirect('/'); // untuk mengembalikan ke halaman yang habis di delete atau 
        }



        public function login()
        {
        
        if($this->input->post()) { // apabila ada data baru di proses ke sistem 

       
                $username = $this->input->post('username'); // login sistem statis, tidak menambahkan database, karna tidak lebih dari satu 
                $password = $this->input->post('password');

                if ($username == 'admin' && $password == 'admin')
                        {
                                $_SESSION['username'] = 'amirganteng21';

                                redirect('/'); // kembali ke halaman home
                        }
                        else {
                        $this->session->set_flashdata('message', '<div class="alert alert-warning">Username/Password tidak Valid.</div>');     

                                redirect('blog/login'); // session kembali ke halaman login 
                        }
        }
           $this->load->view('login');     
        }



        public function logout()
        {
                $this->session->sess_destroy();
                redirect('/'); // kembali ke halaman home 
        }


}   