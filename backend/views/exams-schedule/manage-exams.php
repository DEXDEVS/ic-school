<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manage Exams</title>
	<style type="text/css">
		#sub-hvr:hover{
			background-color:#001F3F;
			color:white;
		}
	</style>
</head>
<body>

<?php $branch_id = Yii::$app->user->identity->branch_id; ?>

<div class="container-fluid">
	<div class="well well-sm" style="border-left:2px solid;border-radius:10px;">
		<h4 style="font-weight:bolder;"><i class="glyphicon glyphicon-hand-right"></i> Manage Exam</h4>
	</div>
	<div class="box box-primary col-md-12">
		<div class="box-header">
			<div class="well well-sm" style="text-align:center;border-left:2px solid;border-right:2px solid;margin-top:10px;background-color:#001F3F;color:white;">
			<h4 style="font-size:25px;font-family:georgia;font-weight:bolder;">Exam Criteria</h4>
			</div>
		</div>
		<div class="box-body">
			<form method="POST" action="manage-exams">
				 <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>"> 
				<div class="row">
					<div class="col-md-4">	
						<div class="form-group">
							<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Select Exam Category</label>
							<select name="exam_category" class="form-control" required>
								<option value="">Select Category</option>
								<?php 
								 $ExamCategories = Yii::$app->db->createCommand("SELECT * FROM exams_category")->queryAll();
								
								foreach ($ExamCategories as $key => $value) { ?>
									<option value="<?php echo $value['exam_category_id']; ?>">
									 	<?php echo $value['category_name']; ?>
									</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="fa fa-university" style="color:#4997e5;"></i>Select Class</label>
							<select name="class_head" class="form-control" required>
								<option value="">Select Class</option>
						<?php 	$Classes = Yii::$app->db->createCommand("SELECT class_name, 		class_name_id FROM std_class_name")->queryAll(); 

								foreach ($Classes as $key => $value) { ?>
								 <option value="<?php echo $value['class_name_id']; ?>">
								 	<?php echo $value['class_name']; ?>
								 </option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam Start Date</label>
							<input type="date" name="exam_start_date" class="form-control" required="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">	
						<div class="form-group">
							<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam End Date</label>
							<input type="date" name="exam_end_date" class="form-control" required="">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Exam Type</label>
							<select name="exam_type" class="form-control" required>
								<option value="">Select Exam Type </option>
								<option value="Regular">Regular</option>
								<option value="Supply">Supply</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button style="float: right;" type="submit" name="submit" class="btn btn-success btn-xs"></i> Get Subjects</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(isset($_POST['submit'])) {
	$exam_category 		= $_POST["exam_category"];
	$classId 			= $_POST["class_head"];
	$exam_start_date 	= $_POST["exam_start_date"];
	$exam_end_date 		= $_POST["exam_end_date"];
	$exam_type 			= $_POST["exam_type"];

	if($exam_type == "Regular"){
		//fetch sections against class_name_id
		$class_sections = Yii::$app->db->createCommand("SELECT std_enroll_head_id, std_enroll_head_name
		FROM  std_enrollment_head
		WHERE class_name_id = '$classId'
		")->queryAll();

		if(empty($class_sections)){
			Yii::$app->session->setFlash('warning', "Sections not found.");
		} else {
			$countSections = count($class_sections);
			//query check if selected class have any schedull against selected dates
			$examCriteriaData = Yii::$app->db->createCommand("SELECT exam_criteria_id
			FROM  exams_criteria
			WHERE class_id 				= '$classId' AND
				  exam_start_date 		= '$exam_start_date' AND
				  exam_end_date 		= '$exam_end_date'
			")->queryAll();

		if (!empty($examCriteriaData)) {
			Yii::$app->session->setFlash('warning', "Exams Schedule already managed against selected class in selected date range ...!");
		}else{
			$marks = Yii::$app->db->createCommand("SELECT mwh.subjects_id,mwd.weightage_type_id,mwd.marks
			FROM marks_weightage_head as mwh
			INNER JOIN marks_weightage_details as mwd
			ON mwh.marks_weightage_id = mwd.weightage_head_id
			WHERE mwh.exam_category_id = '$exam_category'
			AND mwh.class_id = '$classId'")->queryAll();
		if(empty($marks)){
			Yii::$app->session->setFlash('warning',"Marks waitage for this category is not set.");
		} else {
			$subjects = Yii::$app->db->createCommand("SELECT std_subject_name
			FROM std_subjects
			WHERE class_id = '$classId'")->queryAll();
			$subject = $subjects[0]['std_subject_name'];
			$subjectarray = explode(',', $subject);
			$subjCount = count($subjectarray); ?>

			<div class="container-fluid">
			<div class="box box-primary container-fluid">
				<div class="box-header">
					<div class="well well-sm" style="text-align:center;border-left:2px solid;border-right:2px solid;margin-top:10px;background-color:#001F3F;color:white;">
						<h4 style="font-size:25px;font-family:georgia;font-weight:bolder;">Exam Schedule</h4>
					</div>
				</div>
				<!-- closing box-header -->
				<form method="post" action="manage-exam-sections">
					
				<div class="box-body" style="background-color:#fafafa;">
					
					<table class="table table-stripped"> 
				<?php 	for ($i=0; $i <$subjCount ; $i++) {
							$subject = $subjectarray[$i];
							//fetch subject id
							$subjectId = Yii::$app->db->createCommand("
							SELECT subject_id FROM subjects WHERE subject_name = '$subject'
								")->queryAll();
							$subarray[$i] = $subjectId[0]['subject_id'];
							//marks weightage
							$marks = Yii::$app->db->createCommand("SELECT mwd.weightage_type_id,mwd.marks
								FROM marks_weightage_head as mwh
								INNER JOIN marks_weightage_details as mwd
								ON mwh.marks_weightage_id = mwd.weightage_head_id
								WHERE mwh.exam_category_id = '$exam_category'
								AND mwh.class_id = '$classId'
								AND mwh.subjects_id = '$subarray[$i]'")->queryAll();
							
							$markcount = count($marks);
							$totalMarks = 0;
							foreach($marks as $value){
								$totalMarks += $value['marks'];
							}
							 
							if ($totalMarks <= 100) {
								$passmarks = 33;
							}
							elseif ($totalMarks <= 75) {
								$passmarks = 25;
							}
							elseif ($totalMarks <= 50) {
								$passmarks = 17;
							} else {
								$passmarks = 0;
							} ?>
							<tr>
								<td>
									<div class="row">
										<div id="sub-hvr" class="col-md-12" style="border:1px solid;border-radius: 8px;">
											<h4 style="text-align: center;">
											<i class="fa fa-book" style="color:#4997e5;"></i>
											<?php echo $subject;?>
											</h4>
										</div>
									</div><br>
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group" >
												<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Date</label>
												<input type="date" name="date[]" class="form-control" required="">
											</div>
											
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> Start Time</label>
												<input type="time" name="exam_start_time[]" class="form-control" required="">
											</div>
											<div class="form-group">
												<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> End Time</label>
												<input type="time" name="exam_end_time[]" class="form-control" required="">
											</div>
										</div>
										<div class="col-sm-7">
											<div class="row">
										<?php for ($m=0; $m <$markcount ; $m++) { 
												$weightageId = $marks[$m]['weightage_type_id'];
												$weightageName = Yii::$app->db->createCommand("
												SELECT weightage_type_name
												FROM marks_weightage_type WHERE weightage_type_id ='$weightageId'
												")->queryAll();
												$weightageMarks = $marks[$m]['marks']; ?>
												<div class="col-sm-2">
													<div class="form-group">
														<label><?php echo $weightageName[0]['weightage_type_name']; ?></label>
														<input type="text" class="form-control" value="<?php echo $weightageMarks;?>" readonly="">
													</div>
												</div>
		 									<?php } ?>
		 									<div class="col-sm-2">
												<div class="form-group">
													<label>T.Marks</label>
													<input type="text" class="form-control" value="<?php echo $totalMarks;?>" readonly="" name="fullmarks[]"> 
												</div>
											</div>
											<div class="col-sm-2">
												<div class="form-group">
													<label>P.Marks</label>
													<input type="text" class="form-control" value="<?php echo $passmarks;?>" readonly="" name="passingmarks[]"> 
												</div>
											</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
					<?php } //end of for loop 
						foreach ($subarray as $key => $value) {
							echo '<input type="hidden" name="subarray[]" value="'.$value.'">';
						}
						 ?>
						
					</table>
						 <div class="row">
						 	<div class="col-md-12">
						 		<button type="submit" name="save" class="btn btn-success btn-xs" style="float: right;"><i class="glyphicon glyphicon-save"></i> Save Date Sheet</button>
						 	</div>
						 </div>
						<input type="hidden" name="exam_category" value="<?php echo $exam_category;?>">
						<input type="hidden" name="classId" value="<?php echo $classId;?>">
						<input type="hidden" name="exam_start_date" value="<?php echo $exam_start_date;?>">
						<input type="hidden" name="exam_end_date" value="<?php echo $exam_end_date;?>">
						<input type="hidden" name="subjCount" value="<?php echo $subjCount;?>">
						<input type="hidden" name="exam_type" value="<?php echo $exam_type;?>">
					</form>
				</div>
				<!-- closing box-body -->
<?php	}//closing of else for marks weightage
		}//closing of else for exam schedule date
		}//closing of else for class_sections
	} //closing of if(Reguler)
	
	if($exam_type == "Supply"){
		$examCriteriaData = Yii::$app->db->createCommand("SELECT exam_criteria_id
			FROM  exams_criteria
			WHERE exam_category_id 		= '$exam_category' AND
				  class_id 				= '$classId' AND
				  exam_start_date 		= '$exam_start_date' AND
				  exam_end_date 		= '$exam_end_date' AND
				  exam_type				= 'Supply'
			")->queryAll();

		if (!empty($examCriteriaData)) {
			Yii::$app->session->setFlash('warning', "Exams Schedule for supplimentry is already managed against selected Date range ...!");
		}else{

		$marks = Yii::$app->db->createCommand("SELECT * FROM marks_weitage WHERE exam_category_id = '$exam_category'")->queryAll();

		if(empty($marks)){
			Yii::$app->session->setFlash('warning',"Marks waitage for this category is not set.");
		} else {

			$criteriaId = Yii::$app->db->createCommand("SELECT c.exam_criteria_id, s.passing_marks, s.subject_id 
				FROM exams_criteria as c
				INNER JOIN exams_schedule as s
				ON c.exam_criteria_id = s.exam_criteria_id
				WHERE c.exam_category_id = $exam_category
				AND c.class_id = $classId
				AND c.exam_status = 'Result Announced'
				AND c.exam_type = 'Regular'")->queryAll();

			if(empty($criteriaId)){
				Yii::$app->session->setFlash('warning',"Cannot manage supplimentry scedule before announcement of result for reguler exam");
			}else{
				$criteria_id = $criteriaId[0]['exam_criteria_id'];
				$stdExamStatus = Yii::$app->db->createCommand("SELECT h.std_id
						FROM marks_head as h
						WHERE h.exam_criteria_id = '$criteria_id'
						AND h.exam_status = 'Fail'
						")->queryAll();
				if(empty($stdExamStatus)){
					Yii::$app->session->setFlash('warning',"No student Failed in this Exam..!");
				} else {
				$count = count($criteriaId);
				for($i=0; $i<$count; $i++){
					$subId = $criteriaId[$i]['subject_id'];
					$passingMarks = $criteriaId[$i]['passing_marks'];
					$subject = Yii::$app->db->createCommand("SELECT DISTINCT(d.subject_id)
						FROM marks_details as d
						INNER JOIN marks_head as h
						ON d.marks_head_id = h.marks_head_id
						WHERE h.exam_criteria_id = '$criteria_id'
						AND h.exam_status = 'Fail'
						AND d.subject_id = '$subId'
						AND d.obtained_marks < '$passingMarks'
						OR d.obtained_marks = 'A'
						")->queryAll();
				}
				$subjectArray = array();
				foreach ($subject as $key => $value) {
					$subjectArray[$key] = $value['subject_id'];
					
				}
				$countSubject = count($subject);

			?>
<div class="container-fluid">
<div class="box box-default container-fluid">
	<div class="box-header">
		<h3>Exam Schedule</h3><hr>
	</div>		
<div class="box-body" style="background-color:#fafafa;">
	<form method="post">
	<table class="table table-stripped"> 
		<?php for ($s=0; $s < $countSubject; $s++) { 
				$subjectId =$subjectArray[$s];
				$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectId' ")->queryAll();

				$marks = Yii::$app->db->createCommand("
				SELECT * FROM marks_weitage WHERE exam_category_id = '$exam_category' AND subject_id = '$subjectId'
					")->queryAll();

					$totalMarks = $marks[0]['presentation']+$marks[0]['assignment']+$marks[0]['attendance']+$marks[0]['dressing']+$marks[0]['theory']+$marks[0]['practical'];

					if ($totalMarks == 100) {
						$passmarks = 33;
					}
					elseif ($totalMarks == 75) {
						$passmarks = 25;
					}
					elseif ($totalMarks == 50) {
						$passmarks = 17;
					} else {
						$passmarks = 0;
					}
				
		 ?>
				<tr>
					<td>
							<div class="row">
								<div id="sub-hvr" class="col-md-12" style="border:1px solid;color:#AA5397;border-radius: 8px;">
									<h4 style="text-align: center;">
									<i class="fa fa-book"></i>
									<?php echo $subjectName[0]['subject_name']; ?>
									</h4>
								</div>
							</div><br>
							<div class="row" style="border-bottom:1px solid #ebd6e7; ">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group" >
											<label>Date</label>
											<input type="date" name="date[]" class="form-control" required="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Presentation</label>
											<input type="text" name="presentation[]" class="form-control" value="<?php echo $marks[0]['presentation'];?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Assignment</label>
											<input type="text" name="assignment[]" class="form-control" value="<?php echo $marks[0]['assignment'];?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Attendance</label>
											<input type="text" name="attendance[]" class="form-control" value="<?php echo $marks[0]['attendance'];?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Dressing</label>
											<input type="text" name="dressing[]" class="form-control" value="<?php echo $marks[0]['dressing'];?>" readonly="">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
											<label>Invagilator</label>
											<select name="Invagilator[]" class="form-control" required>

												<?php 

												$teacher = Yii::$app->db->createCommand("
												SELECT emp_id,emp_name
												FROM emp_info WHERE group_by ='Faculty'
												")->queryAll();
												$countteacher = count($teacher);
												 ?>
												<option value="">Select invagilator</option>
												<?php 
												for ($j=0; $j <$countteacher ; $j++) { ?>
												<option value="<?php
														echo $teacher[$j]['emp_id'];
												?>">
												<?php
														echo $teacher[$j]['emp_name'];
												?>
												</option>
												<?php } ?>
											</select>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Theory</label>
											<input type="text" name="theory" class="form-control" value="<?php echo $marks[0]['theory'];?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Practical</label>
											<input type="text" name="practical[]" class="form-control" value="<?php echo $marks[0]['practical'];?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Full Marks</label>
											<input type="text" name="fullmarks[]" class="form-control" value="<?php echo $totalMarks;?>" readonly="">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<label>Passing Marks</label>
											<input type="text" name="passingmarks[]" class="form-control" value="<?php echo $passmarks; ?>" readonly="">
											</div>
										</div>
									</div>
								</div>
								
							</div>
						
					</td>
				</tr>
	<?php 
	} //end of for loop counrSubject
	foreach ($subjectArray as $key => $value) {
		echo '<input type="hidden" name="subarray[]" value="'.$value.'">';
	}

	 ?>
	
	</table>
	 <div class="row">
	 	<div class="col-md-12">
	 		<button type="submit" name="save" class="btn btn-success btn-xs" style="float: right;"><i class="glyphicon glyphicon-save"></i> Save Date Sheet</button>
	 	</div>
	 </div>
	<input type="hidden" name="exam_category" value="<?php echo $exam_category;?>">
	<input type="hidden" name="classId" value="<?php echo $classId;?>">
	<input type="hidden" name="exam_start_date" value="<?php echo $exam_start_date;?>">
	<input type="hidden" name="exam_end_date" value="<?php echo $exam_end_date;?>">
	<input type="hidden" name="exam_start_time" value="<?php echo $exam_start_time;?>">
	<input type="hidden" name="exam_end_time" value="<?php echo $exam_end_time;?>">
	<input type="hidden" name="room" value="<?php //echo $room;?>">
	<input type="hidden" name="subjCount" value="<?php echo $countSubject;?>">
	<input type="hidden" name="exam_type" value="<?php echo $exam_type;?>">
	 </form>
	</div>
		<?php
	}
	//closing of else studentExamStatus
		}	
		//closing of else criteriaId
		}
		//closing of else for marks weightage
		}
		//closing of else for exam schedule date
	}//closing of if(Supply)
	} // closing of isset
	 ?>
	 
	</div>
</div>
	
</body>
</html>