
   <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="content">
                    
    <div class="document-title">
        <h1>Row Version</h1>

        <ul class="breadcrumb">
            <li><a href="#">Docmed</a></li>
            <li><a href="#">Listing</a></li>
        </ul>
    </div><!-- /.document-title -->


 <form class="filter" method="post" action="">
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <input type="text" placeholder="Keyword" class="form-control">
            </div><!-- /.form-group -->
        </div><!-- /.col-* -->

        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <select class="form-control" title="Select Location">
                    <option>Bronx</option>
                    <option>Brooklyn</option>
                    <option>Manhattan</option>
                    <option>Staten Island</option>
                    <option>Queens</option>
                </select>
            </div><!-- /.form-group -->
        </div><!-- /.col-* -->

        <div class="col-sm-12 col-md-4">
            <div class="form-group">
                <select class="form-control" title="Select Category">
                    <option value="">Automotive</option>
                    <option value="">Jobs</option>
                    <option value="">Nightlife</option>
                    <option value="">Services</option>
                </select>
            </div><!-- /.form-group -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->

    <hr>

    <div class="row">
        <div class="col-sm-8">
            <div class="filter-actions">
                <a href="#"><i class="fa fa-close"></i> Reset Filter</a>
                <a href="#"><i class="fa fa-save"></i> Save Search</a>
            </div><!-- /.filter-actions -->
        </div><!-- /.col-* -->

        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Redefine Search Result</button>
        </div><!-- /.col-* -->
    </div><!-- /.row -->
</form>


<h2 class="page-title">
    <?php echo count($user_detail);?> results matching your query

    <form method="get" action="" class="filter-sort">
        <div class="form-group">
            <select title="Sort by">
                <option name="price">Price</option>
                <option name="rating">Rating</option>
                <option name="title">Title</option>
            </select>
        </div><!-- /.form-group -->
                
        <div class="form-group">
            <select title="Order">
                <option name="ASC">Asc</option>
                <option name="DESC">Desc</option>
            </select>
        </div><!-- /.form-group -->
    </form>
</h2><!-- /.page-title -->

<div class="cards-row">
    <?php foreach($user_detail as $user_detail){?>
        <div class="card-row">
            <div class="card-row-inner">
                <div class="card-row-image"  data-background-image="<?php echo $user_detail->photo;?>">
                    <div class="card-row-label"><a href="listing-detail.html">Vacation</a></div><!-- /.card-row-label -->
                    
                        <div class="card-row-price"><a href="<?php echo base_url('Frontend/view_detail')?>"> View</a></div><!-- -->
                    
                </div><!-- /.card-row-image -->

                <div class="card-row-body">
                    <h2 class="card-row-title"><a href="listing-detail.html"><!-- <?php echo $user_detail->username;?> --></a></h2>

<?php if(@$user_detail->clinic_name){?>

<div class="card-row-content"><b>Clinic Name:</b><p><?php echo $user_detail->clinic_name; ?></p></div>
                   
<?php }else{ ?>

 <div class="card-row-content"><b>Services</b><p><?php $services= json_decode($user_detail->services); 
                             foreach ($services as  $value) {
                                 echo $services_option[$value].'<br>';
                             }

                            ?></p></div>



<?php } ?>

                            <!-- /.card-row-content -->
                </div><!-- /.card-row-body -->

                <div class="card-row-properties">
                    <dl>
                        
                            <dd>E-mail</dd><dt><?php echo $user_detail->email;?></dt>
                        

                        
                            <dd>mobile.</dd><dt><?php echo $user_detail->mobile;?></dt>
                        

                        
                            <dd>Address</dd><dt><?php echo $user_detail->address;?></dt>
                            <dd>State</dd><dt><?php echo @$state_option[$user_detail->state];?></dt>

                            <dd>City</dd><dt><?php echo @$cities_option[$user_detail->cities];?></dt>

                            <dd>srvices</dd><dt></dt>                       

                        <dd>Rating</dd>
                        <dt>
                            <div class="card-row-rating">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div><!-- /.card-row-rating -->
                        </dt>
                    </dl>
                </div><!-- /.card-row-properties -->
            </div><!-- /.card-row-inner -->
        </div><!-- /.card-row -->
    <?php } ?>



    
</div><!-- /.cards-row -->


<div class="pager">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">5</a></li>
        <li class="active"><a>6</a></li>
        <li><a href="#">7</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div><!-- /.pagination -->


                </div><!-- /.content -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->

  