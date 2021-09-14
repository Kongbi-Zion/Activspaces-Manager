<?php
     include_once('security.php'); 
     include_once('db_connection.php');   

     $total_service_amount_per_month = array();
     $total_service_amount_per_day = array();
     $total_service_amount_per_range = array();
     $total_service_amount_for_particular_month = array();
     $total_service_amount_for_particular_year = array();
     
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


    // conditions to display graph
     if(isset($_SESSION['username']) && !(isset($_POST['filter']))){
       $display = 'month';
     }  

     if(isset($_SESSION['username']) && isset($_POST['filter'])){
       $from_date = $_POST['from_date'];
       $to_date =  $_POST['to_date'];
       $option = $_POST['selected_year'];
       $search_month = $_POST['month'];


       if($from_date != '' && ($to_date == '' && $option == '')){
         $display = 'day';
         $query_services = "SELECT service_id, name_of_service FROM services "; 
         $query_services_run = mysqli_query($connection, $query_services);
         if(mysqli_num_rows($query_services_run) > 0)
         {
           while($row = mysqli_fetch_array($query_services_run))
           {
             $services_id = $row['service_id'];
             $name_of_service = $row['name_of_service'];
             $current_amount = "SELECT SUM(amount) AS total_services_amount FROM facture WHERE date_of_creation='$from_date' AND id_service='$services_id' "; 
             $current_amount_run = mysqli_query($connection, $current_amount);
             if($current_amount_run->num_rows > 0) {
               $service_amount = $current_amount_run->fetch_assoc();
               $amount_per_service = $service_amount['total_services_amount'];
               if($amount_per_service == ''){
                 $amount_per_service = 0;
               }
               $total_service_amount_per_day[$name_of_service] = $amount_per_service;
             }
           }
         }
       }


       if( ($from_date != '' && $to_date != '') && $option =='' ){
         $display = 'range';
         $query_services = "SELECT service_id, name_of_service FROM services "; 
         $query_services_run = mysqli_query($connection, $query_services);
         if(mysqli_num_rows($query_services_run) > 0)
         {
           while($row = mysqli_fetch_array($query_services_run))
           {
             $services_id = $row['service_id'];
             $name_of_service = $row['name_of_service'];
             $current_amount = "SELECT SUM(amount) AS total_services_amount FROM facture WHERE date_of_creation BETWEEN '$from_date' AND '$to_date' AND id_service='$services_id' "; 
             $current_amount_run = mysqli_query($connection, $current_amount);
             if($current_amount_run->num_rows > 0) {
               $service_amount = $current_amount_run->fetch_assoc();
               $amount_per_service = $service_amount['total_services_amount'];
               if($amount_per_service == ''){
                 $amount_per_service = 0;
               }
               $total_service_amount_per_range[$name_of_service] = $amount_per_service;
             }
           }
         }
       }


       if( ($search_month !='' && $option !='') && ($from_date == '' && $to_date == '') ){
         $display = 'particular_month';
         $new_date = $search_month .'/'. $option;
         $query_services = "SELECT service_id, name_of_service FROM services "; 
         $query_services_run = mysqli_query($connection, $query_services);
         if(mysqli_num_rows($query_services_run) > 0)
         {
           while($row = mysqli_fetch_array($query_services_run))
           {
             $services_id = $row['service_id'];
             $name_of_service = $row['name_of_service'];
             $current_amount = "SELECT SUM(amount) AS total_services_amount FROM facture WHERE id_service='$services_id' AND date_of_creation LIKE '___".$new_date."' "; 
             $current_amount_run = mysqli_query($connection, $current_amount);
             if($current_amount_run->num_rows > 0) {
               $service_amount = $current_amount_run->fetch_assoc();
               $amount_per_service = $service_amount['total_services_amount'];
               if($amount_per_service == ''){
                 $amount_per_service = 0;
               }
               $total_service_amount_for_particular_month[$name_of_service] = $amount_per_service;
             }
           }
         }
       }



       if( ($search_month =='' && $option !='') && ($from_date == '' && $to_date == '') ){
         $display = 'particular_year';
         $query_services = "SELECT service_id, name_of_service FROM services "; 
         $query_services_run = mysqli_query($connection, $query_services);
         if(mysqli_num_rows($query_services_run) > 0)
         {
           while($row = mysqli_fetch_array($query_services_run))
           {
             $services_id = $row['service_id'];
             $name_of_service = $row['name_of_service'];
             $current_amount = "SELECT SUM(amount) AS total_services_amount FROM facture WHERE id_service='$services_id' AND date_of_creation LIKE '%".$option."' "; 
             $current_amount_run = mysqli_query($connection, $current_amount);
             if($current_amount_run->num_rows > 0) {
               $service_amount = $current_amount_run->fetch_assoc();
               $amount_per_service = $service_amount['total_services_amount'];
               if($amount_per_service == ''){
                 $amount_per_service = 0;
               }
               $total_service_amount_for_particular_year[$name_of_service] = $amount_per_service;
             }
           }
         }
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
        <?php
          foreach ($total_service_amount_per_month as $service_names => $amount_total) {
             echo "['" .$service_names. "'," .$amount_total. ", 'color: gray'],";
          }
        ?>
      ]);
        var options = {    
           title: "Company Service total Income",
        };
        var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
        chart.draw(data, google.charts.Bar.convertOptions(options));
  }       
    </script>
 <!---------------------------------X---------------- Default graph -----------------X---------------------------->

   <!------------------------------------------------- Day graph --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Day", "Amount", { role: "style" } ],
        <?php
          foreach ($total_service_amount_per_day as $service_names => $amount_total) {
             echo "['" .$service_names. "'," .$amount_total. ", 'color: gray'],";
          }
        ?>
      ]);
        if(display == 'day')
        {
           var options = {    
             title: "Total Company Services Income For Selected Day" ,
           };
           var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
           chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  }       
    </script>
 <!---------------------------------X---------------- Day graph -----------------X---------------------------->

 <!------------------------------------------------- Range of Days graph --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Day", "Amount", { role: "style" } ],
        <?php
          foreach ($total_service_amount_per_range as $service_names => $amount_total) {
             echo "['" .$service_names. "'," .$amount_total. ", 'color: gray'],";
          }
        ?>
      ]);
        if(display == 'range')
        {
           var options = {    
             title: "Total Company Services Income For Range Of Days Selected" ,
           };
           var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
           chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  }       
    </script>
 <!---------------------------------X---------------- Range of Days graph -----------------X---------------------------->

 <!------------------------------------------------- Graph For a particular Month --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Day", "Amount", { role: "style" } ],
        <?php
          foreach ($total_service_amount_for_particular_month as $service_names => $amount_total) {
             echo "['" .$service_names. "'," .$amount_total. ", 'color: gray'],";
          }
        ?>
      ]);
        if(display == 'particular_month')
        {
           var options = {    
             title: "Total Company Services Income For Selected Month And Year" ,
           };
           var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
           chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  }       
    </script>
 <!---------------------------------X---------------- Graph For a particular Month -----------------X----------------------------> 



 <!------------------------------------------------- Graph For a particular year --------------------------------------------->  
    <script type="text/javascript">
      var display = '<?= $display ?>';
      google.charts.load("current", {"packages":["bar"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ["Day", "Amount", { role: "style" } ],
        <?php
          foreach ($total_service_amount_for_particular_year as $service_names => $amount_total) {
             echo "['" .$service_names. "'," .$amount_total. ", 'color: gray'],";
          }
        ?>
      ]);
        if(display == 'particular_year')
        {
           var options = {    
             title: "Total Company Services Income For Selected Year" ,
           };
           var chart = new google.charts.Bar(document.getElementById("columnchart_material"));
           chart.draw(data, google.charts.Bar.convertOptions(options));
        }
  }       
    </script>
 <!---------------------------------X---------------- Graph For a particular year -----------------X----------------------------> 



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
            <div class="container" style="width:800px; margin-left: 18rem; margin-top: 2.5rem; margin-bottom: -5rem;">
              <form action="#" method="POST">
                <div class="col-md-2">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" style="border-radius: 8px;" />  
                </div>  
                <div class="col-md-2">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" style="border-radius: 8px;" />  
                </div> 
                 <div class="col-md-2">  
                     <select class="form-control form-control-lg" style="border-radius: 8px;" name="month">
                       <option value="">Month</option>
                       <option value="01">January</option>
                       <option value="02">February</option>
                       <option value="03">March</option>
                       <option value="04">April</option>
                       <option value="05">May</option>
                       <option value="06">June</option>
                       <option value="07">July</option>
                       <option value="08">August</option>
                       <option value="09">September</option>
                       <option value="10">October</option>
                       <option value="11">November</option>
                       <option value="12">December</option>
                     </select>  
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