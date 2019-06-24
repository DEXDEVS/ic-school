<?php 

	if(isset($_GET['examcatID'])){

		$examCatID 		= $_GET['examcatID'];
		$classID 	= $_GET['classID'];
		$examType 	= $_GET['examType'];

		$examStatus = Yii::$app->db->createCommand("SELECT exam_status FROM exams_criteria WHERE exam_category_id = '$examCatID' AND class_id = '$classID' AND exam_status = 'Result Prepared' OR exam_status = 'Result Announced' AND exam_type = '$examType' ")->queryAll();
		if (empty($examStatus)) {
			Yii::$app->session->setFlash('warning',"Result card not prepared yet..!");
		} 
		else {

		$ExamName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCatID'")->queryAll();

		$className = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classID'")->queryAll();

		$examData = Yii::$app->db->createCommand("SELECT c.exam_type,c.exam_criteria_id,s.subject_id,s.passing_marks
			FROM exams_schedule as s
			INNER JOIN exams_criteria as c 
			ON s.exam_criteria_id = c.exam_criteria_id
			WHERE c.class_id = '$classID'
			AND c.exam_category_id = '$examCatID'
			AND c.exam_status = 'Result Prepared'
			 OR c.exam_status = 'Result Announced' 
			AND c.exam_type = '$examType'
			")->queryAll();
		$criteriaID = $examData[0]['exam_criteria_id'];
		$countSubject = count($examData);

		$stdData = Yii::$app->db->createCommand("SELECT d.std_roll_no,d.std_enroll_detail_std_id,d.std_enroll_detail_std_name
			FROM std_enrollment_detail as d
			INNER JOIN std_enrollment_head as h 
			ON h.std_enroll_head_id = d.std_enroll_detail_head_id
			WHERE h.std_enroll_head_id = '$classID'")->queryAll();

		
		$countStdData = count($stdData);

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
			<a href="./exam-lists?id=<?php echo $examCatID ;?>" style="float: right;" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-backward"></i> Back</a>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header" style="text-align: center;">
					<h2>Result Card (<?php echo $examData[0]['exam_type']; ?>)</h2>
				</div><hr>
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
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Roll #</th>
								<th>Name</th>
								<?php 
								for ($s=0; $s <$countSubject ; $s++) { 
									$subjectId = $examData[$s]['subject_id'];
									$subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectId'")->queryAll();

								 ?>
								<th><?php echo $subjectName[0]['subject_name']; ?></th>
								<?php } ?>
								<th>Grand Total</th>
								<th>%age</th>
								<th>Grade</th>
								<th>Result</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i <$countStdData ; $i++) { 
								$stdID = $stdData[$i]['std_enroll_detail_std_id'];
							?>
							<tr>
								<td><?php echo $stdData[$i]['std_roll_no']; ?></td>
								<td><?php echo $stdData[$i]['std_enroll_detail_std_name']; ?></td>
								<?php 
								for ($j=0; $j <$countSubject ; $j++) { 
									$subjectId = $examData[$j]['subject_id'];
									$subjectMarks = Yii::$app->db->createCommand("SELECT d.obtained_marks
										FROM marks_details as d 
										INNER JOIN marks_head as h 
										ON h.marks_head_id = d.marks_head_id
										WHERE h.exam_criteria_id = '$criteriaID' AND
										h.std_id = '$stdID' AND
										d.subject_id = '$subjectId'")->queryAll();

								 ?>
								<td>
									<?php 
								if ($subjectMarks[0]['obtained_marks'] == 'A' || $subjectMarks[0]['obtained_marks'] < $examData[$j]['passing_marks']) {
									echo "<span class='label label-warning'>".$subjectMarks[0]['obtained_marks']."</span>";

								}else{
									echo $subjectMarks[0]['obtained_marks'];
								}
									?>
									
								</td>
								<?php } ?>
								<?php 
									$stdResult = Yii::$app->db->createCommand("SELECT h.grand_total,h.percentage,h.grade,h.exam_status
										FROM marks_head as h 
										WHERE h.exam_criteria_id = '$criteriaID' AND
										h.std_id = '$stdID'")->queryAll();
								 ?>
								<td><?php echo $stdResult[0]['grand_total']; ?></td>
								<td><?php echo $stdResult[0]['percentage']; ?></td>
								<td><?php echo $stdResult[0]['grade']; ?></td>
								<td>
									<?php 
									if ($stdResult[0]['exam_status'] == 'Fail') {
										echo "<span class='label label-danger'>".$stdResult[0]['exam_status']."</span>";
									}
									else{
										echo "<span class='label label-success'>".$stdResult[0]['exam_status']."</span>";
									}
									

									?>
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
</body>
</html>
<?php 
	} 

}
?>
