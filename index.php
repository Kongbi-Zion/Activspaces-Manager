<?php
     include_once('security.php'); 
     include_once('db_connection.php');

               $current_year = date('Y'); 
               $current_year_query = "SELECT year_name FROM year WHERE year_name='$current_year' ";
               $current_year_query_run = mysqli_query($connection, $current_year_query);
               
               if ($current_year_query_run->num_rows > 0) {
                }else{
                     $current_year_insert = "INSERT INTO year (year_name) VALUES ('$current_year')";
                     $current_year_insert_run = mysqli_query($connection, $current_year_insert);
                }



     $total_service_amount_per_month = array();
     // total percentages
     $total_service_percentages = array();
     
     // total income from a particular service per month
     $query_services = "SELECT service_id, name_of_service FROM services "; 
     $query_services_run = mysqli_query($connection, $query_services);
     if(mysqli_num_rows($query_services_run) > 0)
       {
         while($row = mysqli_fetch_array($query_services_run))
         {
           $services_id = $row['service_id'];
           $name_of_service = $row['name_of_service'];
           $total_amount = "SELECT SUM(amount) AS total_amount FROM facture "; 
           $total_amount_run = mysqli_query($connection, $total_amount);
           if($total_amount_run->num_rows > 0) {
             $total_percentage_amount = $total_amount_run->fetch_assoc();
             $amount_totall = $total_percentage_amount['total_amount'];
           }
           $current_amount = "SELECT SUM(amount) AS total_services_amount FROM facture WHERE id_service='$services_id' "; 
           $current_amount_run = mysqli_query($connection, $current_amount);
           if($current_amount_run->num_rows > 0) {
             $service_amount = $current_amount_run->fetch_assoc();
             $amount_per_service = $service_amount['total_services_amount'];
             if($amount_per_service == ''){
               $amount_per_service = 0;
             }
             $total_service_amount_per_month[$name_of_service] = $amount_per_service;
             $current_pecentage = (int) ($amount_per_service*100/$amount_totall);
             $total_service_percentages[$name_of_service] = $current_pecentage;
           }
         }
       }

                // CONDITIONS TO DRAW THE GRAPH

               if(isset($_SESSION['username']) && !(isset($_POST['filter']))){
                $display = 'month';
                $this_year = date('Y');
               }

               if(isset($_SESSION['username']) && isset($_POST['filter'])){
                $from_date = $_POST['from_date'];
                $to_date =  $_POST['to_date'];
                $option = $_POST['selected_year'];

                 if($from_date != '' && ($to_date == '' && $option == '')){
                  $display = 'day';
                  $this_year = date('Y');

                  $query_day = "SELECT * FROM facture WHERE date_of_creation='$from_date' ";
                  $query_day_run = mysqli_query($connection, $query_day);
                 }

                 if( ($from_date != '' && $to_date != '') && $option =='' ){
                  $display = 'range';
                  $this_year= date('Y');

                     $range_of_days = "SELECT * FROM total_amount_per_day WHERE day BETWEEN '$from_date' AND '$to_date' ";
                     $range_of_days_run = mysqli_query($connection, $range_of_days); 
                 }

                if($option != '' && ($from_date == '' && $to_date == '')){
                  $display = 'year';
                  $this_year = $option;
                }

                if(($from_date == '' && $to_date == '') && $option == ''){
                    $this_year = date('Y');
                    $display = 'month';
                }
   
               }
            

            $query1 = "SELECT * FROM facture WHERE date_of_creation LIKE '___01/".$this_year."' ";
            $query2 = "SELECT * FROM facture WHERE date_of_creation LIKE '___02/".$this_year."' ";
            $query3 = "SELECT * FROM facture WHERE date_of_creation LIKE '___03/".$this_year."' ";
            $query4 = "SELECT * FROM facture WHERE date_of_creation LIKE '___04/".$this_year."' ";
            $query5 = "SELECT * FROM facture WHERE date_of_creation LIKE '___05/".$this_year."' ";
            $query6 = "SELECT * FROM facture WHERE date_of_creation LIKE '___06/".$this_year."' ";
            $query7 = "SELECT * FROM facture WHERE date_of_creation LIKE '___07/".$this_year."' ";  
            $query8 = "SELECT * FROM facture WHERE date_of_creation LIKE '___08/".$this_year."' ";
            $query9 = "SELECT * FROM facture WHERE date_of_creation LIKE '___09/".$this_year."' ";
            $query10 = "SELECT * FROM facture WHERE date_of_creation LIKE '___10/".$this_year."' ";
            $query11 = "SELECT * FROM facture WHERE date_of_creation LIKE '___11/".$this_year."' ";
            $query12 = "SELECT * FROM facture WHERE date_of_creation LIKE '___12/".$this_year."' ";

            $query_run1 = mysqli_query($connection, $query1);
            $query_run2 = mysqli_query($connection, $query2);
            $query_run3 = mysqli_query($connection, $query3);
            $query_run4 = mysqli_query($connection, $query4);
            $query_run5 = mysqli_query($connection, $query5);
            $query_run6 = mysqli_query($connection, $query6);
            $query_run7 = mysqli_query($connection, $query7);
            $query_run8 = mysqli_query($connection, $query8);
            $query_run9 = mysqli_query($connection, $query9);
            $query_run10 = mysqli_query($connection, $query10);
            $query_run11 = mysqli_query($connection, $query11);
            $query_run12 = mysqli_query($connection, $query12);
           
     
             $January = 0; $February = 0; $March = 0; $April = 0; $May = 0; $June = 0; $July = 0; $August = 0; $September = 0; $October = 0; $November = 0; $December = 0;

             $year = date('Y');

             if(mysqli_num_rows($query_run1) > 0)
               {
                   while($row = mysqli_fetch_array($query_run1))
                   {
                     $January += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run2) > 0)
               {
                   while($row = mysqli_fetch_array($query_run2))
                   {
                     $February += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run3) > 0)
               {
                   while($row = mysqli_fetch_array($query_run3))
                   {
                     $March += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run4) > 0)
               {
                   while($row = mysqli_fetch_array($query_run4))
                   {
                     $April += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run5) > 0)
               {
                   while($row = mysqli_fetch_array($query_run5))
                   {
                     $May += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run6) > 0)
               {
                   while($row = mysqli_fetch_array($query_run6))
                   {
                     $June += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run7) > 0)
               {
                   while($row = mysqli_fetch_array($query_run7))
                   {
                     $July += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run8) > 0)
               {
                   while($row = mysqli_fetch_array($query_run8))
                   {
                     $August += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run9) > 0)
               {
                   while($row = mysqli_fetch_array($query_run9))
                   {
                     $September += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run10) > 0)
               {
                   while($row = mysqli_fetch_array($query_run10))
                   {
                     $October += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run11) > 0)
               {
                   while($row = mysqli_fetch_array($query_run11))
                   {
                     $November += intval($row['amount']);
                   }
               }
               if(mysqli_num_rows($query_run12) > 0)
               {
                   while($row = mysqli_fetch_array($query_run12))
                   {
                     $December += intval($row['amount']);
                   }
               }             
          ?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home | ActivSpaces Manager (ASM)</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('header_links.php'); ?>  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!------------------------------------------------- Default graph --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Year", "Amount", { role: "style" } ],
        ["January", <?php  echo $January; ?>, "color: gray"],
        ["February", <?php echo $February; ?>, "color: gray"],
        ["March", <?php echo $March; ?>, "color: gray"],
        ["April", <?php echo $April; ?>, "color: gray"],
        ["May", <?php echo $May; ?>, "color: gray"],
        ["June", <?php echo $June; ?>, "color: gray"],
        ["July", <?php echo $July; ?>, "color: gray"],
        ["August", <?php echo $August; ?>, "color: gray"],
        ["September", <?php echo $September; ?>, "color: gray"],
        ["October", <?php echo $October; ?>, "color: gray"],
        ["November", <?php echo $November; ?>, "color: gray"],
        ["December", <?php echo $December; ?>, "color: gray"]
      ]);
        var options = {    
           title: "Company Income",
        };
        var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
        chart.draw(data, google.charts.Bar.convertOptions(options));
  }       
    </script>
 <!---------------------------------X---------------- Default graph -----------------X----------------------------> 


 <!------------------------------------------------- Year graph --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Year", "Amount", { role: "style" } ],
        ["January", <?php  echo $January; ?>, "color: gray"],
        ["February", <?php echo $February; ?>, "color: gray"],
        ["March", <?php echo $March; ?>, "color: gray"],
        ["April", <?php echo $April; ?>, "color: gray"],
        ["May", <?php echo $May; ?>, "color: gray"],
        ["June", <?php echo $June; ?>, "color: gray"],
        ["July", <?php echo $July; ?>, "color: gray"],
        ["August", <?php echo $August; ?>, "color: gray"],
        ["September", <?php echo $September; ?>, "color: gray"],
        ["October", <?php echo $October; ?>, "color: gray"],
        ["November", <?php echo $November; ?>, "color: gray"],
        ["December", <?php echo $December; ?>, "color: gray"]
      ]);
        if(display == 'year'){
           var options = {    
              title: "Company Income",
           };
           var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
           chart.draw(data, google.charts.Bar.convertOptions(options));
      }
  }       
    </script>
 <!---------------------------------X---------------- Year graph -----------------X----------------------------> 
      
<!------------------------------------------------- Day graph --------------------------------------------->  
<script type="text/javascript">
   var display = '<?= $display ?>';
     google.charts.load("current", {"packages":["bar"]});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data2 = google.visualization.arrayToDataTable([
         ["Day", "Amount", { role: "style" } ],
         <?php
           if(mysqli_num_rows($query_day_run) > 0)
           {
             while($row = mysqli_fetch_array($query_day_run))
             {
               echo "['" .$row['time_created']. "'," .$row['amount']. ", 'color: gray'],";
             }
           }
         ?>
      ]);
      if(display == 'day'){
        var option2 = {    
           title: "Company Income",
        };
        var chart2 = new google.charts.Bar(document.getElementById("columnchart_material"));
        chart2.draw(data2, google.charts.Bar.convertOptions(option2));
      }
  }    
</script>
<!---------------------------------X---------------- Day graph -----------------X---------------------------->



<!------------------------------------------------- Range graph --------------------------------------------->  


<script type="text/javascript">
   var display = '<?= $display ?>';
     google.charts.load("current", {"packages":["bar"]});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data3 = google.visualization.arrayToDataTable([
         ["Range of days", "Amount", { role: "style" } ],
         <?php 
           if(mysqli_num_rows($range_of_days_run) > 0)
           {
             while($row = mysqli_fetch_array($range_of_days_run))
             {
               echo "['" .$row['day']. "'," .$row['amount']. ", 'color: gray'],";
             }
           }
         ?>
      ]);
      if(display == 'range'){
        var option3 = {    
           title: "Company Income",
        };
        var chart3 = new google.charts.Bar(document.getElementById("columnchart_material"));
        chart3.draw(data3, google.charts.Bar.convertOptions(option3));
      }
  }    
</script>
<!---------------------------------X---------------- Range graph -----------------X----------------------------> 


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
    <script type="text/javascript">
      $(function(){
        $("#from_date").datepicker({
          dateFormat: 'dd-mm-yy',
          onSelect: function(dateselected)
          {
             var dd = new Date(dateselected);
             dd.setDate(dd.getDate());
             $("#to_date").datepicker("option", "minDate", dd);
          }
        });

        $("#to_date").datepicker({
          dateFormat: 'dd-mm-yy',
          onSelect: function(dateselected)
          {
             var dd = new Date(dateselected);
             dd.setDate(dd.getDate());
             $("from_date").datepicker("option", "maxDate", dd);
          }
        });

      });
    </script>
</head>

<body>
    <?php include_once('side_bar.php'); ?>

     <?php include_once('nav_bar.php'); ?> <br><br><br>
     
           
            <div class="breadcome-area">
                <div class="container-fluid">
                     <div class="row">

                       <?php 
                 foreach ($total_service_percentages as $key => $value) {
                   
                 ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 1.5rem;">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5><?php echo $key; ?></h5>
                                <h2>XAF<span class=""><?php echo " ".(int)$total_service_amount_per_month[$key]; ?></span>
                                <span class="tuition-fees"></span></h2>
                                <span class="text-success"><?php echo $value; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $value; ?>%";> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <?php

                }

                ?>
         
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Number Of Services</h5><br><br>
                                <?php $total_number_of_services = count($total_service_amount_per_month); ?>
                                <h2><?php echo ' '. $total_number_of_services; ?></h2>
                                <span class="text-danger"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $amount_totall; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Total Services Amount</h5><br>
                                <h2>XAF<span class=""></span><?php echo " ".(int)$amount_totall; ?><span class="tuition-fees">Montant</span></h2>
                                
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $amount_totall; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div><br>
                            </div>
                        </div>
                    </div>

                     </div>
               </div>
           </div>
            <div class="container" style="width:800px; margin-left: 25rem; margin-top: 2.5rem; margin-bottom: -5rem;">
              <form action="#" method="POST">
                <div class="col-md-2">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" style="border-radius: 8px;" />  
                </div>  
                <div class="col-md-2">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" style="border-radius: 8px;" />  
                </div> 
                <div class="col-md-3">  
                     <select class="form-control form-control-lg" style="border-radius: 8px;" name="selected_year">
                       <option value="">Select year</option>
                       <?php 
                           $year_select = "SELECT * FROM year";
                            $year_run_select = mysqli_query($connection, $year_select);
                           if(mysqli_num_rows($year_run_select) > 0){
                             while($row = mysqli_fetch_assoc($year_run_select)) {        
                       ?>
                             <option value="<?php echo $row['year_name']; ?>"><?php echo $row['year_name']; ?></option>
                       <?php           
                           }
                        }
                       ?>
                     </select>  
                </div> 
                <div class="col-md-1">  
                     <button class="btn btn-info" name="filter">Filter</button>  
                </div> 
              </form>

                <div class="col-md-2">  
                   <button class="btn btn-info"><a href="filter_services.php" style="color: white; text-decoration: none;">Filter services</a></button> 
                </div>
 
            </div> 
           
            <div style="padding-top: 2rem; margin: 1rem; background-color: white;">
               <div style="margin: 2.5rem;">
                   <div id="columnchart_material" style="width: auto; height: 500px;"></div>
               </div>
            </div>


                    

                     </div>
                </div>
            </div><br><br>
        
    <?php include_once('footer.php'); ?>

    <?php include_once('footer_links.php'); ?> 
</body>
</html>