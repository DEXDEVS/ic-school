<?php 

	$examCatID = $_GET["id"];
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<!-- back button start -->
	 <ol class="breadcrumb">
      <li><a class="btn btn-primary btn-xs" href="exams-category-view?id=<?php echo $examCatID ;?>"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
	<!-- back button close -->
	<!-- invagilator section start -->
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-header" style="padding: 0px;text-align: center;">
					<h3 style="text-align: center;font-family: georgia;font-size:30px;">
						Invigilators Attendance
					</h3>
					<!-- <p style="font-weight:bold;text-align: center;"><u>Date Sheets</u></p> -->
				</div><hr>	
				<div class="box-body">					
					<div class="row">
				        <div class="col-md-12">
	                		<form method="POST">
	                			<div class="row">
	                				<div class="col-md-12">
	                					<div class="form-group">
			                				<label>Select Date</label>
			                				<input type="date" name="date" class="form-control">
	                					</div>
	                				</div>

	                				<input type="hidden" name="examCatId" value="<?php echo $examCatID;?>">
	                			</div>
	                			<div class="row">
	                				<div class="col-md-4">
		                				<button class="btn btn-info" type="submit" name="search" > Search </button>
		                			</div>
	                			</div>	
	                		</form>
				        </div>
				    </div><hr>

            		<?php 
            		if(isset($_POST["search"]))
            		{
            			$date = $_POST['date'];
						$examCatId = $_POST['examCatID'];

						$invigilatorData = Yii::$app->db->createCommand("SELECT
						s.subject_id,r.class_head_id,r.emp_id,r.invigilator_attend
						FROM ((exams_room as r
						INNER JOIN exams_schedule as s
						ON s.exam_schedule_id = r.exam_schedule_id)
						INNER JOIN exams_criteria as c
						ON c.exam_criteria_id = s.exam_criteria_id)
						WHERE c.exam_status = 'Announced'
						AND c.exam_category_id = '$examCatId'
						AND c.date = '$date'
						AND c.date = '$date'")->queryAll();
						$countInvigilatorData = count($invigilatorData);
						//get all invegilators against selected date
						// $invigilator = Yii::$app->db->createCommand("SELECT c.exam_criteria_id,c.class_id,s.subject_id,s.emp_id
						// 	        FROM exams_criteria as c
						// 			INNER JOIN exams_schedule as s
						// 			ON c.exam_criteria_id = s.exam_criteria_id
						// 	        WHERE c.exam_category_id = '$examCatId'
						// 	        AND c.exam_status = 'announced'
						// 	        AND s.date = '$date'")->queryAll();
						// var_dump($invigilator);
						// if (empty($invigilator)) {
						// 	echo "No schedule announced yet..!";
						// }else{
						// 	$invigilatorAtt = Yii::$app->db->createCommand("SELECT s.emp_attendance
						// 	        FROM exams_criteria as c
						// 			INNER JOIN exams_schedule as s
						// 			ON c.exam_criteria_id = s.exam_criteria_id
						// 	        WHERE c.exam_category_id = '$examCatId'
						// 	        AND c.exam_status = 'announced'
						// 	        AND s.date = '$date'")->queryAll();
							
						// 	if(empty($invigilatorAtt[0]['emp_attendance'])){
						// $countinvigilator = count($invigilator);
            	 	?>
            	 	<div class="row">
            	 		<div class="col-md-12">
							<form method="POST">
            	 			<table class="table">
            	 				<thead>
            	 					<tr>
            	 						<th>Sr.#</th>
            	 						<th>Class</th>
            	 						<th>Subject</th>
            	 						<th>Invagilator</th>
            	 						<th>Attendance</th>
            	 					</tr>
            	 				</thead>
            	 				<tbody>
            	 					<?php 
            	 					// $criteriaArray = array();
            	 					// $classArray = array();
            	 					// $subjectArray = array();
            	 					// $empArray = array();
            	 					for ($i=0; $i <$countInvigilatorData ; $i++) {
            	 						$headID = $invigilatorData[$i]['class_head_id'];
            	 						$headName = Yii::$app->db->createCommand("
										SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$headID'
											")->queryAll();
            	 						//get criteria id
            	 						$criteriaId = $invigilator[$i]['exam_criteria_id']; 
            	 						$criteriaArray[$i] = $criteriaId;
            	 						//get class name
            	 						$classId = $invigilator[$i]['class_id'];
            	 						$classArray[$i] = $classId;
            	 						$classesName = Yii::$app->db->createCommand("
										SELECT std_enroll_head_name FROM std_enrollment_head WHERE class_id = '$std_enroll_head_id'
											")->queryAll();
            	 						//get subject name
            	 						$subId = $invigilator[$i]['subject_id'];
            	 						$subjectArray[$i] = $subId;
            	 						$subName = Yii::$app->db->createCommand("
										SELECT subject_name FROM subjects WHERE subject_id = '$subId'
											")->queryAll();
            	 						//get invagilator name
            	 						$empId = $invigilator[$i]['emp_id'];
            	 						$empArray[$i] = $empId;
            	 						$empName = Yii::$app->db->createCommand("
										SELECT emp_name FROM emp_info WHERE emp_id = '$empId'
											")->queryAll();
            	 					 ?>
            	 					<tr>
            	 						<td><?php echo $i+1; ?></td>
            	 						<td><?php echo $headName[0]['std_enroll_head_name'];  ?></td>
            	 						<td>
            	 							<?php //echo $subName[0]['subject_name']; ?>
            	 						</td>
            	 						<td>
            	 							<?php //echo $empName[0]['emp_name']; ?>
            	 						</td>
            	 						<td>
            	 							<input type="radio" name="emp<?php //echo $i+1?>" value="P"/> <b  style="color:green">P </b>
											<input type="radio" name="emp<?php //echo $i+1?>" value="A"  checked="checked"/> <b style="color: red">A </b>
											<input type="radio" name="emp<?php //echo $i+1?>" value="L" /><b style="color: #F7C564;"> L</b>
            	 						</td>
            	 					</tr>
            	 					<?php } ?>
            	 				</tbody>
            	 			</table>
            	 			<input type="hidden" name="date" value="<?php //echo $date; ?>">
            	 			 <?php foreach ($criteriaArray as $value) {
				                		//echo '<input type="hidden" name="criteriaArray[]" value="'.$value.'" style="width: 30px">';
				                	}
				                  foreach ($classArray as $value) {
				                		//echo '<input type="hidden" name="classArray[]" value="'.$value.'" style="width: 30px">';
				                	}
				                  foreach ($subjectArray as $value) {
				                		//echo '<input type="hidden" name="subjectArray[]" value="'.$value.'" style="width: 30px">';
				                	}
				                  foreach ($empArray as $value) {
				                		//echo '<input type="hidden" name="empArray[]" value="'.$value.'" style="width: 30px">';
				                	} ?>
            	 			<input type="hidden" name="countinvigilator" value="<?php //echo $countinvigilator; ?>"> 
            	 			
            	 			<button type="submit" name="save_attendance" class="btn btn-success btn-xs" style="float: right;">Save Attendance</button>
            	 		</form>
            	 		</div>
            	 	</div>
            	 	<?php } else {
            	 		//echo "Attendance already marked";
            	 	} //end of else attendance
            	 	 } //end of else 
            	 	  } //end of if isset ?>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			
		</div>
	</div>
	<!-- invagilator section close -->
</div>
</body>
</html>
<?php 

	if(isset($_POST['save_attendance'])){
		$date = $_POST['date'];
		$criteriaArray = $_POST['criteriaArray'];
		$classArray = $_POST['classArray'];
		$subjectArray = $_POST['subjectArray'];
		$empArray = $_POST['empArray'];
		$countinvigilator = $_POST['countinvigilator'];

		for($i=0; $i<$countinvigilator;$i++){
			$q=$i+1;
			$emp = "emp".$q;
			$emp_attendance[$i] = $_POST["$emp"];
		}

		$transection = Yii::$app->db->beginTransaction();
			try{
				for($i=0; $i<$countinvigilator; $i++){
					$invigilator = Yii::$app->db->createCommand()->update('exams_schedule', [
							'emp_attendance'=> $emp_attendance[$i],
							'updated_at'	=> new \yii\db\Expression('NOW()'),
							'updated_by'	=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $criteriaArray[$i], 'subject_id' => $subjectArray[$i], 'emp_id' => $empArray[$i], 'date' => $date]
	                    )->execute();
				}
				if($invigilator){
				$transection->commit();
					Yii::$app->session->setFlash('success', "Attendance for Invigilator marked successfully...!");
				}
			} catch(Exception $e){
				$transection->rollback();
				Yii::$app->session->setFlash('warning', "Attendance not marked. Try again!");
			}
	}// save_attendance clossing


 ?> 