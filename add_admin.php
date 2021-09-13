<?php include_once('security.php'); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add New Client | Activspaces Manager (ASM)</title>
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
                            <div class="">
			         <div class="container">
			        <div class="formdiv">

                    <br>
					<div class="card-header py-3">
						<h2 class="m-0 font-weight-bold text-primary">Register Client</h2>
					</div>
					<br><br>
   
			            <form action="php-code.php" method="POST">

			                <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">Nom</label>
					        	<div class="col-sm-7">
					        	<input type="text" name="nom" value="" class="form-control" placeholder="nom" pattern="[A-Za-z\.]{3,15}" title="Eqaul to or more than 3 letters" required>
					            </div>
					        </div>

					        <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">Prenom</label>
					        	<div class="col-sm-7">
					        	<input type="text" name="prenom" value="" class="form-control" placeholder="Prenom" pattern="[A-Za-z\.]{3,15}" title="Eqaul to or more than 3 letters" required>
					            </div>
					        </div>

					         <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">Phone</label>
					        	<div class="col-sm-7">
					        	<input type="number" name="text" value="" class="form-control" placeholder="Phone" pattern="[0-9]{9,12}" title="Between 9 and 12 numbers" required>
					            </div>
					        </div>

					        <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">Email</label>
					        	<div class="col-sm-7">
					        	<input type="email" name="email" value="" class="form-control" placeholder="Email" required>
					            </div>
					        </div>

					         <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">Entreprise</label>
					        	<div class="col-sm-7">
					        	<input type="text" name="entreprise" value="" class="form-control" placeholder="Entreprise" pattern="[A-Za-z\.]{3,15}" title="Eqaul to or more than 3 letters" required>
					            </div>
					        </div>

			                     <?php $date = date('Y-m-d'); ?>


					        
					        	<input type="hidden" name="date_registered" value="<?php echo $date;  ?>" class="form-control">

					         <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">RC</label>
					        	<div class="col-sm-7">
					        	<input type="number" name="RC" value="" class="form-control" placeholder="RC" required>
					            </div>
					        </div>

					        <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">BP</label>
					        	<div class="col-sm-7">
					        	<input type="text" name="BP" value="" class="form-control" placeholder="BP" required>
					            </div>
					        </div>

					         <div class="form-group row">
					        	<label class="col-sm-3 col-form-label">NIU</label>
					        	<div class="col-sm-7">
					        	<input type="text" name="NIU" value="" class="form-control" placeholder="NIU" required>
					            </div>
					        </div>
                            
                            <br><br>
					        <a href="client.php" class="btn btn-danger"> CANCEL</a>
					        <button type="submit" name="add" class="btn btn-primary">Register</button>

					    </form>

				</div>
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
