<?php 

	if(isset($_GET['sub_id']))
	{
		$sub_id = $_GET['sub_id'];
		$class_id = $_GET['class_id'];
		$emp_id = $_GET['emp_id'];

		$empName = Yii::$app->db->createCommand("SELECT emp.emp_name FROM emp_info as emp WHERE emp.emp_id = '$emp_id'")->queryAll();

        $CLASSName = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_name
            FROM std_enrollment_head as seh
            WHERE seh.std_enroll_head_id = '$class_id'")->queryAll();

        $subjectsName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$sub_id'")->queryAll();

        $studentData = Yii::$app->db->createCommand("SELECT d.std_roll_no,d.std_enroll_detail_std_name,d.std_enroll_detail_std_id
        FROM std_enrollment_head as h
		INNER JOIN std_enrollment_detail as d
		ON h.std_enroll_head_id = d.std_enroll_detail_head_id
        WHERE h.std_enroll_head_id = '$class_id'")->queryAll();

        $countStdData = count($studentData);

        $getCriteriaId = Yii::$app->db->createCommand("SELECT c.exam_category_id,c.exam_type,c.exam_criteria_id, s.passing_marks FROM exams_criteria as c
        	INNER JOIN exams_schedule as s 
        	ON c.exam_criteria_id = s.exam_criteria_id
        	WHERE c.std_enroll_head_id = '$class_id' AND c.exam_status = 'conducted' OR c.exam_status = 'Result Prepared' AND s.subject_id = '$sub_id'")->queryAll();
        $catIDD = $getCriteriaId[0]['exam_category_id'];
        $examCatName = Yii::$app->db->createCommand("SELECT category_name
		FROM exams_category
		WHERE exam_category_id = '$catIDD' 
					")->queryAll();

        if (empty($getCriteriaId)) {
        	echo "No Result prepared yet...!!!";
        }
        else{
        	$examCriteriaId = $getCriteriaId[0]['exam_criteria_id'];
        	$passingMarks = $getCriteriaId[0]['passing_marks'];

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
			<div class="box box-default">
				<div class="box-header">
					<h2 style="text-align: center;font-family: georgia;"><?php echo $examCatName[0]['category_name']; ?></h2>
					<h4 style="text-align: center;">View Marks Sheet <b>(<?php echo $getCriteriaId[0]['exam_type']; ?>)</b></h4><hr>
					<div class="row">
						<div class="col-md-4" style="text-align: center;border-right:1px solid;">
							<label>Class Name</label>
							<p><?php echo $CLASSName[0]['std_enroll_head_name']; ?></p>
						</div>
						<div class="col-md-4" style="text-align: center;border-right:1px solid;">
							<label>Subject Name</label>
							<p><?php echo $subjectsName[0]['subject_name'];  ?></p>
						</div>
						<div class="col-md-4" style="text-align: center;border-right:1px solid;">
							<label>Teacher Name</label>
							<p><?php echo $empName[0]['emp_name']; ?></p>
						</div>
					</div>
				</div><hr>
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Sr.#</th>
								<th>Roll.#</th>
								<th>Student</th>
								<th>Marks</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							for ($i=0; $i <$countStdData ; $i++) { 
								$stdId = $studentData[$i]['std_enroll_detail_std_id'];
								 $studentMarks = Yii::$app->db->createCommand("SELECT d.obtained_marks
						        FROM marks_head as h
								INNER JOIN marks_details as d
								ON h.marks_head_id = d.marks_head_id
						        WHERE h.exam_criteria_id = '$examCriteriaId' AND std_id = '$stdId' AND d.subject_id = '$sub_id'")->queryAll();


							?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<td>
									<?php echo $studentData[$i]['std_roll_no']; ?>	
								</td>
								<td>
									<?php echo $studentData[$i]['std_enroll_detail_std_name']; ?>	
								</td>
								<td><?php 
								if($studentMarks[0]['obtained_marks'] < $passingMarks || $studentMarks[0]['obtained_marks'] == 'A' ){
									echo "<span class='label label-warning'>".$studentMarks[0]['obtained_marks']."</span>";
								} else {
									echo $studentMarks[0]['obtained_marks']; 
								}
								?></td>
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

	} // end of else

} // end of isset


 ?>