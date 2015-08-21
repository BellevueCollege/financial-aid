<?php
	require_once('faform-model.php');
	Class Form_Post_Model extends Faform_Model{

		public function __construct($template_uri, $form_post_url){
		parent::__construct($template_uri , $form_post_url);

	}

/*
	Save form to the database.
*/
	function save_form($post)
	{	
		//var_dump($post);
		$username = $_SESSION['FA_USERNAME'];
		$user_information = $this->get_student_information($username);		
			
		try{
				$sql_stmt = $this->create_insert_form_data_sql();					
				$values = $this->create_field_value_mapping($post,$user_information);										
				$query = $this->database_connection->prepare($sql_stmt); 
				//var_dump($values);
				$query->execute($values);
				//var_dump($query);
				$return_value = $query->fetch(PDO::FETCH_ASSOC);
				$id = isset($return_value['FAAppID']) ? $return_value['FAAppID'] : null;
				//var_dump($return_value);				
				if(!empty($id))
				{

				// Save quarters requiring loan information
				
					if(isset($post['require_loan_quarters']) && is_array($post['require_loan_quarters']))
					{
						for($i=0;$i<count($post['require_loan_quarters']);$i++)
						{
							$anticipated_credits_for_quarter = $post['anticipated_credits_for_quarter_'.$post['require_loan_quarters'][$i]];
							$sql_stmt = "EXEC dbo.usp_InsertQuartersRequiringLoan 
											@FAAppID = :FAAppID,
											@SID = :SID,
											@YearQuarterID = :YearQuarterID,
											@CreditID = :CreditID
										";
							$values = array(':FAAppID' 			=> $id,
											':SID' 	   			=> $user_information['SID'],
											':YearQuarterID' 	=> $post['require_loan_quarters'][$i],
											':CreditID'			=> $anticipated_credits_for_quarter
										   );
							$query = $this->database_connection->prepare($sql_stmt); 
							//var_dump($values);
							$query->execute($values);
						}					
					}
				

					// Save type of degree information			
					
					if(isset($post['type_of_degree']) && is_array($post['type_of_degree']))
					{
						for($i=0;$i<count($post['type_of_degree']);$i++)
						{						
							$sql_stmt = "EXEC dbo.usp_InsertTypeofDegreeHeld 
											@FAAppID = :FAAppID,
											@SID = :SID,
											@TypeofDegree = :TypeofDegree
											
										";
							$values = array(':FAAppID' 			=> $id,
											':SID' 	   			=> $user_information['SID'],
											':TypeofDegree' 	=> 	$post['type_of_degree'][$i]								
										   );
							$query = $this->database_connection->prepare($sql_stmt); 
							//var_dump($values);
							$query->execute($values);
						}					
					}

					// Save type of loan requested information
					
					if(isset($post['types_of_loan']) && is_array($post['types_of_loan']))
					{
						for($i=0;$i<count($post['types_of_loan']);$i++)
						{						
							$sql_stmt = "EXEC dbo.usp_InsertTypeofLoanRequested 
											@FAAppID = :FAAppID,
											@SID = :SID,
											@TypeofLoan = :TypeofLoan
											
										";
							$values = array(':FAAppID' 			=> $id,
											':SID' 	   			=> $user_information['SID'],
											':TypeofLoan' 		=> 	$post['types_of_loan'][$i]								
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
							 @ExpectedGraduatedDate = :ExpectedGraduatedDate
							 ;"; 
		error_log($sql_stmt);	
		return $sql_stmt;
	}
/*
	Create a mapping of column field (in database) and its value to be stored
*/
	function create_field_value_mapping($post,$user_information)
	{
		
		$values = array(':AcademicYrChosen' 		=> $post['academic_year'],
						':AttendedSummer'   		=> $post['attend_summer'],
						':FirstName'				=> $user_information['FirstName'],
						':LastName'					=> $user_information['LastName'],
						':DOB'						=> $user_information['DOB'],
						':Phone'					=> $user_information['Phone'],
						':SSN'						=> $user_information['SSN'],
						':SID'						=> $user_information['SID'],
						':Email'					=> $user_information['Email'],
						':AttendedCollege'			=> $post['attend_college'],
						':HoldCollegeDegree'		=> $post['hold_college_degree'],
						':POS'						=> $post['program_of_study'],
						':ReceivedThirdPartyFunding'=> $post['third_party_funding'],
						':FundingAmount' 			=> floatval($post['funding_amount']),
						':OtherFundingSource'		=> $post['funding_source'],
						':ApplyForFinancialAid'		=> $post['apply_for_fa'],						
						':ReleaseStudentInfoBox1'	=> $post['release_student_info_box1'],
						':ReleaseStudentInfoBox2'	=> $post['release_student_info_box2'],
						':AuthRepName1'				=> $post['auth_rep_name1'],
						':AuthRepName2'				=> $post['auth_rep_name2'],
						':FAContractAgreement'		=> $post['fa_contract_agreement'],
						':Signature'				=> $post['signature'],
						':ExpectedGraduatedDate'	=> $post['expected_graduation_date']
					);
		return $values;
	}

	}
?>