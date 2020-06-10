<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row">
            <?php if ($sub_sub_category) { ?>
            <?php foreach ($sub_sub_category as $products) { ?>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 m-l-r-auto" style="margin-bottom: 34px;">
                <!-- block1 -->
                <a href="<?php echo base_url('/' . $category_name . '/' . $products->slug . '-'); ?> ">
                    <div class="block1 hov-img-zoom pos-relative m-b-30" style="
                        margin-bottom: 10px;
                        ">
                        <img src="<?php echo $products->category_image; ?>" alt="IMG-BENNER">
                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="<?php echo base_url('/'  . $category_name . '/' . $products->slug . '-'); ?> "
                                class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                View </a>
                        </div>
                    </div>
                </a>
                <center>
                    <h3 style="font-weight:400px; "><?php echo substr($products->category_name, 0, 30); ?></h3>
                </center>
                <!-- block1 -->
            </div>
            <?php

        }
    } else { ?>
            <center>
                <h1 style="padding:50px">Coming Soon..</h1>
            </center>
            <?php

        } ?>
        </div>
    </div>
</section>

<section class="bgwhite p-t-26 p-b-38" style="
    border-top: 2px solid black; ">
    <div class="container">
        <div class="row">

            <div class="col-md-6 p-b-30">

                <p class="p-b-8">
                    <?php echo $hidden_text->seo_text; ?>

                </p><br>

            </div>
            <div class="col-md-6 p-b-30">

                <p class="p-b-8" style="color:white;">
                    <?php echo $hidden_text->hidden_text; ?>

                </p><br>

            </div>
        </div>
    </div>
</section>


<script src="<?php echo base_url('assets/theme'); ?>/javascripts/libs/jquery.min.js" type="text/javascript"></script>