<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
			<div class="col-md-12">
					<a href="./" style="float: right;" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-step-backward"></i> Back</a>
			</div>
		</div><br>
		<div class="box box-primary">
			<div class="box-header">
				<h3>Marks Sheet Criteria</h3><hr
			</div>
			<div class="box-body">
				<form method="POST" >
					 <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>"> 
					<div class="row">
						<div class="col-md-4">	
							<div class="form-group">
								<label>Select Exam Category</label>
								<select name="exam_category" class="form-control">
									<option>Select Exam Category</option>
									<?php 

									 $examCategories = Yii::$app->db->createCommand("SELECT * FROM exams_category")->queryAll();					 	
									 ?>
									 <?php foreach ($examCategories as $key => $value) { ?>
									 <option value="<?php echo $value['exam_category_id']; ?>">
									 	<?php echo $value['category_name']; ?>
									 </option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Select Class</label>
								<select name="class_head" class="form-control">
									<option>Select Class</option>
									<?php 

									 $Classes = Yii::$app->db->createCommand("SELECT std_enroll_head_id,std_enroll_head_name FROM std_enrollment_head")->queryAll();					 	
									 ?>
									 <?php foreach ($Classes as $key => $value) { ?>
									 <option value="<?php echo $value['std_enroll_head_id']; ?>">
									 	<?php echo $value['std_enroll_head_name']; ?>
									 </option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Exam Type</label>
								<select name="exam_type" class="form-control" required>
									<option value="">Select Exam Type</option>
									<option value="Regular">Regular</option>
									<option value="Supply">Supply</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4" style="margin-top:24px;">
							<button type="submit" name="submit" class="btn btn-success">
								<i class="glyphicon glyphicon-search"></i> Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php 
	if(isset($_POST['submit']))
	{
		$examCategory = $_POST['exam_category'];
		$classHead = $_POST['class_head'];
		$exam_type = $_POST['exam_type'];

		$classNameId = Yii::$app->db->createCommand("SELECT class_name_id FROM std_enrollment_head WHERE std_enroll_head_id = '$classHead'")->queryAll();
		$classNameID = $classNameId[0]['class_name_id'];
		$ExamData = Yii::$app->db->createCommand("SELECT exam_criteria_id FROM exams_criteria WHERE exam_category_id = '$examCategory' AND class_id = '$classNameID' AND exam_status = 'conducted' OR exam_status = 'Result Prepared' AND exam_type = '$exam_type'")->queryAll();
		if(empty($ExamData)){
			Yii::$app->session->setFlash('warning',"Exams not conducted Yet..!");
		} else {

		$ExamName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCategory'")->queryAll();

		$className = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHead'")->queryAll();

		$criteriaId = $ExamData[0]['exam_criteria_id'];

		$examSchedule = Yii::$app->db->createCommand("SELECT s.subject_id, s.full_marks, s.passing_marks,c.exam_status,s.status FROM exams_schedule as s
			INNER JOIN exams_criteria as c 
			ON s.exam_criteria_id = c.exam_criteria_id
			WHERE c.class_id = '$classNameID'
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
				WHERE h.std_enroll_head_id = '$classHead';
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
				<div class="table-responsive">
				<table class="table table-hover table-bordered table-responsive">
					<thead>
						<tr>
							<!-- <th colspan="2" style="text-align: center;">Teacher Name</th> -->
						</tr>
						<tr>
							<th colspan="2">Teacher Name </th>
							
							<?php 

							for ($i=0; $i <$countSubjects ; $i++) {
								$subId = $examSchedule[$i]['subject_id'];
								$status = $examSchedule[$i]['status'];
							$teacherName = Yii::$app->db->createCommand("SELECT h.teacher_id, h.teacher_subject_assign_head_name
									FROM  teacher_subject_assign_head as h
									INNER JOIN teacher_subject_assign_detail as d 
									ON h.teacher_subject_assign_head_id = d.teacher_subject_assign_detail_head_id
									WHERE class_id = '$classHead' AND  subject_id = '$subId'")->queryAll();
									?>
						
						<td align="center">
							<a style="color:black;" target="_blank" href="./emp-info-view?id=<?php echo $teacherName[0]['teacher_id'];?>">
								<?php 
									if ($status == 'not') {

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
								$marks = Yii::$app->db->createCommand("SELECT d.obtained_marks FROM marks_details as d 
									INNER JOIN marks_head as h
									ON d.marks_head_id = h.marks_head_id
									WHERE h.exam_criteria_id = '$criteriaId'
									AND h.std_id = '$stdId'
									AND d.subject_id = '$subId'")->queryAll();
								
								?>
								<td><?php 
									if(empty($marks)){
										echo "<span class='label label-primary'> N/A </span>";
										$resultCounter++;
									} else {
										$obtMarks = $marks[0]['obtained_marks'];
										if($obtMarks < $examSchedule[$s]['passing_marks'] || $obtMarks == 'A'){
											echo "<span class='label label-warning'>".$obtMarks ."</span>";
											$failCounter++;
										} else {
											echo $obtMarks;
										}
									 
										if($marks[0]['obtained_marks'] == 'A'){
											$grandTotal += 0;
										} else {
											$grandTotal += $marks[0]['obtained_marks'];
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
									//$percent = round($percentage);
									//echo $percent;
									//$p = ceil($percentage);
									//echo $p;
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
									<a href="./update-marks?examCatID=<?php echo $examCategory;?>&classID=<?php echo $classNameID; ?>&classHeadID=<?php echo $classHead; ?>&stdID=<?php echo $stdId; ?>&examType=<?php echo $exam_type; ?>" class="btn btn-info btn-xs">
									<i class="glyphicon glyphicon-edit"></i> update
									</a>
								</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				</div>
				<br>
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
				<input type="hidden" name="classHead" value="<?php echo $classHead; ?>">
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
} // closing of isset
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
							'percentage' 	=> $percentArray[$i] ,
							'grade' 		=> $gradeArray[$i] ,
							'exam_status' 	=> $resultArray[$i] ,
							'updated_at'	=> new \yii\db\Expression('NOW()'),
							'updated_by'	=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $examCriteriaID, 'std_id' => $studentArray[$i]]
	                    )->execute();
				} //end of for loop
				if($marksHeadUpdate){
					$examStatusUpdate = Yii::$app->db->createCommand()->update('exams_criteria', 				[
							'exam_status' 	=> "Result Prepared",
							'updated_at'	=> new \yii\db\Expression('NOW()'),
							'updated_by'	=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $examCriteriaID]
	                    )->execute();
				}
				if($examStatusUpdate){
				$transection->commit();
				Yii::$app->session->setFlash('success', "Result Prepeard successfully...!");
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
		$countMarks 	= $_POST["countMarks"];
		$subjectArray 	= $_POST["subjectArray"];
		$marksDetailIdArray 	= $_POST["marksDetailIdArray"];

		for($j=0; $j<$countMarks; $j++){
			$a = $j+1;
			$marks = "marks_".$a;
			 $obt_marks[$j] = $_POST["$marks"];
		}

	$transection = Yii::$app->db->beginTransaction();
	try{
		for($k=0; $k<$countMarks; $k++){
			$marksdetailUpdate = Yii::$app->db->createCommand()->update('marks_details', [
					'subject_id' 		=> $subjectArray[$k],
					'obtained_marks' 	=> $obt_marks[$k] ,
					'updated_at'		=> new \yii\db\Expression('NOW()'),
					'updated_by'		=> Yii::$app->user->identity->id,
                    ],
                    ['marks_detail_id' => $marksDetailIdArray[$k]]
                )->execute();
		}
		if($marksdetailUpdate){
				$transection->commit();
				Yii::$app->session->setFlash('success', "Marks Updated sccessfully...!");
			}

		//closing of try block
	} catch(Exception $e){
		$transection->rollback();
		echo $e;
		Yii::$app->session->setFlash('warning', "Marks not Updated. Try again!");
	}
	//closing of catch

	} ?>