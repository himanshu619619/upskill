
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
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
                         <li><a href="#">Dashboard</a></li>
                         <li class="active"><?php echo $page_title; ?></li>
                      </ol>
                   </div>
                   <!-- /.breadcrumb -->
                </div>
                <!-- .row -->
           <?php if ($feedback=$this->session->flashdata('feedback')) { ?>
               <div class="alert alert-success"> <?php echo $feedback; ?></div>
           <?php } ?>
 
  <div class="row">
    <div class="col-sm-12">
          <div class="white-box">
              <div class="row">
                  <div class="col-sm-12 col-xs-12">
                      <?php echo form_open('admin/backend/search_customer') ?>    
                          <div class="row">
                          
                              <div class="col-lg-4">
                                  <div class="form-group">
                                     
                                      <input type="text" class="form-control" placeholder=" Enter First Name" name="fname">
                                     
                                  </div>
                              </div>

                               <div class="col-lg-4">
                                  <div class="form-group">
                                     
                                     
                                      <input type="date" class="form-control  "  data-date-format="mm/dd/yyyy"  name="created"  >
                                  </div>
                              </div>
 
                             
                              <div class="col-lg-2">
                                  <div class="input-group">
                                     
                                      <button type="submit" class="btn btn-info">Search</button>
                                  </div>
                              </div>
                              </form>
                              <div class="col-lg-2">
                                  <div class="">
                                     
                                     <div class="box-header with-border">
                <a class="btn btn-primary fa fa-download button-block" type="button" onclick="tableToExcel('testTable', 'W3C Example Table')"> Export to Excel</a>
             </div>
                                  </div>
                              </div>
                          </div>
                          
                         
                      
                  </div>
                
                
              </div>
          </div>
      </div>
 
      <div class="col-sm-12">
          <div class="white-box">
              
              <div class="table-responsive">
                  <table id="testTable" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>S.no</th>
                              <th>Name</th>
                            
                              
                              <th>E mail</th>
                              <th>Mobile</th>
                               <th>Order Id</th>
                               <th>Amount</th>
                                <th>PAYMENT BY</th>
                                <th>STATUS</th>
                                 
                                 
                                  <th>Created at</th>
                              
                             
                         
                              <th class="text-nowrap">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php if($amc_purchase_offers) { ?>
                         <?php $no=1; foreach ($amc_purchase_offers as $key => $value) { ?>
                          <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $value->name; ?></td>
                            
                               <td><?php echo $value->email; ?></td>
                                <td><?php echo $value->mobile; ?></td>
                                <td><?php echo $value->ORDER_ID; ?></td>

                                 <td><?php echo $value->TXNAMOUNT; ?></td>
                                   <td><?php echo $value->BANKNAME; ?></td>
                                        <td><?php echo $value->STATUS; ?></td>
                                   
                                      <td><?php echo $value->TXNDATE; ?></td>
                                                     
                              <td class="text-nowrap">
                        
                                  <a href="<?php echo base_url('admin/backend/delete_user_details/'.$value->payment_id)?>" onclick="return confirm('are you sure');" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                              </td>
                          </tr>
                          <?php } ?>

                          <?php }else{ ?> 
                             <tr>
                             <td colspan="6"> <center>   <h5>No Record Found</h5></center></td>
                            </tr>
                          <?php } ?>

                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
 </div>
 <!-- .row -->
 <!-- .right-sidebar -->
 
 <!-- /.right-sidebar -->
 </div>
 
   <script type="text/javascript">
 var tableToExcel = (function() {
   var uri = 'data:application/vnd.ms-excel;base64,'
     , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
     , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
     , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
   return function(table, name) {
     if (!table.nodeType) table = document.getElementById(table)
     var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
     window.location.href = uri + base64(format(template, ctx))
   }
 })()
 </script>

<!-- <script type="text/javascript">
  $('.datepicker').datepicker();

</script> -->