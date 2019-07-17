<?php 
	$examCategory = $_GET['exam_category'];
	$classId = $_GET['class_id'];
	$headId = $_GET['headID'];
	$exam_type = $_GET['exam_type'];
	$startYear = $_GET['startYear'];
	$endYear   = $_GET['endYear'];
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
					<a href="./view-sections?examcatID=<?php echo $examCategory; ?>&classID=<?php echo $classId; ?>&examType=<?php echo $exam_type; ?>&startYear=<?php echo $startYear; ?>&endYear=<?php echo $endYear; ?>" style="float: right;" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-step-backward"></i> Back</a>
			</div>
		</div><br>
</div>
<?php
		

// 		$classNameId = Yii::$app->db->createCommand("SELECT class_name_id FROM std_enrollment_head WHERE std_enroll_head_id = '$classHead'")->queryAll();
// 		$classNameID = $classNameId[0]['class_name_id'];
// print_r($classNameID);
		$ExamData = Yii::$app->db->createCommand("SELECT exam_criteria_id FROM exams_criteria WHERE exam_category_id = '$examCategory' AND class_id = '$classId'  AND exam_type = '$exam_type' AND YEAR(exam_start_date) = '$startYear' AND YEAR(exam_end_date) = '$endYear' AND ( exam_status = 'Conducted' OR exam_status = 'Result Prepared')")->queryAll();
		//print_r($ExamData);
		if(empty($ExamData)){
			Yii::$app->session->setFlash('warning',"Exams not conducted Yet..!");
		} else {

		$ExamName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCategory'")->queryAll();

		$className = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$headId'")->queryAll();
		//print_r($className);
		
		//$classheadId = $className[0]['std_enroll_head_id'];
		$criteriaId = $ExamData[0]['exam_criteria_id'];

		$examSchedule = Yii::$app->db->createCommand("SELECT s.subject_id, s.full_marks, s.passing_marks,c.exam_status,s.status FROM exams_schedule as s
			INNER JOIN exams_criteria as c 
			ON s.exam_criteria_id = c.exam_criteria_id
			WHERE c.class_id = '$classId'
			AND c.exam_category_id = '$examCategory'
			AND c.exam_criteria_id = '$criteriaId'
			 AND c.exam_status = 'conducted'
			 AND c.exam_type = '$exam_type' 
			 OR c.exam_status = 'Result Prepared'
			")->queryAll();
		
		if(empty($examSchedule)){
			Yii::$app->session->setFlash('warning',"Exams not conducted for this categroy.");
		} else {
			$countSubjects = count($examSchedule);
			$students = Yii::$app->db->createCommand("SELECT d.std_enroll_detail_std_id,d.std_roll_no, d.std_enroll_detail_std_name FROM std_enrollment_detail as d
				INNER JOIN std_enrollment_head as h 
				ON d.std_enroll_detail_head_id = h.std_enroll_head_id
				WHERE h.std_enroll_head_id = '$headId';
				")->queryAll();
			$stdCount = count($students);

			$subjectId = array();
			$studentArray = array();
			$grandTotalArray = array();
			$percentArray = array();
			$gradeArray = array();
			$resultArray = array();
			$resultCounter=0;
	?>	
<div class="container-fluid">
	<div class="box bos-default">
		<div class="box-header" style="padding:0px;">
			<h2 style="text-align: center;">Marks Register</h2>
			<p style="text-align: center;"><b>Status:</b> <?php echo $examSchedule[0]['exam_status']; ?></p>
		</div><hr>
		<form method="POST">
			<div class="box-body">
				<div class="row" style="text-align: center;height:30px;">
					<div class="col-md-6" style="border-right:1px solid;">
						<label>Exam</label>
						<p><?php echo $ExamName[0]['category_name']; ?></p>
					</div>
					<div class="col-md-6">
						<label>Class</label>
						<p><?php echo $className[0]['std_enroll_head_name']; ?></p>
					</div>
				</div><hr>
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<!-- <th colspan="2" style="text-align: center;">Teacher Name</th> -->
						</tr>
						<tr>
							<th colspan="2">Teacher Name </th>
							
							<?php 

							for ($i=0; $i <$countSubjects ; $i++) {
								$subId = $examSchedule[$i]['subject_id'];
							$teacherName = Yii::$app->db->createCommand("SELECT h.teacher_id, h.teacher_subject_assign_head_name
									FROM  teacher_subject_assign_head as h
									INNER JOIN teacher_subject_assign_detail as d 
									ON h.teacher_subject_assign_head_id = d.teacher_subject_assign_detail_head_id
									WHERE class_id = '$headId' AND  subject_id = '$subId'")->queryAll();
							$marks = Yii::$app->db->createCommand("SELECT mdw.obtained_marks
								FROM ((marks_head as mh 
								INNER JOIN marks_details as md
								ON mh.marks_head_id = md.marks_head_id)
								INNER JOIN marks_details_weightage as mdw
								ON md.marks_detail_id = mdw.marks_details_id)
								WHERE mh.class_head_id = '$headId'
								AND md.subject_id = '$subId'")->queryAll();
									?>
						
						<td align="center">
							<a style="color:black;" target="_blank" href="./emp-info-view?id=<?php echo $teacherName[0]['teacher_id'];?>">
								<?php 
									if (empty($marks)) {

										echo "<span style='background-color:#D73925;color:white;'>".$teacherName[0]['teacher_subject_assign_head_name']."</span>";
									}else{
										echo "<span style='background-color:seagreen;color:white;'>".$teacherName[0]['teacher_subject_assign_head_name']."</span>";
									}
								 ?>
							</a>
						</td>	
						<?php } ?>
						<th style="text-align: center;background-color: #ECF0F5" colspan="5">Final Report </th>
						</tr>

						<tr>
							<th >Roll #</th>
							<th>Name:</th>
							
							<?php $total=0;
							for ($i=0; $i <$countSubjects ; $i++) {
								$subId = $examSchedule[$i]['subject_id'];
								$total += $examSchedule[$i]['full_marks'];
								$subjectId[$i] = $subId;
								$subject = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subId'")->queryAll();
							?>
						
								<th style="text-align: center;">
									<?php echo $subject[0]['subject_name']; ?>
										
								</th>
							<?php
							} ?>
							<th style="text-align: center;">Grand Total</th>
							<th style="text-align: center;">Percent(%)</th>
							<th style="text-align: center;">Grade</th>
							<th style="text-align: center;">Result</th>
							<th style="text-align: center;">Action</th>
							
						</tr>
					</thead>
					<tbody>
						<?php for ($std=0; $std < $stdCount; $std++) { 
							$grandTotal = 0;
							$failCounter = 0;
							$stdId = $students[$std]['std_enroll_detail_std_id'];
							$studentArray[$std] = $stdId;
						?>
						<tr style="text-align: center;">
							<td><?php echo $students[$std]['std_roll_no']; ?></td>
							<td><?php echo $students[$std]['std_enroll_detail_std_name']; ?>
							</td>
							<?php for ($s=0; $s < $countSubjects; $s++) { 
								$subId = $subjectId[$s];

								$marks = Yii::$app->db->createCommand("SELECT mdw.obtained_marks
								FROM ((marks_head as mh 
								INNER JOIN marks_details as md
								ON mh.marks_head_id = md.marks_head_id)
								INNER JOIN marks_details_weightage as mdw
								ON md.marks_detail_id = mdw.marks_details_id)
								WHERE mh.class_head_id = '$headId'
								AND mh.std_id = '$stdId'
								AND md.subject_id = '$subId'")->queryAll();
								//print_r($marks);
								
								?>
								<td><?php 
									if(empty($marks)){
										echo "<span class='label label-primary'> N/A </span>";
										$resultCounter++;
									} else {
										$marksCount = count($marks);
										$totalMarks = 0;
										for ($i=0; $i <$marksCount ; $i++) { 

											if ($marks[$i]['obtained_marks'] == 'A') {
												$totalMarks = 'A';
											}
											else{
												$totalMarks += $marks[$i]['obtained_marks'];
											}
										}
										if($totalMarks < $examSchedule[$s]['passing_marks'] || $totalMarks == 'A'){
											echo "<span class='label label-warning'>".$totalMarks ."</span>";
											$failCounter++;
										} else {
											echo $totalMarks;
										}
									 
										if($totalMarks == 'A'){
											$grandTotal += 0;
										} else {
											$grandTotal += $totalMarks;
										}
									}
									?>
								</td>
							<?php } ?>
								<td><?php 
									echo $grandTotal."/".$total; 
									$grandTotalArray[$std] = $grandTotal; ?>
								</td>
								<td><?php 
								if($resultCounter >0 ){
									echo "-";
								} else {
									$percentage = ($grandTotal/$total)*100;
									$percent = round($percentage);
									echo $percent;
									$percentArray[$std] = $percent;
								}
								 ?></td>
								 <td>
								 	<?php  
								if($resultCounter >0 ){
									echo "-";
								} else {
								 	$grades = Yii::$app->db->createCommand("SELECT grade_name FROM grades WHERE grade_from <= '$percent' AND grade_to >= '$percent'")->queryAll();
								 	if(empty($grades)){
								 		echo "-";
								 	} else {
									 	$grade = $grades[0]['grade_name'];
									 	echo $grade;
									 	$gradeArray[$std] = $grade;
								 	}
								}
								 	 ?>
								 </td>
								 <td>
								 	<?php 

								if($resultCounter >0 ){
									echo "-";
								} else {
								 	if($failCounter >= 1)
								 	{
								 		echo "<span class='label label-danger'> Fail</span>";
								 		$resultArray[$std] = "Fail";
								 	}
								 	else{
								 		echo "<span class='label label-success'> Pass </span>";
								 		$resultArray[$std] = "Pass";
								 	}
								 }
								 	?>
								 </td>
								<td>

									<a href="./update-marks?examCatID=<?php echo $examCategory;?>&classID=<?php echo $classId; ?>&classHeadID=<?php echo $headId; ?>&stdID=<?php echo $stdId; ?>&examType=<?php echo $exam_type; ?>&startYear=<?php echo $startYear; ?>&endYear=<?php echo $endYear; ?>&criteriaId=<?php echo $criteriaId; ?>" class="btn btn-info btn-xs">
									<i class="glyphicon glyphicon-edit"></i> update
									</a>
								</td>
						</tr>
					<?php } ?>
					</tbody>
				</table><br>
				<?php foreach ($grandTotalArray as $value) {
			        		echo '<input type="hidden" name="grandTotalArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        	<?php foreach ($percentArray as $value) {
			        		echo '<input type="hidden" name="percentArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        	<?php foreach ($gradeArray as $value) {
			        		echo '<input type="hidden" name="gradeArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        	<?php foreach ($resultArray as $value) {
			        		echo '<input type="hidden" name="resultArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        	<?php foreach ($studentArray as $value) {
			        		echo '<input type="hidden" name="studentArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
				<input type="hidden" name="resultCounter" value="<?php echo $resultCounter; ?>">
				<input type="hidden" name="examCriteriaID" value="<?php echo $criteriaId; ?>">
				<input type="hidden" name="classHead" value="<?php echo $headId; ?>">
				<input type="hidden" name="classId" value="<?php echo $classId; ?>">
				<input type="hidden" name="examCategory" value="<?php echo $examCategory; ?>">
				<input type="hidden" name="stdCount" value="<?php echo $stdCount; ?>">
				<div class="row">
				<div class="col-md-12">	
					<button  style="float: right;" type="submit" name="save" class="btn btn-success btn-xs">
						Save Marks Sheet
					</button>
				</div>
			</div>
			</div>
		</form>
	</div>
</div>
<?php	
} // else of exam data
} //closing of else
 ?>
</body>
</html>
<?php 
	if(isset($_POST['save'])){
		$resultCounter 	= $_POST["resultCounter"];
		

		if($resultCounter > 0){
			Yii::$app->session->setFlash('warning',"Mark sheet incomplete..!");
		} else {
			$examCriteriaID = $_POST["examCriteriaID"];
			$classHead 		= $_POST["classHead"];
			$classId 		= $_POST["classId"];
			$examCategory = $_POST["examCategory"];
			$studentArray = $_POST["studentArray"];
			$resultArray = $_POST["resultArray"];
			$gradeArray = $_POST["gradeArray"];
			$percentArray = $_POST["percentArray"];
			$grandTotalArray = $_POST["grandTotalArray"];
			$stdCount = $_POST["stdCount"];
			
			$transection = Yii::$app->db->beginTransaction();
			try
			{
			for($i=0; $i<$stdCount; $i++){
			$marksHeadUpdate = Yii::$app->db->createCommand()->update('marks_head', 				[
						'grand_total' 	=> $grandTotalArray[$i],
						'percentage' 	=> $percentArray[$i],
						'grade' 		=> $gradeArray[$i],
						'exam_status' 	=> $resultArray[$i],
						'updated_at'	=> new \yii\db\Expression('NOW()'),
						'updated_by'	=> Yii::$app->user->identity->id,
                        ],
                        ['exam_criteria_id' => $examCriteriaID, 'std_id' => $studentArray[$i]]
                    )->execute();
			} //end of for loop

			if($marksHeadUpdate){
			 	$classHeadIds = Yii::$app->db->createCommand("SELECT s.status 
			 		FROM exams_schedule as s
			 		INNER JOIN exams_criteria as c
			 		ON c.exam_criteria_id = s.exam_criteria_id
			 		WHERE c.class_id = '$classId'
			 		AND c.exam_category_id = '$examCategory'
			 		AND c.exam_status = 'Conducted'
			 	")->queryAll();
				$countHeads = count($classHeadIds);
				$count=0;
				foreach ($classHeadIds as $key => $value) {
					if($value['status'] == 'not'){
						$count++;
					}
				}

				if($count == $countHeads){
					$examStatusUpdate = Yii::$app->db->createCommand()->update('exams_criteria', 				[
							'exam_status' 	=> "Result Prepared",
							'updated_at'	=> new \yii\db\Expression('NOW()'),
							'updated_by'	=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $examCriteriaID]
	                    )->execute();
				} //closing of if
				if($examStatusUpdate){
					$transection->commit();
					Yii::$app->session->setFlash('success', "Result Prepeard successfully...!");
				}	
			}
				
		} // end of try
			catch(Exception $e)
			{
				$transection->rollback();
				echo $e;
				Yii::$app->session->setFlash('warning', "Result not Prepeared. Try again!");
			} // end of catch
		} // end of else
	}
 ?>
  
<?php //for updation of single student marks

if(isset($_POST['update'])){

	$marksDetailID 		= $_POST["marksDetailID"];
	$weightageTypeId 	= $_POST["weightageTypeId"];
	$marks 				= $_POST["marks"];

	$transection = Yii::$app->db->beginTransaction();
	try {
		$countMarksDetail = count($marksDetailID);

		for($i=0; $i<$countMarksDetail; $i++) {
			$countweightage = count($weightageTypeId[$i]);
			for ($j=0; $j <$countweightage ; $j++) { 
				$marksdetailUpdate = Yii::$app->db->createCommand()->update('marks_details_weightage', [
						'obtained_marks' 	=> $marks[$i][$j] ,
						'updated_at'		=> new \yii\db\Expression('NOW()'),
						'updated_by'		=> Yii::$app->user->identity->id,
	                    ],
	                    ['marks_details_id' => $marksDetailID[$i],'weightage_type_id' => $weightageTypeId[$i][$j]]
	                )->execute();
			} // closing of weightage[j] for loop
		} // closing of subject[i] for loop
		if($marksdetailUpdate){
			$transection->commit();
			Yii::$app->session->setFlash('success', "Marks Updated sccessfully...!");
		}
	} // closing of try
	catch (Exception $e) {
		$transection->rollback();
		echo $e;
		Yii::$app->session->setFlash('warning', "Marks not Updated. Try again!");
	} // closing of catch

} ?>