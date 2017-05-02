<?php include("db.php"); ?>

<?php 

class OopBackEndPhp {

	public function connection(){
		$con = mysqli_connect('localhost','root','','mysystem');

  		if(mysqli_connect_errno($con)) {
   			return 'Failed to connect';
  		}
		return $con;
	}


	public function athundiacation($username, $password, $category)
	{	
		$con = $this->connection();
		$user = array();
		$details = array();

		if($category == 'student')
		{
			$query = mysqli_query($con,"SELECT * FROM `students` WHERE `Username` = '$username' AND `Password` = '$password'");
		}
		else if($category == 'lecturer')
		{
			$query = mysqli_query($con,"SELECT * FROM `lecturer` WHERE `Username` = '$username' AND `Password` = '$password'");
		}

		if($query)
		{
			$user = mysqli_fetch_assoc($query);  
			$details['KEY'] = $category;
			$details['User'] = $user;

			return $details;
		}	
	}


	public function updateSession($id, $studentId, $lecturerId, $startTime, $endTime, $date, $sessionNumber,$task){

		$con = $this->connection();
  		$insertQuery = mysqli_query($con, "INSERT INTO `sessions` (`student_ID`, `lecturer_ID`, `start_Time`, `end_Time`,
           `Date`, `Details`, `session_No`) VALUES ('$studentId', '$lecturerId', '$startTime', '$endTime', '$date',
            '$task', '$sessionNumber')");

        if($insertQuery)
        {
        	$message = "success message";
           	return $message;
        }
        else 
        {
        	$message = "error message";
           	return $message;
        }
	}

	public function studentDetails($studentId)
	{
		$con = $this->connection();
		$personalDetails = array();
		$sessionDetails = array();
		$details = array();
		$detailsQuery = mysqli_query($con,"SELECT * FROM `students` WHERE `ID` = '$studentId'");
		$currentQuery = mysqli_query($con,"SELECT MAX(`session_No`) AS `currentSession` FROM `sessions` WHERE `student_ID` = '$studentId'");
		$currentSession = mysqli_fetch_assoc($currentQuery);
		$sessioinNumber = $currentSession['currentSession'];
		$sessionQuery = mysqli_query($con,"SELECT * FROM `sessions` WHERE `session_No` = '$sessioinNumber' AND  `student_ID` = '$studentId'");		
		$personalDetails = mysqli_fetch_assoc($detailsQuery);
		$sessionDetails = mysqli_fetch_assoc($sessionQuery);
		$lecturerId = $sessionDetails['lecturer_ID'];
		$lecturerQuery = mysqli_query($con,"SELECT * FROM `lecturer` WHERE `ID` = '$lecturerId'");
		$lecturerDetails = mysqli_fetch_assoc($lecturerQuery);
		$details['KEY'] = 'STUDENT';
		$details['personal'] = $personalDetails;
		$details['session'] = $sessionDetails;
		$details['lecturer'] = $lecturerDetails;

		return $details;
	}


	public function lecturerDetails($lecturerId)
	{
		$con = $this->connection();
  		$personalDetails = array();
		$details = array();
  		$detailsQuery = mysqli_query($con,"SELECT * FROM `lecturer` WHERE `ID` = '$lecturerId'");
		$personalDetails =  mysqli_fetch_assoc($detailsQuery);	
		$details['KEY'] = 'LECTURE';
		$details['personal'] = $personalDetails;

		return $details;
	
	}


	public function searchStudent($studentId,$lecturerId)
	{
		$con = $this->connection();
  		$studentDetails = array();
		$sessionDetails = array();
		$details = array();
		$studentQuery = mysqli_query($con,"SELECT * FROM `students` WHERE `ID` = '$studentId'");
		$currentQuery = mysqli_query($con,"SELECT MAX(`session_No`) AS `currentSession` FROM `sessions` WHERE `student_ID` = '$studentId'");
		$currentSession = mysqli_fetch_assoc($currentQuery);
		$sessioinNumber = $currentSession['currentSession'];
		$sessionQuery = mysqli_query($con,"SELECT * FROM `sessions` WHERE `session_No` = '$sessioinNumber' AND  `student_ID` = '$studentId'");
		$studentDetails = mysqli_fetch_assoc($studentQuery);
		$sessionDetails = mysqli_fetch_assoc($sessionQuery);
		$details['studentDetails'] = $studentDetails;
		$details['sessionDetails'] = $sessionDetails;
			
		return $details;
	}

	public function previousSession($studentId,$sessionNumber)
	{
		$con = $this->connection();	
  		$sessionDetails = array();
		$details = array();
  		$sessionQuery = mysqli_query($con,"SELECT * FROM `sessions` WHERE `student_ID` = '$studentId' AND 
		`session_No` = '$sessionNumber'");	
		$sessionDetails = mysqli_fetch_assoc($sessionQuery);
		$details['session'] = $sessionDetails;
		
		return $details;
	}
}

?>