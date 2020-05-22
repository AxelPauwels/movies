<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/Raspi.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">

        <title>MovieServer</title>

        <!-- Bootstrap Core CSS -->
        <?php echo stylesheet("bootstrap.css"); ?>
        <!-- Custom CSS -->
        <?php echo stylesheet("heroic-features.css"); ?>
        <!-- Buttons CSS -->
        <?php echo stylesheet("buttons.css"); ?>
        <!-- ADMIN -->
        <?php echo stylesheet("admin/main_templates.css"); ?>
        <!-- my CSS -->
        <?php echo stylesheet("my.css"); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php echo javascript("jquery-3.1.0.min.js"); ?>
        <?php echo javascript("bootstrap.js"); ?>
        <?php echo javascript("sb-admin.js"); ?>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js"></script>
        <script type="text/javascript">
            var site_url = '<?php echo site_url(); ?>';
            var base_url = '<?php echo base_url(); ?>';
        </script>
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url() ?>"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
                </div>   

                <?php
                if (!$user == null) {

                    switch ($user->level) {
                        case 1:
                            //  USER LEVEL 1
                            ?>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                             <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="<?php echo site_url('/movies') ?>">Movies</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/episodes') ?>">Episodes</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/comedy') ?>">Comedy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/documentary') ?>">Documentary</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/home/profile') ?>"> <?php echo '<i class="fa fa-user-circle-o" aria-hidden="true"></i> ' . $user->naam ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tooltip" title="Statistieken" data-placement="bottom" href="<?php echo site_url('/home/info') ?>"> <?php echo '<i class="fa fa-bar-chart" aria-hidden="true"></i> ' ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tooltip" title="Progress" data-placement="bottom" href="<?php echo site_url('/home/siteProgress') ?>"> <?php echo '<i class="fa fa-tasks" aria-hidden="true"></i>' ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tooltip" title="Logout" data-placement="bottom" href="<?php echo site_url('/home/afmelden') ?>"> <?php echo '<i class="fa fa-sign-out" aria-hidden="true"></i> ' ?></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                            <?php
                            //  /USER LEVEL 1
                            break;
                        case 5:
                            //  USER LEVEL 5
                            ?>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="<?php echo site_url('/movies') ?>">Movies</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/episodes') ?>">Episodes</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/comedy') ?>">Comedy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/documentary') ?>">Documentary</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('/home/profile') ?>"><?php echo '<i class="fa fa-user-circle-o" aria-hidden="true"></i> ' . $user->naam ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tooltip" title="Statistieken" data-placement="bottom" href="<?php echo site_url('/home/info') ?>"> <?php echo '<i class="fa fa-bar-chart" aria-hidden="true"></i> ' ?></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tooltip" title="Progress" data-placement="bottom" href="<?php echo site_url('/home/siteProgress') ?>"> <?php echo '<i class="fa fa-tasks" aria-hidden="true"></i>' ?></a>
                                    </li>

                                    <!-- ADMIN -->
                                    <li>
                                        <a style="color:#4AAF46" href="<?php echo site_url('/admin/getUsers') ?>"><i class="fa fa-wrench" aria-hidden="true"></i> Manage</a>
                                    </li>
									<li>
										<a data-toggle="tooltip" title="Logout" data-placement="bottom" href="<?php echo site_url('/home/afmelden') ?>"> <?php echo '<i class="fa fa-sign-out" aria-hidden="true"></i> ' ?></a>
									</li>



								</ul>
                            </div>
                            <!-- /.navbar-collapse -->
                            <?php
                            break;
                    }
                }else {
                    ?>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a data-toggle="tooltip" title="Login" data-placement="bottom" href="<?php echo site_url('/home/login') ?>">  <?php echo '<i class="fa fa-sign-in" aria-hidden="true"></i> ' ?> </a>
                            </li>
                        </ul>
                    </div> 
                    <?php
                }
                ?>
            </div>
            <!-- /.container -->
        </nav>

        <!-- ADMIN -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav nav-for-admin">
<!--                <li class="nav-item nav-item-admin">-->
<!--                    <a class="nav-link" href="--><?//=site_url('/admin/ajaxReadFilesMovies/movie')?><!--">-->
<!---->
<!--                        <span><i class="fa fa-film"></i>  Movies</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item nav-item-admin">-->
<!--                    <a class="nav-link" href="--><?//=site_url('/admin/ajaxReadFilesMovies/comedy')?><!--">-->
<!--                        <span><i class="fa fa-film"></i>  Comedy</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item nav-item-admin">-->
<!--                    <a class="nav-link" href="--><?//=site_url('/admin/ajaxReadFilesEpisodes/episode')?><!--">-->
<!--                        <span><i class="fa fa-film"></i>  Episodes</span></a>-->
<!--                </li>-->
<!--                <li class="nav-item nav-item-admin">-->
<!--                    <a class="nav-link" href="--><?//=site_url('/admin/ajaxReadFilesMovies/documentary')?><!--">-->
<!--                        <span><i class="fa fa-film"></i>  Documentary</span></a>-->
<!--                </li>-->
                <li class="nav-item nav-item-admin">
                    <a class="nav-link" href="<?=site_url('/admin/getCodes')?>">
                        <span><i class="fa fa-key"></i> Codes</span></a>
                </li>
                <li class="nav-item nav-item-admin">
                    <a class="nav-link" href="<?=site_url('/admin/generateCodes')?>">
                        <span><i class="fa fa-key"></i> Generate Codes</span></a>
                </li>
                <li class="nav-item nav-item-admin">
                    <a class="nav-link" href="<?=site_url('/admin/getRequests')?>">
                        <span><i class="fa fa-envelope"></i> Requests</span></a>
                </li>
                <li class="nav-item nav-item-admin">
                    <a class="nav-link" href="<?=site_url('/admin/getUsers')?>">
                        <span><i class="fa fa-users"></i> All Users</span></a>
                </li>
                <li class="nav-item nav-item-admin">
                    <a class="nav-link" href="<?=site_url('/admin/getSettings')?>">
                        <span><i class="fa fa-cog"></i> Settings</span></a>
                </li>
            </ul>
            <!-- END ADMIN -->
        <!-- /Navigation -->

        <!-- Page Content -->
            <!-- ADMIN -->
        <div id="content-wrapper">
            <div id="masterContentContainer">
                <div id="masterContentTitle" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <!--        <h3>--><?php //echo $title; ?><!--</h3>-->
                </div>
                <!-- END ADMIN -->

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="customTextGray"><?php echo $title; ?></h4>
                </div>
            </div>

            <!-- Page Features -->
            <?php if (isset($nobox)) { ?>
                <div class="row text-center">
                    <?php echo $content; ?>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-lg-12 hero-feature">
                        <div class="thumbnail" style="padding: 20px">
                            <div class="caption">
                                <p>
                                    <?php echo $content; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>        
            <?php } ?>
            <!-- /.row -->
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </footer>
        </div>
        </div>
        </div>
        </div>
        <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
    </body>
</html>
