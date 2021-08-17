<?php include_once('security.php'); ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   <?php include_once('header_links.php'); ?>
</head>

<body>

    <?php include_once('side_bar.php'); ?>

    <?php include_once('nav_bar.php'); ?>

        <br><br><br><br>        
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Ajouter un abonnement</a></li>    
                            </ul>
                            </div>
                            <div class="product-status-wrap drp-lst">
                            <div class="asset-inner">
                                <table>
                                <?php
                                    try{
                                        $connection = new PDO("mysql:host=localhost;dbname=system_db", "root", "");
                                    }
                                    catch(Exception $e){
                                        die('Erreur : '.$e->getMessage());
                                    }


                                    $query_run = $connection->query("SELECT nom FROM services") or die(print_r($connection->errorInfo()));
                                    echo "<tr><th>Période d'abonnement</th>";
                                    $name[0] = "periode";
                                    $i = 1;
                                    while ($query = $query_run->fetch()) { 
                                        echo '<th>' .$query['nom']. '</th>';
                                        $name[$i] = $query['nom'];
                                        $i += 1;
                                    }
                                    echo '</tr>';
                                    
                                    $query_run->closeCursor();
                                    ?>
                                    <form action='departments.php' method='post'>
                                     <tr>
                                     <?PhP 
                                     $placeholder[0] = "Période d'abonnement";
                                     for ($i=0; $i < COUNT($name); $i++) {
                                        $placeholder[$i+1] = 'prix';
                                         echo '<td>
                                         <div class="form-group">
                                             <input name=' .$name[$i]. ' type="text" class="form-control" placeholder=' .$placeholder[$i]. '>
                                         </div>
                                     </td>';
                                     }
                                     ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <input type="submit" name="bill_submitbtn" class="btn btn-primary waves-effect waves-light" value="Ajouter">
                                </div>
                            </div>
                        </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br><br><br>
       
       <?php include_once('footer.php'); ?>
    </div>

<?php include_once('footer_links.php'); ?>
</body>

</html>