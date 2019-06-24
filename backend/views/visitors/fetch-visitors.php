<?php 
	if(isset($_POST['visitorCnic'])){
		$visitorCnic= $_POST['visitorCnic'];
		//$visitorCnic= "45102-0511722-2";

		$visitorData= Yii::$app->db->createCommand("SELECT * FROM visitors WHERE visitor_cnic LIKE '%$visitorCnic%' ")->queryAll();
		
		echo json_encode($visitorData);
	}

 ?>