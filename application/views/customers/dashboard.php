






<div id="page-wrapper">
            <div class="container-fluid">
               <div class="row bg-title">
                  <!-- .page title -->
                  <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                     <h4 class="page-title" style=" color:red;"><marquee>Sanjay Gupta Toppers Institute, Online Classes, No.1 institute in Delhi NCR.</marquee></h4>
                  </div>
                  <!-- /.page title -->
                 
               </div>
              <!-- .row -->
                <div>
     <img src="<?php echo base_url('assets/theme');?>/images/<?php echo $banner->banner_name; ?>" class="img-responsive" style="filter: border: 2px solid rgba(0,0,0,0.1);">
   </div>

                        <div class="video-section">
                       

                        <div id="swap-video" class="swap-video-left1">
                            <div id="media">
                              
                                <iframe id="" src="https://webcastlive.co.in/player/play_sc.php?event_id=demo_purplewave002" width="100%" height="300px" marginheight="0" frameborder="0" scrolling="no"  allowfullscreen="allowfullscreen"></iframe>
                            </div>
                        </div>
                    </div>

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
                                            <h3 class="box-title">Have a query? Fill in details below</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" name="name"class="form-control" placeholder="Enter Name"> <span class="help-block"> <?php echo form_error('name'); ?> </span> </div>


                                                </div>
                                                <!--/span-->
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="control-label">Massage*</label>
                                                        <textarea name="message" rows="4" class="form-control" placeholder="Enter Message"></textarea> 

                                                        <?php echo form_error('message'); ?></span> </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                        

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                            
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
  