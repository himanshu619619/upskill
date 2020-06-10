
<div class="container" style=" ">
  <div class="row" style=";">

  

 <div class="col-md-12">
<br>




  
      <section  class="login-registers" >
  <div class="login-box login-sidebar" id="registerss">
    <div class="white-box" style="padding:150px 0px;">


        <?php if ($flashdata = $this->session->flashdata('error')){  ?>
                          <div class="alert alert-danger">
                       <h1>  <?php echo $flashdata;  ?> </h1>
                          </div>
                        <?php } ?>

                          <?php if ($flashdata = $this->session->flashdata('success')){  ?>
                          <div class="alert alert-success">
                         <h1>  <?php echo $flashdata;  ?> </h1>
                          </div>
                        <?php } ?>
                        <a href="<?php echo base_url(''); ?>"> <button class="btn"> Back to Home </button></a>

</div>



  </div>


</section>



      
    </div>



  </div>
</div>
<br>
<br>
