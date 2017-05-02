<?php include("db.php"); 
	  require 'OopBackEndPhp.php';
?>


<?php

	header('Content-Type: application/json');
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$data = $_POST['detailsObject'];
		$key = $data['key'];

		if($key == 'checkLogin')
		{
			$username = $data['inputUsername'];
			$password = $data['inputPassword'];
			$category = $data['inputCategory'];
			$details = array();
			$object = new OopBackEndPhp();
			$details = $object->athundiacation($username, $password, $category);
			print(json_encode($details));	
		}
		else if($key == 'UpdateSession')
		{
			$id = $data['ID'] + 1;
			$studentId = $data['studentId'];
			$lecturerId = $data['lecturerId'];
            $startTime = $data['startTime'];
            $endTime = $data['endTime'];
            $date = $data['date'];
            $sessionNumber = $data['sessionNumber'];
            $task = $data['task'];
        	$object = new OopBackEndPhp();
			$details = $object->updateSession($id, $studentId, $lecturerId, $startTime, $endTime, $date, $sessionNumber,$task);
			print(json_encode($details));
		}
	}
	else if ($_SERVER['REQUEST_METHOD'] == "GET") 
	{
		$data = $_GET['detailsObject'];
		$key = $data['key'];

		if($key == 'studentDetails')
		{
			$details = array();
			$studentId = $data['studentId'];
			$object = new OopBackEndPhp();
			$details = $object->studentDetails($studentId);
			print(json_encode($details));
		}
		else if($key == 'lecturerDetails')
		{
			$details = array();
			$lecturerId = $data['lecturerId'];
			$object = new OopBackEndPhp();
			$details = $object->lecturerDetails($lecturerId);
			print(json_encode($details));
		}
		else if($key == 'searchStudent')
		{
			$details = array();
			$studentId = $data['studentId'];
			$lecturerId = $data['lecturerId'];
			$object = new OopBackEndPhp();
			$details = $object->searchStudent($studentId, $lecturerId);
			print(json_encode($details));
		}
		else if($key == 'previousSession')
		{
			$details = array();
			$studentId = $data['studentId'];
			$sessionNumber = $data['sessionNumber'] - 1;
			if($sessionNumber >= 1)
			{
				$object = new OopBackEndPhp();
				$details = $object->previousSession($studentId, $sessionNumber);
				print(json_encode($details));
			}
			else 
			{
			 	print(json_encode("No Session Available"));
			}
		}
		else if($key == 'beforeSession')
		{
			print(json_encode($data));
		}
	}	
?>
