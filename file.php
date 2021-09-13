<?php
     include_once('security.php'); 
     include_once('db_connection.php');

                              
                               
                                     

                // CONDITIONS TO DRAW THE GRAPH

               
            

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

     

     // Data 2

     //  var data2 = google.visualization.arrayToDataTable([
     //    ["Day", "Amount", { role: "style" } ],

     //  <?php
     //    if(mysqli_num_rows($query_day_run) > 0)
     //  {
     //    while($row = mysqli_fetch_array($query_day_run))
     //      {
     //         echo "['" .$row['time_created']. "'," .$row['amount']. ", 'color: gray'],";
     //      }
     //  }
     // ?>
     //  ]);

     //    var option2 = {    
     //       title: "Company Income",
     //    };
     //    var chart2 = new google.charts.Bar(document.getElementById("columnchart_material"));
     //    chart2.draw(data2, google.charts.Bar.convertOptions(option2));


     


     //Data 3 

     //  var data3 = google.visualization.arrayToDataTable([
     //    ["Day", "Amount", { role: "style" } ],

     //  <?php
     //    if(mysqli_num_rows($range_of_days_run) > 0)
     //  {
     //    while($row = mysqli_fetch_array($range_of_days_run))
     //      {
     //         echo "['" .$row['day']. "'," .$row['amount']. ", 'color: gray'],";
     //      }
     //  }
     // ?>
     //  ]);

     //    var option3 = {    
     //       title: "Company Income",
     //    };
     //    var chart3 = new google.charts.Bar(document.getElementById("columnchart_material"));
     //    chart3.draw(data3, google.charts.Bar.convertOptions(option3));




  }    
     
    </script>


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

     <?php include_once('nav_bar.php'); ?> <br><br><br><br>
     
           
            <div class="breadcome-area">
                <div class="container-fluid">
                     <div class="row">
                         <?php 


try {
    $bdd=new PDO ( 'mysql:host=localhost;dbname=asm1_db','root','' );
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch(Exception $e) {
    die("Error: ". $e->getMessage());
}

$data=$bdd->prepare('SELECT * FROM facture GROUP BY MONTH(date_creation)');
 $data->execute();

$tab_period = [];
$tab_montant = [];
while($row = $data->fetch(PDO::FETCH_ASSOC)){
  extract($row);
  // recuperation du mois
  setlocale(LC_TIME, 'fr_FR', 'fra_FRA');
  $month = strftime("%B",strtotime($date_creation));
  $mois = utf8_encode($month);

  $tab_period[] = $mois;
  $tab_montant[] =$montant;
}
// while($row = $data->fetch(PDO::FETCH_ASSOC)){
//   extract($row);
//   $tab_period[] = $periode;
//   $tab_montant[] = $montant;
// }


$abonnement = $bdd->prepare('SELECT id_abonnement FROM abonnement');
$abonnement->execute();
$nbre_abon = $abonnement->fetchAll();
 $total = count($nbre_abon);


$services = $bdd->prepare('SELECT id_services, montant FROM facture');
$services->execute();
$i=0;
while ($nbre_serv = $services->fetch()){

    $idserv[$i] = (int) $nbre_serv['id_services'];
   $montan[$i] = (int) $nbre_serv['montant'];
    $i = $i + 1;

}
  
   $montant1=0;
    $montant2=0;
    $montant3=0;
     $montant4=0;
      $montant5=0;
       $montant6=0;

       $num=0;

$montant = $montan;
for ($i=0; $i < COUNT($montant) ; $i++) { 
     $num = $num + (int) $montant[$i];
}

for ($i=0; $i < COUNT($montant) ; $i++) { 
    
    if( $idserv[$i]==1 AND $montant[$i] != 0){
        $montant1 += (int) $montant[$i];
    }

     if( $idserv[$i]==2  AND $montant[$i] != 0){
        $montant2 += $montant[$i];
    }

     if( $idserv[$i]==3 AND $montant[$i] != 0){
        $montant3 += $montant[$i];
    }

     if( $idserv[$i]==4 AND $montant[$i] != 0){
        $montant4 += $montant[$i];
    }

     if( $idserv[$i]==5 AND $montant[$i] != 0){
        $montant5 += $montant[$i];
    }

     if( $idserv[$i]==6 AND $montant[$i] != 0){
        $montant6 += $montant[$i];
    }


}

$percentage1 = (int) ($montant1*100/$num);
$percentage2 = (int) ($montant2*100/$num);
$percentage3 = (int) ($montant3*100/$num);
$percentage4 = (int) ($montant4*100/$num);
$percentage5 = (int) ($montant5*100/$num);
$percentage6 = (int) ($montant6*100/$num);  
?>

        <div class="analytics-sparkle-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Co-working Space</h5>
                                <h2>XAF<span class="counter"><?php echo ' '.(int)$montant1; ?></span>
                                <span class="tuition-fees"></span></h2>
                                <span class="text-success"><?php echo $percentage1; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage1; ?>%";> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Salle De Reunion</h5>
                                <h2>XAF<span class="counter"><?php echo ' '.$montant2; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-danger"><?php echo $percentage2; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage2; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content"><br>
                                <h5>Nombre Abonnement</h5>
                                <h2><?php echo ' '. $total ?></h2>
                                <span class="text-danger"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $total ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Hall</h5>
                                <h2>XAF<span class="counter"><?php echo ' '.$montant3; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-info"><?php echo $percentage3; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage3; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top: 1.3rem;">
                        <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>MakerSpace</h5>
                                <h2>XAF<span class="counter"><?php echo ' '. $montant4; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-inverse"><?php echo $percentage4; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage4; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top: 1.3rem;">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Boxes</h5>
                                <h2>XAF<span class="counter"><?php echo ' '.$montant5; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-warning"><?php echo $percentage5; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage5; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top: 1.3rem;">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Formation</h5>
                                <h2>XAF<span class="counter"><?php echo ' '. $montant6; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-info"><?php echo $percentage6; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage6; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top: 1.3rem;">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Total Services</h5>
                                <h2>XAF<span class="counter"></span><?php echo ' '. $num; ?><span class="tuition-fees">Montant</span></h2>
                                
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $num; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
     </div>
            <div class="container" style="width:800px; margin-left: 25rem; margin-top: 5rem; margin-bottom: -5rem;">
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
        if(display == 'month'){
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
    </script>
 <!---------------------------------X---------------- Day graph -----------------X----------------------------> 

 <!------------------------------------------------- Range of days graph --------------------------------------------->  
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
    </script>
 <!---------------------------------X---------------- Range of days graph -----------------X----------------------------> 