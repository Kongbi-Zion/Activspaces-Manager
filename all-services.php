<?php include_once('security.php'); ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Services | ActivSpaces Manager</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

                                <?php

                                  if(isset($_SESSION['success']) && $_SESSION['success'] !='')
                                 {
                                    echo '<h2 class="pd-setting text-white bg-success" style="margin-left: 4.5rem;">'. $_SESSION['success']. '</h2>';
                                    unset($_SESSION['success']);
                                 }

                                 if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                                 {
                                    echo '<h2 class="bg-danger text-white">'. $_SESSION['status']. '</h2>';
                                    unset($_SESSION['status']);
                                 }
                            ?>
        <div class="courses-area">
            <div class="container-fluid">
                <div class="row">

                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap drp-lst">
                             <h2 class="m-0 font-weight-bold text-primary">List of Services offered by Activspaces</h2>
                              <div class="add-product">
                                <a type="button" href="add-service.php" class="pd-setting">Add new Service</a></h4>
                              </div>
                        </div>
                     </div>

                    <?php

                         include_once('db_connection.php');
                       $query = "SELECT * FROM services";
                       $query_run = mysqli_query($connection, $query);
         
                         if(mysqli_num_rows($query_run) > 0){
                             while($row = mysqli_fetch_assoc($query_run)) {        
                    ?>
                    <div id="Cow" class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="courses-inner res-mg-b-30" style=" margin-bottom: 1.5rem;" >
                            <div class="courses-title">
                                <a href="#"><img class="img1" src="img/courses/<?php echo $row['service_image']; ?>" alt=""></a>
                                <h2><?php echo $row['name_of_service']; ?></h2>
                            </div>
                            <div class="courses-alaltic">
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-money"></i></span> <b><?php echo $row['daily_price'].' Xaf'.'/'.'jours,'. ' '. $row['weekly_price'].' Xaf'.'/'.'semaine,'. ' '. $row['monthly_price'].' Xaf'.'/'.'mois,'. ' '?></b></span>
                            </div>
                            <div class="course-des">
                                <p><span><i class="fa fa-clock"></i></span> <b>Durée d'abonnement:</b><?php echo $row['Subscription_term'] ?></p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Responsable:</b><?php echo $row['manager'] ?></p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Capacité:</b><?php echo $row['capacity']. ' ' ?> places </p>
                            </div>

                            <!-- Modal -->
                                <div class="modal fade" id="<?php echo $row['service_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Service</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         Are you sure you want to permanently delete this service?
                                      </div>
                                      <div class="modal-footer">
                                        <form action="php-code.php" method="POST">
                                            <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" name="delete_service" class="btn btn-primary">Yes</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                            <div class="product-buttons">
                                 <a href="edit_service.php?id=<?php echo $row['service_id']; ?> " class="btn btn-primary">Modifier</a>
                                 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $row['service_id']; ?>">
                                      Supprimer
                            </button>

                        </div>
                        </div>  
                    </div>
                    

                                            <?php           
                                             }
                                          }
                                         ?>
                </div>

            </div>
        
        </div>
        <br><br><br><br>
        
        <?php include_once('footer.php'); ?>
    </div>

    <?php include_once('footer_links.php'); ?>     
</body>

</html>