<?php $this->load->view('partials/header'); ?> <!-- untuk membuat header di sistem -->

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>Tambah Artikel Baru</h1>
    
          </div>
        </div>
      </div>
    </div>
  </header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

    <h1>Tambah Artikel</h1>

    <div class="alert alert-warning">
    <?php echo validation_errors(); ?> <!-- fungsi untuk memunculkan pesan error jika data tidak di isi  -->
    </div>

    <?php echo form_open_multipart(); ?>  <!-- sama penulisan  <form method="POST"> -->

            <div class="form-group">
                <label>Judul</label>
                <?php echo form_input('title', set_value('title'), 'class="form-control"'); ?>   <!--  penulisan yang sama <input class="form-control" type="text" name="title"> -->   
            </div>

            <div class="form-group">        
                <label>Url</label>
                <?php echo form_input('url', set_value('url'), 'class="form-control"'); ?>   <!-- catatan "null adalah value"  <input class="form-control" type="text" name="url"> -->
            </div>

            <div class="form-group">        
                <label>Konten</label>
                <?php echo form_textarea('content', set_value('content'), 'class="form-control"'); ?>    <!--   <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea> -->
            </div>

            <div class="form-group">        
                <label>Cover</label>
                <?php echo form_upload('cover', set_value('cover'), 'class="form-control"'); ?>    <!--   <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea> -->
            </div>

            <button class="btn btn-primary" type="submit">Simpan Artikel</button>
       
        </form>
        </div>
</div>
</div>

<?php $this->load->view('partials/footer'); ?> <!-- untuk membuat foooter di sistem -->