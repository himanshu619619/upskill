<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">

<div class="row">

 <?php foreach($products as $products){?>

        <div class="col-sm-12 col-md-8 col-lg-3 m-l-r-auto" style="margin-bottom: 34px;">
          <!-- block1 -->
          <div class="block1 hov-img-zoom pos-relative m-b-30" style="
    margin-bottom: 10px;
">
            <img src="<?php echo $products->image;?>" alt="IMG-BENNER">

            <div class="block1-wrapbtn w-size2">
              <!-- Button -->
              <a href="<?php echo base_url('Frontend/singleproduct/'. $products->product_id);?> " class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                      View       </a>
            </div>



          </div>
<h5 style="font-weight:400px; "><?php echo substr($products->product_title,0,30) ;?></h5>
          <!-- block1 -->
          
        </div>

        <?php } ?>
      </div>









	</div>
</section>
	



<script src="<?php echo base_url('assets/theme');?>/javascripts/libs/jquery.min.js" type="text/javascript"></script>


