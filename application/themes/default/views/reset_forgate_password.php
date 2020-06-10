<!doctypehtml>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<link rel="stylesheet" type="text/css" href=" <?php echo base_url('assets');?>/css/login_style.css">

<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
    
input[type=text]:focus{
    background-color:#f77986;
    color: white;
    
    font-size: 15px;

}
input[type=password]:focus{

    background-color: #f77986;
    color: white;
}

.error
{
    color: red;
}
</style>


</head>

<body style="background-image:url(<?php echo base_url('assets');?>/images/red_in_abstract-wide.jpg);">

       <!--forms-->
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <div class="space-medium">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">   </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:55px;background-color: white;">
                    <div class="account-holder" style="padding: 30px;">
                         <!--login-form-->
                        <?php if ($this->session->flashdata('error')) {?>
                           <div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong><?php echo $this->session->flashdata('error'); ?></strong> 
                        </div>
                    <?php } ?>
                         

                        <h3>Login to Account</h3>
                        <br>
                        
                        <div class="row">
                           <?php echo form_open($form_action); ?>
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label required" for="email">Email<sup style="color:red">*</sup></label>
                                        <input id="email" name="email" type="text" class="form-control" placeholder="Enter Email Address">
                                        <?php echo form_error('email');?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label required" for="email">Password<sup style="color:red">*</sup></label>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="password">
                                        <?php echo form_error('password');?>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#myModal" class="forgot-password">Forgot Password?</a>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                   <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                           
                                            <p>Remember Me?</p>
                                             </label>
                                        
                                    </div>
                                    <div>
                                        <p class="pull-right"> Don't Have A Account? <a href="<?php echo base_url($register); ?>">signup</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 <!--/.login-form-->
                      <!--sing-up-form-->
              
                 
        </div>
                   
            </div>
        </div>
    </div>
       <!--/.forms-->

   </body>
   </html>



   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgate Password</h4>
          <h2 id="forgete_msg"></h2>
        </div>
        <div class="modal-body" id="forgete_pass">
          <form action="" method="post" id="forgate_password">
          <div class="form-group">
            <label class="control-label required" for="email">Email<sup style="color:red">*</sup></label>
            <input id="email" name="email" type="email" class="form-control" placeholder="Enter Email Address">
            
        </div>
        </div>
        <div class="modal-footer" id="forgete_pass">
          <button type="submit" class="btn btn-info">Save</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>

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