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
					<h3 class="well well-sm">View Class Wise Time Table</h3>
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
							$classHeadIds = Yii::$app->db->createCommand("SELECT DISTINCT(class_id) FROM time_table_head ")->queryAll();
							$countClassHeadIds = count($classHeadIds);
							for ($i=0; $i <$countClassHeadIds ; $i++) { 
								$classHeadID = $classHeadIds[$i]['class_id'];
								$classHeadName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID ' ")->queryAll();
							 ?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<td><?php echo $classHeadName[0]['std_enroll_head_name'];  ?></td>
								<td>
									<a href="class-time-table-view?classHeadID=<?php echo $classHeadID; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i> View</a>
									<a href="" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Update</a>
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
</body>
</html>