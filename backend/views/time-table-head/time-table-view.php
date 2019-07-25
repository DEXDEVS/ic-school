<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<form method="post" action="time-table-view">
		<div class="row">
			<div class="col-md-12">
				<h2 class="well well-sm">View Time Table</h2>
				<button class="btn btn-success" name="class-wise" type="submit">
					<i class="glyphicon glyphicon-search"></i> Search Class Wise
				</button>
				<button class="btn btn-primary" name="teacher-wise" type="submit">
					<i class="glyphicon glyphicon-search"></i> Search Teacher Wise
				</button>
			</div>
		</div>
	</form>
</div><br>
</body>
</html>
<?php 

if(isset($_POST['class-wise'])) { ?> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-default">
						<div class="box-header">
							<h3 class="well well-sm" style="text-align:center;font-family:verdana;">View Class Wise Time Table</h3>
							<?php 
									$classHeadIds = Yii::$app->db->createCommand("SELECT DISTINCT(class_id) FROM time_table_head ")->queryAll();

									if (!empty($classHeadIds)) {?>
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
									$countClassHeadIds = count($classHeadIds);
									for ($i=0; $i <$countClassHeadIds ; $i++) { 
										$classHeadID = $classHeadIds[$i]['class_id'];
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
									<?php
									 } // closing of for loop
									?>
								</tbody>
							</table>
							<?php } // closing of if 
							else { ?>
								<div class="row info">
									<div class="col-md-12">
										<h2 style="text-align:center;">No Schedule yet....!!!</h2>
									</div>
								</div>
							<?php } // closing of else ?>
							<!-- end of table tag -->
						</div>
					</div>
					<!-- end of box -->
				</div>
			</div>
		</div>
		<!-- end of container fluid -->

<?php	} // closing of class-wise if issset?>
<?php 

if(isset($_POST['teacher-wise'])) { ?> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-default">
						<div class="box-header">
							<h3 class="well well-sm" style="text-align:center;font-family:verdana;">View Teacher Wise Time Table</h3>
							<?php 
									$teacherHeadData = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_id,tsah.teacher_subject_assign_head_name FROM teacher_subject_assign_head as tsah")->queryAll();
									//print_r($teacherHeadData);
									$countTeacherHeadData = count($teacherHeadData);

									if (!empty($teacherHeadData)) {?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Sr.#</th>
										<th>Teacher Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// $countClassHeadIds = count($classHeadIds);
									for ($i=0; $i <$countTeacherHeadData ; $i++) { 
										$teacherHeadName = $teacherHeadData[$i]['teacher_subject_assign_head_name'];
										$teacherHeadId = $teacherHeadData[$i]['teacher_subject_assign_head_id'];
									 ?>
									<tr>
										<td><?php echo $i+1; ?></td>
										<td><?php echo $teacherHeadName;  ?></td>
										<td>
											<a href="class-time-table?teacherHeadId=<?php echo $teacherHeadId; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i> View</a>
											<!-- <a href="class-time-table?classHeadID=<?php //echo $classHeadID; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Update</a> -->
										</td>
									</tr>
									<?php
									 } // closing of for loop
									?>
								</tbody>
							</table>
							<?php } // closing of if 
							else { ?>
								<div class="row info">
									<div class="col-md-12">
										<h2 style="text-align:center;">No Schedule yet....!!!</h2>
									</div>
								</div>
							<?php } // closing of else ?>
							<!-- end of table tag -->
						</div>
					</div>
					<!-- end of box -->
				</div>
			</div>
		</div>
		<!-- end of container fluid -->

<?php	} // closing of teacher-wise if issset?>