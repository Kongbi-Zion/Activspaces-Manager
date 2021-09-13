<?php
include_once('security.php'); 
ob_start();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Invoice List For client | Activspaces Manager (ASM)</title>
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
                            <div class="breadcome-list single-page-breadcome">
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
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Departments</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap drp-lst">
                            <?php

                                 if(isset($_POST['id_submit'])){
                                     $client_id = $_POST['id_value'];
                                 }

                                     include_once('db_connection.php');
                                     $query = "SELECT nom, prenom FROM client WHERE id_client ='$client_id' ";
                                    $query_run = mysqli_query($connection, $query);
                                    if ($query_run->num_rows > 0) {
                                     $client = $query_run->fetch_assoc();
                                     $nom = $client['nom'];
                                     $prenom = $client['prenom'];
                                    }


                                     $query2 = "SELECT * FROM facture WHERE id_client ='$client_id' ";
                                    $query_run2 = mysqli_query($connection, $query2);
                                    if ($query_run2->num_rows > 0) {
                                
                                ?>
                                <br>
                                <h2 class="m-0 font-weight-bold text-primary">Invoice List For  <?php echo '  ' .$nom. '  '.$prenom; ?></h2>
                                <br>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>Invoice_number</th>
                                        <th>Date of Creation</th>
                                        <th>Name of service</th>
                                        <th>Amount</th>
                                        <th>Invoice</th>

                                    <?php                       
                                        while($row = mysqli_fetch_array($query_run2))
                                        {
                                      
                                         $service_id = $row["id_service"];
                                         $query1 = "SELECT name_of_service FROM services WHERE service_id='$service_id' ";
                                         $query_run1 = mysqli_query($connection, $query1);
                                         if ($query_run1->num_rows > 0) {
                                         $service = $query_run1->fetch_assoc();
                                         $service_name = $service['name_of_service'];
                                        }
                                    ?>

                                   <tr>
                                         <td><?php echo $row['invoice_number']; ?></td>
                                         <td><?php echo $row["date_of_creation"]; ?></td>
                                         <td><?php echo $service_name; ?></td>
                                         <td><?php echo $row["amount"]; ?></td>
                                         <td>
                                             <form action="./bill/html/bill3.php" method="POST">
                                                 <input type="hidden" name="id_value" value="<?php echo $row['id_facture']; ?>">
                                                 <button type="submit" name="facture_id" class="btn btn-primary">View Invoice</button>
                                             </form>
                                         </td>
                                  </tr>


                              <?php  
                                }
    
                              }
                            else
                            {
                                 $_SESSION['status'] =$nom.'  '.$prenom.'  '.'has Not been offered an invoice';
                                 header('Location: history.php');
                                 ob_end_fluch();
                            }
                            ?>
                        </table>
                            </div>
                            <div class="custom-pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('footer.php'); ?>
    </div>

   <?php include_once('footer_links.php'); ?>
</body>

</html>