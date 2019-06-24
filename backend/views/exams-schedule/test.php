<?php 

	// getting `exam_category_id` from `exams_criteria`
	$examCateogryId = $_GET['examcatID'];
	// getting `class_id`
	$classId = $_GET['classID'];
	// geeting all info from `exams_criteria` table and `exams_schedule` table
	$manageExamData = Yii::$app->db->createCommand("SELECT c.exam_category_id,c.std_enroll_head_id,c.exam_start_date,c.exam_end_date,c.exam_start_time,c.exam_end_time,c.exam_room,
		s.subject_id,s.date
		FROM exams_criteria as c
		INNER JOIN exams_schedule as s
		ON c.exam_criteria_id = s.exam_criteria_id
		WHERE c.exam_category_id = '$examCateogryId'
		AND c.std_enroll_head_id = '$classId' 
					")->queryAll();
	$classId = $manageExamData[0]['std_enroll_head_id'];
	// getting classes name `std_enroll_head_name` from `std_enrollment_head` against `std_enroll_head_id`
	$className = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classId'
					")->queryAll();
	$countmanageExam = count($manageExamData);
	// getting exam `category_name` from `exams_cateogry`
	$examCategoryName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCateogryId'
					")->queryAll();

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
			<div class="panel panel-primary">
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h2 style="text-align: center;font-family: georgia;box-shadow: 1px 1px 1px 1px;">
							<?php echo $examCategoryName[0]['category_name']; ?> (<?php echo date('Y'); ?>)
							</h2>
							<br>
							<p style="text-align: center;font-weight: bold;font-size: 20px;">Date Sheet</p><br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4" style="border-right:1px solid;text-align: center;">
							<table class="table">
									<tr>
										<b>Exam Time</b><br>
										<center>
											<?php 
											echo date('h:i:A',strtotime($manageExamData[0]['exam_start_time']));
											?>
											<b>TO</b>&nbsp;<?php 
											echo date('h:i:A',strtotime($manageExamData[0]['exam_end_time']));
											?>
										</center>
									</tr>
							</table>
						</div>
						<div class="col-md-4" style="border-right:1px solid;text-align: center;">
							<table class="table">
									<tr>
										<b>Exam Room</b><br>
										<center>
											<?php echo $manageExamData[0]['exam_room']; ?>
										</center>
									</tr>
							</table>
						</div>
						<div class="col-md-4" style="text-align: center;">
							<table class="table">
									<tr>
										<b>Class Name</b>
										<center>
											<?php echo $className[0]['std_enroll_head_name']; ?>
										</center>
									</tr>
							</table>
						</div>
					</div><hr>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-hover">
								<thead>
									<tr style="background-color: #337AB7;color: white;">
										<th class="text-center">Date</th>
										<th class="text-center">Day</th>
										<th class="text-center">Subject</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									for ($i=0; $i <$countmanageExam ; $i++) { 
										$subjectId = $manageExamData[$i]['subject_id'];
										$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectId'
										")->queryAll();

									 ?>
									<tr align="center">
										<td>
											<?php
											echo 
											date('F d, Y',strtotime($manageExamData[$i]['date']));
											?>	
										</td>
										<td>
											<?php 
											//Our YYYY-MM-DD date string.
											$date = $manageExamData[$i]['date'];

											//Get the day of the week using PHP's date function.
											$dayOfWeek = date("l", strtotime($date));

											//Print out the day that our date fell on.
											echo $dayOfWeek;
											?>	
											</td>
										<td>
											<?php echo $subjectName[0]['subject_name']; ?>	
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>


