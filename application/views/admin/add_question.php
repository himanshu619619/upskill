
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Question*</label>
                                                        <input type="text" name="question_name" value="<?php echo set_value('question_name',$question_name); ?>" class="form-control" placeholder="Enter question"> <span class="help-block"> <?php echo form_error('question_name'); ?> </span> </div>

                                                          <input type="hidden" name="vote_id" value="<?php echo @$vote_id; ?>">
                                                </div>
                                                <!--/span-->
                                                
                                                <!--/span-->
                                            </div>



                                         <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Option 1</label>
                                                        <input type="text" name="option1" id="option1" oninput="myFunction()" value="<?php echo set_value('option1',$option1); ?>" class="form-control" placeholder="Enter option 1"> Is it right Answer? &nbsp;<input type="radio" id="option1n" name="result[]" <?php echo $result == $option1 ? 'checked' : ''; ?>  value="<?php echo set_value('option1',$option1); ?>"><span class="help-block"> <?php echo form_error('option1'); ?> </span>  </div>

                                                </div>
                                                      
                                                        <div class="col-md-6">
                                                         <div class="form-group">
                                                        <label class="control-label">option 2</label>
                                                        <input type="text" name="option2" id="option2" oninput="myFunction2()" value="<?php echo set_value('option2',$option2); ?>" class="form-control" placeholder="Enter option 2">  Is it right Answer?&nbsp;<input type="radio" id="option2n"  <?php echo $result == $option2 ? 'checked' : ''; ?> name="result[]" value="<?php echo set_value('option2',$option2); ?> "><span class="help-block"> <?php echo form_error('option2'); ?> </span>  </div>
                                                      
                                                        </div>


                                                </div>


                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">option 3</label>
                                                        <input type="text" name="option3"  id="option3" oninput="myFunction3()" value="<?php echo set_value('option3',$option3); ?>" class="form-control" placeholder="Enter option 3">  Is it right Answer?&nbsp; <input type="radio" id="option3n" <?php echo $result == $option3 ? 'checked' : ''; ?> name="result[]" value="<?php echo set_value('option3',$option3); ?> "><span class="help-block"> <?php echo form_error('option3'); ?> </span>  </div></div>
                                                     
                                                        <div class="col-md-6">
                                                         <div class="form-group">
                                                        <label class="control-label">option 4</label>
                                                        <input type="text" name="option4" id="option4" oninput="myFunction4()" value="<?php echo set_value('option4',$option4); ?>" class="form-control" placeholder="Enter option 4"> Is it right Answer? &nbsp;<input type="radio" id="option4n" <?php echo $result == $option4 ? 'checked' : ''; ?> name="result[]" value="<?php echo set_value('option4',$option4); ?> "> <span class="help-block"> <?php echo form_error('option4'); ?> </span>  </div>
                                                     
                                                        </div>


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
  
  <script>
      function myFunction() {
            var inputVal = document.getElementById("option1").value;
           document.getElementById("option1n").value = inputVal;

           }
               function myFunction2() {
            var inputVal = document.getElementById("option2").value;
           document.getElementById("option2n").value = inputVal;

           }
               function myFunction3() {
            var inputVal = document.getElementById("option3").value;
           document.getElementById("option3n").value = inputVal;

           }
               function myFunction4() {
            var inputVal = document.getElementById("option4").value;
           document.getElementById("option4n").value = inputVal;

           }
    </script>