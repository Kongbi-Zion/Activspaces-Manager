<!doctype html>
<html class="no-js" lang="en">
<?php
  include_once('security.php');
 include_once('db_connection.php');

 $query = "SELECT * FROM services";
 $query_run = mysqli_query($connection, $query);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create Facture</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
     <?php include_once('header_links.php'); ?>
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
                            <br>
                            <h2 class="m-0 font-weight-bold text-primary">Create Client Bill</h2>
                            <br>
                            <div class="">
                            <form action="./bill/html/bill2.php" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Invoice Number</label>
                                <div class="col-sm-7">
                                <input type="text" name="invoice_number" value="" class="form-control" placeholder="Enter_invoice number">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Service</label>
                                <div class="col-sm-7">
                                     <select name="service_name" class="form-control" required="">
                                         <option value="">Select services</option>
                                         <?php 
                                             if(mysqli_num_rows($query_run) > 0){
                                                 while($row = mysqli_fetch_assoc($query_run)) {        
                                         ?>
                                         <option value="<?php echo $row['name_of_service']; ?>"><?php echo $row['name_of_service']; ?></option>
                                         <?php           
                                             }
                                          }
                                         ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Period</label>
                                <div class="col-sm-7">
                                     <select name="period" class="form-control" required="">
                                         <option value="">Select period</option>
                                         <option value="Day">Day</option>
                                         <option value="Week">Week</option>
                                         <option value="Month">Month</option>
                                         <option value="Year">Year</option>
                                    </select>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Qauntity</label>
                                <div class="col-sm-7">
                                <input type="number" name="qauntity" value="" class="form-control" placeholder="Enter Qauntity">
                                </div>
                            </div>

                                 <?php $date = date('d/m/Y'); ?>


                            
                                <input type="hidden" name="date_created" value="<?php echo $date;  ?>" class="form-control">

                             <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Objective</label>
                                <div class="col-sm-7">
                                <input type="text" name="objective" value="" class="form-control" placeholder="Enter objective">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-7">
                                <input type="text" name="search" id="search" value="" class="form-control" placeholder="Select client name">
                                </div>
                            </div> 

                             <div class="col-md-5" style="position: relative;margin-top: -15px;margin-left: 260px;">
                                     <div class="list-group" id="show-list">
                                     </div>
                             </div>

                            <br>
                            <br>

                            <a href="index.php" class="btn btn-danger"> CANCEL</a>
                            <button type="submit" name="create_bill" class="btn btn-primary">Create</button>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('footer.php'); ?>
    </div>

<?php include_once('footer_links.php'); ?>

<script type="text/javascript">
    $(document).ready(function () {
  // Send Search Text to the server
  $("#search").keyup(function () {
    let searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "search_user_facture.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });
});
</script>
</body>
</html>