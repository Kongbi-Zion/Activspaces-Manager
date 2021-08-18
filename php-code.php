<?php
session_start();

     include_once('db_connection.php');

     //-------------------------- User login verification -------------------------------
     if(isset($_POST['login_btn']))
     {
     	 $username_login = $_POST['username'];
     	 $password_login = $_POST['password'];
     
         $query = "SELECT * FROM admin WHERE admin_name='$username_login' AND password='$password_login' ";
         $query_run = mysqli_query($connection, $query);

         if(mysqli_fetch_array($query_run))
         {
     	     $_SESSION['username'] = $username_login;
     	     header('Location: index.php');
         }
         else
        {
     	     $_SESSION['status'] = 'User Name or Password is Invalide';
      	     header('Location: login.php');
         }
     }



    //-------------------------- Logout From App ----------------------------
     if(isset($_POST['logout_btn']))
     {
     	 session_destroy();
     	 unset($_SESSION['username']);
     	 header('Location: login.php');
     }


    //--------------------------- Add Client -----------------------------------
     if(isset($_POST['add'])) 
     {
    	 $id = $_POST['edit_id'];
	     $nom = $_POST['nom'];
	     $prenom = $_POST['prenom'];
	     $phone = $_POST['phone'];
	     $email = $_POST['email'];
	     $entreprise = $_POST['entreprise'];
	     $date_registered = $_POST['date_registered'];
	     $RC = $_POST['RC'];
	     $BP = $_POST['BP'];
	     $NIU = $_POST['NIU'];

	     $query = "INSERT INTO client (nom,prenom,phone,email,entreprise,date_enregistrement_client,RC,BP,NIU) VALUES ('$nom','$prenom','$phone','$email','$entreprise','$date_registered','$RC','$BP','$NIU')";
		 $query_run = mysqli_query($connection, $query);

		if($query_run)
		{
			 echo  "saved";
			 $_SESSION['success'] = "New client has been Added";
			 header('Location: client.php');
		}
		else
		{
			 $_SESSION['status'] = "New client has NOT been Added";
			 header('Location: client.php');
		}
     }

    
    //---------------------------------- Add New Service --------------------------------
     if(isset($_POST['add_service']))
     {
	     $nom = $_POST['nom'];
	     $daily = $_POST['daily'];
	     $weekly = $_POST['weekly'];
	     $monthly = $_POST['monthly'];
	     $term = $_POST['term'];
	     $manager = $_POST['manager'];
	     $capacity = $_POST['capacity'];
	     $filename = $_FILES['file']['name'];

	      if($filename !='')
	     {
	     	 $fileTempName = $_FILES['file']['tmp_name'];
	         $fileExt = explode('.', $filename);
	         $fileActualExt = strtolower(end($fileExt));
	         $fileNewName = uniqid('', true).".".$fileActualExt;
             $allowed = array('jpg', 'jpeg', 'png', 'pdf');

             if(in_array($fileActualExt, $allowed))
             {
             	 $fileDestination = 'img/courses/'.$fileNewName;
                 move_uploaded_file($fileTempName, $fileDestination);
                 $service_image = $fileNewName;

                  $query = "INSERT INTO services (name_of_service, daily_price, weekly_price, monthly_price, Subscription_term, manager, capacity, service_image) VALUES ('$nom', '$daily', '$weekly', '$monthly', '$term', '$manager', '$capacity', '$service_image')";
	             $query_run = mysqli_query($connection, $query);
	         }
	         else{

    	         $_SESSION['status_img'] = "The file choosen was not an image";
		         header('Location: add-service.php');
             }
	     
         }
         else
         {
         	$service_image = 1;
         	$query2 = "INSERT INTO services (name_of_service, daily_price, weekly_price, monthly_price, Subscription_term, manager, capacity, service_image) VALUES ('$nom', '$daily', '$weekly', '$monthly', '$term', '$manager', '$capacity', '$service_image')";
	         $query_run2 = mysqli_query($connection, $query2);
         }

         
	     if($query_run OR $query_run2)
	     {
		     $_SESSION['success'] = "New Service has been Added";
		     header('Location: all-services.php');
	     }
	     else
	     {
             $_SESSION['status'] = "Service has NOT been Added";
		     header('Location: all-services.php');		
	     }
     }
     

     //------------------------- Update Client Info ---------------------
     if(isset($_POST['updatebtn']))
     {
	     $id = $_POST['edit_id'];
	     $nom = $_POST['nom'];
	     $prenom = $_POST['prenom'];
	     $phone = $_POST['phone'];
	     $email = $_POST['email'];
	     $entreprise = $_POST['entreprise'];
	     $date_registered = $_POST['date_registered'];
	     $RC = $_POST['RC'];
	     $BP = $_POST['BP'];
	     $NIU = $_POST['NIU'];

	     $query = "UPDATE client SET nom='$nom', prenom='$prenom', phone='$phone', email='$email', entreprise='$entreprise', date_enregistrement_client='$date_registered', RC='$RC', BP='$BP', NIU='$NIU' WHERE id_client='$id' ";
	     $query_run = mysqli_query($connection, $query);

	     if($query_run)
	     {
	         $_SESSION['success'] = "Client data has been Updated";
		     header('Location: client.php');
	     }
	     else
	     {
             $_SESSION['status'] = "Client data has NOT been Updated";
		     header('Location: client.php');		
	     }
     }



     //------------------------------- Service update-----------------------------
     if(isset($_POST['serviceupdatebtn']))
     {
	     $id = $_POST['edit_id'];
	     $nom = $_POST['nom'];
	     $daily = $_POST['daily'];
	     $weekly = $_POST['weekly'];
	     $monthly = $_POST['monthly'];
	     $term = $_POST['term'];
	     $manager = $_POST['manager'];
	     $capacity = $_POST['capacity'];
	     $filename = $_FILES['file']['name'];

	     if($filename !='')
	     {
	     	 $fileTempName = $_FILES['file']['tmp_name'];
	         $fileExt = explode('.', $filename);
	         $fileActualExt = strtolower(end($fileExt));
	         $fileNewName = uniqid('', true).".".$fileActualExt;
             $allowed = array('jpg', 'jpeg', 'png', 'pdf');

             if(in_array($fileActualExt, $allowed))
             {
             	 $fileDestination = 'img/courses/'.$fileNewName;
                 move_uploaded_file($fileTempName, $fileDestination);
                 $service_image = $fileNewName;

                 $query = "UPDATE services SET name_of_service='$nom', daily_price='$daily', weekly_price='$weekly', monthly_price='$monthly', Subscription_term='$term', manager='$manager', capacity='$capacity', service_image='$service_image' WHERE service_id='$id' ";
	             $query_run = mysqli_query($connection, $query);

	         }
	         else{

    	         $_SESSION['status_img'] = "The file choosen was not an image";
		         header('Location: edit_service.php');
             }
	     
         }
         else
         {
         	 $query = "SELECT service_image FROM services WHERE service_id='$id' ";
             $query_run = mysqli_query($connection, $query);
             if ($query_run->num_rows > 0) 
             {
                 $img = $query_run->fetch_assoc();
                 $simg = $img['service_image'];
                 $service_image = $simg;
             }

             $query2 = "UPDATE services SET name_of_service='$nom', daily_price='$daily', weekly_price='$weekly', monthly_price='$monthly', Subscription_term='$term', manager='$manager', capacity='$capacity', service_image='$service_image' WHERE service_id='$id' ";
	         $query_run2 = mysqli_query($connection, $query2);

         }
        
	     if($query_run OR $query_run2)
	     {
		     $_SESSION['success'] = "Service data has been Updated";
		     header('Location: all-services.php');
	     }
	     else
	     {
             $_SESSION['status'] = "Service data has NOT been Updated";
		     header('Location: all-services.php');		
	     }
     }



     //------------------------------- Delete Client -----------------------------
     if(isset($_POST['delete_id']))
     {
	     $id = $_POST['client_id'];

	     $query = "DELETE FROM client WHERE id_client='$id' ";
	     $query_run = mysqli_query($connection, $query);

	     $query2 = "DELETE FROM facture WHERE id_client='$id' ";
	     $query_run2 = mysqli_query($connection, $query2);

	     if($query_run AND $query_run2)
	     {
             $_SESSION['success'] = "Client data has been deleted";
             header("Location: client.php");
	     }
	     else
	     {
             $_SESSION['status'] = "Client data has not been deleted";
             header("Location: client.php");
	     }
     }

     //------------------------------- Delete Service -----------------------------
     if(isset($_POST['delete_service']))
     {
	     $id = $_POST['service_id'];

	     $query = "DELETE FROM services WHERE service_id='$id' ";
	     $query_run = mysqli_query($connection, $query);

	     if($query_run)
	     {
             $_SESSION['success'] = "Service data has been deleted";
             header("Location: all-services.php");
	     }
	     else
	     {
             $_SESSION['status'] = "Service data has not been deleted";
             header("Location: all-services.php");
	     }
     }


?>






































