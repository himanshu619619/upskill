
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/user');?>/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
   

<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-19175540-9', 'auto');
    ga('send', 'pageview');
    </script>

<div id="page-wrapper">
  <div class="container-fluid">
     <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
           <h4 class="page-title">Starter Page</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
           
<ol class="breadcrumb">
              <li><a href="#">Dashboard</a></li>
              <li class="active">Starter Page</li>
           </ol>
        </div>
        <!-- /.breadcrumb -->
     </div>
     <!-- .row -->
<?php  $service_doctor =  json_decode($user->services);?>
<div class="row">
    <div class="col-sm-8">
        <div class="white-box">
            <h3 class="box-title">Doctor Services</h3>
            <?php if($feedback=$this->session->flashdata('feedback')){?>
                <div class=" alert alert-success">
               <?php echo $feedback; ?>
               </div>
                <?php }?>
            <div class="table-responsive">
                <?php echo form_open('Doctor/save_doctor_services')?>
                <table class="table color-bordered-table primary-bordered-table">
                    <thead>
                        <tr>
                            <th>check</th>
                            <th>Service Name</th>
                           
                       </tr>
                    </thead>
                    <?php foreach ($services as $value) { ?>                                                         
                  <tbody>
                        <tr>
                        <td>
                      <div class="form-check">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" 
                          <?php foreach ($service_doctor as  $service) {
                          
                            if ($service == $value->id) {
                              echo 'checked="checked"';
                             }
                           } 
                          ?>

                       name="services[]" value="<?php echo $value->id; ?>" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                                
                            </label>
                           </div>
                         </td>
                            <td>
                             <?php echo $value->service_name; ?></td>
                           
                        </tr>
                        
                    </tbody>
                    <?php } ?>
                  
                </table>  
                          
             <div>
           
             <div class="form-group row">
                 <div class="col-8">
                  <button type="submit"  class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                  
                </div>
             </div>                          
          </form>
        </div>
    </div>
               <!-- .row -->
               
            </div>


            <script src="<?php echo base_url('assets/user');?>/plugins/bower_components/switchery/dist/switchery.min.js"></script>
    <script src="<?php echo base_url('assets/user');?>/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo base_url('assets/user');?>/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/user');?>/plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
        // For select 2

        $(".select2").select2();
        $('.selectpicker').selectpicker();

        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }

        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();

        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });

        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });

        // For multiselect

        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });

        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });

    });
    </script>
    <!--Style Switcher -->
    