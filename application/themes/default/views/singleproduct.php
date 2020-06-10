
<div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        <div class="item-slick3" data-thumb="<?php echo $products->image;?>">
                            <div class="wrap-pic-w">
                                <img src="<?php echo $products->image;?>" alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="<?php echo $products->image2;?>">
                            <div class="wrap-pic-w">
                                <img src="<?php echo $products->image2;?>" alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="<?php echo $products->image3;?>">
                            <div class="wrap-pic-w">
                                <img src="<?php echo $products->image3;?>" alt="IMG-PRODUCT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h2 class="product-detail-name m-text16 p-b-13">
                   <?php echo $products->product_title;?>
                </h2>

            

                <p class="s-text8 p-t-10">
                   <?php echo $products->product_desc;?>
                </p>

                <!--  -->
              <div class="p-t-33 p-b-60">
                     <div class="" style="padding-left:8px;">

                  <b> Availability: &nbsp;</b>  <?php echo $products->availablity;?>

                       
                    </div>  
                     <div class="" style="padding-left:8px;">
                
 <b> SKU CODE: </b> &nbsp; <?php echo $products->sku;?>
                       
                    </div>

                    <div class="flex-m flex-w">
                  

                      
                    </div>

                    <div class="">
                        <div class="w-size16 flex-m flex-w">
                            

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button --><a href="<?php echo base_url('Frontend/contact');?>">
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                   Contact Us
                                </button></a>
                            </div>
                        </div>
                    </div>
                </div>

           <!--      <div class="p-b-45">
                    <span class="s-text8 m-r-35">SKU: MUG-01</span>
                    <span class="s-text8">Categories: Mug, Design</span>
                </div> -->

                <!--  -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                       Additional information
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            <?php echo $products->product_sub_desc;?>
                        </p>
                    </div>
                </div>

               <!--  <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Additional information
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div> -->

               <!--  <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Reviews (0)
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
        <!-- col End --> 


      <!-- shop-sidebar:starts -->

      

        <!-- row End -->  




<!-- <div class="row add-top-half">
  <article class="col-md-12">
        <h3 class="shop-subheading white-bg">Related Products</h3>
  </article>
</div> -->

<!-- <div class="row related-thumbs-wrap">

      <article class="col-md-3 col-xs-6 related-thumbs">
        <div class="related-thumbs-inner white-bg">
          <a href="product-details.html"><img class="img-responsive" src="<?php echo base_url('assets/theme');?>/images/Advertising/17s.jpg" alt="shop"></a>
        </div>
      </article>

      <article class="col-md-3 col-xs-6 related-thumbs">
        <div class="related-thumbs-inner white-bg">
          <a href="product-details.html"><img class="img-responsive" src="<?php echo base_url('assets/theme');?>/images/Advertising/17s.jpg" alt="shop"></a>
        </div>
      </article>

      <article class="col-md-3 col-xs-6 related-thumbs">
        <div class="related-thumbs-inner white-bg">
          <a href="product-details.html"><img class="img-responsive" src="<?php echo base_url('assets/theme');?>/images/Advertising/17s.jpg" alt="shop"></a>
        </div>
      </article>

      <article class="col-md-3 col-xs-6 related-thumbs">
        <div class="related-thumbs-inner white-bg">
          <a href="product-details.html"><img class="img-responsive" src="<?php echo base_url('assets/theme');?>/images/Advertising/17s.jpg" alt="shop"></a>
        </div>
      </article>

</div>
 -->
      




<!-- intro:ends -->




    <!-- Relate Product -->
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Related Products
                </h3>
            </div>


            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
<?php foreach ($related as $related) { ?>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative ">
                                <img src="<?php echo $related->image;?>" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                           <a   href=" <?php echo base_url('Frontend/singleproduct/'. $related->product_id);?> ">   
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            View 
                                        </button> </a>

                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                 <?php echo $related->product_title?>
                                </a>

                          <!--       <span class="block2-price m-text6 p-r-5">
                                    $75.00
                                </span> -->
                            </div>
                        </div>
                    </div>
<?php } ?>

                </div>
            </div>

        </div>
    </section>








