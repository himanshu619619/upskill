<div class="main">
        <div class="main-inner">
            <div class="content">
<div id="page-wrapper">
            <div class="container-fluid">
               <div class="row bg-title">
                  <!-- .page title -->
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                     
                  </div>
                  <!-- /.page title -->
                  <!-- .breadcrumb -->
                  
                  <!-- /.breadcrumb -->
               </div>
               <!-- .row -->
               
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                       
                        <div class="white-box">
                       <center>
                       <h2><?php echo $medicine_detail->medicine_name; ?></h2>
                            <div class="box-body box-profile"> 
                            <?php if ($medicine_detail->medicine_photo) {?>
                              <img alt="user" src="<?php echo $medicine_detail->medicine_photo;?>" class="profile-user-img img-responsive img-circle" style="height: 200px; width: 200px; margin:10px; " >
 <?php  } else{ ?>
                              <img alt="user" src="<?php echo $medicine_detail->medicine_photo;?>" class="profile-user-img img-responsive img-circle" style="height: 200px; width: 200px; margin:10px; " >
                        
                      <?php  }  ?>
                           </div>
                           </center>
                            
                            <div class="user-btm-box">
                                <!-- .row -->
                                <!-- <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Name</strong>
                                        <p><?php echo @$sub_cat->med_name;?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Phone</strong>
                                        <p><?php echo @$clinic_profile->clinic_address; ?></p>
                                    </div>
                                </div>  -->
                                <!-- /.row -->
                                <hr>
                               
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <div class="white-box">
                          <?php echo form_open('Doctor/requesttojoin'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center">Medicine Detail</h3>
                                 <div class="table-responsive">
                                  <table class="table">
                                   
                                    <tbody>
                                        <tr>
                                            <th>Medicine Name</th>
                                            <td><?php echo $medicine_detail->medicine_name; ?></td>
                                           
                                        </tr>
                                       <!-- <tr>
                                            <th>Apointment Date</th>
                                            <td><?php echo $clinic_profile->appointment_date; ?></td>
                                           
                                        </tr> -->


                                          <tr>
                                            <th>Company Name</th>
                                            <td><?php echo $medicine_detail->company_name; ?></td>
                                           
                                        </tr>

                                          <tr>
                                            <th>Composition</th>
                                            <td><?php echo $medicine_detail->salt; ?></td>
                                           
                                        </tr>

                                         
                                         

                                      </tbody>
                                    </table>
<br>
                                    <div class="product_desc"><center><h1 class="main-title">Drug Information<i class="fa"></i></h1></center><div id="prod_desc"><p><?php echo $medicine_detail->description; ?></p></div></div>
                                 </div>  
                                </div>
                              
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               <!-- .row -->
               
            </div>     </div></div>     </div>     </div>