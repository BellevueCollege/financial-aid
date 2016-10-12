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
			margin-top: 1em;
			border-bottom: 1px solid #ccc;
		}
		fieldset legend {
			font-size: 1.3em;
			text-indent: -8px;
			margin-bottom: .5em;
		} 
		.input-group, .form-group {
			margin-left: .6em;
		}
		ol {
			margin: 1em 0 1em 0;
		}
		ol ul {
			margin-left: 1em;
			margin-top: 0;
		}
		.hide {
			display: none;
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

								<div id="errors">
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
								</div>			
								<noscript>
									<div class="alert alert-warning">This form works best if JavaScript is enabled. <a href="http://enable-javascript.com/">Learn how to enable JavaScript</a>.</div>
								</noscript>
								<?php include("student-info-include-template.php"); ?>
								<form id="financial_aid_application" name="financial_aid_application" action="<?php if(!empty($form_post_url)) echo $form_post_url ; ?>" method="post">									

									<?php //var_dump($already_submitted_app_qtr_ids); ?>
									<fieldset>
										<legend>Academic Year</legend>
										
										<label><strong>Choose the academic year(s) you would like to apply for: <span class="text-danger" title="Required field">*</span></strong></label>
										<div class="form-group">
										<?php 
											if(!empty($year_quarter_information))
											{
												$ac_submitted = array();
												//var_dump($already_submitted_app_qtr_ids);
												foreach($year_quarter_information as $key=>$value)
												{
													$has_submitted = $already_submitted_app_qtr_ids[$key];
													if ( isset($has_submitted) && $has_submitted ) {
														$ac_submitted[] = $value; 
														continue;
													}
													
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
												
												if ( !empty($ac_submitted) ) {
												?>
													<span id="academic_year_help_block" class="help-block small">
														You have already submitted applications for the following academic year(s). 
														If you have questions about a previous application, <a href="https://www.bellevuecollege.edu/fa/contact">contact the Financial Aid Office</a>.
														<ul style="margin-top: 0; padding-left: .5em;">
												<?php
													foreach($ac_submitted as $ay ) {
												?>
															<li><?php echo $ay; ?></li>
												<?php
													}
												?>
														</ul>
													</span>
												<?php
												}	
											}
										?>
										</div>	
									</fieldset>
									<div id="form_remainder">	
									<fieldset>
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
												<div class="radio-inline">
													<label for="attend_summer_yes">
														<input type="radio" name="attend_summer" id="attend_summer_yes" value="1" <?php echo $checked_one; ?> required> 
														Yes
													</label>
												</div>
												<div class="radio-inline">
													<label for="attend_summer_no">
														<input type="radio" name="attend_summer" id="attend_summer_no" value="0" <?php echo $checked_zero; ?> required> 
														No
													</label>
												</div>	
											</div>
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
											<div class="radio-inline">
												<label for="attend_college_yes">
													<input type="radio" id="attend_college_yes" name="attend_college" value="1" <?php echo $checked_one; ?> required /> 
													Yes
												</label>
											</div>
											<div class="radio-inline">
												<label for="attend_college_no">
													<input type="radio" id="attend_college_no" name="attend_college" value="0" <?php echo $checked_zero; ?> required /> 
													No
												</label>
											</div>
										</div>
										
										<div id="form_degree_info">
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
											<label><strong>Do you hold a college degree, including degrees outside the U.S.? <span class="text-danger" title="Required field">*</span></strong></label>
											<div class="form-group">
												<div class="radio-inline">
													<label for="hold_college_degree_yes">
														<input type="radio" id="hold_college_degree_yes" name="hold_college_degree" value="1" <?php echo $checked_one; ?> /> 
														Yes
													</label>
												</div>	
												<div class="radio-inline">
													<label for="hold_college_degree_no">
														<input type="radio" id="hold_college_degree_no" name="hold_college_degree" value="0" <?php echo $checked_zero; ?> /> 
														No
													</label>
												</div>
											</div>
											
											<div id="form_degree_type">
												<div class="form-group">
													<label><strong>What type(s) of degree do you hold? <span class="text-danger" title="Required field">*</span></strong></label>	
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
										</div>
									</fieldset>
										
									<fieldset>
										<legend>Program of Study</legend>
										
										<p>
                                                                                    To receive financial aid you must declare a degree or certificate program and take classes only in that program. Financial aid can only pay for classes required for graduation. There are limits on the amount of aid you can receive. Taking classes outside your program may result in loss of financial aid eligibility, and/or running out of funds before you complete your program.
<!--											<em>Your intended program of study on record:</em> Your program of study is a critical component of your financial aid – failure to complete your classes successfully or complete your program in a timely manner may result in the loss of your aid.-->
										</p>
<!--										<ol>
											<li>Financial aid will only fund classes that are required for your degree or certificate. We can only fund programs 24 credits or more in length.</li>-->

                                                                                        <p>The BC Financial Aid Office will use the program you indicate here to track your progress towards: </p>
												<ul>
													<li>Completion of 67% of your classes (the completion ratio, i.e. completed classes divided by attempted)</li>
													<li>Quarterly and cumulative grade point average</li>
													<li>Maximum time frame (you may receive financial aid for up to 150% of your program’s length)</li>
												</ul>
<!--											<li>Some forms of financial aid have lifetime maximums. You could exhaust your financial aid eligibility before completing your degree or certificate if you fail to complete your classes or change your program of study.</li>-->
<!--										</ol>-->
										<div class="row">
											<div class="col-xs-12 col-md-6">
												<div class="form-group">
													<label for="program_of_study"><strong>Your intended program of study <span class="text-danger" title="Required field">*</span></strong></label>
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
											</div>
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
										<!--<label><strong>Are you receiving scholarship/funding from a third party or using the state tuition waiver? <span class="text-danger" title="Required field">*</span></strong></label>-->
                                                                                <label><strong>Do you expect to receive another source (outside of financial aid) of funding to help you pay for school? This may include scholarships, tuition waivers for state employees, employer tuition payment or reimbursement, etc.  <span class="text-danger" title="Required field">*</span></strong></label>
										<div class="form-group">
											<div class="radio-inline">
												<label for="third_party_funding_yes">
													<input type="radio" name="third_party_funding" id="third_party_funding_yes" value="1" <?php echo $checked_one; ?> required/> 
													Yes
												</label>
											</div>
											<div class="radio-inline">
												<label for="third_party_funding_no">
													<input type="radio" name="third_party_funding" id="third_party_funding_no" value="0" <?php echo $checked_zero; ?> required/> 
													No
												</label>
											</div>
										</div>	
										<!-- Funding amount and funding amount are required fields if user answer yes to the above field -->
										<div id="form_additional_funding_info">
											<div class="row">
												<div class="col-xs-12 col-md-6">
													<div class="form-group">
														<label for="funding_amount"><strong>Funding amount</strong> <span class="text-danger">*</span></strong></label>
														<div class="input-group"> 
															<span class="input-group-addon">$</span>
															<input type="text" pattern="\d*" name="funding_amount" id="funding_amount" class="form-control" maxlength="<?php echo $funding_amount_length; ?>" value="<?php if(!empty($selected_funding_amount) ) echo htmlspecialchars($selected_funding_amount); ?>" />
														</div>
													</div>
													<div class="form-group">
														<!--<label for="funding_source"><strong>Other funding source? Please explain. <span class="text-danger">*</span></strong></strong></label>-->
                                                                                                                <label for="funding_source"><strong>State the source of your additional funding: <span class="text-danger">*</span></strong></strong></label>
														<textarea name="funding_source" id="funding_source" class="form-control" rows="3" maxlength="<?php echo $funding_source_length; ?>" placeholder="Maximum length of <?php echo $funding_source_length; ?> characters"><?php if(!empty($selected_funding_source)) echo htmlspecialchars($selected_funding_source); ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									
									<fieldset>
										<legend>Loans (Federal Direct Stafford Loans)</legend>
                                                                                <p class="small">
                                                                                    You are not required to apply for a student loan, and you may apply anytime within the school year. However, complete the information below now if you know you want one. This allows us to award you loan funds at the same time we consider you for other types of aid. 
                                                                                    To learn about student loans, including the amount you can borrow, please click <a href="<?php echo $loan_details; ?>">HERE</a>
                                                                                    <br/>Do you wish to receive a Federal Direct Student Loan?
                                                                                    <br/>When do you expect to complete your degree or certificate and graduate from your program?
                                                                                    <br/>How much would you like to borrow?
                                                                                    <br/>There are additional online processes you must complete such as entrance loan counseling and a MPN before we can disburse loan funds to you. Check your BC email account, and the student financial aid portal for details.

                                                                                </p>
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
										<label><strong>Would you like to apply for financial aid loans? <span class="text-danger">*</span></strong></label>
										<div class="form-group">
											<div class="radio-inline">
												<label for="apply_for_fa_yes">
													<input type="radio" name="apply_for_fa" id="apply_for_fa_yes" value="1" aria-describedby="apply_for_fa_help_block" <?php echo $checked_one; ?> required/>
													Yes
												</label> 
											</div>
											<div class="radio-inline">
												<label for="apply_for_fa_no">
													<input type="radio" name="apply_for_fa" id="apply_for_fa_no" value="0" aria-describedby="apply_for_fa_help_block" <?php echo $checked_zero; ?> required/> 
													No
												</label>
											</div>
											<span id="apply_for_fa_help_block" class="help-block small">Note: you can apply for loans now, but you don't have to accept the funds. If you think you might need loans, completing this now will expedite the process.</span>
										</div>
										
										<div id="form_loan_info">
											<label><strong>Types of loans: <span class="text-danger">*</span></strong></label>
											<div class="form-group">
												<?php
													if(!empty($types_of_loan))
													{
														foreach ( $types_of_loan as $loan_type ) 
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
											</div>
											<div id="form_require_loans">
												<!-- Show/Hide quarter depending on the Year selected -->
												<label><strong>Choose the quarters you will require loans for: <span class="text-danger">*</span></strong></label>
												
												<div class="form-group">
												<?php
													//var_dump($selected_anticipated_credits_for_quarter);
													//var_dump($quarters);
													if(!empty($quarters))
													{
														foreach($quarters as $ac_year=>$acy_quarters)
														{
														?>
															<div id="form_quarters_<?php echo $ac_year; ?>" class="quarters-container">
															<?php
																foreach($acy_quarters as $key=>$value) {
																	$checked = '';
																	if(!empty($selected_require_loan_quarters) && is_array($selected_require_loan_quarters))
																	{
																		if(in_array($key, $selected_require_loan_quarters))
																			$checked = 'checked';
																	}
															?>
																	<div class="row">
																		<div class="col-md-2 col-xs-6">
																			<div class="checkbox">
																				<label for="require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>">
																					<input type="checkbox" id="require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>" name="require_loan_quarters_<?php echo $ac_year; ?>[]" value="<?php echo $key; ?>" <?php echo $checked; ?> />
																					<?php echo $value; ?>
																				</label>
																			</div>
																		</div>
																		<div class="col-md-3 col-xs-6">
																			<div id="anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>">
																				<?php
																				//var_dump($credit_options);
																				if(!empty($credit_options))
																				{
																				?>
																					<div class="form-group">
																						<label for="anticipated_credits_for_quarter_<?php echo $ac_year; ?>_<?php echo $key; ?>" class="sr-only">Select anticipated credits for <?php echo $value; ?></label>
																						<select name="anticipated_credits_for_quarter_<?php echo $key; ?>" id="anticipated_credits_for_quarter_<?php echo $ac_year; ?>_<?php echo $key; ?>" class="form-control input-sm">
																							<option value="">Select anticipated credits for quarter...</option>
																						<?php
																							for($i=0;$i<count($credit_options);$i++)
																							{
																								$credit_option_id = $credit_options[$i]['CreditID'];
																								$credit_option_value = $credit_options[$i]['Credit']; 
																								$selected = '';
																								if(!empty($credit_options[$i]) && isset($credit_option_id) && isset($credit_option_value))
																								{
																									if(!empty($selected_anticipated_credits_for_quarter) && is_array($selected_anticipated_credits_for_quarter) && isset($selected_anticipated_credits_for_quarter[$key]))
																									{
																										if($selected_anticipated_credits_for_quarter[$key] == $credit_option_id) {
																											$selected = 'selected';
																										}
																									}
																						?>
																								<option value="<?php echo $credit_option_id; ?>" <?php echo $selected; ?>><?php echo $credit_option_value; ?></option>
																						<?php
																								}
																							}
																						?>
																						</select>
																					</div>
																				<?php
																				}
																				?>
																			</div>
																		</div>
																	</div>
																<?php 
																}
																?>
															</div>
												<?php
														}
													}
												?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-12">
												<label for="expected_graduation_date"><strong>Expected graduation date <span class="text-danger">*</span></strong></label>
												<div class="form-group">
													<select id="expected_graduation_date" name="expected_graduation_date" class="form-control" aria-describedby="graddate_help_block">
														<option value="">Select...</option>
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
										</div>
									</fieldset>	
                                                                            
                                                                        <fieldset>
											<legend>Information Release Authorization (Optional)</legend> 
                                                                                        <p>If you wish to allow another person to have access to your financial aid information, file and status. This may include a parent, guardian, spouse or partner, or any other person you designate, click <a href="<?php echo $release_authorization_form_url; ?>"> HERE </a> to access the form. Submit the form to the Enrollment Services Office/Student Central for processing. </p>
                                                                                        <br/>
                                                                            
                                                                        </fieldset>   
                                                                            
<!--										<fieldset>
											<legend>Information Release</legend>
											
											<div class="alert alert-warning"> Information release description 
												<strong>This section is optional.</strong> Only complete this section if you wish to 
												allow an authorized representative to access your financial aid information. Commonly this 
												would be a parent, guardian, or relative.
											</div>End of Information Release description div 
											
											<div class="form-group">
												<div class="checkbox">
													<?php
//													$checked = '';
//													if(!empty($selected_release_student_info_box1) && $selected_release_student_info_box1 == '1')
//															$checked = 'checked';
													?>
												<label for="release_student_info_box1">
													<input type="checkbox" value="1" id="release_student_info_box1" name="release_student_info_box1" <?php echo $checked; ?>>
														I give the Bellevue College Financial Aid Office permission to discuss my financial aid application status, award, or eligibility with the following individual(s). I understand that this permission will remain in force from the date the office notes receipt of this form until the last day of Spring quarter of the academic year(s) you are applying for.
												</label>
												</div>
											</div>
											<div class="form-group">
												<div class="checkbox">
												<?php
//													$checked = '';
//													if(!empty($selected_release_student_info_box2) && $selected_release_student_info_box2 == '1')
//															$checked = 'checked';
												?>
												<label for="release_student_info_box2">
													<input type="checkbox" value="1" id="release_student_info_box2" name="release_student_info_box2" <?php echo $checked; ?>>
														I authorize the release of award letters or other documents to the individual(s) listed below. This permission does not include check pickup. Visit our office for an additional form to grant the release of checks.
												</label>
												</div>
											</div>
											<div>
												<p class="small">The Bellevue College Financial Aid Office will release information from your record to the person(s) identified below as an authorized representative. We will not permit the authorized representative to pick up financial aid documents (award letters, etc.) from our office unless specify. Permission to release information is granted for one financial aid year (Summer through Spring quarter). You may cancel this permission at any time by submitting an additional written statement requesting cancellation.</p>
											</div>
											<div class="row">
												<div class="col-xs-12 col-md-6">
													<div class="form-group">
														<label for="auth_rep_name1"><strong>Authorized representative's name</strong></label>
														<input type="text" name="auth_rep_name1" id="auth_rep_name1" class="form-control" maxlength="<?php echo $auth_rep_name_length; ?>" value="<?php if(isset($selected_auth_rep_name1)) echo htmlspecialchars($selected_auth_rep_name1); ?>">
													</div>
													<div class="form-group">
														<label for="auth_rep_name2"><strong>Authorized representative's name</strong></label>
														<input type="text" name="auth_rep_name2" id="auth_rep_name2" class="form-control" maxlength="<?php echo $auth_rep_name_length; ?>" value="<?php if(isset($selected_auth_rep_name2)) echo htmlspecialchars($selected_auth_rep_name2); ?>">
													</div>
												</div>
											</div>
										</fieldset>
										<fieldset>
											<legend>Sign and Finish</legend>
											<?php 
//												$checked = '';
//												if(!empty($selected_fa_contract_agreement) && $selected_fa_contract_agreement == '1')
//														$checked = 'checked';
											 ?>
											<div class="form-group">
												<div class="checkbox">
													<label for="fa_contract_agreement">
														<input type="checkbox" value="1" name="fa_contract_agreement" id="fa_contract_agreement" <?php //echo $checked; ?> >
														I understand that if I do not follow the financial aid contract it may result in the loss of my financial aid. <strong><span class="text-danger">*</span></strong>
													</label>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 col-md-6">
													<div class="form-group">
														<label for="signature"><strong>Name <span class="text-danger" title="Required field">*</span></strong></label> 
														<input type="text" name="signature" id="signature" class="form-control" maxlength="<?php //echo $signature_length; ?>" aria-describedby="sig_help_block" value="<?php //if(isset($selected_signature)) echo htmlspecialchars($selected_signature); ?>">
														<span id="sig_help_block" class="help-block small">Type your full name as your signature for this application.</span>
													</div>
												</div>
											</div>
										</fieldset>	-->
										<p></p>
										<input type="submit" value="Submit application" name="submit" id="submit" class="btn btn-primary" />	
									</div>	
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
	<script type="text/javascript">
		//Add method to check min allowed value
		$.validator.addMethod('minAllow', function (value, el, param) {
    		return value > param;
		});
		$.validator.addMethod('maxAllow', function (value, el, param) {
    		return value < param;
		});
		//Required/validation logic
		$("#financial_aid_application").validate({
  			rules: {
    			academic_year: "required",
				attend_summer: "required",
				attend_college: "required",
				hold_college_degree: {
					required: {
        				depends: function(element) {
          					return $("#attend_college_yes").is(":checked");
        				}
					}
				},
				"type_of_degree[]" : {
					required: {
						depends: function(element) {
          					return $("#hold_college_degree_yes").is(":checked");
        				}
					}
				},
				program_of_study : "required",
				third_party_funding : "required",
				funding_amount : {
					required: {
						depends: function(element) {
          					return $("#third_party_funding_yes").is(":checked");
        				}
					},
					minAllow: 0,
					maxAllow: <?php echo($funding_amount_length); ?>,
					number: true
				},
				funding_source : {
					required: {
						depends: function(element) {
          					return $("#third_party_funding_yes").is(":checked");
        				}
					}
				},
				apply_for_fa : "required",
				"types_of_loan[]" : {
					required: {
						depends: function(element) {
          					return $("#apply_for_fa_yes").is(":checked");
        				}
					}
				},
				<?php 
				foreach( $quarters as $ac_year=>$acy_quarters) {
				?>
					"require_loan_quarters_<?php echo $ac_year; ?>[]" : {
						required: {
							depends: function(element) {
          						return ( $("#apply_for_fa_yes").is(":checked") && ($("input:radio[name='academic_year']:checked").val() === "<?php echo $ac_year; ?>") );
        					}
						}
					},
				<?php
					foreach($acy_quarters as $key=>$value) {
				?>
						anticipated_credits_for_quarter_<?php echo $key; ?> : {
							required: {
								depends: function(element) {
									return ( ($("input:radio[name='academic_year']:checked").val() === "<?php echo $ac_year; ?>") && $("#require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>").is(":checked") );
								}
							}
						},
				<?php
					}
				}
				?>
				expected_graduation_date : "required",
				//fa_contract_agreement : "required",
				//signature : "required",
  			},
			messages: {
				academic_year: "Select the academic year.",
				attend_summer: "Select whether you plan to attend during the summer.",
				attend_college: "Choose if you have previously attended college or university.",
				hold_college_degree : "Choose whether you hold a college degree.",
				"type_of_degree[]" : "Choose the type(s) of degree(s) you hold.",
				program_of_study : "Select your intended program of study.",
				third_party_funding : "Select whether you are receiving scholarship/funding from a third party.",
				funding_amount : {
					required: "Enter the funding amount.",
					minAllow: "The funding amount must be a valid number greater than 0.",
					maxAllow: "The funding amount must be less than <?php echo($funding_amount_length); ?>.",
					number: "The funding amount must be a valid number greater than 0."
				},
				funding_source : "Enter additional information about the funding source.",
				apply_for_fa : "Select if you would like to apply for financial aid loans.",
				"types_of_loan[]" : "Choose the type(s) of loans you would like to apply for.",
				<?php 
				foreach( $quarters as $ac_year=>$acy_quarters) {
				?>
					"require_loan_quarters_<?php echo $ac_year; ?>[]" : "Select the quarters for which you will require loans.",
				<?php
					foreach($acy_quarters as $key=>$value) {
				?>
						anticipated_credits_for_quarter_<?php echo $key; ?> : "Select your anticipated credits for <?php echo $value; ?>.",
				<?php
					}
				}
				?>
				expected_graduation_date : "Select your expected graduation date.",
				//fa_contract_agreement : "You must check that you understand that if you do not follow the financial aid contract it may result in the loss of financial aid.",
				//signature: "Enter your full name as your signature for this application."
			},
			highlight : function (element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight : function (element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			showErrors : function (errorMap, errorList) {

        		// output summary error message
        		var msg = "<div class='alert alert-danger' role='alert'>Your application form contains errors. See details below.<div>"				
				$("#errors").html(msg);
		
				// also show default labels from errorPlacement callback
				this.defaultShowErrors(); 
		
				// toggle the error summary box
				if (this.numberOfInvalids() > 0) {
					$("#errors").show();
				} else {
					$("#errors").hide();
				}

    		},
			errorElement : 'span',
			errorClass : 'help-block',
			errorPlacement : function (error, element) {
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else if (element.parent('.radio') || element.parent('.radio-inline') || element.parent('.checkbox') ) {
					error.appendTo(element.closest('.form-group')); 
				} else {
					error.insertAfter(element);
				}
			}
		});
	</script>
	<script type="text/javascript">
		//Show/hide and dynamic required attribute logic
		$(document).ready(function () {
			/******** Hide groups of elements as needed ********/
			
			//Check current or pre-selected states
			if( !$("[name='academic_year']").is(":checked") ) {
				$("#form_remainder").removeClass("hide").addClass("hide");
			}
			if( !$("#attend_college_yes").is(":checked") || $("#attend_college_no").is(":checked") ) { 
				$("#form_degree_info").addClass("hide");
				$("#hold_college_degree_yes").prop("required", false);
			}
			if( !$("#hold_college_degree_yes").is(":checked") || $("#hold_college_degree_no").is(":checked") ) { 
				$("#form_degree_type").addClass("hide");
			}
			if( !$("#third_party_funding_yes").is(":checked") || $("#third_party_funding_no").is(":checked") ) { 
				$("#form_additional_funding_info").addClass("hide");
			}
			if( !$("#apply_for_fa_yes").is(":checked") || $("#apply_for_fa_no").is(":checked") ) { 
				$("#form_loan_info").addClass("hide"); 
			}
	
			<?php 
				foreach($quarters as $ac_year=>$acy_quarters) {
			?>
					if ( $("[name='academic_year']:checked").val() !== "<?php echo $ac_year; ?>") {
						$("#form_quarters_<?php echo $ac_year; ?>").removeClass("hide").addClass("hide");
					}
			<?php 
					foreach($acy_quarters as $key=>$value) {
			?>
						if( ($("[name='academic_year']:checked").val() !== "<?php echo $ac_year; ?>") || !$("#require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>").is(":checked") ) {
							$("#anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>").removeClass("hide").addClass("hide"); 
						}
						if( $("[name='academic_year']:checked").val() === "<?php echo $ac_year; ?>" && $("#require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>").is(":checked") ) {
							$("#anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>").removeClass("hide");
						}
						$("#require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>").on("touchend click", function() {
							if($(this).is(":checked")) { $("#anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>").removeClass("hide"); }
							if(!$(this).is(":checked")) { $("#anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>").removeClass("hide").addClass("hide"); } 
						});
			<?php
					}
				}
			?>
			
			// check changing states
			$("[name='academic_year']").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_remainder").removeClass("hide"); }
			});
			$("[name='academic_year']").on("change", function() {
				var year = $("[name='academic_year']:checked").val();
				$(".quarters-container").removeClass("hide").addClass("hide");
				$("#form_quarters_" + year).removeClass("hide");
				<?php 
					foreach($quarters as $ac_year=>$acy_quarters) {
						foreach($acy_quarters as $key=>$value) {
				?> 
							if( year === "<?php echo $ac_year; ?>" && $("#require_loan_quarters_<?php echo $ac_year; ?>_<?php echo $key; ?>").is(":checked") ) {
								$("#anticipated_credits_<?php echo $ac_year; ?>_<?php echo $key; ?>").removeClass("hide");
							}
				<?php
						}
					}
				?>
			});

			$("#attend_college_no").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_degree_info").removeClass("hide").addClass("hide"); }
			});
			$("#third_party_funding_no").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_additional_funding_info").removeClass("hide").addClass("hide"); }
			});
			$("#apply_for_fa_no").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_loan_info").removeClass("hide").addClass("hide"); }
			});
			$("#attend_college_yes").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_degree_info").removeClass("hide"); }
			});
			$("#hold_college_degree_yes").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_degree_type").removeClass("hide"); }
			});
			$("#hold_college_degree_no").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_degree_type").removeClass("hide").addClass("hide"); }
			});
			$('#third_party_funding_yes').on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_additional_funding_info").removeClass("hide"); }
			});
			$("#apply_for_fa_yes").on("touchend click", function() {
   				if($(this).is(":checked")) { $("#form_loan_info").removeClass("hide"); }
			});
		});
	</script>
</body>

</html>
