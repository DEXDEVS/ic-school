<?php 
	$branch_id = Yii::$app->user->identity->branch_id;
	$user_cnic = Yii::$app->user->identity->username;

	$empId = Yii::$app->db->createCommand("SELECT emp.emp_id FROM emp_info as emp WHERE emp.emp_cnic = '$user_cnic'")->queryAll();
    $empId = $empId[0]['emp_id'];

    $teacherId = Yii::$app->db->createCommand("SELECT teacher_subject_assign_head_id FROM teacher_subject_assign_head WHERE teacher_id = '$empId'")->queryAll();

    if(empty($teacherId)){
            Yii::$app->session->setFlash('warning',"Sorry. No class assigned to you..!");
    } else {
        $teacherHeadId = $teacherId[0]['teacher_subject_assign_head_id'];

        $classIds = Yii::$app->db->createCommand("SELECT DISTINCT d.class_id FROM teacher_subject_assign_detail as d WHERE d.teacher_subject_assign_detail_head_id = '$teacherHeadId' AND d.incharge = 1")->queryAll();
        $countClassIds = count($classIds); 
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
					<h3 class="well well-sm">Class Time Table</h3>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Sr.#</th>
								<th>Class</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for ($i=0; $i <$countClassIds ; $i++) { 
								$classHeadID = $classIds[$i]['class_id'];
								$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID ' ")->queryAll();
							 ?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<td><?php echo $classHeadName[0]['std_enroll_head_name'];  ?></td>
								<td>
									<a href="class-time-table?classHeadID=<?php echo $classHeadID; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i> View</a>
									<!-- <a href="class-time-table?classHeadID=<?php echo $classHeadID; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Update</a> -->
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<!-- end of table tag -->
				</div>
			</div>
			<!-- end of box -->
		</div>
	</div>
</div>
<!-- end of container fluid -->
<?php } ?>
</body>
</html>