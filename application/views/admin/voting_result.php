
<style type="text/css">


    .error{color:red;}
    #modal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0%;
    left: 0%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    height: 100%;
    width: 100%;}
    .modalconent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 37%;
    padding: 20px;
    
}
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .modalconent {
    position: absolute;
    top: 37%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 88%;
    padding: 20px;}
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
                 
               </div>
              <!-- .row -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
 <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                         <?php if ($flashdata = $this->session->flashdata('success')){  ?>
                          <div class="alert alert-success">
                           <?php echo $flashdata;  ?>
                          </div>
                        <?php } ?>


                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

                                  <?php foreach ($voting_result as $value): ?>

                                    <canvas id="<?php echo $value->question_id ; ?>" width="200px" height="200px"></canvas>
                                      <script>
var ctx = document.getElementById('<?php echo $value->question_id ; ?>').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['<?php echo $value->option1 ; ?>', '<?php echo $value->option2 ; ?>', '<?php echo $value->option3 ; ?>', '<?php echo $value->option4 ; ?>'],
        datasets: [{
            label: '<?php echo $value->question_name ; ?>',
            data: ['<?php echo $value->pct1 ; ?>', '<?php echo $value->pct2 ; ?>', '<?php echo $value->pct3 ; ?>', '<?php echo $value->pct4 ; ?>'],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                     max: 100,
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
                                    
                                  <?php endforeach ?>



                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <!-- /.row -->
               
            </div>

        </div>
  


