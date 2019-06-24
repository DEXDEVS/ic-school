<?php 
echo "DEXDEVS";
 if(isset($_POST['cnic'])){
	 	$cnic = $_POST['cnic'];
		//$cnic = '45102-0511722-2';
		$empCnic = Yii::$app->db->createCommand("SELECT emp_id FROM emp_info WHERE emp_cnic = '$cnic'")->queryAll();
		
		if(!empty($empCnic)){
			$result = 1;
		} else {
			$result = 0;
		}
		echo json_encode($result); 
}
 ?>
