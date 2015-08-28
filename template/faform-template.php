<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-US" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-US" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>
	<title>Apply for Financial Aid :: Financial Aid</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $globals_url; ?>c/g.css?ver=3.3">
	<link rel="stylesheet" media="print" href="<?php echo $globals_url; ?>c/p.css?ver=3.3">

	<style type="text/css">
		fieldset {
			padding-left: 1em;
			/*border-top: 1px solid black;*/
		}
		fieldset legend {
			font-size: 1.3em;
			text-indent: -1em;
			margin-bottom: .5em;
		} 
		.input-group, .form-group {
			margin-left: .6em;
		}
		ol {
			/*border: 1px solid blue;*/
			margin: 1em 0 1em 0;
		}
		ol ul {
			/*border: 1px solid red;*/
			margin-left: 1em;
			margin-top: 0;
		}
		
		.required {
			
		}
		#form-degree-info {
			/*display: none;*/
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo $globals_url; ?>j/ghead.js"></script>
	<!--[if lt IE 9]><script type="text/javascript" src="/<?php echo $globals_url; ?>j/respond.js"></script><![endif]-->
	<link rel="stylesheet"" id="open-sans-css"" href="//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.0.1"" type="text/css" media="all" />
	<?php
		if(!empty($globals_path))
			 include( $globals_path . 'h/gabranded.html' );
	 ?>
</head>
<body class="nav-enrollment">
	<?php
		if(!empty($globals_path))
		 	require( $globals_path . 'h/bhead.html' );
	 ?>
	<div id="main-wrap" class="globals-branded">
		<div id="main" class="container no-padding">
			<div class="content-padding">
				<div id="site-header">
					<h1 class="site-title">Financial Aid</h1>
				</div><!-- container header -->
			</div><!-- content-padding -->
			<div class="row">
				<div class="col-md-12">
					<div class="box-shadow" id="content">
						<div class="row row-padding">
							<div class="content-padding">
								<p>&nbsp;</p>
								<h1>Apply for Financial Aid</h1>

								<?php
								if(!empty($validation_form_errors))
								{
								?>
									<div class="alert alert-danger" role="alert">
										<ul>
										<?php
										for($i=0;$i<count($validation_form_errors);$i++)
										{
										?>											
											<li><?php echo $validation_form_errors[$i]; ?></li>
										<?php
										}
										?>
										</ul>
									</div>
								<?php
								}
								?>								
								<form id="financial_aid_application" name="financial_aid_application" action="<?php if(!empty($form_post_url)) echo $form_post_url ; ?>" method="post">									

									<fieldset>
										<legend>Academic Year</legend>

										<label><strong>Choose the academic year(s) you would like to apply for: <span class="text-danger" title="Required field">*</span></strong></label>
										<div class="form-group">
										<?php 
											if(!empty($year_quarter_information))
											{
												foreach($year_quarter_information as $key=>$value)
												{
													$checked = '';
													if(!empty($selected_academic_year) && $selected_academic_year == $key)				
														$checked = 'checked';
									
											?>
													<div class="radio">
														<label for="academic_year_<?php echo $key ;?>">
															<input type="radio" name="academic_year" id="academic_year_<?php echo $key; ?>" value="<?php echo $key; ?>" <?php  echo $checked; ?> required /> 
															<?php echo $value; ?>
														</label>
													</div>
											<?php
												}
											}
										?>
										</div>	
										
										<?php
											$checked_one = '' ; $checked_zero = '';
											if(isset($selected_attend_summer) )
											{
												if($selected_attend_summer == '1')
													$checked_one = 'checked';
												else if($selected_attend_summer == '0')
													$checked_zero = 'checked';
											}
										?>
										<label><strong>Do you plan to attend during the summer? <span class="text-danger" title="Required field">*</span></strong></label>
											<div class="form-group">
												<div class="btn-group" data-toggle="buttons">
													<label for="attend_summer_yes" class="btn btn-default">
														<input type="radio" name="attend_summer" id="attend_summer_yes" value="1" <?php echo $checked_one; ?> required /> 
														Yes
													</label>
													<label for="attend_summer_no" class="btn btn-default">
														<input type="radio" name="attend_summer" id="attend_summer_no" value="0" <?php echo $checked_zero; ?> required /> 
														No
													</label>
												</div>	
											</div>
											
											<!--<label>Do you plan to attend during the summer? <span class="text-danger" title="Required field">*</span></label>
											<div class="form-group">
												<div class="radio">
													<label>
														<input type="radio" name="attend_summer" value="1" required /> 
														Yes
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="attend_summer" value="0" required /> 
														No
													</label>
												</div>	
											</div>
											
											<label>Do you plan to attend during the summer? <span class="text-danger" title="Required field">*</span></label>
											<div class="form-group">
												<div class="radio-inline">
													<label>
														<input type="radio" name="attend_summer" value="1" required /> 
														Yes
													</label>
												</div>
												<div class="radio-inline">
													<label>
														<input type="radio" name="attend_summer" value="0" required /> 
														No
													</label>
												</div>	
											</div>-->
									</fieldset>
									
									<fieldset>
										<legend>Previous Schools</legend>
										
										<?php
											$checked_one = '' ; $checked_zero = '';
											if(isset($selected_attend_college) )
											{
												if($selected_attend_college == '1')
													$checked_one = 'checked';
												else if($selected_attend_college == '0')
													$checked_zero = 'checked';
											}
										?>
										<label><strong>Have you previously attended college or university? <span class="text-danger" title="Required field">*</span></strong></label>
										<div class="form-group">
											<div class="radio">
												<label for="attend_college_yes">
													<input type="radio" id="attend_college_yes" name="attend_college" value="1" <?php echo $checked_one; ?> required /> 
													Yes
												</label>
											</div>
											<div class="radio">
												<label for="attend_college_no">
													<input type="radio" id="attend_college_no" name="attend_college" value="0" <?php echo $checked_zero; ?> required /> 
													No
												</label>
											</div>
										</div>
										
										<div id="form-degree-info">
											<?php
												$checked_one = ''; $checked_zero = '';
												if(isset($selected_hold_college_degree) )
												{
													if($selected_hold_college_degree == '1')
														$checked_one = 'checked';
													else if($selected_hold_college_degree == '0')
														$checked_zero = 'checked';
												}
											?>	
											<label><strong>Do you hold a college degree, including degrees outside the U.S.?</strong></label>
											<div class="form-group">
												<div class="radio">
													<label for="hold_college_degree_yes">
														<input type="radio" id="hold_college_degree_yes" name="hold_college_degree" value="1" class="radio" <?php echo $checked_one; ?> required /> 
														Yes
													</label>
												</div>	
												<div class="radio">
													<label for="hold_college_degree_no">
														<input type="radio" id="hold_college_degree_no" name="hold_college_degree" value="0" class="radio" <?php echo $checked_zero; ?> required /> 
														No
													</label>
												</div>
											</div>
											
											<label><strong>If yes, what type(s) of degree do you hold?</strong></label>
											<div class="form-group">	
											<?php
												if(!empty($types_of_degree))
												{
													foreach( $types_of_degree as $degree_type ) // $i=0;$i<count($types_of_degree);$i++)
													{
														$degree_type_id = $degree_type['DegreeID'];
														$degree_type_name = $degree_type['Degree'];
														
														if(isset($degree_type_id))
														{
															$checked = '';
															if(!empty($selected_type_of_degree) && is_array($selected_type_of_degree) )
															{
																if(in_array($degree_type_id, $selected_type_of_degree))
																	$checked = 'checked';
															}
															?>
															<div class="checkbox">
																<label>
																	<input type="checkbox" id="type_of_degree_<?php echo $degree_type_id; ?>" name="type_of_degree[]" value="<?php echo $degree_type_id; ?>" <?php echo $checked; ?> />
																	<?php echo $degree_type_name; ?>
																</label>
															</div>
													<?php
														}
													}
												}
											?>
											</div>
										</div>
									</fieldset>
										
									<fieldset>
										<legend>Program of Study</legend>
										
										<p>
											<em>Your intended program of study on record:</em> Your program of study is a critical component of your financial aid – failure to complete your classes successfully or complete your program in a timely manner may result in the loss of your aid.
										</p>
										<ol>
											<li>Financial aid will only fund classes that are required for your degree or certificate. We can only fund programs 24 credits or more in length.</li>
											<li>The BC Financial Aid Office will use the program you indicate here to track your progress towards:</li>
												<ul>
													<li>Completion of 67% of your classes (the completion ratio, i.e. completed classes divided by attempted)</li>
													<li>Quarterly and cumulative grade point average</li>
													<li>Maximum time frame (you may receive financial aid for up to 150% of your program’s length)</li>
												</ul>
											<li>Some forms of financial aid have lifetime maximums. You could exhaust your financial aid eligibility before completing your degree or certificate if you fail to complete your classes or change your program of study.</li>
										</ol>
										<div class="form-group">
											<label for="program_of_study"><strong>Your intended program of study: <span class="text-danger" title="Required field">*</span></strong></label>
											<select name="program_of_study" id="program_of_study" class="form-control" required>
												<option value="">Select...</option>
												<?php		
												if(!empty($program_of_study_options))
												{								
													for($i=0;$i<count($program_of_study_options);$i++)
													{
														$selected = '';
														if(!empty($selected_program_of_study) && $program_of_study_options[$i] == $selected_program_of_study)
														{
															$selected = 'selected';
														}
													?>
														<option value="<?php echo $program_of_study_options[$i] ?>" <?php echo $selected; ?>>
															 <?php echo $program_of_study_options[$i]; ?>
														</option>
														
													<?php	
													}
												}
												?>
											</select>
										</div>
									</fieldset>
									<fieldset>
										<legend>Third-Party Funding</legend>
										<?php
											$checked_one = '' ; $checked_zero = '';
											if(isset($selected_third_party_funding) )
											{
												if($selected_third_party_funding == '1')
													$checked_one = 'checked';
												else if($selected_third_party_funding == '0')
													$checked_zero = 'checked';
											}
										?>
										<div class="form-group">
											<label>Are you receiving scholarship/funding or using the state tuition waiver? <span class="text-danger" title="Required field">*</span></label>
											<div class="radio">
												<label for="third_party_funding_yes">
													<input type="radio" name="third_party_funding" id="third_party_funding_yes" value="1" <?php echo $checked_one; ?> required/> 
													Yes
												</label>
											</div>
											<div class="radio">
												<label for="third_party_funding_no">
													<input type="radio" name="third_party_funding" id="third_party_funding_no" value="0" <?php echo $checked_zero; ?> required/> 
													No
												</label>
											</div>
										</div>	
										<!-- Funding amount and funding amount are requie fields if user answer yes to the above field -->
										<div id="additional_funding_info">
											<div class="form-group">
												<label for="funding_amount"><strong>Funding amount</strong></label> 
												<input type="text" name="funding_amount" id="funding_amount" class="form-control" <?php if(!empty($selected_funding_amount) ) echo $selected_funding_amount; ?> />
											</div>
											<div class="form-group">
												<label for="funding_source"><strong>Other funding source? Please explain.</strong></label>
												<textarea name="funding_source" id="funding_source" class="form-control" rows="3"> 
													<?php if(!empty($selected_funding_source)) echo $selected_funding_source; ?>
												</textarea>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend>Loans (Federal Direct Stafford Loans)</legend>
										<?php
											$checked_one = '' ; $checked_zero = '';
											if(isset($selected_apply_for_fa))
											{
												if($selected_apply_for_fa == '1')
													$checked_one = 'checked';
												else if($selected_apply_for_fa == '0')
													$checked_zero = 'checked';
											}
											?>
										<label aria-describedby="apply_for_fa_help_block"><strong>Would you like to apply for financial aid loans? <span class="text-danger">*</span></strong></label>
										<div class="form-group">
											<div class="radio">
												<label for="apply_for_fa_yes">
													<input type="radio" name="apply_for_fa" id="apply_for_fa_yes" value="1" <?php echo $checked_one; ?> required/>
													Yes
												</label> 
												<label for="apply_for_fa_no">
													<input type="radio" name="apply_for_fa" id="apply_for_fa_no" value="0" <?php echo $checked_zero; ?> required/> 
													No
												</label>
											</div>
											<span id="apply_for_fa_help_block" class="help-block small">Note: you can apply for loans now, but you don't have to accept the funds. If you think you might need loans, completing this now will expedite the process.</span>
										</div>
										
										<div id="apply_for_fa_loan_info">
											<label><strong>Types of loans:</strong></label>
											<?php
												if(!empty($types_of_loan))
												{
													foreach ( $types_of_loan as $loan_type ) //$i=0;$i<count($types_of_loan);$i++)
													{
														$loan_type_id = $loan_type['LoanTypeID'];
														$loan_type_name = $loan_type['LoanType'];
														
														if(!empty($loan_type_id) && !empty($loan_type_name))
														{
															$checked = '';
															if(!empty($selected_types_of_loan) && is_array($selected_types_of_loan))
															{
																if(in_array($loan_type_id, $selected_types_of_loan))
																	$checked = 'checked';
															}
											?>
															<div class="checkbox">
																<label for="type_of_loan_<?php echo $loan_type_id; ?>">
																	<input type="checkbox" name="types_of_loan[]" id="type_of_loan_<?php echo $loan_type_id; ?>" value="<?php echo $loan_type_id; ?>" <?php echo $checked; ?> />
																	<?php echo $loan_type_name; ?>
																</label>
															</div>
											<?php
														}
													}
												}
											?>
											<div id="require_loans">
												<label><strong>Choose the quarters you will require loans for:</strong></label>
												<!-- Show/Hide quarter depending on the Year selected -->
												<div class="form-group">
												<?php
													if(!empty($quarters))
													{
														foreach($quarters as $key=>$value)
														{
															$checked = '';
															if(!empty($selected_require_loan_quarters) && is_array($selected_require_loan_quarters))
															{
																if(in_array($key, $selected_require_loan_quarters))
																	$checked = 'checked';
															}
												?>
															<div class="checkbox">
																<label for="require_loan_quarters_<?php echo $key; ?>">
																	<input type="checkbox" id="require_loan_quarters_<?php echo $key; ?>" name="require_loan_quarters[]" value="<?php echo $key; ?>" <?php echo $checked; ?> />
																	<?php echo $value; ?>
																</label>
															</div>
															<div id="anticipated_credits_<?php echo $key; ?>">
																<?php
																if(!empty($credit_options))
																{
																	for($i=0;$i<count($credit_options);$i++)
																	{
																		$credit_option_id = $credit_options[$i]['CreditID'];
																		$credit_option_value = $credit_options[$i]['Credit']; 
																		$checked = '';
																		if(!empty($credit_options[$i]) && isset($credit_option_id) && isset($credit_option_value))
																		{
																			if(!empty($selected_anticipated_credits_for_quarter) && is_array($selected_anticipated_credits_for_quarter) && isset($selected_anticipated_credits_for_quarter[$key]))
																			{
																				if($selected_anticipated_credits_for_quarter[$key] == $credit_option_id)
																					$checked = 'checked';
																			}
																?>
																			<div class="radio">
																				<label for="anticipated_credits_for_quarter_<?php echo $key; ?>_<?php echo $credit_option_id; ?>">
																					<input type="radio" id="anticipated_credits_for_quarter_<?php echo $key; ?>_<?php echo $credit_option_id; ?>" name="anticipated_credits_for_quarter_<?php echo $key; ?>" 
																					value="<?php echo $credit_option_id; ?>" <?php echo $checked; ?>/> 
																					<?php echo $credit_option_value; ?>
																				</label>												
																			</div>	
																<?php
																		}
																	}
																}
																?>
															</div>
												<?php
														}
													}
												?>
												</div>
											</div>
											<div class="form-group">
												<label for="expected_graduation_date"><strong>Expected graduation date <span class="text-danger">*</span></strong></label>
												<select id="expected_graduation_date" name="expected_graduation_date" class="form-control" aria-describedby="graddate_help_block">
												<?php
												if(!empty($expected_graduation_year_array))
												{	
													for($i=0;$i<count($expected_graduation_year_array);$i++)
													{
														$selected = '';
														if(!empty($selected_expected_graduation_date) &&  $selected_expected_graduation_date == $expected_graduation_year_array[$i])
															$selected = 'selected';
													?>
														<option value="<?php echo $expected_graduation_year_array[$i] ?>" <?php echo $selected; ?>><?php echo $expected_graduation_year_array[$i] ?></option>
													<?php
													}
												}
												?>
												</select>
												<span id="graddate_help_block" class="help-block small">When do you expect to complete your degree or certificate classes? (For example, it usually takes two years to complete an AA: start Fall 2015, finish Spring 2017.)</span>
											</div>
										</div>
									</fieldset>	
										<fieldset>
											<legend>Information Release</legend>
											
											<div class="alert alert-info"><!-- Information release description -->
												<strong>This section is optional.</strong> Only complete this section if you wish to 
												allow an authorized representative to access your financial aid information. Commonly this 
												would be a parent, guardian, or relative.
											</div><!--End of Information Release description div -->
											
											<div class="checkbox">
												<?php
												$checked = '';
												if(!empty($selected_release_student_info_box1) && $selected_release_student_info_box1 == '1')
														$checked = 'checked';
												?>
											  <label for="release_student_info_box1">
											    <input type="checkbox" value="1" id="release_student_info_box1" name="release_student_info_box1" <?php echo $checked; ?>>
											    	I give the Bellevue College Financial Aid Office permission to discuss my financial aid application status, award, or eligibility with the following individual(s). I understand that this permission will remain in force from the date the office notes receipt of this form until the last day of Spring quarter of the academic year(s) you are applying for.
											  </label>
											</div>
											<div class="checkbox">
											<?php
												$checked = '';
												if(!empty($selected_release_student_info_box2) && $selected_release_student_info_box2 == '1')
														$checked = 'checked';
											?>
											  <label for="release_student_info_box2">
											    <input type="checkbox" value="1" name="release_student_info_box2" <?php echo $checked; ?>>
											    	I authorize the release of award letters or other documents to the individual(s) listed below. This permission does not include check pickup. Visit our office for an additional form to grant the release of checks.
											  </label>
											</div>
											<div>
												<p class="small">The Bellevue College Financial Aid Office will release information from your record to the person(s) identified below as an authorized representative. We will not permit the authorized representative to pick up financial aid documents (award letters, etc.) from our office unless specify. Permission to release information is granted for one financial aid year (Summer through Spring Quarter). You may cancel this permission at any time by submitting an additional written statement requesting cancellation. Please check appropriate permissions below.</p>
											</div>
											<div class="form-group">
												<label for="auth_rep_name1"><strong>Authorized representative's name</strong></label>
												<input type="text" name="auth_rep_name1" id="auth_rep_name1" class="form-control" maxlength="50" value="<?php if(isset($selected_auth_rep_name1)) echo $selected_auth_rep_name1; ?>">
											</div>
											<div class="form-group">
												<label for="auth_rep_name2"><strong>Authorized representative's name</strong></label>
												<input type="text" name="auth_rep_name2" id="auth_rep_name2" class="form-control" value="<?php if(isset($selected_auth_rep_name2)) echo $selected_auth_rep_name2; ?>">
											</div>
										</fieldset>
										<fieldset>
											<legend>Sign and Finish</legend>
											<!--<div class="form-group">
												I understand that if I do not follow the financial aid contract it may result in the loss of my financial aid. *
											</div>-->
											
											<?php 
												/*$checked = '';
												if(!empty($selected_fa_contract_agreement) && $selected_fa_contract_agreement == '1')
														$checked = 'checked'; */
											 ?>
											<!--<div class="checkbox">
											  <label>
											    <input type="checkbox" value="1" name='fa_contract_agreement' <?php //echo $checked; ?>>
											    	I agree
											  </label>-->
											<?php 
												$checked = '';
												if(!empty($selected_fa_contract_agreement) && $selected_fa_contract_agreement == '1')
														$checked = 'checked';
											 ?>
											<div class="checkbox">
											  <label>
											    <input type="checkbox" value="1" name="fa_contract_agreement" <?php echo $checked; ?> >
											    I understand that if I do not follow the financial aid contract it may result in the loss of my financial aid. *
											  </label>
											</div>
											<div class="form-group">
												<label for="signature">Name <span class="text-danger" title="Required field">*</span></label> 
												<input type="text" name="signature" id="signature" class="form-control" aria-describedby="sig_help_block" value="<?php if(isset($selected_signature)) echo $selected_signature; ?>">
												<span id="sig_help_block" class="help-block small">Type your full name as your signature for this application.</span>
											</div>
										</fieldset>	
										<div class="alert alert-info">
											<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
											<?php if(!empty($email)) echo $email; ?> is the email address on file for you. Communications will be conducted using this email.
										</div>
											
										<input type="submit" value="Submit application" name="submit" class="btn btn-primary" />	
										
								</form>
								<div class="content-padding top-spacing30"></div>
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
	<?php include( $globals_path . 'h/legal.html' ); ?>

	<script src="<?php echo $globals_url; ?>j/bootstrap.min.js"></script>
	<script src="<?php echo $globals_url; ?>j/g.js"></script>

	<!-- jQuery Validate -->
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

</body>

</html>