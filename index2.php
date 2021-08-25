<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home ActivSpaces</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('header_links.php'); ?>
</head>

<body>
    <?php include_once('side_bar.php'); ?>
     <?php include_once('nav_bar.php'); ?>
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Search..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start the  app applcation -->
        <?php 


try {
    $bdd=new PDO ( 'mysql:host=localhost;dbname=system_db','root','' );
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch(Exception $e) {
    die("Error: ". $e->getMessage());
}

$data=$bdd->prepare('SELECT * FROM facture
    GROUP BY MONTH(date_creation)');
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

/*  $tab_montant = [];
   while($montants = $montant->fetch(PDO::FETCH_ASSOC)) {
                  $tab_montant[] = $montants;
     }
var_dump($tab_montant);
exit;



/*
$connect=mysqli_connect("localhost", "root", "","asm1_db");

$query="SELECT * FROM  facture";
$result= mysqli_query($connect, $query);


while($row= mysqli_fetch_array($result)){
         $montant=$montant.'""'.$row['montant'].'",';
}

$montant=trim($montant,",");
*/
  
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
                            <div class="analytics-content">
                                <h5>Nombre Abonnement</h5>
                                <h2><?php echo ' '. $total ?></h2>
                                <span class="text-danger"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $total ?>%;"> <span class="sr-only">0% Complete</span> </div>
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

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
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
                    
                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Boxes</h5>
                                <h2>XAF<span class="counter"><?php echo ' '.$montant5; ?></span> <span class="tuition-fees">Montant</span></h2>
                                <span class="text-info"><?php echo $percentage5; ?>%</span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage5; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
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

                     <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                            <div class="analytics-content">
                                <h5>Total Services</h5>
                                <h2>XAF<span class="counter"></span><?php echo ' '. $num; ?><span class="tuition-fees">Montant</span></h2>
                                
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ' '. $num; ?>%;"> <span class="sr-only">0% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        

                    
        
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-15 col-sm-15 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-12 col-md-9 col-sm-7 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b>ActivSpaces Earnings</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                            <p>All Earnings are in hundred-of-thousand XCF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline cus-product-sl-rp">
                                
                               
                              
                                <li>
                                    <h5><i class="fa fa-circle" style="color: skyblue;"></i>Mensuel</h5>
                                </li>
                            </ul>
                           <!--  <div id="chart" style="width: :100%; height: 60vh; border: 1px solid #555652; background: #222; margin-top: 10px;" ></div> -->
                           <canvas id="chart" ></canvas>


                        </div>
                    </div>
                </div>
            </div>




                    

                    
      
                 
        





      
   
        
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2020 ASM by ActivSpaces intern<a href="https://colorlib.com/wp/templates/"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery
        ============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
        ============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
        ============================================ -->
    <script src="js/morrisjs/raphael-min.js"></script>
    <script src="js/morrisjs/morris.js"></script>
    <script src="js/morrisjs/morris-active.js"></script>
    <script src="//cdnjs.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>
            var ctx=document.getElementById("chart").getContext('2d');

        Chart.defaults.global.defaultFontSize = 16;
        Chart.defaults.global.defaultFontColor = '#777';

        var mychart = new Chart(ctx, {
            type: "line",
            data: {
                labels:<?php echo json_encode($tab_period);?>,
                datasets:[{
                  label:'Montant',
                  data:<?php echo json_encode($tab_montant); ?>,
                  backgroundColor:'skyblue',
                  borderColor:'#777',
                  borderWidth:1,
                  hoverBorderWidth: 3,
                  hoverBorderColor: '#000'

                }]
            },
            options: {
              title: {
                display: true,
                text: 'Mon titre du graphe',
                fontSize: 30
              },
              legend: {
                position: 'top',
                fontColor: 'black'
              },
              tooltips: {
                enabled: true
            }
        }
    });
    </script>

    <!-- morrisjs JS
        ============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
        ============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
        ============================================ -->
    
</body>

</html>