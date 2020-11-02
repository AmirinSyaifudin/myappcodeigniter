<?php $this->load->view('partials/header'); ?>
 
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/home-bg.jpg')">

<!-- <header class="masthead" style="background-image: url('<?php echo base_url(); ?>assets/img/home-bg.jpg')"> -->
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Models View Controller</h1>
            <span class="subheading">MVC Pancen Oiiyeeaachhh Kwik...Kwik...Kwik</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

      <?php echo $this->session->flashdata('message'); ?> <!-- pemanggilan session di controller "Blog" -->

        <form>
            <input type="text" name="find">
            <button type="submit">Cari</button>
        </form>

          <?php foreach ($blogs as $key => $blog): ?> <!-- array,,,untuk menampilkan artikel satu per satu   -->

        <div class="post-preview">
          <a href="<?php echo site_url('blog/detail/'. $blog['url']); ?> ">  <!-- di dunakan untuk menampilakan data "data detail dari artikel"  -->
            <h2 class="post-title">
             <?php echo $blog['title']; ?> <!-- di gunakan untuk menampilkan judul artikel  -->
            </h2>
            
            <!-- <h3 class="post-subtitle">
              Problems look mighty small from 150 miles up
            </h3> -->
          </a>
            <p class="post-meta">
                Posted on <?php echo $blog['date'];  ?> <!-- untuk membuat tanggal di artikel  -->
              
            <?php if(isset($_SESSION['username'])): ?> <!--  apabila username di set, session akan aktif untuk menampilakn form "Edit" dan form "Delete"  -->

              <a href="<?php echo site_url('blog/edit/'. $blog['id']); ?>">Edit</a>
              <a href="<?php echo site_url('blog/delete/'. $blog['id']); ?>" onclick="return confirm('Yakin Mau di Hapus, Seriuss achhh ,,,')">Delete</a>  <!-- berfungsi untuk penambahan java scrip untuk pesan penghapusan   -->
            
            <?php endif; ?> <!-- penutup session -->

            </p>
          <?php echo $blog['content']; ?> <!-- untuk menambahkan conten di sis artikel -->

        </div>
        <hr>

      <?php endforeach;  ?>

      <?php echo $this->pagination->create_links(); ?>
      
      </div>
    </div>
  </div>

  <hr>

 

  <?php $this->load->view('partials/footer'); ?>