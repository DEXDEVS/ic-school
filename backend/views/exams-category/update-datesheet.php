<?php 

	if(isset($_GET["classID"]))
	{
	// getting `exam_category_id` from `exams_criteria`
	$examCateogryId = $_GET['examcatID'];
	// getting `class_id`
	$classId = $_GET['classID'];
	//getting `examType`
	$examType = $_GET['examType'];
	$startYear = $_GET['startYear'];
	$endYear = $_GET['endYear'];
	// geeting all info from `exams_criteria` table
	$examCriteriaData = Yii::$app->db->createCommand("SELECT * FROM exams_criteria WHERE exam_category_id = '$examCateogryId' AND class_id = '$classId' AND exam_type = '$examType' AND YEAR(exam_start_date) = '$startYear' AND YEAR(exam_end_date) = '$endYear' 
					")->queryAll();
	
	$criteriaId = $examCriteriaData[0]['exam_criteria_id'];

	$examScheduleData = Yii::$app->db->createCommand("SELECT * FROM exams_schedule WHERE exam_criteria_id = '$criteriaId'
					")->queryAll();
	$count = count($examScheduleData);
	// getting classes name `class_name` from `std_class_name` against `class_name_id`
	$className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
					")->queryAll();
	
	// getting exam `category_name` from `exams_cateogry`
	$examCategoryName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCateogryId'
					")->queryAll();

	// getting all info from `exams_room` table
	//$examRoom = Yii::$app->db->createCommand("SELECT * FROM exams_room WHERE exam_criteria_id = '$criteriaId'")->queryAll();
	//$countRooms = count($examRoom);

 ?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Datesheet Update</title>
	<style type="text/css">
		#hover-effect:hover{
			background-color:#001F3F;
			color:white;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- back button start -->
	 	<ol class="breadcrumb">
      		<li><a class="btn btn-primary btn-xs" href="./exam-lists?id=<?php echo $examCateogryId;?>"><i class="fa fa-backward"></i> Back</a></li>
    	</ol>
		<!-- back button close -->
		<div class="box box-primary">
			<div class="box-header">
				<div class="well well-sm" style="border-left:2px solid;margin-top:10px;font-size:20px;font-weight:bolder;">
					<h4><i class="glyphicon glyphicon-hand-right"></i> Update Date Sheet</h4>
				</div>
				<h3 class="well well-sm" style="text-align:center; border-left:1px solid;border-right:2px solid; font-family:georgia;background-color:#001F3F;color:white;">Exams Criteria</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="exam-lists?id=<?php echo $examCateogryId ?>">
					<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>"> 
					<div class="row">
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Select Exam Category</label>
								<select name="exam_category" class="form-control" >
									<?php 
									$ExamCategories = Yii::$app->db->createCommand("SELECT * FROM exams_category WHERE exam_category_id != '$examCateogryId'")->queryAll();
									$examName = Yii::$app->db->createCommand("SELECT category_name,exam_category_id FROM exams_category WHERE exam_category_id = '$examCateogryId'")->queryAll();					 	
									?>
										<option value="<?php echo $examName[0]['exam_category_id']; ?>">
											<?php echo $examName[0]['category_name']; ?>
										</option>
									<?php foreach ($ExamCategories as $key => $value) { ?>
										<option value="<?php echo $value['exam_category_id']; ?>">
											<?php echo $value['category_name']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-university" style="color:#4997e5;"></i> Class Name</label>
								<input class="form-control" type="text" value="<?php echo $className[0]['class_name']; ?>" readonly="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam Start Date</label>
								<input type="date" name="exam_start_date" class="form-control" value="<?php echo $examCriteriaData[0]['exam_start_date'];?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam End Date</label>
								<input type="date" name="exam_end_date" class="form-control" value="<?php echo $examCriteriaData[0]['exam_end_date'];?>">
							</div>
						</div>
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-stats" style="color:#4997e5;"></i> Select Status</label>
								<select name="exam_status" class="form-control">
									 <option value="<?php echo $examCriteriaData[0]['exam_status'];?>">
									 	<?php echo $examCriteriaData[0]['exam_status'];?>
									 </option>
								<?php if($examCriteriaData[0]['exam_status'] != "Inactive"){?>
										<option value="Inactive">Inactive</option>
								<?php }
								if($examCriteriaData[0]['exam_status'] != "Announced"){?>
									 <option value="Announced">Announced</option>
								<?php } 
								if($examCriteriaData[0]['exam_status'] != "Conducted"){?>?>
									 <option value="Conducted">Conducted</option>
									<?php 	} ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Exam Type</label>
								<input class="form-control" type="text" name="examType" value="<?php echo $examCriteriaData[0]['exam_type']; ?>" readonly="">
							</div>
						</div>
					</div>
					<div class="box-header" style="text-align: center;">
						<h3 class="well well-sm" style="border-left:2px solid;border-right:2px solid; font-family:georgia;background-color:#001F3F;color:white;">Exams Schedule</h3>
					</div>
					<?php for ($i=0; $i <$count ; $i++) {
					 	$subjectId = $examScheduleData[$i]['subject_id'];

						$subjectName = Yii::$app->db->createCommand("
						SELECT subject_name FROM subjects WHERE subject_id = '$subjectId'
							")->queryAll();
					 	$subarray[$i] = $subjectId;
						?>
					<table class="table table-stripped well well-sm"> 
						<tr>
							<td>
								<div class="row container-fluid">
									<div class="col-md-12">
										<p id="hover-effect" style="text-align: center;border-bottom:1px solid;padding:10px;border-radius:20px;font-size:20px;">
										<i class="fa fa-book" style="color:#4997e5;"></i>
										<?php echo $subjectName[0]['subject_name'];?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Date</label>
													<input type="date" name="date[]" class="form-control" value="<?php echo $examScheduleData[$i]['date']; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> Exam Start Time</label>
													<input type="time" name="exam_start_time[]" class="form-control" value="<?php echo $examScheduleData[$i]['exam_start_time']; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> Exam End Time</label>
													<input type="time" name="exam_end_time[]" class="form-control" value="<?php echo $examScheduleData[$i]['exam_end_time']; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<?php } //end of for loop?>
					<input type="hidden" name="headId" value="<?php echo $classId;?>">
					<input type="hidden" name="subjCount" value="<?php echo $count;?>">
					<input type="hidden" name="criteriaId" value="<?php echo $criteriaId;?>">
					<?php 
					foreach ($subarray as $key => $value) {
						echo '<input type="hidden" name="subarray[]" value="'.$value.'">';
					}
					?>
					<div class="row">
					 	<div class="col-md-12">
					 		<button type="submit" name="update" class="btn btn-info btn-xs" style="float: right;"><i class="glyphicon glyphicon-edit"></i> Update</button>
					 	</div>
					 </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php } ?>
<?php 

	if(isset($_GET["headID"]))
	{ 
		// getting `exam_category_id` from `exams_criteria`
	$examCateogryId = $_GET['examcatID'];
	// getting `class_id`
	$classId = $_GET['class_id'];
	$headID = $_GET['headID'];
	//getting `examType`
	$examType = $_GET['examType'];
	$startYear = $_GET['startYear'];
	$endYear = $_GET['endYear'];

	// geeting all info from `exams_criteria` table
	$examCriteriaData = Yii::$app->db->createCommand("SELECT * FROM exams_criteria WHERE exam_category_id = '$examCateogryId' AND class_id = '$classId' AND exam_type = '$examType' AND YEAR(exam_start_date) = '$startYear' AND YEAR(exam_end_date) = '$endYear' 
					")->queryAll();
	
	$criteriaId = $examCriteriaData[0]['exam_criteria_id'];

	$examScheduleData = Yii::$app->db->createCommand("SELECT * FROM exams_schedule WHERE exam_criteria_id = '$criteriaId'
					")->queryAll();
	$count = count($examScheduleData);
	// getting classes name `class_name` from `std_class_name` against `class_name_id`
	$className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
					")->queryAll();
	$headName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$headID'
					")->queryAll();
	
	// getting exam `category_name` from `exams_cateogry`
	$examCategoryName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCateogryId'
					")->queryAll();

	// getting all info from `exams_room` table
	//$examRoom = Yii::$app->db->createCommand("SELECT * FROM exams_room WHERE exam_criteria_id = '$criteriaId'")->queryAll();
	//$countRooms = count($examRoom);

	?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Datesheet Update</title>
	<style type="text/css">
		#hover-effect:hover{
			background-color:#001F3F;
			color:white;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<!-- back button start -->
	 	<ol class="breadcrumb">
      		<li><a class="btn btn-primary btn-xs" href="./exam-lists?id=<?php echo $examCateogryId;?>"><i class="fa fa-backward"></i> Back</a></li>
    	</ol>
		<!-- back button close -->
		<div class="box box-primary">
			<div class="box-header">
				<div class="well well-sm" style="border-left:2px solid;margin-top:10px;font-size:20px;font-weight:bolder;">
					<h4><i class="glyphicon glyphicon-hand-right"></i> Update Date Sheet : ( <?php echo "<b>".$headName[0]['std_enroll_head_name']."</b>"; ?> )</h4>
				</div>
				<h3 class="well well-sm" style="text-align:center; border-left:1px solid;border-right:2px solid; font-family:georgia;background-color:#001F3F;color:white;">Exams Criteria</h3>
			</div>
			<div class="box-body">
				<form method="POST" action="./view-sections?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>">
					<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>"> 
					<div class="row">
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Select Exam Category</label>
									<?php 
									$examName = Yii::$app->db->createCommand("SELECT category_name,exam_category_id FROM exams_category WHERE exam_category_id = '$examCateogryId'")->queryAll();					 	
									?>
									<input type="text" name="exam_category" readonly="" value="<?php echo $examName[0]['category_name']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="fa fa-university" style="color:#4997e5;"></i> Class Name</label>
								<input class="form-control" type="text" value="<?php echo $className[0]['class_name']; ?>" readonly="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam Start Date</label>
								<input type="date" name="exam_start_date" class="form-control" value="<?php echo $examCriteriaData[0]['exam_start_date'];?>" readonly="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Exam End Date</label>
								<input type="date" name="exam_end_date" class="form-control" value="<?php echo $examCriteriaData[0]['exam_end_date'];?>" readonly="">
							</div>
						</div>
						<div class="col-md-4">	
							<div class="form-group">
								<label><i class="glyphicon glyphicon-stats" style="color:#4997e5;"></i> Select Status</label>
								<input type="text" name="exam_status" value="<?php echo $examCriteriaData[0]['exam_status'];?>" readonly="" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><i class="glyphicon glyphicon-th-list" style="color:#4997e5;"></i> Exam Type</label>
								<input class="form-control" type="text" name="examType" value="<?php echo $examCriteriaData[0]['exam_type']; ?>" readonly="">
							</div>
						</div>
					</div>
					<div class="box-header" style="text-align: center;">
						<h3 class="well well-sm" style="border-left:2px solid;border-right:2px solid; font-family:georgia;background-color:#001F3F;color:white;">Exams Schedule</h3>
					</div>
					<?php for ($i=0; $i <$count ; $i++) {
					 	$subjectId = $examScheduleData[$i]['subject_id'];

						$subjectName = Yii::$app->db->createCommand("
						SELECT subject_name FROM subjects WHERE subject_id = '$subjectId'
							")->queryAll();
					 	$subarray[$i] = $subjectId;
					 	$scheduleID[$i] = $examScheduleData[$i]['exam_schedule_id'];
					 	$scheduleData = Yii::$app->db->createCommand("
						SELECT exam_room,emp_id
						FROM exams_room
						WHERE exam_schedule_id = '$scheduleID[$i]'
						AND class_head_id = '$headID'
							")->queryAll();
					 	$roomID = $scheduleData[0]['exam_room'];
						$roomName = Yii::$app->db->createCommand("SELECT room_name FROM rooms WHERE room_id = '$roomID'")->queryAll();
						$invigilatorID = $scheduleData[0]['emp_id'];
						$invigilatorName = Yii::$app->db->createCommand("SELECT emp_name FROM emp_info WHERE emp_id = '$invigilatorID'")->queryAll();
						?>
					<table class="table table-stripped well well-sm"> 
						<tr>
							<td>
								<div class="row container-fluid">
									<div class="col-md-12">
										<p id="hover-effect" style="text-align: center;border-bottom:1px solid;padding:10px;border-radius:20px;font-size:20px;">
										<i class="fa fa-book" style="color:#4997e5;"></i>
										<?php echo $subjectName[0]['subject_name'];?>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-calendar" style="color:#4997e5;"></i> Date</label>
													<input type="date" name="date[]" class="form-control" value="<?php echo $examScheduleData[$i]['date']; ?>" readonly="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> Exam Start Time</label>
													<input type="time" name="exam_start_time[]" class="form-control" value="<?php echo $examScheduleData[$i]['exam_start_time']; ?>" readonly="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-time" style="color:#4997e5;"></i> Exam End Time</label>
													<input type="time" name="exam_end_time[]" class="form-control" value="<?php echo $examScheduleData[$i]['exam_end_time']; ?>" readonly="">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-th" style="color:#4997e5;"></i> Room</label>
													<select name="room[]" class="form-control">
														<option value="<?php echo $roomID; ?>">
															<?php echo $roomName[0]['room_name']; ?>
														</option>
														<?php 
														$roomData = Yii::$app->db->createCommand("SELECT room_id,room_name FROM rooms WHERE room_id != '$roomID'")->queryAll();
														foreach ($roomData as $key => $value) {
														
														 ?>
														 <option value="<?php echo $value['room_id'] ; ?>">
														 	<?php echo $value['room_name'] ; ?>
														 </option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label><i class="glyphicon glyphicon-user" style="color:#4997e5;"></i> Invigilator</label>
													<select name="invigilator[]" class="form-control">
														<option value="<?php echo $invigilatorID; ?>">
															<?php echo $invigilatorName[0]['emp_name']; ?>
														</option>
														<?php 
														$invigilatorData = Yii::$app->db->createCommand("SELECT emp_name,emp_id FROM emp_info WHERE emp_id != '$invigilatorID'")->queryAll();
														foreach ($invigilatorData as $key => $value) {
														
														 ?>
														 <option value="<?php echo $value['emp_id'] ; ?>">
														 	<?php echo $value['emp_name'] ; ?>
														 </option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<?php } //end of for loop?>
					<input type="hidden" name="headId" value="<?php echo $headID;?>">
					<input type="hidden" name="subjCount" value="<?php echo $count;?>">
					<?php 
					foreach ($scheduleID as $key => $value) {
						echo '<input type="hidden" name="scheduleID[]" value="'.$value.'">';
					}
					?>
					<div class="row">
					 	<div class="col-md-12">
					 		<button type="submit" name="update" class="btn btn-info btn-xs" style="float: right;"><i class="glyphicon glyphicon-edit"></i> Update</button>
					 	</div>
					 </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php } //isset for headid close ?>