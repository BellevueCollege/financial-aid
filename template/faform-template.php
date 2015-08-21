
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php
		if(!empty($globals_url))
		{ 
	?>
		<link rel="stylesheet" href="<?php echo $globals_url ?>c/g.css">
		<link rel="stylesheet" media="print" href="<?php echo $globals_url?>c/p.css">
		<script type="text/javascript" src="<?php echo $globals_url ?>j/ghead.js"></script>
	<?php
		}

	?>
	
	<style type="text/css">
		.errors{
			border: 1px solid;
    		color: red;
    		padding: 5px;
		}
	</style>	
	
	<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.0.1' type='text/css' media='all' />
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
			<div class="row">
				<div class="col-md-12">
					<div class="box-shadow" id="content">
						<div class="row row-padding">
							<div class="content-padding">
								<p class='entry-title'>&nbsp;</p>
								<h1>Financial Aid Application</h1>
								<hr />
								
								<form id="financial_aid_application" name="financial_aid_application" action="<?php if(!empty($form_post_url)) echo $form_post_url ; ?>" method="post">									
										<!-- <fieldset class='scheduler-border'>
											<legend class='schedule-border'>Choose Academic Year</legend> -->
								<?php
									if(!empty($validation_form_errors))
									{
									?>
										<div class='errors'>
									<?php
										for($i=0;$i<count($validation_form_errors);$i++)
										{
										?>											
											<?php	echo $validation_form_errors[$i] ; ?> <br/>
											
										<?php
										}
									?>
										</div>
									<?php
									}
								?>
								
										<h4>Choose Academic Year</h4><br/>

										<?php
										if(!empty($year_quarter_information))
										{
											foreach($year_quarter_information as $key=>$value)
											{
												$checked = '';
												if(!empty($selected_academic_year) && $selected_academic_year == $key)				
													$checked = 'checked';
								
										?>
											<span> Choose the Academic Year(s) you would like to apply for: *</span>
											<div class="radio">

												<label>
													<input type="radio" name="academic_year" value="<?php echo $key ;?>" class="radio" <?php  echo $checked;?>/> 
													<span><?php echo $value; ?></span>
												</label>
											</div>
										<?php
											}
										}
										?>
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
											<span> Do you plan to attend during the summer? *</span>
											<div class="radio">
												<label>
											
													<input type="radio" name="attend_summer" value="1" class="radio" <?php echo $checked_one ;?> /> 
													<span>Yes</span>
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="attend_summer" value="0" class="radio" <?php echo $checked_zero ;?> /> 
													<span>No</span>
												</label>
											</div>	
										<!-- </fieldset> -->
										<h4>Previous Schools</h4><br/>
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
											<span>Have you previously attended college or university? *</span>
											<div class="radio">
												<label>
													<input type="radio" name="attend_college" value="1" class="radio" <?php echo $checked_one; ?>/> 
													<span>Yes</span>
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="attend_college" value="0" class="radio" <?php echo $checked_zero; ?> /> 
													<span>No</span>
												</label>
											</div>
											<?php
												$checked_one = '' ; $checked_zero = '';
												if(isset($selected_hold_college_degree) )
												{
													if($selected_hold_college_degree == '1')
														$checked_one = 'checked';
													else if($selected_hold_college_degree == '0')
														$checked_zero = 'checked';
												}
											?>	
											<span>Do you hold a college degree, including degrees outside the US?</span>
											<div class="radio">
												<label>
													<input type="radio" name="hold_college_degree" value="1" class="radio" <?php echo $checked_one; ?> /> 
													<span>Yes</span>
												</label>
											</div>	
											<div class="radio">
												<label>
													<input type="radio" name="hold_college_degree" value="0" class="radio" <?php echo $checked_zero; ?> /> 
													<span>No</span>
												</label>
											</div>
											<?php
												
												
											?>		
											<span>If yes, what type of degree do you hold? *</span>
											
												<?php
												if(!empty($types_of_degree))
												{
													for($i=0;$i<count($types_of_degree);$i++)
													{
														if(isset($types_of_degree[$i]['DegreeID']))
														{
															$checked = '';
															if(!empty($selected_type_of_degree) && is_array($selected_type_of_degree) )
															{
																if(in_array($types_of_degree[$i]['DegreeID'], $selected_type_of_degree))
																	$checked = 'checked';
															}
															?>
															<div class="checkbox">
																<label>
																	<input type='checkbox' name='type_of_degree[]' value='<?php echo $types_of_degree[$i]['DegreeID']; ?>' <?php echo $checked; ?> />
																	<span><?php echo $types_of_degree[$i]['Degree']; ?></span>
																</label>
															</div>
													<?php
														}
													}
												}
												?>
												
										<h4>Program of Study</h4><br/>
											<description> 
												<p>

													<strong>Your Intended Program of Study on Record:</strong> Your intended Program of Study on Record: Your program of study is a critical component of your financial aid – failure to complete your classes successfully or complete your program in a timely manner may result in the loss of your aid.<br/>
													<ol>
														<li> Financial aid will only fund classes that are required for your degree or certificate. We can only fund programs 24 credits or more in length.</li>
														<li> The BC Financial Aid Office will use the program you indicated here to track your progress towards:</li>
															<ul>
																<li>Completion of 67% of your classes (the completion ratio, i.e. completed classes divided by attempted)</li>
																<li>Quarterly and cumulative grade point average.</li>
																<li>Maximum time frame (you may receive financial aid for up to 150% of your program’s length). </li>
															</ul>
														<li>Some forms of financial aid have lifetime maximums. You could exhaust your financial aid eligibility before completing your degree or certificate if you fail to complete your classes or change your program of study.</li>
													</ol>
												<p>
											</description>
											<div class='form-group'>
												<label for='program_of_study'>Your intended program of study: *</label>
												<select name='program_of_study' id='program_of_study' class='form-control'>
													<option value=''>Select</option>
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
														<option value='<?php echo $program_of_study_options[$i] ?>'  <?php echo $selected; ?>>
															 <?php echo $program_of_study_options[$i]; ?>
														</option>
														
													<?php	
													}
												}
												?>
												</select>
											</div>

										<h4>3rd Party Funding</h4><br/>
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
											<span>Are you receiving any outside assistance or third party funding including, but not limited to, scholarships, DVR or the state tuition waiver for state employees? *</span>
											<div class="radio">
												<label>
													<input type="radio" name="third_party_funding" value="1" class="radio"  <?php echo $checked_one; ?> /> 
													<span>Yes</span>
												</label>
												<label>
													<input type="radio" name="third_party_funding" value="0" class="radio"  <?php echo $checked_zero; ?> /> 
													<span>No</span>
												</label>
											</div>	
											<!-- Funding amount and funding amount are requie fields if user answer yes to the above field -->
											<label>Funding Amount: * </label> <input type='text' name='funding_amount' id='funding_amount' class="form-control" value='<?php if(!empty($selected_funding_amount) ) echo $selected_funding_amount ;?>' /><br/>
											
											<label>Funding source? Please explain</label>
											<textarea name='funding_source' id='funding_source' class="form-control" rows="3" >
												<?php if(!empty($selected_funding_source)) echo $selected_funding_source ; ?>
											</textarea>

										<h4>Loans (Federal Direct Stafford Loans)</h4><br/>
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
											<span>Would you like to apply for financial aid loans? *</span>
												<div class="radio">
													<label>
														<input type="radio" name="apply_for_fa" value="1" class="radio" <?php echo $checked_one; ?> /> 
														<span>Yes</span>
													</label>
													<label>
														<input type="radio" name="apply_for_fa" value="0" class="radio" <?php echo $checked_zero; ?> /> 
														<span>No</span>
													</label>
												</div>

											<span>Types of Loans:</span>
											
													<?php
													if(!empty($types_of_loan))
													{
														for($i=0;$i<count($types_of_loan);$i++)
														{
															if(!empty($types_of_loan[$i]['LoanTypeID']) && !empty($types_of_loan[$i]['LoanType']))
															{
																$checked = '';
																if(!empty($selected_types_of_loan) && is_array($selected_types_of_loan))
																{
																	$checked = 'checked';
																}
													?>
																<div class="checkbox">
																<label>
																	<input type='checkbox' name='types_of_loan[]' value='<?php echo $types_of_loan[$i]['LoanTypeID']; ?>'  <?php echo $checked; ?> />
																	<span><?php echo $types_of_loan[$i]['LoanType']; ?></span>
																</label>
																</div>
														<?php
															}
														}
													}
													?>
											<div id='require_loans' >
												<span>Choose the Quarters you will require loans for:</span>
												<!-- Show/Hide quarter depending on the Year selected -->
												
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
																<label>
																	<input type='checkbox' name='require_loan_quarters[]' value='<?php echo $key; ?>'  <?php echo $checked; ?>  />
																	<?php echo $value; ?>
																</label>
															</div>
															<div id="anticipated_credits">
																<?php
															if(!empty($credit_options))
															{
																for($i=0;$i<count($credit_options);$i++)
																{
																	$checked = '' ;
																	if(!empty($credit_options[$i]) && isset($credit_options[$i]['CreditID']) && isset($credit_options[$i]['Credit']))
																	{
																		if(!empty($selected_anticipated_credits_for_quarter) && is_array($selected_anticipated_credits_for_quarter) && isset($selected_anticipated_credits_for_quarter[$key]))
																		{
																			if($selected_anticipated_credits_for_quarter[$key] == $credit_options[$i]['CreditID'])
																					$checked = 'checked';
																		}
																?>
																<div class="radio">
																	<label>
																		<input type="radio" name="anticipated_credits_for_quarter_<?php echo $key; ?>" value="<?php echo $credit_options[$i]['CreditID'] ?>" class="radio"  <?php echo $checked; ?>/> 
																		<span><?php echo $credit_options[$i]['Credit'] ?></span>
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
											<div>
												<span>Expected Graduation Date: *</span>
												<select id='expected_graduation_date' name='expected_graduation_date' class='form-control'>
												<?php
												if(!empty($expected_graduation_year_array))
												{	
													for($i=0;$i<count($expected_graduation_year_array);$i++)
													{
														$selected = '';
														if(!empty($selected_expected_graduation_date) &&  $selected_expected_graduation_date == $expected_graduation_year_array[$i])
																$selected = 'selected';
													?>
														<option value='<?php echo $expected_graduation_year_array[$i] ?>' <?php echo $selected; ?> ><?php echo $expected_graduation_year_array[$i] ?></option>
													<?php
													}
												}
												?>
												</select>
												<span id="helpBlock" class="help-block">When do you expect to complete your degree or certificate classes? (For example it usually takes two years to complete an AA, start fall 2014 finish spring 2016).</span>
											</div>

										<h4>Information Release</h4><br/>
											<div><!-- Information release description -->
												<strong>
													This section is optional. Only complete this section if you wish to allow an authorized representative to access your financial aid information. Commonly this would be a parent, guardian or relative.
												</strong>

											</div><!--End of Information Release description div -->
											<br/>
											<span>Permissions to Release Student Information:</span>
											<?php
												$checked = '';
												if(!empty($selected_release_student_info_box1) && $selected_release_student_info_box1 == '1')
														$checked = 'checked = checked';
											?>
											<div class="checkbox">
											  <label>					
											    <input type="checkbox" value="1" name='release_student_info_box1' <?php echo $checked; ?>>
											    	I give the Bellevue College Financial Aid Office permission to discuss my financial aid application status, award, or eligibility with the following individual(s). I understand that this permission will remain in force from the date the office notes receipt of this form until the last day of Spring quarter of the academic year(s) you are applying for.
											  </label>
											</div>
											<?php
												$checked = '';
												if(!empty($selected_release_student_info_box2) && $selected_release_student_info_box2 == '1')
														$checked = 'checked = checked';
											?>
											<div class="checkbox">
											  <label>
											    <input type="checkbox" value="1" name='release_student_info_box2' >
											    	I authorize the release of award letters or other documents to the individual(s) listed below. This permission does not include check pickup. Visit our office for an additional form to grant the release of checks.
											  </label>
											</div>
											<div>
												The Bellevue College Financial Aid Office will release information from your record to the person(s) identified below as an authorized representative. We will not permit the authorized representative to pick up financial aid documents (award letters, etc.) from our office unless specify. Permission to release information is granted for one financial aid year (Summer through Spring Quarter). You may cancel this permission at any time by submitting an additional written statement requesting cancellation. Please check appropriate permissions below.
											</div>
											<div class='form-group'>
												<label for='auth_rep_name1'>Authorized Representative's Name:</label>
												<input type="text" name='auth_rep_name1' id='auth_rep_name1' class='form-control' maxlength='50' value='<?php if(isset($selected_auth_rep_name1)) echo $selected_auth_rep_name1; ?>'/>
												
											</div>
											<div class='form-group'>
												<label for='auth_rep_name2'>Authorized Representative's Name:</label>
												<input type="text" name='auth_rep_name2' id='auth_rep_name2' class='form-control' maxlength='50' value='<?php if(isset($selected_auth_rep_name2)) echo $selected_auth_rep_name2; ?>'/>
												
											</div>
										<h4>Sign & Finish</h4><br/>
											<div class='form-group'>
												I understand that if I do not follow the financial aid contract it may result in the loss of my financial aid: *
											</div>
											<?php 
												$checked = '';
												if(!empty($selected_fa_contract_agreement) && $selected_fa_contract_agreement == '1')
														$checked = 'checked';
											 ?>
											<div class="checkbox">
											  <label>
											    <input type="checkbox" value="1" name='fa_contract_agreement' <?php echo $checked; ?>>
											    	I agree
											  </label>
											</div>
											<div class='form-group'>
												<label for='signature'>Name:</label>
												<input type="text" name='signature' id='signature' class='form-control' maxlength='100' value='<?php if(isset($selected_signature)) echo $selected_signature; ?>'>
												<span id="helpBlock" class="help-block">Type your full name as your signature for this application.</span>
											</div>
											<blockquote>
												<p>Communication</p>
												<footer>
													 <?php if(!empty($Email)) echo $Email; ?> is the email address on file for you. Communications will be conducted using this address.
												</footer>
											</blockquote>
										<input type='submit' value='Submit' name='submit' />	
										
								</form>
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

	<?php
		if(!empty($globals_path))
		{
		 	include( $globals_path  . 'h/bfoot.html' ); 
		 	include( $globals_path  . 'h/legal.html' );
		}
		if(!empty($globals_url))
		{
	?>
			<script src="<?php echo $globals_url ?>j/bootstrap.min.js"></script>
			<script src="<?php echo $globals_url ?>j/g.js"></script>
	<?php
		}
	?>

	
</body>

</html>
