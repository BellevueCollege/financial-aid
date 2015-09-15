<?php
	require_once('faform-model.php');
	Class Form_Post_Model extends Faform_Model{
/*
	Declaring variables to collect posted form information
	pv stands for post value
*/
		protected $academic_year_pv;
		protected $attend_summer_pv;
		protected $attend_college_pv;
		protected $hold_college_degree_pv;
		protected $type_of_degree_pv; 
		protected $program_of_study_pv;
		protected $third_party_funding_pv;
		protected $funding_amount_pv;
		protected $funding_source_pv;
		protected $apply_for_fa_pv;
		protected $types_of_loan_pv;
		protected $require_loan_quarters_pv;
		protected $anticipated_credits_for_quarter_pv;
		protected $expected_graduation_date_pv;
		protected $release_student_info_box1_pv;
		protected $release_student_info_box2_pv;
		protected $auth_rep_name1_pv;
		protected $auth_rep_name2_pv;
		protected $fa_contract_agreement_pv;
		protected $signature_pv;
		protected $submit_pv;
// Declare $post variable
		protected $post;

		public function __construct($template_uri, $form_post_url,$post){
		parent::__construct($template_uri , $form_post_url);
		$this->post = $post;
		$this->set_post_variables($post);
		

	}

/*
	extract $post variables and set them 
*/

function set_post_variables($post)
{
	//var_dump($post);
	$this->academic_year_pv = (!empty($post['academic_year'])) ? $post['academic_year'] : null;
	$this->attend_summer_pv = (isset($post['attend_summer']) && !is_null($post['attend_summer'])) ? $post['attend_summer'] : null;
	$this->attend_college_pv = (isset($post['attend_college']) && !is_null($post['attend_college'])) ? $post['attend_college'] : null;
	$this->hold_college_degree_pv = (isset($post['hold_college_degree']) && !is_null($post['hold_college_degree'])) ? $post['hold_college_degree'] : null;
	$this->type_of_degree_pv = (!empty($post['type_of_degree']))? $post['type_of_degree'] : null;
	$this->program_of_study_pv = (!empty($post['program_of_study'])) ? $post['program_of_study'] : null;
	$this->third_party_funding_pv = (isset($post['third_party_funding']) && !is_null($post['third_party_funding'])) ? $post['third_party_funding'] : null;
	//var_dump($post);
	if(!empty($post['funding_amount']) && $this->check_only_spaces_string($post['funding_amount']))
	{		
		$this->funding_amount_pv = $post['funding_amount'] ;
	}else {
		$this->funding_amount_pv = null;
	} 
	if(!empty($post['funding_source']) && $this->check_only_spaces_string($post['funding_source']))
	{
		$this->funding_source_pv = $post['funding_source'] ;
	}else {
		$this->funding_source_pv = null;
	} 
	
	$this->apply_for_fa_pv = (isset($post['apply_for_fa']) && !is_null($post['apply_for_fa'])) ? $post['apply_for_fa'] : null;
	$this->types_of_loan_pv = (!empty($post['types_of_loan'])) ? $post['types_of_loan'] : null;
	$this->require_loan_quarters_pv = (!empty($post['require_loan_quarters'])) ? $post['require_loan_quarters'] : null;
	$anticipated_credits = array();
	if(!empty($this->require_loan_quarters_pv) && is_array($this->require_loan_quarters_pv))
	{
		for($i=0;$i<count($this->require_loan_quarters_pv);$i++)
		{
			$anticipated_credits_for_quarter = 'anticipated_credits_for_quarter_'.$this->require_loan_quarters_pv[$i];
			if(!empty($post[$anticipated_credits_for_quarter]))
				$anticipated_credits[$this->require_loan_quarters_pv[$i]] = $post[$anticipated_credits_for_quarter];
			
		}
	}
	$this->anticipated_credits_for_quarter_pv = $anticipated_credits;
	$this->expected_graduation_date_pv = (!empty($post['expected_graduation_date'])) ? $post['expected_graduation_date'] : null;
	$this->release_student_info_box1_pv = (!empty($post['release_student_info_box1'])) ? $post['release_student_info_box1'] : null;
	$this->release_student_info_box2_pv = (!empty($post['release_student_info_box2'])) ? $post['release_student_info_box2'] : null;
	if(!empty($post['auth_rep_name1']) && $this->check_only_spaces_string($post['auth_rep_name1']))
	{
		$this->auth_rep_name1_pv = $post['auth_rep_name1'];
	}else{ $post['auth_rep_name1'] = null; }

	if(!empty($post['auth_rep_name2']) && $this->check_only_spaces_string($post['auth_rep_name2']))
	{
		$this->auth_rep_name2_pv = $post['auth_rep_name2'];
	}else{ $post['auth_rep_name2'] = null; }
	
	$this->fa_contract_agreement_pv = (isset($post['fa_contract_agreement'])  && !is_null($post['fa_contract_agreement'])) ? $post['fa_contract_agreement'] : null;
	$this->signature_pv = (!empty($post['signature'])) ? $post['signature'] : null;
	$this->submit_pv = (isset($post['submit']) && !is_null($post['submit'])) ? $post['submit'] : null;

}

// Get academic year post value

function get_academic_year_pv()
{
	return $this->academic_year_pv;
}
// Get attend summer post value
function get_attend_summer_pv()
{
	return $this->attend_summer_pv;
}
// Get academic college post value
function get_attend_college_pv()
{
	return $this->attend_college_pv;
}
// Get hold college degree post value
function get_hold_college_degree_pv()
{
	return $this->hold_college_degree_pv;
}
// Get type of degree post value
function get_type_of_degree_pv()
{
	return $this->type_of_degree_pv;
}
// Get program of study post value
function get_program_of_study_pv()
{
	return $this->program_of_study_pv;
}
// Get third party funding post value
function get_third_party_funding_pv()
{
	return $this->third_party_funding_pv;
}
// Get funcding amount post value
function get_funding_amount_pv()
{
	return $this->funding_amount_pv;
}
// Get funding source post value
function get_funding_source_pv()
{
	return $this->funding_source_pv;
}
// Get apply for financial aid post value
function get_apply_for_fa_pv()
{
	return $this->apply_for_fa_pv;
}
// Get types of loan post value
function get_types_of_loan_pv()
{
	return $this->types_of_loan_pv;
}
// Get require loan quarters post value
function get_require_loan_quarters_pv()
{
	return $this->require_loan_quarters_pv;
}
// Get anticipate credits for quarters post value
function get_anticipated_credits_for_quarter_pv()
{
	return $this->anticipated_credits_for_quarter_pv;
}
// Get expected graduation date post value
function get_expected_graduation_date_pv()
{
	return $this->expected_graduation_date_pv;
}
// Get release student info box1 post value
function get_release_student_info_box1_pv()
{
	return $this->release_student_info_box1_pv;
}
// Get release student info box2 post value
function get_release_student_info_box2_pv()
{
	return $this->release_student_info_box2_pv;
}
// Get auth rep name1 post value
function get_auth_rep_name1_pv()
{
	return $this->auth_rep_name1_pv;
}
// Get auth rep name2 post value
function get_auth_rep_name2_pv()
{
	return $this->auth_rep_name2_pv;
}
// Get fa contrat agreement post value
function get_fa_contract_agreement_pv()
{
	return $this->fa_contract_agreement_pv;
}
// Get signature post value
function get_signature_pv()
{
	return $this->signature_pv;
}
// Get submit post value
function get_submit_pv()
{
	return $this->submit_pv;
}


/*
	Save form to the database.
*/
	function save_form()
	{			
		//$sid = $this->get_sid();
                $academic_yr = $this->get_academic_year_pv();                
                // Check if a record already exists for given sid and academic year
                $check = $this->get_faappid($academic_yr);
                //var_dump($check);
                if(empty($check))
                {
			
		try{
				$sql_stmt = $this->create_insert_form_data_sql();					
				$values = $this->create_field_value_mapping();										
				$query = $this->database_connection->prepare($sql_stmt); 
				//var_dump($values);
				$query->execute($values);
				//var_dump($query);
				$return_value = $query->fetch(PDO::FETCH_ASSOC);
				$id = isset($return_value['FAAppID']) ? $return_value['FAAppID'] : null;
				//var_dump($return_value);
                                //exit();
				if(!empty($id))
				{

				// Save quarters requiring loan information
				
					if(is_array($this->require_loan_quarters_pv))
					{
						for($i=0;$i<count($this->require_loan_quarters_pv);$i++)
						{
							$anticipated_credits_for_quarter = '';
							if(isset($this->anticipated_credits_for_quarter_pv[$this->require_loan_quarters_pv[$i]]))
							{
								$anticipated_credits_for_quarter = $this->anticipated_credits_for_quarter_pv[$this->require_loan_quarters_pv[$i]] ;
							}
							$sql_stmt = "EXEC dbo.usp_InsertQuartersRequiringLoan 
											@FAAppID = :FAAppID,											
											@YearQuarterID = :YearQuarterID,
											@CreditID = :CreditID
										";
                                                    $values = array(':FAAppID' 		=> $id,											
                                                                    ':YearQuarterID' 	=> $this->require_loan_quarters_pv[$i],
                                                                    ':CreditID'		=> $anticipated_credits_for_quarter
                                                                    );
							$query = $this->database_connection->prepare($sql_stmt); 
							//var_dump($values);
							$query->execute($values);
						}					
					}
				

					// Save type of degree information			
					
					if(is_array($this->type_of_degree_pv))
					{
						for($i=0;$i<count($this->type_of_degree_pv);$i++)
						{						
							$sql_stmt = "EXEC dbo.usp_InsertTypeofDegreeHeld 
											@FAAppID = :FAAppID,											
											@TypeofDegree = :TypeofDegree											
										";
							$values = array(':FAAppID' 		=> $id,											
									':TypeofDegree' 	=> $this->type_of_degree_pv[$i]								
										   );
							$query = $this->database_connection->prepare($sql_stmt); 
							//var_dump($values);
							$query->execute($values);
						}					
					}

					// Save type of loan requested information
					
					if(is_array($this->types_of_loan_pv))
					{
						for($i=0;$i<count($this->types_of_loan_pv);$i++)
						{						
							$sql_stmt = "EXEC dbo.usp_InsertTypeofLoanRequested 
											@FAAppID = :FAAppID,											
											@TypeofLoan = :TypeofLoan
											
										";
							$values = array(':FAAppID' 	=> $id,
											
									':TypeofLoan' 	=> $this->types_of_loan_pv[$i]								
										   );
							$query = $this->database_connection->prepare($sql_stmt); 
							//var_dump($values);
							$query->execute($values);
						}					
					}
				} // end of if(!empty($id))
				else
				{
					return false;
				}		
					
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}
                        
                    return true;
                }
                else
                {
                    return 'record exists';
                }
                return false;
	}
/*
	Create sql statement for inserting form data into database
*/

	function create_insert_form_data_sql()
	{
		$sql_stmt = "EXEC dbo.usp_InsertFAFormData
							 @AcademicYrChosen = :AcademicYrChosen,
							 @AttendedSummer = :AttendedSummer,
							 @FirstName = :FirstName,
							 @LastName = :LastName,
							 @DOB = :DOB,
							 @Phone = :Phone,
							 @SSN = :SSN,
							 @SID = :SID,
							 @Email = :Email,
							 @AttendedCollege = :AttendedCollege,
							 @HoldCollegeDegree = :HoldCollegeDegree,
							 @POS = :POS,
							 @ReceivedThirdPartyFunding = :ReceivedThirdPartyFunding,
							 @FundingAmount = :FundingAmount,
							 @OtherFundingSource = :OtherFundingSource,
							 @ApplyForFinancialAid = :ApplyForFinancialAid,							 
							 @ReleaseStudentInfoBox1 = :ReleaseStudentInfoBox1,
							 @ReleaseStudentInfoBox2 = :ReleaseStudentInfoBox2,
							 @AuthRepName1 = :AuthRepName1,
							 @AuthRepName2 = :AuthRepName2,
							 @FAContractAgreement = :FAContractAgreement,
							 @Signature = :Signature,
							 @ExpectedGraduatedDate = :ExpectedGraduatedDate,
							 @DateSubmitted = :DateSubmitted
							 ;"; 
		//error_log($sql_stmt);	
		return $sql_stmt;
	}
/*
	Create a mapping of column field (in database) and its value to be stored
*/
	function create_field_value_mapping()
	{
		$current_date_time = date('Y-m-d H:i:s');
		$values = array(':AcademicYrChosen' 		=> $this->academic_year_pv,
						':AttendedSummer'   		=> $this->attend_summer_pv,
						':FirstName'				=> $this->first_name,
						':LastName'					=> $this->last_name,
						':DOB'						=> $this->dob,
						':Phone'					=> $this->phone,
						':SSN'						=> $this->ssn,
						':SID'						=> $this->sid,
						':Email'					=> $this->email,
						':AttendedCollege'			=> $this->attend_college_pv,
						':HoldCollegeDegree'		=> $this->hold_college_degree_pv,
						':POS'						=> $this->program_of_study_pv,
						':ReceivedThirdPartyFunding'=> $this->third_party_funding_pv,
						':FundingAmount' 			=> floatval($this->funding_amount_pv),
						':OtherFundingSource'		=> $this->funding_source_pv,
						':ApplyForFinancialAid'		=> $this->apply_for_fa_pv,						
						':ReleaseStudentInfoBox1'	=> $this->release_student_info_box1_pv,
						':ReleaseStudentInfoBox2'	=> $this->release_student_info_box2_pv,
						':AuthRepName1'				=> $this->auth_rep_name1_pv,
						':AuthRepName2'				=> $this->auth_rep_name2_pv,
						':FAContractAgreement'		=> $this->fa_contract_agreement_pv,
						':Signature'				=> $this->signature_pv,
						':ExpectedGraduatedDate'	=> $this->expected_graduation_date_pv,
						':DateSubmitted'		=> $current_date_time
					);
		return $values;
	}

	}
?>