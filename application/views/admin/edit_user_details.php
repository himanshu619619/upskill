
<style type="text/css">


    .error{color:red;}
    #modal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0%;
    left: 0%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    height: 100%;
    width: 100%;}
    .modalconent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 37%;
    padding: 20px;
    
}
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .modalconent {
    position: absolute;
    top: 37%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 88%;
    padding: 20px;}
}

</style>






<div id="page-wrapper">
            <div class="container-fluid">
               <div class="row bg-title">
                  <!-- .page title -->
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                     <h4 class="page-title"><?php echo $page_title; ?></h4>
                  </div>
                  <!-- /.page title -->
                 
               </div>
              <!-- .row -->

 <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                         <?php if ($flashdata = $this->session->flashdata('success')){  ?>
                          <div class="alert alert-success">
                           <?php echo $flashdata;  ?>
                          </div>
                        <?php } ?>


                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   <?php echo form_open_multipart($form_action) ?>
                                       <div class="form-body">
                                            <h3 class="box-title">Fill All Details</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">First NAme*</label>
                                                        <input type="text" name="fname" value="<?php echo set_value('fname',$fname); ?>" class="form-control" placeholder="Enter Code"> <span class="help-block"> <?php echo form_error('fname'); ?> </span> </div>


                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Last Name*</label>
                                                        <input type="text" name="lname"  
                                                        value="<?php echo set_value('lname',$lname); ?>" class="form-control" placeholder="Enter Name"> <span class="help-block">  <?php echo form_error('lname'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                         <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">username*</label>
                                                        <input type="text" name="username"class="form-control" placeholder="Enter Address" value="<?php echo set_value('username',$username); ?>"> <span class="help-block">  <?php echo form_error('username'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">dob*</label>
                                                        <input type="text" name="dob"  class="form-control" value="<?php echo set_value('dob',$dob); ?>" placeholder="Enter City"> <span class="help-block">  <?php echo form_error('dob'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                       
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">mobile*</label>
                                                        <input type="text" name="mobile" class="form-control" placeholder="Enter Pin Code" value="<?php echo set_value('mobile',$mobile) ?>"> <span class="help-block">  <?php echo form_error('mobile'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">email*</label>
                                                        <input type="email" name="email"  class="form-control" placeholder="Enter email" value="<?php echo set_value('email',$email) ?>"> <span class="help-block">  <?php echo form_error('email'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>




<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">address</label>
                                                        <input type="text" name="address"class="form-control" placeholder="Enter address" value="<?php echo set_value('address',$address); ?>"> <span class="help-block">  <?php echo form_error('address'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">country</label>
                                                        <input type="text" name="country"  class="form-control" placeholder="Enter country" value="<?php echo set_value('country',$country); ?>" readonly > <span class="help-block">  <?php echo form_error('brand'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">cities</label>
                                                        <input type="text" name="cities" class="form-control" placeholder="city" value="<?php echo set_value('cities',$cities) ?>" readonly> <span class="help-block">  <?php echo form_error('cities'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">pin code</label>
                                                        <input type="text" name="pin_code"  class="form-control" placeholder="pin_code" value="<?php echo set_value('pin_code',$pin_code) ?>"> <span class="help-block">  <?php echo form_error('pin_code'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">state</label>
                                                        <input type="text" name="state" class="form-control" placeholder="state" value="<?php echo set_value('state',$state) ?>" readonly> <span class="help-block">  <?php echo form_error('state'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                             
                                                <!--/span-->
                                            </div>
                                            

                                      
                                        

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <!-- /.row -->
               
            </div>

        </div>
  