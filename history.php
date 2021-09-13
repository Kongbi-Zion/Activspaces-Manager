<?php include_once('security.php'); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
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
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap drp-lst">
                              <h2 class="m-0 font-weight-bold text-primary">List Of Registered Clients / Their invoice</h2>
                             <?php 

                                  if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                                 {
                                    echo '<h2 class="bg-danger text-white">'. $_SESSION['status']. '</h2>';
                                    unset($_SESSION['status']);
                                 }


                             ?>
                              <div class="add-product">
                              
                            </div>
                            <div class="">

                            <?php

                                  if(isset($_SESSION['success']) && $_SESSION['success'] !='')
                                 {
                                    echo '<h2 class="pd-setting text-white">'. $_SESSION['success']. '</h2>';
                                    unset($_SESSION['success']);
                                 }

                                 if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                                 {
                                    echo '<h2 class="bg-danger text-white">'. $_SESSION['status']. '</h2>';
                                    unset($_SESSION['status']);
                                 }


                            ?>

                            

                            <div class="container">
                                 <br />
                                 <div id="result"></div>
                            </div>
                            
                            <div style="clear:both"></div>
                            <br />
 
                            <div class="custom-pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
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


<script>
$(document).ready(function(){
    load_data();
    function load_data(query)
    {
        $.ajax({
            url:"fetch2.php",
            method:"post",
            data:{query:query},
            success:function(data)
            {
                $('#result').html(data);
            }
        });
    }
    
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();            
        }
    });
});
</script>