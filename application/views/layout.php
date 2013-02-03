<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta name="HandheldFriendly" content="true">
        <meta name="viewport" content="width=device-width, height=device-height, user-scalable=no">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CurLink&nbsp;&#45;&nbsp;<?php echo $titre; ?></title>
        <meta name="description" content="CurLink, great app to curl your links">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--<link rel="stylesheet" href="<?php echo base_url();?>web/css/normalize.css">-->
        <link rel="stylesheet" href="<?php echo base_url();?>web/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>web/css/main.css"/>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
        <!--<script src="js/vendor/modernizr-2.6.2.min.js"></script>-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
    <div id="mainPage">
        <header>
            <a id="title" href="<?php echo base_url(); ?>"><h1>CurLink!</h1><img alt="logo Curlink" src="<?php echo base_url();?>web/img/logo.png"></a>
            <div id="memberBox">
                <?php
                if($this->session):
                
                if($this->session->userdata('logged in')): ?><p id="nomMembre"><?php echo $this->session->userdata('nom'); ?></p>
                <?php echo anchor('membre/logout/','Se déconnecter','id="logout"'); 
                endif; 
                endif; ?>
            </div>
        </header>
        <?php if(isset($message)): ?>
        <div class="feedback"><?php echo $message; ?></div>
        <?php endif ; ?>
         <div id="content">
            <div id="memberConnect">
                     <?php
                        if($this->session):
                            if(!$this->session->userdata('logged in')):
                                if(isset($connect))
                                {
                                echo $connect;
                                }           
                            endif; 
                        endif; ?>
                </div>
                <?php
                        if($this->session):
                            if($this->session->userdata('logged in')): ?>
                 <a title="Afficher la liste des membres" href="#" id="listButton"></a>
         <?php
         endif;
         endif; 
         echo $vue;
         ?>
        </div>
        <?php if(isset($listeMembre)){echo $listeMembre;}?>
    <footer>
        
    </footer>
</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>web/script/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>web/script/main.js"></script>
        </script>
    </body>
</html>
