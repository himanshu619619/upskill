

<!-- main body start -->
<div id="fixit_main_content">

  <!-- page title start -->
  <div class="fixit_page_title gradian-background">
    <div class="fixit_page_title_inner">
      <h3>Login </h3>
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Login </li>
      </ul>
    </div>
  </div>
  <!-- page title end -->
  
  <!-- project detail start -->
  <div class="fixit_section">
    <div class="container">
      <div class="row">

        <!-- Top content -->
            <div class="top-content">
              
                <div class="inner-bg">
                    <div class="container">
                        <div class="row">
                         <?php if ($flashdata = $this->session->flashdata('error')) { ?> 
                          <div class="alert alert-success">
                           <?php echo $flashdata;  ?>
                          </div>
                        <?php } ?>
                           <div class="col-sm-3">
                           </div> 


                            <div class="col-sm-6">
                              
                              <div class="form-box">
                                <div class="form-top">
                                  <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                      <p>Enter username and password to log on:</p>
                                  </div>
                                  <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                  </div>
                                  </div>
                                  <div class="form-bottom">
                                 <?php echo form_open($form_action); ?>
                                  <div class="form-group">
                                    <label class="sr-only" for="form-username">Username</label>
                                      <input type="text" name="username" placeholder="Username or E-mail...." class="form-username form-control" id="form-username">
                                       <div class="error">
                <?php echo form_error('username');?>
            </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="sr-only" for="form-password">Password</label>
                                      <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                </form>
                              </div>
                            </div>
                        
                          <div class="social-login">
                                <h3>...or login with:</h3>
                                <div class="social-login-buttons">
                                  <a class="btn btn-link-1 btn-link-1-facebook" href="<?php echo base_url('Google_authentication'); ?>">
                                    <i class="fa fa-facebook"></i> Facebook
                                  </a>
                                <!--   <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                  </a> -->
                                  <a class="btn btn-link-1 btn-link-1-google-plus" href="<?php echo base_url('user_authentication'); ?>">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                  </a>
                                </div>
                              </div>
                              
                            </div>
                            <div class="col-sm-3">
              </div>   
                          


                        </div>
                        
                    </div>
                </div>
                
            </div>

      </div>
    </div>
  </div>
  <!-- project detail end --> 
</div>
<!-- main body end -->

 <script type="text/javascript">
    
    $('form#forgate_password').submit(function(e) {
   
    var form = $(this);

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Frontend/forgate_password'); ?>",
        data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "html",
        success: function(data){
          alert(data);
            if(data==1){
              
              $('#forgete_pass').hide();
              $('#forgete_msg').html("Pleas Check your emailid");

            }else{
              $('#forgete_msg').html("Email doesn't Exist");
            }
            //$('#feed-container').prepend(data);
        },
        error: function() { alert("Error posting feed."); }
   });

});
  </script>