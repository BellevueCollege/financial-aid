<?php
//require_once('config.php');
//require_once('model/database-model.php');

Class Default_Model{


//protected $db_conn; // database connection object variable
protected  $database_connection;
// Path to a HTML template file to be used by a view.
protected $template_uri;

protected $first_name; // logged in user's first name

protected $last_name; // logged in user's last name

protected $dob; // logged in user's date of birth

protected $phone; // logged in user's phone

protected $ssn; // logged in user's ssn information

protected $sid; // logged in user's sid

protected $email; // logged in user's email id

protected $form_url;

const FORM_URI = 'application';

public function __construct($template_uri) {
	if($this->check_database_config())
	{
		try{

				$this->database_connection = new PDO( $GLOBALS['DATABASE_DSN'], $GLOBALS['DATABASE_USER'],$GLOBALS['DATABASE_PASSWORD'] );
				if (!$this->database_connection) 
		    		die('Something went wrong while connecting to the database'); // exit out 
			} catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}
	}
	else
		 die(' Database configuration not set'); // exit out 
	$this->template_uri = $template_uri;

	// set user information
	$username = $_SESSION['FA_USERNAME'];
	$user_information = $this->get_student_information($username);
	$this->first_name = isset($user_information['FirstName']) ? $user_information['FirstName'] : null;
	$this->last_name = isset($user_information['LastName']) ? $user_information['LastName'] : null;
	$this->dob = isset($user_information['DOB']) ? $user_information['DOB'] : null;
	$this->phone = isset($user_information['Phone']) ? $user_information['Phone'] : null;
	$this->ssn = isset($user_information['SSN']) ? $user_information['SSN'] : null;
	$this->sid = isset($user_information['SID']) ? $user_information['SID'] : null;
	$this->email = isset($user_information['Email']) ? $user_information['Email'] : null;
        /* Set form url */
        $this->set_form_url();
	}// end of constructor

/*
	Check database configuration variables exists
*/
	function check_database_config()
	{
		if(isset($GLOBALS['DATABASE_DSN']) && !empty($GLOBALS['DATABASE_DSN']) && isset($GLOBALS['DATABASE_USER']) && !empty($GLOBALS['DATABASE_USER']) && isset($GLOBALS['DATABASE_PASSWORD']) && !empty($GLOBALS['DATABASE_PASSWORD'] ))
			return 1;

		return 0;
	}
/*
	Set template URI
*/
	public function set_template_uri($template_uri)
	{
		//echo $template_uri;
		$this->template_uri = $template_uri;
	}


/*
	Get User first name
*/
	public function get_first_name()
	{		
		return $this->first_name;
	}


/*
	Get User last name
*/
	public function get_last_name()
	{		
		return $this->last_name;
	}

/*
	Get User date of birth
*/
	public function get_dob()
	{		
		return $this->dob;
	}
/*
	Get User phone
*/
	public function get_phone()
	{		
		return $this->phone;
	}
/*
	Get User ssn
*/
	public function get_ssn()
	{		
		return $this->ssn;
	}
/*
	Get User sid
*/
	public function get_sid()
	{		
		return $this->sid;
	}
/*
	Get User email
*/
	public function get_email()
	{		
		return $this->email;
	}

/*
	check if the string only has spaces
*/

function check_only_spaces_string($input)
{
	if (strlen(trim($input)) == 0) {
	    return false;// "String is empty.\n";
	}
	return true;
}

/*
	Get Academic Year Quarters 
*/
	public function get_academic_year_quarters()
	{
		$quarter_information = array();
		$current_year = date("Y");
		$current_month = date("m");		
		/*
			If currnet month is less than the conditional month query twice, else query once
		*/
		try{
				$q_sql = "EXEC dbo.usp_getAcademicYear @CurrentYear = :CurrentYear;"; // quarter(q) sql

				if(isset($GLOBALS['CONDITIONAL_MONTH']) && $current_month < $GLOBALS['CONDITIONAL_MONTH']) // For Month's from Jan to June
				{					
					$previous_year = $current_year-1;					
					$values = array(':CurrentYear' => $previous_year);	
					$query = $this->database_connection->prepare($q_sql); 
					$query->execute($values);			
					$quarter_data = $query->fetch(PDO::FETCH_ASSOC);
					$quarter_information[] = $quarter_data['AcademicYearQuarter'];									
				}									
				$values = array(':CurrentYear' => $current_year);				
				$query = $this->database_connection->prepare($q_sql); 
				$query->execute($values);			
				$quarter_data = $query->fetch(PDO::FETCH_ASSOC);
				$quarter_information[] = $quarter_data['AcademicYearQuarter'];
					
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}		
		return $quarter_information;		
		
	}//end of get_academic_years function

/*
	Get YearQuarterID information for a given quarter title 
*/
	public function get_year_quarter_id($title)
	{
		if(!empty($title))
		{
			try{
					$yqid_sql = "EXEC dbo.usp_getYearQuarterID @title= :Title;"; // year quarter id(yqid) sql
					$values = array(':Title' => $title);
					$query = $this->database_connection->prepare($yqid_sql); 
					$query->execute($values);			
					$year_quarter_id = $query->fetch(PDO::FETCH_ASSOC);		
					return $year_quarter_id;
				}catch(PDOException $e)
				{
					echo 'ERROR: ' . $e->getMessage();
				}
		}
		return null;
	}
/*
	Get Title for a given YearQuarterID
*/
	public function get_year_quarter_title($year_quarter_id)
	{
		if(!empty($year_quarter_id))
		{
			try{
					$yqt_sql = "EXEC dbo.usp_getYearQuarterTitle @yearQuarterID= :YearQuarterID;"; // year quarter title(yqt) sql
					$values = array(':YearQuarterID' => $year_quarter_id);
					$query = $this->database_connection->prepare($yqt_sql); 
					$query->execute($values);			
					$year_quarter_title = $query->fetch(PDO::FETCH_ASSOC);	
					if(!empty($year_quarter_title['Title']))
					{
						$title = $year_quarter_title['Title'];
						// Convert 'Sum', 'Win', 'Spr' to 'Summer', 'Winter', 'Spring'
						$explode_title = explode(' ',$title);
						$quarter = '';
						switch($explode_title[0])
						{
							case 'Spr':
								$quarter = 'Spring';
								break;
							case 'Sum':
								$quarter = 'Summer';
								break;
							case 'Win':
								$quarter = 'Winter';
								break;
                                                        case 'Fall':
                                                                $quarter = 'Fall';
								break;
						}
						$quarter_title = $quarter. ' '.$explode_title[1];
						return $quarter_title;
					}	
						
				}catch(PDOException $e)
				{
					echo 'ERROR: ' . $e->getMessage();
				}
		}
		return null;
	}

/*
	Get Credits per quarter option values
*/
	public function get_credit_options()
	{
		try{
			$cpq_sql = "EXEC dbo.usp_getCreditsPerQtr;"; // credit per quarter(cpq) sql
			$query = $this->database_connection->prepare($cpq_sql); 
			$query->execute();			
			$credits_options = $query->fetchAll(PDO::FETCH_ASSOC);		
			return $credits_options;
		}catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
		return null;
	}
/*
	Get Program of Study options (poso)
*/
	public function get_program_of_study_options()
	{
		$program_of_study_options = array();
		try{		
				$poso_sql = "EXEC dbo.usp_getProgramOfStudy;"; // program of study options (poso) sql
				$query = $this->database_connection->prepare($poso_sql);		
				$query->execute();			
				$pos_options = $query->fetchAll(PDO::FETCH_ASSOC); // program of study (pos)
				
				for($i=0;$i<count($pos_options);$i++)
				{
					$program_of_study_options[] = $pos_options[$i]['ProgramofStudy'];
				}
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}
		return $program_of_study_options;

		
	}

/*
	Get types of degree options (todo)
*/
	public function get_types_of_degree_options()
	{	
		try{	
				$todo_sql = "EXEC dbo.usp_getTypeofDegree;"; // types of degree options (todo) sql
				$query = $this->database_connection->prepare($todo_sql); 		
				$query->execute();			
				$tod_options = $query->fetchAll(PDO::FETCH_ASSOC); // types of degree (tod)
				return $tod_options;
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}
		
		return null;
	}

/*
	Get types of loan options (tolo)
*/
	public function get_types_of_loan_options()
	{
		try{
				$tolo_sql = "EXEC dbo.usp_getTypeofLoan;"; // types of loan options (tolo) sql
				$query = $this->database_connection->prepare($tolo_sql); 		
				$query->execute();			
				$tol_options = $query->fetchAll(PDO::FETCH_ASSOC); // types of loans (tol)
				return $tol_options;

			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}
		return null;		
	}

public function get_current_url(){
	$request_scheme = ( isset( $_SERVER['HTTPS'] ) ) ? 'https' : 'http';
		$current_url = $request_scheme
			. '://'
			. $_SERVER['HTTP_HOST']
			. $_SERVER['REQUEST_URI']
		;
		return $current_url;
}
/*
	Get student/user information SID, Email, Phone, FirstName, LastName, DOB, SSN
*/
public function get_student_information($username)
	{
		//echo $username;
		if(!empty($username))
		{
			try
			{
				$st_sql = "EXEC dbo.usp_getStudentData @username = :username;"; //student (st) sql
				$values = array(':username' => $username);			
				
				$query = $this->database_connection->prepare($st_sql); 
				$query->execute($values);			
				$user_data = $query->fetch(PDO::FETCH_ASSOC);
				if(!empty($user_data))
				{
					$user_data["Username"] = $username;				
					return $user_data;
				}	
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}		
		}
		return null;
	}
/*
	Get HTML template uri value
*/
public function get_template_uri() {

		return $this->template_uri;

	}

/*
	Get expected graduation year array
*/
public function get_expected_graduation_year_array()
{
	$extected_graduation_year_array = array();
	$current_year = date("Y");	
	for($i=0;$i<4;$i++)
	{
		//Winter		
		$extected_graduation_year_array[] = 'Winter '.($current_year+$i);
		//Spring		
		$extected_graduation_year_array[] = 'Spring '.($current_year+$i) ;
		//Summer		
		$extected_graduation_year_array[] = 'Summer '.($current_year+$i) ;
		//Fall		
		$extected_graduation_year_array[] = 'Fall '.($current_year+$i) ;			
	}
	
	return $extected_graduation_year_array;

}

/*
	Check to make sure all configuration variables are not empty
*/
function check_configuration()
{	
	if(empty($GLOBALS['AUTH_TYPE']))
		return false;
	if((!empty($GLOBALS['AUTH_TYPE']) && $GLOBALS['AUTH_TYPE'] == 'CAS') && (empty($GLOBALS['CAS_SERVER_HOSTNAME']) || empty($GLOBALS['CAS_SERVER_PORT']) || empty($GLOBALS['CAS_SERVER_PATH']) || empty($GLOBALS['CAS_VERSION']) || empty($GLOBALS['CAS_LIBRARY_PATH'])))
		return false;
	if(empty($GLOBALS['DATABASE_DSN']) || empty($GLOBALS['DATABASE_USER']) || empty($GLOBALS['DATABASE_PASSWORD']))
		return false;
	if(empty($GLOBALS['BASE_URI']))
		return false;
	if(empty($GLOBALS['GLOBALS_PATH']) || empty($GLOBALS['GLOBALS_URL']))
		return false;
	if(empty($GLOBALS['FUNDING_AMOUNT_LENGTH']) || empty($GLOBALS['FUNDING_SOURCE_LENGTH']) || empty($GLOBALS['AUTH_REP_NAME_LENGTH']) || empty($GLOBALS['SIGNATURE_LENGTH']))
		return false;
	if(empty($GLOBALS['STATUS_URL']) || empty($GLOBALS['DEADLINES']) || empty($GLOBALS['CONDITIONAL_MONTH']))
		return false;

	return true;
}

/*
	get financial aid application id for a given sid and academic yr chosen
*/

function get_faappid($year_quarter_id)
{
	$sid = $this->get_sid();
	if(!empty($year_quarter_id) && !empty($sid))
	{
		try
			{
				$sql = "EXEC dbo.usp_GetAppIdForGivenSidAndAcademicYr @SID = :Sid, @AcademicYrChosen = :AcademicYrChosen;"; 
				$values = array(':Sid' => $sid, ':AcademicYrChosen' => $year_quarter_id);			
				
				$query = $this->database_connection->prepare($sql); 
				$query->execute($values);			
				$result = $query->fetch(PDO::FETCH_ASSOC);				
				if(!empty($result) && isset($result['FAAppID']))
				{
					$faappid = $result['FAAppID'];
					return $faappid;
				}	
			}catch(PDOException $e)
			{
				echo 'ERROR: ' . $e->getMessage();
			}	
	}
	return null;
}

/*
 * Set form url
 */

function set_form_url()
{
   $request_host = $_SERVER['HTTP_HOST'];
   $base_uri = $GLOBALS['BASE_URI']; 
   error_log("host :".$request_host);
   error_log("uri :".$base_uri);
   if(!empty($request_host) && !empty($request_host))
   {
       $base_uri = trim($base_uri,'/');
        $url = 'https://' . $request_host . '/'. $base_uri .'/'. self::FORM_URI;
        $this->form_url = $url;
   }
}

function get_form_url()
{
    return $this->form_url;
}


}//End of Class Default_Model


?>