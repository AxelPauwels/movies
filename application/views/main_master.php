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
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">
    <link rel="stylesheet"
          href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">

    <title>MovieServer</title>
    <!-- Bootstrap Core CSS -->
    <?php echo stylesheet("bootstrap.css"); ?>
    <!-- Custom CSS -->
    <?php echo stylesheet("heroic-features.css"); ?>
    <!-- Buttons CSS -->
    <?php echo stylesheet("buttons.css"); ?>
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js"></script>
    <script type="text/javascript">
        var site_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';
    </script>
</head>

<body>
<!-- Message -->
<?php
$flashMessageCssClass = "";
if (isset($message)) {
    if (!$message == NULL) {
        $flashMessageCssClass = "flash-message-is-present";
        ?>
        <div class="message">
            <?= $message->flash_message ?>
        </div>
        <?php
    }
}
?>

<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top <?= $flashMessageCssClass ?>" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo site_url('/home') ?>">
				<i class="fa fa-home fa-lg" aria-hidden="true"></i>
			</a>
		</div>

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
					<a data-toggle="tooltip" title="Statistieken" data-placement="bottom"
					   href="<?php echo site_url('/home/info') ?>">
						<?php echo '<i class="fa fa-bar-chart" aria-hidden="true"></i> ' ?>
					</a>
				</li>
				<?php
				if(isset($user)){
					if($user->level){
						?>
						<li>
							<a style="color:#4AAF46" href="<?php echo site_url('/admin/getUsers') ?>">
								<i class="fa fa-wrench" aria-hidden="true"></i> Manage
							</a>
						</li>
					<?php } ?>

						<li>
							<a data-toggle="tooltip" title="Logout" data-placement="bottom"
							   href="<?php echo site_url('/home/afmelden') ?>">
								<i class="fa fa-sign-out" aria-hidden="true"></i>
							</a>
						</li>
				<?php } ?>

			</ul>
		</div>
	</div>
	<!-- /.container -->
</nav>
<!-- /Navigation -->

<!-- /Navigation -->
<!-- Page Content -->
<div class="container <?= $flashMessageCssClass ?>">
    <!-- Page Features -->
        <div class="row text-center">
            <?php echo $content; ?>
        </div>
    <!-- Footer -->
<!--    <footer>-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--            </div>-->
<!--        </div>-->
<!--    </footer>-->
	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>
</html>
