

<!-- main body start -->
<div id="fixit_main_content">

  <!-- page title start -->
  <div class="fixit_page_title gradian-background">
    <div class="fixit_page_title_inner">
      <h3>Register </h3>
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Register </li>
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

 <div class="col-sm-3">
 </div> 


                        
                                    
                                <div class="col-sm-6">
                                    
                                    <div class="form-box">
                                        <div class="form-top">
                                            <div class="form-top-left">
                                                <h3>Sign up now</h3>
                                                <p>Fill in the form below to get instant access:</p>
                                            </div>
                                            <div class="form-top-right">
                                                <i class="fa fa-pencil"></i>

                                            </div>
                                        </div>

                                        <div class="form-bottom">
                                            <?php echo $this->session->flashdata('error'); ?>
                                             <?php echo form_open($form_action); ?>

                                             <div class="form-group">
                                                  <?php echo form_dropdown('user_type',$user_option,set_value('user_type'),'class="form-control"'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="form-first-name">First Name</label>
                                                    <input type="text" name="fname" placeholder="First Name" class="form-first-name form-control" id="form-first-name">
                                                     <div class="error">
                                                                <?php echo form_error('fname');?>
                                                     </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="sr-only" for="form-first-name">Last Name</label>
                                                    <input type="text" name="lname" placeholder="Last Name" class="form-first-name form-control" id="form-first-name">
                                                     <div class="error">
                                                                <?php echo form_error('lname');?>
                                                     </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="form-last-name">Username</label>
                                                    <input type="text" name="username" placeholder="Username" class="form-last-name form-control" id="form-last-name" required="required">
                                                     <div class="error">
                                                        <?php echo form_error('username');?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="form-email">Email</label>
                                                    <input type="text" name="email" placeholder="Your Email ID" class="form-email form-control" id="form-email" required="required">
                                                     <div class="error">
                                                                <?php echo form_error('email');?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="form-email">Password</label>
                                                    <input type="password" name="password" placeholder="Password" class="form-email form-control" id="form-email" required="required">
                                                     <div class="error">
                                                            <?php echo form_error('passowrd');?>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="form-email">Confirm Password</label>
                                                    <input type="password" name="cpassword" placeholder="Confirm Password" class="form-email form-control" id="form-email" required="required">
                                                    <div class="error">
                                                        <?php echo form_error('cpassowrd');?>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn">Sign me up!</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>

<iv class="col-sm-3">
 </div> 
                        
                          <div class="social-login">
                                <h3>...or login with:</h3>
                                <div class="social-login-buttons">
                                  <a class="btn btn-link-1 btn-link-1-facebook" href="<?php echo base_url('Google_authentication'); ?>">
                                    <i class="fa fa-facebook"></i> Facebook
                                  </a>
                               <!--    <a class="btn btn-link-1 btn-link-1-twitter" href="#">
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