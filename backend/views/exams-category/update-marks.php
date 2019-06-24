<?php

	if(isset($_GET['examCatID']))
	{
		$examCatID 		= $_GET['examCatID'];
		$classID 		= $_GET['classID'];
		$classHeadID 		= $_GET['classHeadID'];
		$stdID 			= $_GET['stdID'];
		$examType 		= $_GET['examType'];
		$classHeadID 	= $_GET['classHeadID'];

		$CatName= Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCatID'")->queryAll();

		$ClassName = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classHeadID'")->queryAll();

		$StdName = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info WHERE std_id = '$stdID'")->queryAll();

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="./view-marks-sheet">
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
			<div class="box-body">
				<form method="POST" action="view-marks-sheet">
					<div class="row">
			            <div class="col-md-4">
			                <div class="form-group">
			                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
			                </div>    
			            </div>    
			        </div>
					<div class="row">
						<?php 
						$subjectArray = array();
						$marksDetailIdArray = array();
						$criteria = Yii::$app->db->createCommand("SELECT c.exam_criteria_id 
						FROM exams_criteria as c 
						WHERE c.class_id = '$classID '
						AND c.exam_category_id = '$examCatID'
						AND c.exam_type = '$examType'
						")->queryAll();
						
						$criteriaId = $criteria[0]['exam_criteria_id'];

						// $marks = Yii::$app->db->createCommand("SELECT mdw.obtained_marks
						// 		FROM ((marks_head as mh 
						// 		INNER JOIN marks_details as md
						// 		ON mh.marks_head_id = md.marks_head_id)
						// 		INNER JOIN marks_details_weightage as mdw
						// 		ON md.marks_detail_id = mdw.marks_details_id)
						// 		WHERE mh.class_head_id = '$headId'
						// 		AND md.subject_id = '$subId'")->queryAll();
						
					if(empty($marks)){
						Yii::$app->session->setFlash('warning',"Nothing to update..!");
					} else {
						$countMarks = count($marks);
						 for ($i=0; $i <$countMarks ; $i++) { 
						 	$subjectID = $marks[$i]['subject_id'];
						 	$subjectArray[$i] = $subjectID;
						 	$marksDetailIdArray[$i] = $marks[$i]['marks_detail_id'];

						 	$subName = Yii::$app->db->createCommand("SELECT subject_name FROM subjects WHERE subject_id = '$subjectID'")->queryAll();
						 ?>
						<div class="col-md-3">
							<div class="form-group">
								<label><?php echo $subName[0]['subject_name']; ?></label>
								<input type="text" name="marks_<?php echo $i+1;?>" class="form-control" value="<?php echo $marks[$i]['obtained_marks']; ?>" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13 || event.charCode == 65 || event.charCode == 46) ? null : event.charCode >= 48 && event.charCode <= 57">
							</div>
						</div>
						<?php } ?>
					</div>
					<?php foreach ($subjectArray as $value) {
			        		echo '<input type="hidden" name="subjectArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        <?php foreach ($marksDetailIdArray as $value) {
			        		echo '<input type="hidden" name="marksDetailIdArray[]" value="'.$value.'" style="width: 30px">';
			        	}
			        	?>
			        <input type="hidden" name="countMarks" value="<?php echo $countMarks;?>" style="width: 30px">
			        <input type="hidden" name="classHeadId" value="<?php echo $classHeadID;?>" style="width: 30px">
					<button style="float: right;s" type="submit" name="update" class="btn btn-success btn-flat btn-xs">
					<i class="fa fa-sign-in"></i> <b>Update Marks</b>
					</button>
					<?php //end of else
					} ?>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } //if isset

?>


