
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
                  
                    <div class="col-md-4 col-xs-12">
                   
                        <div class="white-box">
                           
                            <div class="user-bg text-center" style="display: flex; justify-content:center; align-items:center; "> <img width="100%" height=" alt="user" src="<?php echo base_url('uploads/user_photo')?>/<?php echo $view_user_details->photo ? $view_user_details->photo : '/service.png'; ?>"  > </div><br>
                            <center><h4 class="center"><strong><?php echo $view_user_details->fname; ?></strong></h4> </center> 
                            <div class="user-btm-box">
                                <!-- .row -->
                              
                            
                                <!-- /.row -->
                               
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-4 col-xs-6 b-r"> <strong>First Name</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->fname; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong> Last Name </strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->lname; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong>USername</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->username; ?></p>
                                </div>
                                
                            </div>

 <hr>
                              <div class="row">
                                <div class="col-md-4 col-xs-6 b-r"> <strong>Date of Birth</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->dob; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong> Mobile</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->mobile; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->email; ?></p>
                                </div>
                                
                            </div>


                      
                            <hr>

                           
                         
                           <div class="row">
                                <div class="col-md-8 col-xs-6 b-r"> <strong>Address</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->address; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong> Country</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $country_option[$view_user_details->country]; ?></p>
                                </div>
                               
                                
                            </div>
<hr>
                               <div class="row">
                                <div class="col-md-4 col-xs-6 b-r"> <strong>City</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $city_option[$view_user_details->cities]; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong> pin Code</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $view_user_details->pin_code; ?></p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"> <strong>State</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $state_option[$view_user_details->state]; ?></p>
                                </div>
                                
                            </div>
                           
                           
                          

                            </div>
                           <hr>
                            
                           
                           
                            
                            
                           
                           
                          
                           




                           
                        
                        </div>
                    </div>
                </div>



                            </div>
                        </div>
                  
              
                <!-- /.row -->
               
          