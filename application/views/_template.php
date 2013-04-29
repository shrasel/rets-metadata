<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RETS METADATA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet/less" href="<?=base_url()?>assets/less/bootstrap.less">
    <!-- <link rel="stylesheet" href="<?/*=base_url()*/?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?/*=base_url()*/?>assets/css/bootstrap-responsive.min.css">-->

    <style type="text/css">
        body {
            padding-bottom: 40px;
            padding-top: 60px;
        }

        .table th {
            font-size: 13px
        }
        .table td {
            font-size: 12px
        }
        .hero-unit{
            padding: 40px
        }
        .box{
            border: 1px solid #999988;
            background-color: #f5f7f7;
            margin-bottom: 8px;
            padding: 8px;
            border-radius: 8px
        }

    </style>
    <link rel="stylesheet/less" href="<?base_url()?>assets/less/responsive.less">
    <script src="<?=base_url()?>assets/js/less-1.3.3.min.js"></script>
    <script>
        var base_url = "<?=site_url()?>";
        //alert(base_url);
    </script>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<?php if ($this->session->userdata('logged_in')): ?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand active" href="#">RETS/IDX Server Service </a>
            <div class="nav-collapse collapse" style="height: 0px;">
                <ul class="nav">
                    <li><a href="#about">About</a></li>
                    <li><a href="mailto:russell@nextgen-soft.com">Contact</a></li>
                </ul>
                <p class="navbar-text pull-right">
                    <?= anchor('logout', 'Logout', 'class="navbar-text"') ?>
                </p>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
    <?php endif;?>
    <div class="container">
<div class="container-fluid">
    
    <?=$this->load->view($content)?>

    <hr>

    <footer>
        <p class="text-center">© 2013 <?=anchor('http://www.nextgen-soft.com','NextGen Soft')?></p>
    </footer>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>assets/js/app.js"></script>

</body>
</html>
