<?php include_once('security.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Service | Activspaces Manager (ASM)</title>
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
                                                <input type="text" name="search_text" placeholder="Search Client" id="search_text" class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Edit Service</span>
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
                               <?php
                                 if(isset($_SESSION['status_img']) && $_SESSION['status_img'] !='')
                                 {
                                    echo '<h2 class="bg-danger text-white">'. $_SESSION['status_img']. '</h2>';
                                    unset($_SESSION['status_img']);
                                 }

                            ?>
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap drp-lst">
                            <div class="">
                               <div class="container-fluid">

            
                           <div class="container">

                          <div class="formdiv">

                      <div class="card-header py-3">
                        <h2 class="m-0 font-weight-bold text-primary">Edit Service</h2>
                      </div>
                      <br><br>
                      

                        <?php

                                    //  EDDITING DATA

                                  include_once('db_connection.php');
                                 
                                 if(isset($_GET['id'])){
                                  $id = $_GET['id'];

                              $query = "SELECT * FROM services WHERE service_id='$id' ";
                              $query_run = mysqli_query($connection, $query);

                              foreach ($query_run as $row) 
                              {
                                ?>
                              <form action="php-code.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="edit_id" value="<?php echo $row['service_id'];  ?>" >

                                  <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-7">
                                <input type="text" name="nom" value="<?php echo $row['name_of_service'];  ?>" class="form-control" placeholder="nom" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Daily Price</label>
                                <div class="col-sm-7">
                                <input type="number" name="daily" value="<?php echo $row['daily_price'];  ?>" class="form-control" placeholder="Daily Price" required>
                                  </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Weekly Price</label>
                                <div class="col-sm-7">
                                <input type="number" name="weekly" value="<?php echo $row['weekly_price'];  ?>" class="form-control" placeholder="Weekly Price" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Monthly Price</label>
                                <div class="col-sm-7">
                                <input type="number" name="monthly" value="<?php echo $row['monthly_price'];  ?>" class="form-control" placeholder="Monthly Price" required>
                                  </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Subscription term</label>
                                <div class="col-sm-7">
                                <input type="text" name="term" value="<?php echo $row['Subscription_term'];  ?>" class="form-control" placeholder="Subscription term" pattern="[A-Za-z\.]{3,15}" title="Eqaul to or more than 3 letters" required>
                                  </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Manager</label>
                                <div class="col-sm-7">
                                <input type="text" name="manager" value="<?php echo $row['manager'];  ?>" class="form-control" placeholder="Manager" pattern="[A-Za-z\.]{3,15}" title="Eqaul to or more than 3 letters" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Capacity</label>
                                <div class="col-sm-7">
                                <input type="number" name="capacity" value="<?php echo $row['capacity'];  ?>" class="form-control" placeholder="Capacity" required>
                                  </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Select service image(optional)</label>
                                <div class="col-sm-7">
                                   <input type="file" name="file" class="form-control" placeholder="Capacity">
                                </div>
                              </div><br>


      
                              <a href="all-services.php" class="btn btn-danger"> CANCEL</a>
                              <button type="submit" name="serviceupdatebtn" class="btn btn-primary">Update</button>

                          </form>


                                   <?php
                            
                                       
                                   }
                               }    
                        ?>


                      
                    </div>
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


