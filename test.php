<?php
require 'OopBackEndPhp.php';

	header('Content-Type: application/json');
  	$object = new OopBackEndPhp();
	$details = $object->athundiacation('abranah', '789', 'lecturer');
	print(json_encode($details));



	// $object = new OopBackEndPhp();
	// $details = $object->UpdateSession($id, $studentId, $lecturerId, $startTime, $endTime, $date, $sessionNumber,$task);
	// print(json_encode($details));

?>