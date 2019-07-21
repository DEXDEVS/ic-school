<?php 

	$examCateogryId = $_GET['id'];
	echo $examCateogryId;
	$examCatName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCateogryId'")->queryAll();
	

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<!-- back button start -->
	 <ol class="breadcrumb">
      <li><a class="btn btn-primary btn-xs" href="exams-category"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
	<!-- back button close -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
				<div class="box-header">
					<div class="well well-sm" style="border-left:2px solid;border-right:2px solid;font-weight:bolder;font-size:20px;text-align:center;"><?php echo $examCatName[0]["category_name"]; ?>
					</div>
				</div>
				<div class="box-body">
					<a href="./view-marks-weightage?id=<?php echo $examCateogryId; ?>">
						<button class="btn btn-primary btn-block">View Marks Weightage</button>
					</a><br>
					<a href="./exam-lists?id=<?php echo $examCateogryId; ?>">
						<button class="btn btn-primary btn-block">View Schedules</button>
					</a><br>
					<a href="./emp-exam-attendance?id=<?php echo $examCateogryId; ?>">
						<button class="btn btn-primary btn-block">Invigilators Attendance</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>