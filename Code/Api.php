<?php 

	//getting the dboperation class
	require_once '../includes/DbOperation.php';

	//function validating all the paramters are available
	//we will pass the required parameters to this function 
	function isTheseParametersAvailable($params){
		//assuming all parameters are available 
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		//if parameters are missing 
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
			//displaying error
			echo json_encode($response);
			
			//stopping further execution
			die();
		}
	}
	
	//an array to display response
	$response = array();
	
	//if it is an api call 
	//that means a get parameter named api call is set in the URL 
	//and with this parameter we are concluding that it is an api call
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			//the CREATE operation
			//if the api call value is 'createhero'
			//we will create a record in the database
			
			

			case 'createattendence':
			//first check the parameters required for this request are available or not
			//isTheseParametersAvailable(array('Name', 'Teacher_id', 'Class_id', 'Section_id', 'Subject_id', 'Total_marks', 'Passing_marks', 'Comments'));
			//creating a new dboperation object
			$db = new DbOperation();
			
			//creating a new record in the database
			$result = $db->createattendence(
				$_POST['Student_id'],
				$_POST['Ispresent']
			);
			

			//if the record is created adding success to response
			if($result){
				//record is created means there is no error
				$response['error'] = false; 

				//in message we have a success message
				$response['message'] = 'tests addedd successfully';
			}else{

				//if record is not added that means there is an error 
				
				$response['error'] = true; 

				//and we have the error message
				$response['message'] = 'Some error occurred please try again';
			}
			
		break; 


		case 'createstudent':
			//first check the parameters required for this request are available or not
			//isTheseParametersAvailable(array('Name', 'Teacher_id', 'Class_id', 'Section_id', 'Subject_id', 'Total_marks', 'Passing_marks', 'Comments'));
			//creating a new dboperation object
			$db = new DbOperation();
			
			//creating a new record in the database
			$result = $db->createstudent(
				$_POST['Studentname'],
				$_POST['Course_id']
			);
			

			//if the record is created adding success to response
			if($result){
				//record is created means there is no error
				$response['error'] = false; 

				//in message we have a success message
				$response['message'] = 'tests addedd successfully';

				//and we are getting all the heroes from the database in the response
				$response['tests'] = $db->getstudents($_GET['Course_id']);
			}else{

				//if record is not added that means there is an error 
				
				$response['error'] = true; 

				//and we have the error message
				$response['message'] = 'Some error occurred please try again';
			}
			
		break; 


		case 'createattendence':
			//first check the parameters required for this request are available or not
			//isTheseParametersAvailable(array('Name', 'Teacher_id', 'Class_id', 'Section_id', 'Subject_id', 'Total_marks', 'Passing_marks', 'Comments'));
			//creating a new dboperation object
			$db = new DbOperation();
			
			//creating a new record in the database
			$result = $db->createattendence(
				$_POST['Student_id'],
				$_POST['Ispresent']
			);
			

			//if the record is created adding success to response
			if($result){
				//record is created means there is no error
				$response['error'] = false; 

				//in message we have a success message
				$response['message'] = 'tests addedd successfully';
			}else{

				//if record is not added that means there is an error 
				
				$response['error'] = true; 

				//and we have the error message
				$response['message'] = 'Some error occurred please try again';
			}
			
		break; 


		case 'createclasses':
			//first check the parameters required for this request are available or not
			//isTheseParametersAvailable(array('Name', 'Teacher_id', 'Class_id', 'Section_id', 'Subject_id', 'Total_marks', 'Passing_marks', 'Comments'));
			//creating a new dboperation object
			$db = new DbOperation();
			
			//creating a new record in the database
			$result = $db->createclasses(
				$_POST['Classname'],
				$_POST['Email']
			);
			

			//if the record is created adding success to response
			if($result){
				//record is created means there is no error
				$response['error'] = false; 

				//in message we have a success message
				$response['message'] = 'tests addedd successfully';

				//and we are getting all the heroes from the database in the response
				$response['tests'] = $db->getclasses($_GET['Email']);
			}else{

				//if record is not added that means there is an error 
				
				$response['error'] = true; 

				//and we have the error message
				$response['message'] = 'Some error occurred please try again';
			}
			
		break; 


			

		case 'getstudents':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Course_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getstudents($_GET['Course_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 

			case 'getclasses':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Email'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getclasses($_GET['Email']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 


			case 'getabsent':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Student_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getabsent($_GET['Student_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 


			case 'getattendencedate':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Course_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getattendencedate($_GET['Course_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 

			case 'getattendencedate1':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Course_id'],$_GET['Date'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getattendencedate1($_GET['Course_id'],$_GET['Date']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
			

			case 'getpresent':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Student_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->getpresent($_GET['Student_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 

			case 'gettotal':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Student_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->gettotal($_GET['Student_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 


			case 'gettodaysstatus':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['Student_id'])){
					$db = new DbOperation();
					$response['error'] = false; 
					$response['message'] = 'tests deleted successfully';
					$response['tests'] = $db->gettodaysstatus($_GET['Student_id']);
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
		}
		
	}else{
		//if it is not api call 
		//pushing appropriate values to response array 
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	//displaying the response in json structure 
	echo json_encode($response);
	
	
