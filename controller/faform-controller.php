<?php

require_once('default-controller.php');

Class Faform_Controller extends Default_Controller {

		public function __construct( $model ) {
		parent::__construct( $model );
	}

	public function get_academic_year_option_and_values()
	{
		$quarter_options = $this->model->get_academic_year_quarters();
		$quarter_option_values_array = array();
		/*
			$get_quarter_options will have values like 2015 - 2016 (Sum 2015,Fall 2015,Win 2016,Spr 2016)
			We will get the yearQuarterID value for 2015
		*/
		for($i=0;$i<count($quarter_options);$i++) 
		{
			$get_year = substr($quarter_options[$i],0,4);
			$summer_quarter = 'sum '.$get_year;
			$yearQuarterID = $this->model->get_year_quarter_id($summer_quarter);
			if(!empty($yearQuarterID) && isset($yearQuarterID['YearQuarterID']));
			{	
				/* 
					Convert abbreviated quarter string to full name quarter string
					eg: Sum 2015,Fall 2015,Win 2016,Spr 2016 to Summer 2015,Fall 2015,Winter 2016,Spring 2016
				*/

				$seperate_year_quarters_array = $this->seperate_year_quarters($quarter_options[$i]); //eg: Sum 2015,Fall 2015,Win 2016,Spr 2016
				if(isset($seperate_year_quarters_array[0]) && isset($seperate_year_quarters_array[1]))
				{
					$academic_year = $seperate_year_quarters_array[0];
					$abbrviated_quarters_string = $seperate_year_quarters_array[1];					
					$abbreviated_quarters_array = $this->get_quarters_array($abbrviated_quarters_string);
					
					$quarters_readable_array = array();
					for($i=0;$i<count($abbreviated_quarters_array);$i++)
					{
						$full_name_quarter = $this->make_quarter_readable($abbreviated_quarters_array[$i]);						
						$quarters_readable_array[] = $full_name_quarter;
					}
					
					$all_readable_quarters_string = implode(', ', $quarters_readable_array);
					$year_quarter_string = $academic_year . ' ( '.$all_readable_quarters_string.' )';
					$quarter_option_values_array[$yearQuarterID['YearQuarterID']] = $year_quarter_string;
				}
			}	

		}

		return $quarter_option_values_array;
	}
/*
	This function will return all the quarter options available to select.
	For eg:For year 2015 - 2016 (Sum 2015,Fall 2015,Win 2016,Spr 2016) and 2016 - 2017 (Sum 2016,Fall 2016,Win 2017,Spr 2017) it
	should return Summer 2015,Fall 2015,Winter 2016,Spring 2016, Summer 2016,Fall 2016,Winter 2017,Spring 2017 in an array with their respective yearQuarterID's as key.		
*/
	public function get_all_quarter_options_available()
	{
		$quarter_options = $this->model->get_academic_year_quarters();

		$quarters_options_available = array();

		for($i=0;$i<count($quarter_options);$i++) 
		{
			$seperate_year_quarters_array = $this->seperate_year_quarters($quarter_options[$i]); //eg: Sum 2015,Fall 2015,Win 2016,Spr 2016
			$abbreviated_quarters_array = $this->get_quarters_array($seperate_year_quarters_array[1]);
			
			for($i=0;$i<count($abbreviated_quarters_array);$i++)
			{

				$yearQuarterID = $this->model->get_year_quarter_id($abbreviated_quarters_array[$i]);
				if(!empty($yearQuarterID) && isset($yearQuarterID['YearQuarterID']))
				{
					
					$quarter_string = $this->make_quarter_readable($abbreviated_quarters_array[$i]);					
					$quarters_options_available[$yearQuarterID['YearQuarterID']] = $quarter_string;
				}
			}
		}
		
		return $quarters_options_available;
	}
/*
	split year quarter string into two parts and return it in an array
*/
	public function seperate_year_quarters($academic_year_quarter)
	{
		$year_and_quarters = array();
		if(!empty($academic_year_quarter))
		{
			$year_quarter_split = explode('(',$academic_year_quarter);
			$year_and_quarters[] = $year_quarter_split[0];
			$second_part_of_string = rtrim($year_quarter_split[1],')');
			$year_and_quarters[] = $second_part_of_string;
		}
		return $year_and_quarters;
	}
/*
	Get quarters array extracted from quarters string
*/
	public function get_quarters_array($quarters_string)
	{
		if(!empty($quarters_string))
		{
			
			$quarters = explode(",",$quarters_string);
			return $quarters;
		}
		return null;
	}
/*
	This function converts Sum 2015 = Summer 2015, Win 2015 = Winter 2015, Spr 2015 = Spring 2015 quarters
*/
	public function make_quarter_readable($quarter)
	{
		if(!empty($quarter))
		{			
			$split_quarter_value = explode(" ",$quarter);
			$quarter_string = $split_quarter_value[0];
			switch ($quarter_string)
			 {
						case 'Sum':
								$quarter_string = "Summer";
							break;
						case 'Win':
								$quarter_string = "Winter";
							break;
						case 'Spr':
								$quarter_string = "Spring";
							break;
						case 'Fall':
								$quarter_string = "Fall";
							break;
						default:
							# code...
							break;
			}
			$quarter_string .= ' '.$split_quarter_value[1];
			return $quarter_string;
		}
		return null;
	}


	}
?>