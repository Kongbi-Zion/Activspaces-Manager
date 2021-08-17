<!-- Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         Are you sure you want to permanently delete this client?
      </div>
      <div class="modal-footer">
      	<form action="php-code.php" method="POST">
      		<input type="hidden" name="client_id" id="client_id">
      		 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" name="delete_id" class="btn btn-primary">Yes</button>
      	</form>
      </div>
    </div>
  </div>
</div>

<?php
     include_once('db_connection.php');
$output = '';
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
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Enterprise</th>
							<th>Registration_date</th>
							<th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
			     <td hidden>' .$row['id_client']. '</td>
				<td>' .$row['nom'] . ' ' . $row['prenom'].'</td>
				<td>'.$row["phone"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["entreprise"].'</td>
				<td>'.$row["date_enregistrement_client"].'</td>
				<td>
				  <a href="register_edit.php?id= ' .$row['id_client'] .' " class="btn btn-primary">EDIT</a>
                   <button class="btn btn-danger delete_btn">DELETE</button>
				</td>
			</tr>';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>

<script>
     $(document).ready(function(){
        
         $('.delete_btn').on('click', function() {
              $('#deletemodal').modal('show');

              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function(){
                return $(this).text();
                
              }).get();

              console.log(data);

              $('#client_id').val(data[0]);
        });
     });
 </script>