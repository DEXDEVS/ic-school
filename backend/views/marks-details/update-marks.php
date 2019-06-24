<?php

	if(isset($_GET['examCatID']))
	{
		$examCatID 		= $_GET['examCatID'];
		$criteriaId 	= $_GET['criteriaId'];
		$classID 		= $_GET['classID'];
		$stdID 			= $_GET['stdID'];
		$examType 		= $_GET['examType'];
		$classHeadID 	= $_GET['classHeadID'];
		$startYear 		= $_GET['startYear'];
		$endYear 		= $_GET['endYear'];


		$CatName= Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCatID'")->queryAll();

		$ClassName = Yii::$app->db->createCommand("SELECT std_enroll_head_name, class_name_id FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID'")->queryAll();

		$StdName = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$stdID'")->queryAll();
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="./view-marks-sheet?exam_category=<?php echo $examCatID;?>&class_id=<?php echo $classID;?>&headID=<?php echo $classHeadID;?>&exam_type=<?php echo $examType;?>&startYear=<?php echo $startYear; ?>&endYear=<?php echo $endYear; ?>">
				<button style="float: right;" class="btn btn-danger btn-xs">
				<i class="glyphicon glyphicon-backward"></i> <b>Back</b>
				</button>
			</a>
		</div>
	</div>
	<div class="row" style="text-align: center;">
		<div class="box box-default">
			<div class="box-header">
				<p>Update Student:<?php echo $StdName[0]['std_name'];?></p><hr>
				<div class="col-md-4">
					<h3>Category Name</h3>
					<p><?php echo $CatName[0]['category_name']; ?></p>
				</div>
				<div class="col-md-4">
					<h3>Class Name</h3>
					<p><?php echo $ClassName[0]['std_enroll_head_name']; ?></p>
				</div>
				<div class="col-md-4">
					<h3>Student Name</h3>
					<p><?php echo $StdName[0]['std_name']; ?></p>
				</div>
			</div><hr>
		</div>
		<form method="POST" action="./view-marks-sheet?exam_category=<?php echo $examCatID;?>&class_id=<?php echo $classID;?>&headID=<?php echo $classHeadID;?>&exam_type=<?php echo $examType;?>&startYear=<?php echo $startYear; ?>&endYear=<?php echo $endYear; ?>">
			<div class="row">
				<div class="col-md-12">
					<button style="float:right;" name="update" type="submit" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-save"></i> update marks sheet</button>
				</div>
			</div>
					<div class="row">
			            <div class="col-md-4">
			                <div class="form-group">
			                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
			                </div>    
			            </div>    
			        </div>
					<div class="row">
						<?php 

						$subjectsIDs = Yii::$app->db->createCommand("SELECT md.subject_id,md.marks_detail_id,mh.marks_head_id
				        FROM marks_head as mh
				        INNER JOIN marks_details as md 
				        ON mh.marks_head_id = md.marks_head_id
				        WHERE mh.class_head_id = '$classHeadID'
				        AND mh.std_id = '$stdID'")->queryAll();
				        $countSubjectIds = count($subjectsIDs);
				        //print_r($countSubjectIds);

				        for ($i=0; $i <$countSubjectIds ; $i++) { 

				        $subjectID = $subjectsIDs[$i]['subject_id'];

				        $subjectName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID'")->queryAll();
				        $marksDetailID[$i] = $subjectsIDs[$i]['marks_detail_id'];

				        $marksWeightageDetails = Yii::$app->db->createCommand("SELECT weightage_type_id,obtained_marks FROM marks_details_weightage WHERE marks_details_id = '$marksDetailID[$i]'")->queryAll();
				        $countmarksWeightageDetails = count($marksWeightageDetails);
						 ?>
						<div class="col-md-4">
							<div class="box box-danger collapsed-box">
								<div class="box-header" style="padding:15px;">
									<h3 class="box-title">
										<b>
											<?php echo $subjectName[0]['subject_name']; ?>
										</b>
									</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse">  <br><i class="fa fa-plus" style="font-size:15px;padding:px; color:#605CA8;"></i>
                            			</button>
									</div>
								</div>
								<div class="box-body">
								<?php 
								for ($j=0; $j <$countmarksWeightageDetails ; $j++) { 
									$weightageTypeId[$i][$j] = $marksWeightageDetails[$j]['weightage_type_id'];
									$weightageId = $weightageTypeId[$i][$j];
									$weightageTypeName = Yii::$app->db->createCommand("SELECT weightage_type_name FROM marks_weightage_type WHERE weightage_type_id = '$weightageId'")->queryAll();

									$classNameId = $ClassName[0]['class_name_id'];
									
									$weightageMarks = Yii::$app->db->createCommand("SELECT d.marks 
										FROM marks_weightage_details as d 
										INNER JOIN marks_weightage_head as h
										ON h.marks_weightage_id = d.weightage_head_id
										WHERE h.exam_category_id = '$examCatID'
										AND h.class_id = '$classNameId'
										AND h.subjects_id = '$subjectID'
										AND d.weightage_type_id = '$weightageId'")->queryAll();
								 ?>
								 <div class="form-group">
								 	<label>
								 		<?php echo $weightageTypeName[0]['weightage_type_name']." (".$weightageMarks[0]['marks'].")"; ?>
								 	</label>
								 	<input class="form-control" type="text" name="marks[<?php echo $i; ?>][<?php echo $j; ?>]" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57" id="marks<?php echo $j+1;?><?php echo $i+1;?>" value="<?php echo $marksWeightageDetails[$j]['obtained_marks'];?>">
								 </div>
								<?php } ?>
								</div>
							</div>
						</div>
						<?php } 
						?>
					</div>
					<?php 
					foreach ($marksDetailID as $key => $value) { 
						?>
						<input type="hidden" name="marksDetailID[]" value="<?php echo $value; ?>">
					<?php } ?>
					<?php 
						foreach ($weightageTypeId as $j => $value) {
							foreach ($value as $k => $val) { ?>
							 	<input type="hidden" name="weightageTypeId[<?php echo $j; ?>][<?php echo $k; ?>]" value="<?php echo $val; ?>">
						<?php } 
						} ?>				

				</form>
	</div>
</div>
<?php } //if isset

?>


