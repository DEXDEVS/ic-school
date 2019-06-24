<?php
	if(isset($_POST['class_Id'])){

	$classId = $_POST['class_Id'];
	$studentName = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_std_id , sed.std_enroll_detail_std_name  
		FROM std_enrollment_detail as sed 
		INNER JOIN std_enrollment_head as seh 
		ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id 
		WHERE seh.std_enroll_head_id = '$classId'")->queryAll();

	 	echo json_encode($studentName);
 	}
 	else if(isset($_POST['studentId'])){
	//get student fee

 	$studentId = $_POST['studentId'];
 	$studentFeeDetail = Yii::$app->db->createCommand("SELECT net_addmission_fee , net_monthly_fee  FROM std_fee_details WHERE std_id = '$studentId'")->queryAll();
 	echo json_encode($studentFeeDetail);
	}
	else if(isset($_POST['session_Id'])){
	$sessionId = $_POST['session_Id'];
	$sections = Yii::$app->db->createCommand("SELECT section_id,section_name FROM std_sections WHERE session_id = '$sessionId'")->queryAll();
	echo json_encode($sections);
	} else {
		$classId = $_POST['classid'];
		$sessionId = $_POST['sessionid'];
		$sectionId = $_POST['sectionid'];
		$month = $_POST['month'];
		$monthDetail= Yii::$app->db->createCommand("SELECT fmd.month FROM fee_transaction_head as fth INNER JOIN fee_month_detail as fmd ON fth.voucher_no = fmd.voucher_no WHERE fth.class_name_id = '$classId' AND fth.session_id = '$sessionId' AND fth.section_id = '$sectionId' AND fmd.month ='$month'")->queryAll();
		if(empty($monthDetail)){
			$result = '[0]';
		}else {
			$result = '[1]';
		}
		echo json_encode($result);
	}
?>