</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div id="page-wrapper">
  <div class="container-fluid">
     <div class="row bg-title">
        <!-- .page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        </div>
        <!-- /.breadcrumb -->
     </div>
     <!-- .row -->
   <div class="row">
      <div class="col-md-12">
         <div class="white-box">
            <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <!-- <h3 class="box-title">Vertical Tabs</h3>
                <p class="text-muted m-b-30">Use default tab with class <code>vtabs</code></p> -->
                <div class="">
                    <ul class="nav tabs-vertical">
                        <li class="tab nav-item active text_color">
                            <a data-toggle="tab" class="nav-link" href="#home3" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Profile</span> </a>
                        </li>
                        <li class="tab nav-item">
                            <a data-toggle="tab" class="nav-link" href="#profile3" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Change Password</span> </a>
                        </li>
                        <!-- <li class="tab nav-item">
                            <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#messages3"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Messages</span> </a>
                        </li> -->
                    </ul>
            <div class="tab-content" style="width: 100%;">
              <div id="home3" class="tab-pane active">
               <div class="col-sm-12">
                 <div class="white-box">
                <!-- <h3 class="box-title m-b-0">Default Basic Forms</h3>
                <p class="text-muted m-b-30 font-13"> All bootstrap element classies </p> -->

                 <?php echo form_open('Customers/account_setting');?>
                    <div align="center">
                        <div class="form-group row">
                    <?php if ($user->photo) {?>
                     
                      <a href="" data-toggle="modal" data-target="#myModal"> <img src="<?php echo base_url('uploads/user_photo')?>/<?php echo $user->photo; ?>" style="height: 100px; width: 100px;"></a> 
                      <?php } else { ?>
                         <a href="" data-toggle="modal" data-target="#myModal"> <img src="<?php echo base_url('assets/user');?>/plugins/images/users/d1.jpg"></a> 
                      <?php } ?>
                    </div>
                  </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">First Name</label>
                        <div class="col-10">
                            <input class="form-control" type="text" placeholder="" name="fname" value="<?php echo set_value('fname',$user->fname);?>" id="example-text-input">
                            <?php echo form_error('fname');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-2 col-form-label">Last Name</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="lname" value="<?php echo set_value('lname',$user->lname);?>" id="example-search-input">
                            <?php echo form_error('lname');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">User Name</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="username" value="<?php echo set_value('username',$user->username);?>" id="example-email-input">
                            <?php echo form_error('username');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">E-mail</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="email" value="<?php echo set_value('email',$user->email);?>" id="example-email-input">
                            <?php echo form_error('email');?>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Mobile</label>
                        <div class="col-10">
                            <input class="form-control" type="text" name="mobile" value="<?php echo set_value('mobile',$user->mobile);?>" id="example-email-input">
                            <?php echo form_error('mobile');?>
                        </div>
                    </div>

 <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">DOB</label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="dob" value="<?php echo set_value('dob',$user->dob);?>" id="example-email-input">
                            <?php echo form_error('dob');?>
                        </div>
                    </div>


                  

                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">Full Address</label>
                        <div class="col-10">
                            <input class="form-control" value="<?php echo set_value('address',$user->address);?>"   name="address" type="text"  id="example-password-input">
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                 
                    
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">Country</label>
                        <div class="col-10">
                  <?php echo  form_dropdown('country',$country_option,set_value('country',$user->country),'class = "form-control" onchange="get_state(this.value)"');?>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">State</label>
                        <div class="col-10">
                       
                          <?php echo  form_dropdown('state',$state_option,set_value('state',$user->state),'class = "form-control" onchange="get_city(this.value)"');?>
                        </select>
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label" >City</label>
                        <div class="col-10" >
                          

                    <?php echo form_dropdown('cities',$city_option, set_value('cities',$user->cities), 'class="form-control" id="city_form" ' ); ?>

                          
                        </select>
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">Pin Code</label>
                        <div class="col-2">
                            <input class="form-control" value="<?php echo set_value('pin_code',$user->pin_code);?>"  name="pin_code" type="text"  id="example-password-input">
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                    
               
                    
                    
                   <div class="form-group row">
                     <div class="col-10">
                      <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                      <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </div>
                </div>
                </form>
               
            </div>
        </div>
          <div class="clearfix"></div>
              </div>
                  <div id="profile3" class="tab-pane">
                    <div class="col-sm-12">
                      <div class="white-box">
                  <!-- <h3 class="box-title m-b-0">Default Basic Forms</h3>
                  <p class="text-muted m-b-30 font-13"> All bootstrap element classies </p> -->

                    
                   <div class='text-danger text-center' id="change_error_msg"></div>
                   <div class='text-center' id="change_success_msg"></div>

                   <form action="#" method="post" id="change_password">                         
                    <div class="form-group row">
                          <label for="example-text-input" class="col-2 col-form-label">New Password</label>
                          <div class="col-10">
                              <input class="form-control" type="password" placeholder="" name="new_password" value="" id="example-text-input">
                              <?php echo form_error('new_password');?>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-search-input" class="col-2 col-form-label">Confirm password</label>
                          <div class="col-10">
                              <input class="form-control" type="password" name="confirm_password" value="" id="example-search-input">
                              <?php echo form_error('confirm_password');?>
                          </div>
                      </div>
                                                  
                     <div class="form-group row">
                       <div class="col-10">
                        <button type="submit"  class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        
                      </div>
                  </div>
                  </form>
                
              </div>
          </div>
          </div>
                                    
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
                 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Profile</h4>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('Customers/photo_upload');?>
         
           <div class="form-group row">
           <input type="file" name="photo" id="doc_frofile">
          </div>
          <div class="form-group row">
           <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
          </div>
        </form>
        </div>
    </div>
</div>
</div>
        
               <!-- .row -->
               <!-- .right-sidebar -->
              
               <!-- /.right-sidebar -->
            </div>

<script type="text/javascript">
    
    $('form#change_password').submit(function(e) {

    var form = $(this);

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Customers/change_password'); ?>",
        data: form.serialize(), // <--- THIS IS THE CHANGE
        dataType: "html",
        success: function(data){
          //alert(data);  
          if (data !="") {
             $('#change_error_msg').html(data);
          }
          else
          {

            $('#change_success_msg').html('password change successfully');
          }
           
        },
        error: function() {  $('#change_success_msg').html("password change successfully"); }
   });

});



    function get_state(country_id){
      //alert(country_id);
      var country_id = country_id;
      //alert(country_id);
     $.ajax({

             type  : 'post',
             url  : "<?php echo  base_url('Customers/get_states');?>",
             data : {country_id:country_id},
             success : function(data){
                // alert(data);
              $('#state_form').html(data);  
             }
         })
    }

    function get_city(state_id){

      var state_id = state_id;
       //alert(state_id);
      $.ajax({

             type  : 'post',
             url  : "<?php echo  base_url('Customers/get_cities');?>",
             data : {state_id:state_id},
             success : function(data){
                // alert(data);
              $('#city_form').html(data);  
             }
         })
    }


</script>


