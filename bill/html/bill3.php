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

                                if(isset($_POST['facture_id'])) 
                                {
                                     $facture = $_POST['id_value'];
                                }

                             $query1 = "SELECT * FROM facture WHERE id_facture='$facture' ";
                             $query_run1 = mysqli_query($connection, $query1);
                             if ($query_run1->num_rows > 0) {
                                 $facture_info = $query_run1->fetch_assoc();
                                 $client_id = $facture_info['id_client'];
                                 $service_id = $facture_info['id_service'];
                                 $total_amount = $facture_info['amount'];
                                 $invoice_number = $facture_info['invoice_number'];
                                 $date_created = $facture_info['date_of_creation'];
                                 $period = $facture_info['period'];
                                 $qauntity = $facture_info['qauntity'];
                                 $objective= $facture_info['Objective'];


                                }

                             $query2 = "SELECT name_of_service FROM services WHERE service_id='$service_id' ";
                             $query_run2 = mysqli_query($connection, $query2);
                             if ($query_run2->num_rows > 0) {
                                 $service = $query_run2->fetch_assoc();     
                                 $service_name = $service['name_of_service']; 
                                }

                            $query3 = "SELECT * FROM client WHERE id_client='$client_id' ";
                             $query_run3 = mysqli_query($connection, $query3);
                             if ($query_run3->num_rows > 0) {
                                 $client = $query_run3->fetch_assoc();    
                                }


                        ?>  
                        
                        <ul>
                            <li>NAME  : <?php echo "  " .$client['nom']. "  " .$client['prenom']; ?></li>
                            <li>BP  : <?php echo "  " .$client['BP']; ?></li>
                            <li>NIU  : <?php echo "  " .$client['NIU']; ?></li>
                            <li>RC  : <?php echo "  " .$client['RC']; ?></li>
                            <li>Email  : <a href="#"><?php echo "  " .$client['email']; ?></a></li>
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