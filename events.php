<!doctype html>
<html class="no-js" lang="en">
<?php include_once('security.php');?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Plage horaire | ActivSapces Manager</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include_once('header_links.php'); ?>
   
</head>

<body>
    <?php include_once('side_bar.php'); ?>

    <?php include_once('nav_bar.php'); ?>

            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                         <li>
                            <a  href="index.php" title="Page d'accueil" href="index.php">
                                   <span class="educate-icon educate-home icon-wrap"></span>
                                   <span class="mini-click-non">Accueil</span>
                                </a>
                            
                        </li>
                                        <li><a href="events.php">Event</a></li>
                                           <li>
                            <a title="Organisez l'utilisation des services suivant une plage précise" href="events.html" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span> <span class="mini-click-non">Plage Horaire</span></a>
                        </li>
                        
                        
                        <li class="active">
                            <a  title="Ayez une vue générale sur tous les Services" href="all-services.php" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">Services</span></a>
                            
                        </li>
                        
                        
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Messagerie</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Consulter votre boite de reception" href="https://mail.yahoo.com/d/folders/1?.intl=fr&.lang=fr-FR&.partner=none&.src=fp"><span class="mini-sub-pro">Boite de reception</span></a></li>
                                <li><a title="Ecrire un nouveau mail" href="https://mail.yahoo.com/d/compose/3990533881"><span class="mini-sub-pro">Nouveau mail</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="data-table.php" aria-expanded="false"><span class="educate-icon educate-interface icon-wrap"></span> <span class="mini-click-non">Historique</span></a>
                    
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Search..." class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="calender-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <!--<div class="col-lg-12">
                        <div class="calender-inner">
                            <div id='calendar'></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        
        <?php include_once('footer.php'); ?>
    </div>

  <?php include_once('footer_links.php'); ?>
</body>

</html>