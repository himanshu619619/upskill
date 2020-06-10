<div id="page-wrapper">
            <div class="container-fluid">
               <div class="row bg-title">
                  <!-- .page title -->
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                     <h4 class="page-title"><?php echo $page_title; ?></h4>
                  </div>
                  <!-- /.page title -->
                  <!-- .breadcrumb -->
                  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                     
          <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active"><?php echo $page_title; ?></li>
                     </ol>
                  </div>
                  <!-- /.breadcrumb -->
               </div>
               <!-- .row -->
               <div class="row">
                  
                     <div class="white-box">
                        <?php echo form_open('Doctor/doctor_working_schedule');?>
                       
                        <div class="white-box">
                            <div class="col-md-12">
                              <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 control-label col-form-label">Enter Day Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="days[]" class="form-control" id="inputEmail3" placeholder="Day Name">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 control-label col-form-label">From Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" name="form_time[]" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 control-label col-form-label">To Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" name="to_time[]" class="form-control" id="inputEmail3" placeholder="Website">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group row">
                                    <a class="btn btn-primary" onclick="education_fields();"><i class="fa fa-plus"></i>&nbsp; Add New Day</a>
                                </div>
                                </div>
                               </div>


                               <div id="education_fields"></div>

                               <button class="btn btn-primary">
                                 submit
                               </button>
                            </form> 
                        </div>
                     
                          

                    </form>
                
                                         
                        
                     </div>
                  </div>
               </div>
               <!-- .row -->
               <!-- .right-sidebar -->
              
               <!-- /.right-sidebar -->
            </div>



  <script type="text/javascript"> 
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-md-12"> <div class="col-md-3"> <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 control-label col-form-label">Enter Day Name</label> <div class="col-sm-9"> <input type="text" name="days[]" class="form-control" id="inputEmail3" placeholder="Day Name"> </div> </div> </div> <div class="col-md-3"> <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 control-label col-form-label">From Time</label> <div class="col-sm-9"> <input type="time" class="form-control" id="inputEmail3" placeholder="Email" name="form_time[]"> </div> </div> </div> <div class="col-md-3"> <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 control-label col-form-label">To Time</label> <div class="col-sm-9"> <input type="time" class="form-control" id="inputEmail3" placeholder="Website" name="to_time[]"> </div> </div> </div> <div class="col-md-3"> <div class="form-group row"> <a class="btn btn-danger" onclick="remove_education_fields('+room+');"><i class="fa fa-minus"></i>&nbsp; Remove Day</a> </div> </div> </div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {

   
     $('.removeclass'+rid).remove();
   }



  </script>