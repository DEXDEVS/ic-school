<?php 
	if(isset($_POST['classId'])){
		$classId = $_POST['classId'];
		
		$sections = Yii::$app->db->createCommand("SELECT s.section_id, s.section_name
			FROM  std_sections as s
			INNER JOIN std_enrollment_head as h
			ON h.section_id = s.section_id
			WHERE h.class_name_id 		= '$classId'
			")->queryAll();

		foreach ($sections as $key => $value) {
			$sectionIdArray[] = $value["section_id"];
			$sectionNameArray[] = $value["section_name"];
		}
		$obj = (object) array($sectionIdArray, $sectionNameArray);

  	echo json_encode($obj);
	}

 ?>