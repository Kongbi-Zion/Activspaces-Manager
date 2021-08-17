<?php 
   include_once('security.php');
   include_once('db_connection.php');

   //--------------------------- Searching client names -------------------------------
   if (isset($_POST['query'])) 
   {
       $inpText = $_POST['query'];
       $query = "SELECT * FROM client WHERE nom LIKE '%$inpText%' OR prenom LIKE '%" .$inpText. "%'  ";
   }

   $result = $connection->query($query);
   if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()){
         	echo '<a href="#" class="list-group-item list-group-item-action border-1">' .$row["nom"]. " " .$row["prenom"]. '</a>';
         }
    } else {
      echo '<p class="list-group-item border-1">No Record Found</p>';
    }

?>