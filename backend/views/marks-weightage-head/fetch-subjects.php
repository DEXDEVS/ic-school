<?php if(isset($_POST['class_Id'])) {

	$classId = $_POST['class_Id'];

		$subjectsCombination = Yii::$app->db->createCommand("SELECT std_subject_name FROM std_subjects WHERE class_id = 6")->queryAll();

		$subject = $subjectsCombination[0]['std_subject_name'];
		$subjectName = explode(',', $subject);
		$subjectIds = array();
		foreach ($subjectName as $key => $value) {
			$subjectId = Yii::$app->db->createCommand("SELECT subject_id FROM subjects WHERE subject_name = '$value'")->queryAll();
			$subjectIds[$key] = $subjectId[0]['subject_id'];
		}	
		$obj = (object) array($subjectName,$subjectIds);

  	echo json_encode($obj);
	}
?>