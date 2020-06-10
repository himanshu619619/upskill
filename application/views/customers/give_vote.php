






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
                                  <?php if(@$completed_status->completed_status == 1) { ?>

                                   <center> <h2> You have already give a Voting!  </h2> </center>

<?php }else{ ?>
                                   <?php echo form_open_multipart($form_action) ?>
                                       <div class="form-body">
                                            <h3 class="box-title">Fill All MCQ Question</h3>
                                            <hr>
                                           
                                             <?php foreach ($all_questions as $value) {?>

                                                 <div class="row">
                                                <div class="col-md-12">
                                                   <h3>  <?php echo $value->question_name; ?></h3>
                                                </div>
                                           
                                            </div>


                                            <div class="row" style="margin-bottom: 10px;">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                      
                                                        <input type="radio" name="<?php echo $value->question_id; ?>"  value="<?php echo $value->option1; ?>" > 
                                                          <label class="control-label"><?php echo $value->option1; ?></label>
                                                      </div>


                                                </div>
                                                <!--/span-->
                                                <div class="col-md-3">
                                                      <div class="form-group ">
                                                         <input type="radio" name="<?php echo $value->question_id; ?>" value="<?php echo $value->option2; ?>"  > 
                                                          <label class="control-label"><?php echo $value->option2; ?></label>
                                                      </div>
                                                </div>
                                                <!--/span-->


                                                   <div class="col-md-3">
                                                    <div class="form-group">
                                                      
                                                        <input type="radio" name="<?php echo $value->question_id; ?>"  value="<?php echo $value->option3; ?>" > 
                                                          <label class="control-label"><?php echo $value->option3; ?></label>
                                                      </div>


                                                </div>
                                                <!--/span-->
                                                <div class="col-md-3">
                                                      <div class="form-group ">
                                                         <input type="radio" name="<?php echo $value->question_id; ?>" value="<?php echo $value->option4; ?>"  > 
                                                          <label class="control-label"><?php echo $value->option4; ?></label>
                                                      </div>
                                                </div>


                                            </div>


                                              
                                             
                                                <!--/span-->
                                           
                                        <?php }?>

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                            
                                        </div>
                                    </form>
                                      <?php } ?>
                                </div>
                            </div>

                        
                        </div>
                    </div>
                </div>
              
                <!-- /.row -->
               
            </div>

        </div>
  