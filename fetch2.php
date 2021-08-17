<?php
     include_once('db_connection.php');

     if(isset($_POST["query"]))
     {
	     $search = mysqli_real_escape_string($connection, $_POST["query"]);
	     $query = "SELECT * FROM client WHERE nom LIKE '%".$search."%' ";
     }
     else
     {
         $query = "SELECT * FROM client ORDER BY nom";
     }

     $result = mysqli_query($connection, $query);
     if(mysqli_num_rows($result) > 0)
     {

?>
	<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Registration Date</th>
							<th>Facture</th>
						</tr>
 <?php 						
	while($row = mysqli_fetch_array($result))
	{
	 ?>
			<tr>
				<td><?php echo $row['nom'] . ' ' . $row['prenom']; ?></td>
				<td><?php echo $row["phone"]; ?></td>
				<td><?php echo $row["email"]; ?></td>
				<td><?php echo $row["date_enregistrement_client"]; ?></td>
				<td>
				     <form action="department.php" method="POST">
				     	<input type="hidden" name="id_value" value="<?php echo $row['id_client']; ?>">
				     	<button type="submit" name="id_submit" class="btn btn-success">Facture</button>
				     </form>
				</td>
			</tr>

			<!--<a href="department.php?id_client='<?php // echo $row['id_client']; ?>' " class="btn btn-success">Facture</a>-->

<?php
	}
	
}
else
{
	echo 'Data Not Found';
}


?>