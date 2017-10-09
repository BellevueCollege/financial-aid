
<?php 
    require_once('config.php'); 
    define( 'VERSION_NUMBER', '1.4' );
?>
<html lang="en-US">
<!--<![endif]-->

<head>
	<title>Financial Aid :: Bellevue College</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $GLOBALS_URL ?>c/g.css">
	<link rel="stylesheet" media="print" href="<?php echo $GLOBALS_URL ?>c/p.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo $GLOBALS_PATH ?>j/ghead.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/<?php echo $globals_url ?>j/respond.js"></script><![endif]-->
	<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.0.1' type='text/css' media='all' />
	<?php include( $GLOBALS_PATH . 'h/gabranded.html' ); ?>
</head>

<body class="nav-enrollment">
	<?php include( $GLOBALS_PATH . 'h/bhead.html' ); ?>
	<div id="main-wrap" class="globals-branded">
		<div id="main" class="container no-padding">
			<div class="row">
				<div class="col-md-12">
					<div id="content" class="box-shadow">
						<div class="row row-padding">
							<p class='entry-title'>&nbsp;</p>
							<div class="content-padding">
								<h1>Financial Aid Application is under Maintenance. Please check back in 30 minutes</h1>
								
								<small class="pull-right">Financial Aid <?php echo VERSION_NUMBER ?></small>
							</div>
							<!--.content-padding-->
						</div>
						<!--.row-padding-->
					</div>
					<!-- #content-->
				</div>
				<!-- row -->
			</div>
			<!-- col-md-12 -->
		</div>
		<!-- #main .container -->
	</div>
	<!-- #main-wrap -->

	<?php include( $GLOBALS_PATH . 'h/bfoot.html' ); ?>
	<?php include( $GLOBALS_PATH . 'h/legal.html' ); ?>

	<script src="<?php echo $GLOBALS_URL; ?>j/bootstrap.min.js"></script>
	<script src="<?php echo $GLOBALS_URL; ?>j/g.js"></script>
</body>

</html>
