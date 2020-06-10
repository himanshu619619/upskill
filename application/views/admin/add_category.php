<link href="<?php echo base_url('assets/backend') ?>/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../../../cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">

.error{
color: red;
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
      <!-- .breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        
        <ol class="breadcrumb">
          <li><a href="#">Services</a></li>
          <li class="active"><?php echo $page_title; ?></li>
        </ol>
      </div>
      <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    
  <!-- /.row -->
  <div class="row">
    <div class="col-sm-12">
      <div class="white-box">
        <h3 class="box-title m-b-0"></h3>
        <div class="table-responsive">
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>S no.</th>
                <th>Customer Code</th>
                <!--                 <th>State</th> -->
                
                <th> Customer Name</th>
                
                <th>Customer Mobile</th>
                <th>Technisian Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($amc_purchase_offers as $value){ ?>
              <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $value->customer_code; ?></td>
                
               <td><?php echo $value->customer_name; ?></td>
                
                <td><?php echo $value->customer_mobile; ?></td>
                  <td><?php echo $value->technecian; ?></td>

<td class="text-nowrap">
                                 <a href="<?php echo base_url('admin/Backend/view_amc_purchase_offers/'.$value->service_id) ?>" data-toggle="tooltip" data-original-title="View"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                 <a href="<?php echo base_url('admin/Laboratory_admin/delete_amc_purchase_offers/'.$value->service_id)?>" onclick="return confirm('are you sure');" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                             </td>

              </tr>
              <?php } ?>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function get_state(country_id){

jQuery.ajax({

type :  "POST",
url : "<?php echo base_url('admin/Company_admin/get_state') ?>",
data : {country_id : country_id},
DataType : "HTML",
success : function(data){
// alert(data);
$("#state_box").html(data);
}

});

}
function get_city(state_id){
jQuery.ajax({
type : "POST",
url  : "<?php echo base_url('admin/Company_admin/get_city') ?>",
data : {state_id : state_id},
DataType : "HTMl",
success : function(data){
//alert(data);
$("#city_box").html(data);
}
});
}
</script>

<script type="text/javascript">
var edit_1 = new Jodit('#editor2', {        removeButtons: ['source', '|', 'fullsize', 'about']    });

<?php  
  echo "edit_1.value = `".$seo_text."`";
?>

var edit_2 = new Jodit('#editor3', {        removeButtons: ['source', '|', 'fullsize', 'about']    });

<?php  
  echo "edit_2.value = `".$hidden_text."`";
?>

</script>