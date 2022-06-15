<?php
	include 'includes/session.php';
	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$student_id = $_POST['studentid'];
		$course = $_POST['course'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}

		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$user_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);

		$sql = "INSERT INTO students (student_id, firstname, lastname, course_id, photo, created_on, user_id) VALUES ('$student_id', '$firstname', '$lastname', '$course', '$filename', NOW(), '$user_id')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Student added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: student.php');
?>