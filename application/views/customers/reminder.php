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
                        <li><a href="#">Dashboard</a></li>
                        <li class="active"><?php echo $page_title; ?></li>
                     </ol>
                  </div>
                  <!-- /.breadcrumb -->
               </div>
               <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Remind Description</h3>
                            <?php if($feedback=$this->session->flashdata('feedback')){ ?>

                             <div class="alert alert-success"><?php echo $feedback; ?></div>
                            <?php  } ?>
                            <p class="text-muted m-b-30 font-13"> </p>
                            <?php echo form_open($form_action); ?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Title</label>
                                    <div class="col-10">
                                        <input class="form-control" name="title" type="text" value="<?php echo set_value('title',$title); ?>" >
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-2 col-form-label">Date</label>
                                    <div class="col-10">
                                        <input class="form-control" name="date" type="date" value="<?php echo set_value('title',$date); ?>">
                                        <?php echo form_error('date'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-email-input" class="col-2 col-form-label">Description</label>
                                    <div class="col-10">
                                        <?php echo  form_textarea('description',set_value('description',$description),'class = "form-control"'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-email-input" class="col-2 col-form-label"></label>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-info pull-right">Save</button>
                                    </div>
                                </div>
                             
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
              
                    <!-- .row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0"></h3>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Title</th>
                            
                            <th>Date</th>
                            <th>Description</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($reminder as $value){ ?>
                      <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $value->title;?></td> 
                          <td><?php echo $value->date;?></td>
                          <td><?php echo $value->description;?></td>
                          <td>
                           <a href="<?php echo base_url('Patient/delete_reminder/'.$value->id); ?>" class="btn btn-danger fa fa-trash-o"></a>
                           <a href="<?php echo base_url('patient/reminder/'.$value->id); ?>" class="btn btn-info fa fa-edit"></a>
                          </td>
                      </tr>
                       <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row --> 
            </div>