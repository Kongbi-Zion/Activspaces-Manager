<?php include_once('security.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>List Of Subscriptions | Activspaces Manager (ASM)</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('header_links.php'); ?>
</head>

<body>
   <?php include_once('side_bar.php'); ?>
   <?php include_once('nav_bar.php'); ?>

        <br><br><br><br>
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap drp-lst">
                            <h2 class="m-0 font-weight-bold text-primary">Liste des abonnements</h2>
                            <div class="add-product">
                                <a href="add-department.php">Ajouter un abonnement</a>
                            </div>
                            <div class="asset-inner">

                                    <?php
                                         
                                    try{
                                        $connection = new PDO("mysql:host=localhost;dbname=activspace_database", "root", "");
                                    }
                                    catch(Exception $e){
                                        die('Erreur : '.$e->getMessage());
                                    }

                                    ?>

                                <table>
                                <?php
                                    $query_run = $connection->query("SELECT name_of_service FROM services") or die(print_r($connection->errorInfo()));
                                    echo "<tr><th>Période d'abonnement</th>";
                                    while ($query = $query_run->fetch()) { 
                                        echo '<th>' .$query['name_of_service']. '</th>';
                                    }
                                    echo '<th>stting</th></tr>';
                                    
                                    $query_run->closeCursor();

                                    if(isset($_POST['bill_submitbtn'])){
                                        $reponse4 = $connection->prepare('ALTER TABLE services ADD COLUMN :periode INT(100) NULL') or die(print_r( $connection->errorInfo()));
                                        $reponse4->execute(array(
                                                'periode' => $_POST['periode']
                                            ));
                                            //echo 'Bonjour' .$_POST['periode'];
                                        $reponse4->closeCursor();
                                    }
                                     $query_run = $connection->query("SELECT daily_price, weekly_price, monthly_price FROM services") or die(print_r($connection->errorInfo()));
                                     $i = 0;
                                     while($query = $query_run->fetch()){
                                        $row['daily_price'][$i] = $query['daily_price'];
                                        $row['weekly_price'][$i] = $query['weekly_price'];
                                        $row['monthly_price'][$i] = $query['monthly_price'];
                                        $i = $i + 1;
                                     }
                                     $query_run->closeCursor();
                                     echo '<tr>
                                        <td>Mensuelle</td>';
                                        for($i=0; $i< COUNT($row["monthly_price"]); $i++){
                                            echo '<td>' .$row["monthly_price"][$i]. '</td>';} 
                                    echo '<td>
                                            <button data-toggle="tooltip" title="Modifier" class="pd-setting-ed"><a href="edit-department.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                            <button data-toggle="tooltip" title="Supprimer" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hebdomadaire</td>';
                                        for($i=0; $i< COUNT($row["weekly_price"]); $i++){
                                            echo '<td>' .$row["weekly_price"][$i]. '</td>';}
                                        echo '<td>
                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="edit-department.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Journalière</td>';
                                        for($i=0; $i< COUNT($row["daily_price"]); $i++){
                                            echo '<td>' .$row["daily_price"][$i]. '</td>';}
                                        echo '<td>
                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><a href="edit-department.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></button>
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>';
                                    ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br>

        <?php include_once('footer.php'); ?>
    </div>
  
    <?php include_once('footer_links.php'); ?>
</body>
</html>