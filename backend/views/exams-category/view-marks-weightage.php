<?php 

	$examCateogryId = $_GET['id'];
	// getting class ids againts exam categories...
	$classIds = Yii::$app->db->createCommand("SELECT DISTINCT (class_id)
	FROM marks_weightage_head WHERE exam_category_id = '$examCateogryId'")->queryAll();
	$countClassIds = count($classIds);

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
      <li><a class="btn btn-primary btn-xs" href="exams-category-view?id=<?php echo $examCateogryId; ?>"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
	<!-- back button close -->
	<div class="well well-sm" style="border-left:2px solid;border-radius:10px;">
			<h4 style="font-weight:bolder;"><i class="glyphicon glyphicon-hand-right"></i> Marks Weightage View</h4>
	</div>
	<div class="row">
		<?php
			for ($i=0; $i <$countClassIds ; $i++) { 
				$class_ID = $classIds[$i]['class_id'];

				$className = Yii::$app->db->createCommand("SELECT class_name
				FROM std_class_name WHERE class_name_id = '$class_ID'")->queryAll();

				$subjects = Yii::$app->db->createCommand("SELECT mwh.subjects_id
				FROM marks_weightage_head as mwh
				WHERE mwh.exam_category_id = '$examCateogryId'
				AND mwh.class_id = '$class_ID'")->queryAll();
				$countSubjects = count($subjects);
		?>
		<div class="col-md-4">
			<div class="box box-default collapsed-box" style=" border-left:2px solid;">
                    <div class="box-header" style="background-color:#3d6ea0;padding: 15px;">
                        <h3 class="box-title">
                            <b style="color:white;">
                            <?php echo $className[0]['class_name']; ?>
                            </b>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">  <br><i class="fa fa-plus" style="font-size:15px;color:white;"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
						<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<?php 
									for ($j=0; $j <$countSubjects ; $j++) {
										$subjectID = $subjects[$j]['subjects_id'];
										$subjectName = Yii::$app->db->createCommand("SELECT subject_name
										FROM subjects WHERE subject_id = '$subjectID'")->queryAll();
										$marksWeightageDetails = Yii::$app->db->createCommand("SELECT mwd.weightage_type_id,mwd.marks
										FROM marks_weightage_details as mwd
										INNER JOIN marks_weightage_head as mwh
										ON mwh.marks_weightage_id = mwd.weightage_head_id
										WHERE mwh.exam_category_id = '$examCateogryId'
										AND mwh.class_id = '$class_ID'
										AND mwh.subjects_id = '$subjectID'")->queryAll();
										$countmarksWeightageDetails = count($marksWeightageDetails);

								?>
								
									<tr class="info">
									<th colspan="2" style="text-align:center;"><?php echo $subjectName[0]['subject_name']; ?></th>
									<tr style="background-color:#F5F5F5;font-weight:bolder;">
										<td>Weightage Type</td>
										<td>Marks</td>
									</tr>
								</tr>
								<tr>
									<?php
										for ($k=0; $k <$countmarksWeightageDetails ; $k++) {
											$WeightageTypeId = $marksWeightageDetails[$k]['weightage_type_id'];
											$weightageTypeName = Yii::$app->db->createCommand("SELECT weightage_type_name
										FROM marks_weightage_type WHERE weightage_type_id = '$WeightageTypeId'")->queryAll();
									?>
									<tr>
										<td><?php echo $weightageTypeName[0]['weightage_type_name']; ?></td>
										<td><?php echo $marksWeightageDetails[$k]['marks'];?></td>
									</tr>
									<?php } ?>
								</tr>
								
								
								<?php } ?>
							</thead>
						</table>
					</div>
                    </div>
                    <!-- /.box-body -->
                </div>
              <!-- /.box -->
		</div>
		<?php } ?>
	</div>
</div>
</body>
</html>