<?php include_once('security.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Departments | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('header_links.php'); ?>
    <style type="text/css">
    	 .form_validation{
    	 	 margin-left: 18.4rem; 
    	 	 margin-top: -15px; 
    	 	 margin-bottom: 11px; 
    	 	 color: red;" 
    	 	}
    </style>
</head>

<body>

     <?php include_once('side_bar.php'); ?>

     <?php include_once('nav_bar.php'); ?>
     <br><br><br>
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
												<h2 class="m-0 font-weight-bold text-primary">Edit Client</h2>
											</div>
											<br><br>
											

												<?php

									                  // 	EDDITING DATA

												         include_once('db_connection.php');

									                     if(isset($_GET['id']))
									                     {

										                    $id = $_GET['id'];
										

															$query = "SELECT * FROM client WHERE id_client='$id' ";
															$query_run = mysqli_query($connection, $query);

															foreach ($query_run as $row) 
															{
																?>
									            <form action="php-code.php" method="POST">

									            	<input type="hidden" name="edit_id" value="<?php echo $row['id_client'];  ?>" >

									                <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">Nom</label>
											        	<div class="col-sm-7">
											        	     <input type="text" name="nom" value="<?php echo $row['nom'];  ?>" class="form-control" placeholder="nom">
											            </div>
											        </div>
											        <div class="form_validation"><small>error</small></div>

											        <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">Prenom</label>
											        	<div class="col-sm-7">
											        	<input type="text" name="prenom" value="<?php echo $row['prenom'];  ?>" class="form-control" placeholder="Prenom">
											            </div>
											        </div>

											         <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">Phone</label>
											        	<div class="col-sm-7">
											        	<input type="number" name="phone" value="<?php echo $row['phone'];  ?>" class="form-control" placeholder="Phone">
											            </div>
											        </div>

											        <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">Email</label>
											        	<div class="col-sm-7">
											        	<input type="email" name="email" value="<?php echo $row['email'];  ?>" class="form-control" placeholder="Email">
											            </div>
											        </div>

											         <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">Entreprise</label>
											        	<div class="col-sm-7">
											        	<input type="text" name="entreprise" value="<?php echo $row['entreprise'];  ?>" class="form-control" placeholder="Entreprise">
											            </div>
											        </div>

									                     <?php $date = date('Y-m-d'); ?>


											        
											        	<input type="hidden" name="date_registered" value="<?php echo $date;  ?>" class="form-control">

											         <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">RC</label>
											        	<div class="col-sm-7">
											        	<input type="number" name="RC" value="<?php echo $row['RC'];  ?>" class="form-control" placeholder="RC">
											            </div>
											        </div>

											        <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">BP</label>
											        	<div class="col-sm-7">
											        	<input type="text" name="BP" value="<?php echo $row['BP'];  ?>" class="form-control" placeholder="BP">
											            </div>
											        </div>

											         <div class="form-group row">
											        	<label class="col-sm-3 col-form-label">NIU</label>
											        	<div class="col-sm-7">
											        	<input type="text" name="NIU" value="<?php echo $row['NIU'];  ?>" class="form-control" placeholder="NIU">
											            </div>
											        </div>

											        <a href="client.php" class="btn btn-danger"> CANCEL</a>
											        <button type="submit" name="updatebtn" class="btn btn-primary">Update</button>

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


