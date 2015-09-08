<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-US" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-US" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>
	<title>Financial Aid Application</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $globals_url ?>c/g.css">
	<link rel="stylesheet" media="print" href="<?php echo $globals_url ?>c/p.css">
	<style type="text/css">
		
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo $globals_url ?>j/ghead.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/<?php echo $globals_url ?>j/respond.js"></script><![endif]-->
	<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.0.1' type='text/css' media='all' />
	<?php include( $globals_path . 'h/gabranded.html' ); ?>
</head>
<body class="nav-enrollment">
	<?php require( $globals_path . 'h/bhead.html' ); ?>
	<div id="main-wrap" class="globals-branded">
		<div id="main" class="container no-padding">
			<div class="row">
				<div class="col-md-12">
					<div class="box-shadow" id="content">
						<div class="row row-padding">
							<div class="content-padding">
								<div style='padding-top:10px;'>
									<p class="lead">
										<?php
											if(!empty($year_range) )
											{?> 
											<p>
												<div style='color:green;'>** <?php echo $year_range; ?> BC Financial Aid Application Submitted**</div>
												<div>	
													<br/>Thank you! Your <?php echo $year_range; ?> BC Financial Aid Application has been submitted to the Financial Aid office.
													<br/>If you have not done so already, please complete the <?php echo $year_range; ?> Free Application for Federal Student Aid (FAFSA).
													If you have submitted all required documents to our office, you can expect to hear from our office between 30-90 days depending on the time of year you applied. 
													 Check your BC email account often for any important notifications from our office. 
													<br/>Unsure if you submitted everything?  
													 Check your financial aid status on the FA portal (<a href='<?php if(isset($status_url)) echo $status_url; ?>' > Check Status </a>)
													 If you missed the filing deadline (<a href='<?php if(isset($deadlines)) echo $deadlines; ?>' > Deadlines </a>) for the quarter in which you wish to start receiving financial aid, you must pay your own tuition.
													 <br/>Contact the Financial Aid office if you have any questions.
												</div>
											</p>
										<?php
											}
											else if(!empty($error_message))
											{?>
												<p>
											<?php echo $error_message; ?>
												</p>
                                                                                                <p>Please submit your financial aid form <a href='<?php if(!empty($form_url)) echo $form_url; ?>'>here.</a></p>
										<?php
											}
										?>
									</p>
								</div>
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

	<?php include( $globals_path . 'h/bfoot.html' ); ?>
	<?php include( $globals_path. 'h/legal.html' ); ?>


</body>
</html>