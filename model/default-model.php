<?php
//require_once('config.php');
//require_once('model/database-model.php');

Class Default_Model{


//protected $db_conn; // database connection object variable
protected  $database_connection;
// Path to a HTML template file to be used by a view.
protected $template_uri;

public function __construct($template_uri) {

	try{
			$this->database_connection = new PDO( $GLOBALS['DATABASE_DSN'], $GLOBALS['DATABASE_USER'],$GLOBALS['DATABASE_PASSWORD'] );
			if (!$this->database_connection) 
	    		die('Something went wrong while connecting to the database'); // exit out 
		} catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	$this->template_uri = $template_uri;
	}// end of constructor
/*
	Set template URI
*/
	public function set_template_uri($template_uri)
	{
		//echo $template_uri;
		$this->template_uri = $template_uri;
	}

/*
	Get Academic Year Quarters 
*/
	public function get_academic_year_quarters()
	{
		$quarter_information = array();
		$current_year = date("Y");
		$current_month = date("m");
		//echo "Year:".$current_year.", Month:".$current_month;
		/*
			If month is July(7) query once for year quarter giving current Year as input to the query.
			If month is Jan query twice, one with current year as input and another with previous year as input.
		*/
		try{
				$q_sql = "EXEC dbo.usp_getAcademicYear @CurrentYear = :CurrentYear;"; // quarter(q) sql

				if($current_month < 7) // For Month's from Jan to June
				{
					$previous_year = $current_year-1;					
					$values = array(':CurrentYear' => $previous_year);					
				}
				else
				{
					// For months from July to Dec					
					$values = array(':CurrentYear' => $current_year);
				}
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


}//End of Class Default_Model


?>