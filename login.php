<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | ActivSpaces Manager (ASM)</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once('header_links.php'); ?>
    
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="error-pagewrap" align="center">
        <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
                <h3>PLEASE LOGIN TO APP</h3>
                <p>This is the best app ever!</p>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">

                        <?php

                             if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                             {
                                echo '<h5 class="bg-danger text-white">'. $_SESSION['status']. '</h5>';
                                unset($_SESSION['status']);
                             }

                         ?>

                        <form action="php-code.php" id="loginForm" method="POST"><br>

                            <div class="form-group">
                                <label class="control-label" for="password">Usrename</label>
                                <input type="text" placeholder="Enter Username" required="required" value="" name="username" class="form-control">
                                <span class="help-block small">Your Username</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Your strong password</span>
                            </div><br><br>
                            <button name="login_btn" class="btn btn-success btn-block loginbtn">Login</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center login-footer">
                 <p>Copyright © 2020. ActivSpaces Interns </p>
            </div>
        </div>   
    </div>

    <?php include_once('footer_links.php'); ?>
</body>

</html>