<?php
     include_once('db_connection.php');
 if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connection, $_POST["query"]);
	$query = "
	SELECT * FROM facture WHERE invoice_number LIKE '%".$search."%' ";
}
else
{
	$query = "SELECT * FROM facture ORDER BY invoice_number";
}

$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0)
{
?>
	<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Invoice_number</th>
							<th>Date of Creation</th>
							<th>Name of Service</th>
							<th>Amount</th>
							<th>Invoice</th>
						</tr>
 <?php 						
	while($row = mysqli_fetch_array($result))
	{
  
     $service_id = $row["id_service"];
     $query1 = "SELECT nom FROM services WHERE id_service='$service_id' ";
     $query_run1 = mysqli_query($connection, $query1);
     if ($query_run1->num_rows > 0) {
 	 $service = $query_run1->fetch_assoc();
 	 $service_name = $service['nom'];
    }
	 ?>
			<tr>
				<td><?php echo $row['invoice_number']; ?></td>
				<td><?php echo $row["date_creation"]; ?></td>
				<td><?php echo $service_name; ?></td>
				<td><?php echo $row["amount"]; ?></td>
				<td>
				     <form action="department.php" method="POST">
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
	echo 'Data Not Found';
}


?>