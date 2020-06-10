
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
                                                        <label class="control-label">Voting Title*</label>
                                                        <input type="text" name="vote_name" value="<?php echo set_value('vote_name',$vote_name); ?>" class="form-control" placeholder="Enter Voting Title"> <span class="help-block"> <?php echo form_error('vote_name'); ?> </span> </div>


                                                </div>
                                                <!--/span-->
                                                
                                                <!--/span-->
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
  