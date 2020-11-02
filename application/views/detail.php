<?php $this->load->view('partials/header'); ?>

 <!-- Page Header -->
 <?php 
    if(empty($blog['cover']))   // untuk mengecek gambar defaul atau tidak
    $cover = base_url().'assets/img/post-bg.jpg'; // file default bila cover tidak ada di databases
    else 
    $cover = base_url().'uploads/'. $blog['cover'];
 ?>
  <header class="masthead" style="background-image: url('<?php echo $cover;?>')">  <!-- untuk mengupload file gambar di sistem -->
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
          <h1> <?php echo $blog['title'];  ?> </h1> <!-- untuk mengupload artikel ke sistem detail -->
           <!-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> -->
            <span class="meta">Posted on <?php echo $blog['date']; ?></span> <!-- untuk mengupload tanggal di footer sistem -->
          </div>
        </div>
      </div> 
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
        <?php echo $blog['content']; ?> <!-- untuk mengupload artikel ke sistem  --> 
       
    </div>
      </div>
    </div>
  </article>
  <hr>


<?php $this->load->view('partials/footer'); ?>