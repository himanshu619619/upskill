<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-color:black;">
    <h2 class="l-text2 t-center" style="color:white!important;">
      Contact
    </h2>
  </section>

  <!-- content page -->
  <section class="bgwhite p-t-66 p-b-60">
    <div class="container">
      <div class="row" style="background-color: #f7f7f7;">
        <div class="col-md-6 p-b-30">
          <div class="p-r-20 p-r-0-lg" style="padding-top:30px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.078859164006!2d77.0572284145553!3d28.447039099203945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1c3209303e39%3A0xc0b646c928a98d6!2sAccuPrints!5e0!3m2!1sen!2sin!4v1548221251383" width="550" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
<?php if ($feedback = $this->session->flashdata('email_sent')) { ?>
<h5 style="color: green;"><?php echo $feedback; ?></h5>
<?php } ?>
        <div class="col-md-6 p-b-30">
             
          <form  method="post" action="<?php echo base_url('Frontend/send'); ?>" class="leave-comment">
           <h4 class="m-text26 p-b-36 p-t-15">
              
            </h4>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name" required >
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" placeholder="Email Address" required>
            </div>

            <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message" required></textarea>
            

            <div class="w-size25">
              <!-- Button -->
              <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                Send
              </button>
            </div>
          </form>

        </div><p>* Google Map location on website yet to be updated</p>
      </div>
    </div>
  </section>
