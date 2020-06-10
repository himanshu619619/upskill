
<div class="container" style=" ">
  <div class="row" style=";">

  
    <div class="col-md-8 " id="contact_butoon" style=" display:none; margin:150px 0px; color:black;">
     <h1 style="font-weight: 500;"> Contact Details:</h1>
     <strong> E-Mail id : </strong> upskillfirst@gmail.com <br>
     <strong> Mobile Number : </strong> +91 9910026970
    </div>

    <div class="col-md-8 " id="register_butoon" style= " margin:150px 0px; color:black;">
  <img src="<?php echo base_url('assets/theme'); ?>/images/home_right.png" style=" "alt=" logo" />
    </div>


 <div class="col-md-4">
<br>
<button class="btn" onclick="registers()" style="width: 48%;"> Register  </button> &nbsp; 
<button class="btn" style="background:black; width: 48%;" onclick="logins()"> Contact Us </button>



  <?php if ($flashdata = $this->session->flashdata('email_sent')){  ?>
                          <div class="alert alert-success">
                           <?php echo $flashdata;  ?>
                          </div>
                        <?php } ?>
      <section  class="login-registers"  style="background: lightgray;
    padding: 5px 20px; margin: 15px 0px;">
  <div class="login-box login-sidebar" id="registerss">
    <div class="white-box">
     
 <?php echo form_open($form_action, 'class="form-horizontal form-material" id="loginform" '); ?>
        
    
        <h3 class="box-title m-t-40 m-b-0">Register Now</h3>
        
        <input type='hidden' name='ORDER_ID' value='<?php echo  "ORDS" . rand(10000,99999999)?>'>
        <input type='hidden' name='INDUSTRY_TYPE_ID' value='<?php echo $INDUSTRY_TYPE_ID; ?>'>
        <input type='hidden' name='MID' value='<?php echo $MID; ?>'>
        <input type='hidden' name='CHANNEL_ID' value='<?php echo $CHANNEL_ID; ?>'>




        <div class="form-group m-t-20">
          <div class="col-xs-12">
          <input type="text" class="form-control " value="<?php echo set_value('name');?>" placeholder="Name" name="CUST_ID" required>
                <?php echo form_error('username'); ?>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
           <input type="email" class="form-control form-first-name" value="<?php echo set_value('email');?>" placeholder="email" name="EMAIL" required>
                <?php echo form_error('email'); ?>
        </div>
</div>

         <div class="form-group ">
          <div class="col-xs-12">
             <input type="text" class="form-control form-email" value="<?php echo set_value('mobile');?>" placeholder="mobile" name="mobile" required>
                <?php echo form_error('mobile'); ?>
        </div>
        </div>
      <div class="form-group ">
          <div class="col-xs-12">
           <input type="number" class="form-control form-email" value="<?php echo set_value('TXN_AMOUNT');?>" name="TXN_AMOUNT" id="login-form-password-retype" placeholder="Amount" required>
                 <?php echo form_error('amount'); ?>
        </div>
        </div> 

        </div>


      
        
          
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>


          
         
    
       
      </form>
    </div>

<div  id="loginss"  style="display:none;">
<h3>Contact Us </h3>
  <?php echo form_open($form_action_contact);?>
           <div class="form-group m-t-20">
         
          <input type="text" class="form-control " value="<?php echo set_value('name');?>" placeholder="Name" name="name" >
                <?php echo form_error('name'); ?>
        
        </div>
        <div class="form-group ">
         
           <input type="email" class="form-control form-first-name" value="<?php echo set_value('email');?>" placeholder="email" name="email" >
                <?php echo form_error('email'); ?>
       
</div>

         <div class="form-group ">
       
             <input type="text" class="form-control form-email" value="<?php echo set_value('mobile');?>" placeholder="mobile" name="mobile">
                <?php echo form_error('mobile'); ?>
     
        </div>
      <div class="form-group">
        
         <textarea placeholder="Your Message" class="form-control" name="message" stye="  width: 100%;"  > Your Message  </textarea>
        </div>
      

          <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="background:black;">Sent </button>
          
        
           
        </form>

</div>

 <br/>
            

  </div>


</section>



      
    </div>



  </div>
</div>


<script type="text/javascript">

  var x = document.getElementById("loginss");
var z = document.getElementById("registerss");
var r = document.getElementById("register_butoon");
var c = document.getElementById("contact_butoon");

 function logins() {

 
z.style.display = "none";
x.style.display = "block";
c.style.display = "block";
r.style.display = "none";

}

 function registers() {


z.style.display ="block";
x.style.display = "none";
c.style.display = "none";
r.style.display = "block";
}

</script>