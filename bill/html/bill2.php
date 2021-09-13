<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>

    <!--------------------------------- Flexboxgrid -------------------------------->
    <link rel="stylesheet" href="../css/flexboxgrid.css">
    <!-------------------------- Bootstrap --------------------------------->
    <link rel="stylesheet" href="../html/bootstrap/css/bootstrap.min.css">

    <!-------------------------- Stylesheet -------------------------------->
    <link rel="stylesheet" href="../css/stylesheet.css">

    <script src="jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css" media="print">

</head>
<body>
<?php
?>
<!------------------------------------------- header --------------------------------------->
    <header>
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 image">
                    <img class="float" src="../img/activspaces header.png" alt="ActivSpaces logo" width="400px" height="200px">
                </div>
    
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <ul>
                        <li><span class="invoice">INVOICE</span></li>
                        <li><small><span class="color-gray">ACTIVSPACES DOUALA</span></small></li>
                        <li><strong>N<sup>o</sup> CT : M071212289235F</strong></li>
                        <li><strong>RC : 158/37/2012</strong></li>
                        <li><strong>Immeuble Appstech, Akwa | Douala Cameroun</strong></li>
                        <li><strong>Telephone : +237 652280932</strong></li>
                        <li><strong><a href="info@activspaces.com">Email : info@activspaces.com</a></strong></li>
                    </ul>
                </div>
                
            </div>
        </div>            
        
    </header>
    <br>
<!----------------------------x-------------- header -------------------x------------------->

<!--------------------------------------------- Main section -------------------------------------->
    <main>
        <!--------------------------------Section Client Info --------------------------------->
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                        <strong><span class="color-gray">BILL TO</span></strong><br><br>

                        <?php

                             include_once('../../db_connection.php');

                          // Getting values from create facture page

                                if(isset($_POST['create_bill'])) 
                            {
                                $invoice_number = $_POST['invoice_number'];
                                $name_total = $_POST['search'];
                                $objective = $_POST['objective'];
                                $service_name = $_POST['service_name'];
                                $period = $_POST['period'];
                                $qauntity = $_POST['qauntity'];
                                $date_created= $_POST['date_created'];
                                $position = strpos($name_total, ' ');
                                $nom = substr($name_total, 0,$position);
                                $prenom = substr($name_total, $position+1);
                                $time_created = $_POST['time_created'];


                             $query1 = "SELECT * FROM client WHERE nom='$nom' AND prenom='$prenom' ";
                             $query_run1 = mysqli_query($connection, $query1);
                             if ($query_run1->num_rows > 0) {
                                 $client = $query_run1->fetch_assoc();
                                 $client_id = $client['id_client'];
                                }

                             $query2 = "SELECT * FROM services WHERE name_of_service='$service_name' ";
                             $query_run2 = mysqli_query($connection, $query2);
                             if ($query_run2->num_rows > 0) {
                                 $service = $query_run2->fetch_assoc();     
                                 $service_id = $service['service_id']; 
                                }


                            if($period == 'Day'){
                                 $total_amount = $service['daily_price'] * $qauntity;
                             }
                            if($period == 'Week'){
                                 $total_amount = $service['weekly_price'] * $qauntity;
                             }
                            if($period == 'Month'){
                                 $total_amount = $service['monthly_price'] * $qauntity;
                             }

                             // inserting in to amount per day column 
                              $todays_date = date('d/m/Y'); 
                              $amount_per_day = "SELECT amount FROM total_amount_per_day WHERE day='$todays_date' ";
                              $amount_per_day_run = mysqli_query($connection, $amount_per_day);
                               if ($amount_per_day_run->num_rows > 0) {
                                 $amount = $amount_per_day_run->fetch_assoc();     
                                 $new_amount = $amount['amount']; 
                                 $fianl_day_amount = $new_amount + $total_amount;

                                 $query_update_amount = "UPDATE total_amount_per_day SET day='$todays_date', amount='$fianl_day_amount' WHERE day='$todays_date' ";
                                 $query_update_amount_run = mysqli_query($connection, $query_update_amount);
                                }
                                else{
                                     $query_insert_amount = "INSERT INTO total_amount_per_day (day,amount) VALUES ('$todays_date','$total_amount')";
                                     $query_insert_amount_run = mysqli_query($connection, $query_insert_amount);
                                }

                             $query3 = "INSERT INTO facture (invoice_number,date_of_creation,id_client,id_service,period,qauntity,amount,Objective,time_created) VALUES ('$invoice_number','$date_created','$client_id','$service_id','$period','$qauntity','$total_amount', '$objective', '$time_created')";
                                    $query_run3 = mysqli_query($connection, $query3);

                            }


                ?>  
                        
                        <ul>
                            <li>NAME  : <?php echo "  " .$name_total; ?></li>
                            <li>BP  : <?php echo "  " .$client['BP']; ?></li>
                            <li>NIU  : <?php echo "  " .$client['NIU']; ?></li>
                            <li>RC  : <?php echo "  " .$client['RC']; ?></li>
                            <li>Email  : <?php echo "  " .$client['email']; ?></li>
                        </ul>
                    </div>
        
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                        <br><br>

                        <ul>
                            <li>Invoice Number : <?php echo "  " .$invoice_number; ?></li><br>
                            <li>Invoice Date : <?php echo "  " .$date_created; ?></li><br>
                            <li>Amount due(XAF) : <?php echo "  " .$total_amount; ?></li>
                        </ul>

                    </div>
                </div>
            </div>
            <p style="margin: 2rem;"><strong style="padding-left: 5rem;">Object: <?php echo "  " .$objective; ?></strong></p>
        </section>
        <!---------------------x-----------Section Client Info --------------x------------------->


        <!--------------------------------Section table Info --------------------------------->

        <table class="table table-bordered container">
            <thead class="thead">
              <tr>
                <th class="bg-primary" scope="col">PRODUCT</th>
                <th class="bg-primary" scope="col">DESCRIPTION</th>
                <th class="bg-primary" scope="col">QUANTITY</th>
                <th class="bg-primary" scope="col">VAT%</th>
                <th class="bg-primary" scope="col">COST</th>
                <th class="bg-primary" scope="col">Amount Excl.VAT</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"><?php echo $service_name ?></th>
                <td><?php echo $period; ?></td>
                <td><?php echo $qauntity; ?></td>
                <td>0</td>
                <td><?php echo $total_amount; ?></td>
                <td><?php echo $total_amount; ?></td>
              </tr>
              <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td>Total VAT</td>
                <td>0</td>
              </tr>

              <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td><strong>Amount due(XAF) : </strong></td>
                <td><?php echo $total_amount; ?></td>
              </tr>
            </tbody>
          </table>

          <section class="condition">
              <div class="container">
                <div><p>Condition de paiement:</p></div>
                <div><p>Mode de paiement: espèces</p></div>
              </div>
          </section>
          
            <br><br>  

            <div align="center">
                <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
            </div>

          <hr>
        <!---------------------x-----------Section bable Info --------------x------------------->

        <!--------------------------------Section footer Info --------------------------------->

        <footer>
            <div class="container">
                <div class="row">
    
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                        <ul>
                            <li><strong>Our ECOBANK Acount</strong></li>
                            <li><small>Bank code: 10029</small></li>
                            <li><small>Branch code: 26022</small></li>
                            <li><small>Account number: 01323076101</small></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                        <ul>
                            <li><strong>RIB key: 68</strong></li>
                            <li><small>IBAN CODE:  CM21 10029 26022 01323076101 68</small></li>
                            <li><small>SWIFT code: ECOCCMCX</small></li>
                        </ul>
                    </div>
                    
                </div>
            </div>          
        </footer>
        <!---------------------x-----------Section footer Info --------------x------------------->
    </main>
<!---------------------------x------------------ Main section ----------------x---------------------->
<!------------------------------ Jquery -------------------------->
    <script src="./jquery.js"></script>
    <!------------------------------ js ---------------------------->
    <script src="../html/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>