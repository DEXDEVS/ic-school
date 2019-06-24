<?php 
	$examCateogryId = $_GET['id'];

	$currentYear = date('Y');

	//getting scheduled classes
	$inactiveSchedules = Yii::$app->db->createCommand("SELECT class_id, exam_type, YEAR(exam_start_date), YEAR(exam_end_date) FROM exams_criteria WHERE exam_category_id = 5 AND exam_status = 'Inactive' AND ( YEAR(exam_start_date) = $currentYear OR YEAR(exam_end_date) = $currentYear )
					")->queryAll();
	$countinactiveSchedules = count($inactiveSchedules);

	$announcedSchedules = Yii::$app->db->createCommand("SELECT class_id, exam_type, YEAR(exam_start_date), YEAR(exam_end_date) FROM exams_criteria WHERE exam_category_id = 5 AND exam_status = 'Announced' AND ( YEAR(exam_start_date) = $currentYear OR YEAR(exam_end_date) = $currentYear )
					")->queryAll();
	$countannouncedSchedules = count($announcedSchedules);

	$conductedSchedules = Yii::$app->db->createCommand("SELECT class_id, exam_type, YEAR(exam_start_date), YEAR(exam_end_date) FROM exams_criteria WHERE exam_category_id = 5 AND exam_status = 'Conducted' AND ( YEAR(exam_start_date) = $currentYear OR YEAR(exam_end_date) = $currentYear )
					")->queryAll();
	$countconductedSchedules = count($conductedSchedules);

	$ResultPrepareSchedules = Yii::$app->db->createCommand("SELECT class_id, exam_type, YEAR(exam_start_date), YEAR(exam_end_date) FROM exams_criteria WHERE exam_category_id = 5 AND exam_status = 'Result Prepared' AND ( YEAR(exam_start_date) = $currentYear OR YEAR(exam_end_date) = $currentYear )
					")->queryAll();
	$countResultPrepareSchedules = count($ResultPrepareSchedules);

	$ResultAnnouncedSchedules = Yii::$app->db->createCommand("SELECT class_id, exam_type, YEAR(exam_start_date), YEAR(exam_end_date) FROM exams_criteria WHERE exam_category_id = 5 AND exam_status = 'Result Announced' AND ( YEAR(exam_start_date) = $currentYear OR YEAR(exam_end_date) = $currentYear )
					")->queryAll();
	$countResultAnnouncedSchedules = count($ResultAnnouncedSchedules);

	// getting exam `category_name` from `exams_cateogry`
	$examCategoryName = Yii::$app->db->createCommand("SELECT category_name FROM exams_category WHERE exam_category_id = '$examCateogryId'
					")->queryAll();
	// getting class IDs `class_id` from `exams_criteria` against `exam_category_id`
	$classIds = Yii::$app->db->createCommand("SELECT DISTINCT (class_id) FROM exams_criteria WHERE exam_category_id = '$examCateogryId'
					")->queryAll();

	$countClassIds = count($classIds);
	$examCriteria = Yii::$app->db->createCommand("SELECT * FROM exams_criteria WHERE exam_category_id = '$examCateogryId'
					")->queryAll();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<!-- container fluid div start -->
	<div class="container-fluid">

		<!-- back button start -->
		<ol class="breadcrumb">
	    	<li><a class="btn btn-primary btn-xs" href="exams-category-view?id=<?php echo $examCateogryId; ?>"><i class="fa fa-backward"></i> Back</a></li>
	    </ol>
		<!-- back button close -->

		<!-- heading div start -->
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm" style="padding:0px; border-left:2px solid;border-right:2px solid;">
						<h3 style="text-align: center;font-family: georgia;font-size:30px;">
							<?php echo $examCategoryName[0]['category_name']; ?>(<?php echo date('Y'); ?>)
						</h3>
						<p style="text-align: center;font-weight: bolder;">All Schedules</p>
				</div>
			</div>
		</div>
		<!-- heading div close -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
					<div class="box-body">
						<div class="nav-tabs-custom">
				            <ul class="nav nav-tabs">
					            <li class="active">
					              	<a href="#inactive" data-toggle="tab">Inactive
					              		<span class="badge" style="background-color:#c15d5d;">
					              			<?php echo $countinactiveSchedules; ?>
					              		</span>
					              	</a>
					            </li>
					            <li>
					              	<a href="#announced" data-toggle="tab">Announced
					              		<span class="badge" style="background-color:green;">
					              			<?php echo $countannouncedSchedules; ?>
					              		</span>
					              	</a>
					            </li>
					            <li>
					              	<a href="#conducted" data-toggle="tab">Conducted
										<span class="badge" style="background-color:#4997e5;">
					              			<?php echo $countconductedSchedules; ?>
					              		</span>
					              	</a>
					            </li>
					            <li>
					              	<a href="#prepare" data-toggle="tab">Prepared Results
											<span class="badge" style="background-color:purple;">
					              			<?php echo $countResultPrepareSchedules; ?>
					              		</span>
					              	</a>
					            </li>
					            <li>
					              	<a href="#result" data-toggle="tab">Announced Results
										<span class="badge" style="background-color:seagreen;">
					              			<?php echo $countResultAnnouncedSchedules; ?>
					              		</span>
					              	</a>
					            </li>
				            </ul>
				            <div class="tab-content">
				            	<!-- inactive pan start here -->
					            <div class="active tab-pane" id="inactive">
					                <div class="row">
					                	<div class="col-md-6">
					                		<p><i class="fa fa-info-circle"></i> Inactive Schedule Information</p>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-md-12">
					                		<?php 
					                      	if ($countinactiveSchedules == 0) {
					                          	  	?>

													<p style="text-align: center;font-weight:bold;">No Schedule available yet...!!!!</p>
					                          	  	<?php
					                          	  }else{
					                      	 ?>
					                        <table class="table table-striped table-hover table-responsive">
						                        <thead>
						                            <tr>
						                              <th>Sr.#</th>
						                              <th>Class</th>
						                              <th>Exam Type</th>
						                              <th>Action</th>
						                          	</tr>
						                        </thead>
					                            <tbody>
						                          	<?php
						                          	for ($i=0; $i <$countinactiveSchedules ; $i++) { 
						                          		//getting class names
						                          		$classId = $inactiveSchedules[$i]['class_id'];
						                          		$examType = $inactiveSchedules[$i]['exam_type'];
						                          		$startYear = $inactiveSchedules[$i]['YEAR(exam_start_date)'];
						                          		$endYear = $inactiveSchedules[$i]['YEAR(exam_end_date)'];

						                          		$className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
															")->queryAll();
						                          	?>
					                          	<tr>
					                          		<td><?php echo $i+1; ?></td>
					                          		<td><?php echo $className[0]['class_name']; ?></td>
					                          		<td><?php $className[0]['class_name']." ";
					                          			if($examType == "Supply"){
					                          				echo "<span class='label label-primary'>".$examType."</span>";
					                          			} else {
					                          				echo "<span class='label label-success'>".$examType."</span>";
					                          			}
					                          		?>
					                          		</td>
					                          		<td>
					                          			<div class="dropdown">
														    <button style="background-color:#4997E5;" class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Choose Action
														    <span class="caret"></span></button>
														    <ul class="dropdown-menu">
														      	<li>
														      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-sections?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Sections</a>
														      	</li>
														      	<li>
														      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Date Sheet</a>
														      	</li>
														      	<li>
														      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./update-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-edit"></i> 
																	Update Date Sheet
																	</a>
														      	</li>
														    </ul>
														</div>
					                          		</td>
					                          	</tr>
					                          	<?php } } ?>
					                            </tbody>
					                        </table>
					                	</div>
					                </div>
					            </div>
					            <!-- inactive pan close here -->

					            <!-- announced pan start here -->
					            <div class="tab-pane" id="announced">
					              	<div class="row">
					                	<div class="col-md-6">
					                		<p><i class="fa fa-info-circle"></i> Announced Schedule Information</p>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-md-12">
					                		<?php  if ($countannouncedSchedules == 0) { ?>
	 										<p style="text-align: center;font-weight:bold;">No Schedule available yet...!!!!</p>
							                <?php }else{ ?>
					                        <table class="table table-striped table-hover table-responsive">
						                        <thead>
						                            <tr>
						                              	<th>Sr.#</th>
						                              	<th>Class</th>
						                              	<th>Exam Type</th>
						                              	<th>Action</th>
						                          	</tr>
						                        </thead>
					                            <tbody>
						                          	<?php for ($i=0; $i <$countannouncedSchedules ; $i++) { 
						                          		$classId = $announcedSchedules[$i]['class_id'];
						                          		$examType = $announcedSchedules[$i]['exam_type'];
						                          		$startYear = $announcedSchedules[$i]['YEAR(exam_start_date)'];
						                          		$endYear = $announcedSchedules[$i]['YEAR(exam_end_date)'];
						                          		
						                          		$className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'")->queryAll(); ?>
						                          	<tr>
						                          		<td><?php echo $i+1; ?></td>
						                          		<td><?php echo $className[0]['class_name']; ?></td>
						                          		<td>
						                          		<?php $className[0]['class_name']." ";
						                          		if($examType == "Supply"){
					                          				echo "<span class='label label-primary'>".$examType."</span>";
					                          			} else {
					                          				echo "<span class='label label-success'>".$examType."</span>";
					                          			} ?>
						                          		</td>
						                          		<td>
						                          			<div class="dropdown">
															    <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Choose Action
															    <span class="caret"></span></button>
															    <ul class="dropdown-menu">
															    	<li>
														      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-sections?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Sections</a>
														      	</li>
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Date Sheet</a>
															      	</li>
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./update-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-edit"></i> 
																		Update Date Sheet
																	</a>
															      </li>
															    </ul>
															</div>
						                          		</td>
						                          	</tr>
						                          	<?php } } ?>
					                            </tbody>
					                        </table>
					                	</div>
					                </div>
					            </div>
					            <!-- announced pan close here -->

					            <!-- conducted pan start here -->
					            <div class="tab-pane" id="conducted">
					              	<div class="row">
					                	<div class="col-md-6">
					                		<p><i class="fa fa-info-circle"></i> Conducted Schedule Information</p>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-md-12">
					                		<?php if ($countconductedSchedules == 0) { ?>
											<p style="text-align: center;font-weight:bold;">No Schedule available yet...!!!!</p>
						                    <?php }else{ ?>
					                        <table class="table table-striped table-hover table-responsive">
						                        <thead>
						                            <tr>
						                              	<th>Sr.#</th>
						                              	<th>Class</th>
						                              	<th>Exam Type</th>
						                              	<th>Action</th>
						                          	</tr>
						                        </thead>
					                            <tbody>
						                          	<?php for ($i=0; $i <$countconductedSchedules ; $i++) { 
						                          		$classId = $conductedSchedules[$i]['class_id'];
						                          		$examType = $conductedSchedules[$i]['exam_type'];
						                          		$startYear = $conductedSchedules[$i]['YEAR(exam_start_date)'];
						                          		$endYear = $conductedSchedules[$i]['YEAR(exam_end_date)'];
						                          		
						                          		$className = Yii::$app->db->createCommand("
														SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
															")->queryAll();	?>
						                          	<tr>
						                          		<td><?php echo $i+1; ?></td>
						                          		<td><?php echo $className[0]['class_name']; ?></td>
						                          		<td><?php $className[0]['class_name']." "; 
							                          		if($examType == "Supply"){
						                          				echo "<span class='label label-primary'>".$examType."</span>";
						                          			} else {
						                          				echo "<span class='label label-success'>".$examType."</span>";
						                          			} ?>
					                          			</td>
						                          		<td>
						                          			<div class="dropdown">
															    <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Choose Action
															    <span class="caret"></span></button>
															    <ul class="dropdown-menu">
															    	<li>
														      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-sections?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Sections</a>
														      	</li>
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Date Sheet</a>
															      	</li>
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./class-sections-marks-lists?exam_category=<?php echo $examCateogryId;?>&class_id=<?php echo $classId;?>&exam_type=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Marks Sheet</a>
															      	</li>
															    </ul>
															 </div>
						                          		</td>
						                          	</tr>
						                          	<?php } } ?>
					                            </tbody>
					                        </table>
					                	</div>
					                </div>
					            </div>
					            <!-- conducted pan close here -->

					            <!-- prepare result pan start here -->
					            <div class="tab-pane" id="prepare">
					              	<div class="row">
					                	<div class="col-md-6">
					                		<p><i class="fa fa-info-circle"></i> Prepared Result Information</p>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-md-12">
					                		<?php if ($countResultPrepareSchedules == 0) { ?>
											<p style="text-align: center;font-weight:bold;">No Schedule available yet...!!!!</p>
					                        <?php }else{ ?>
					                      	<form method="POST">
					                        <table class="table table-striped table-hover table-responsive">
						                        <thead>
						                            <tr>
						                              	<th>Sr.#</th>
						                              	<th>Class</th>
						                              	<th>Exam Type</th>
						                              	<th>Action</th>
						                          	</tr>
						                        </thead>
					                            <tbody>
						                          	<?php for ($i=0; $i <$countResultPrepareSchedules ; $i++) { 
						                          		$classId = $ResultPrepareSchedules[$i]['class_id'];
						                          		$examType = $ResultPrepareSchedules[$i]['exam_type'];
						                          		$startYear = $ResultPrepareSchedules[$i]['YEAR(exam_start_date)'];
						                          		$endYear = $ResultPrepareSchedules[$i]['YEAR(exam_end_date)'];
						                          		
						                          		$className = Yii::$app->db->createCommand("
														SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
															")->queryAll();	?>
						                          	<tr>
						                          		<td><?php echo $i+1; ?></td>
						                          		<td><?php echo $className[0]['class_name'];?></td>
					                          			<td><?php $className[0]['class_name']." "; 
							                          		if($examType == "Supply"){
						                          				echo "<span class='label label-primary'>".$examType."</span>";
						                          			} else {
						                          				echo "<span class='label label-success'>".$examType."</span>";
						                          			}?>
						                          		</td>
						                          		<td>
						                          			<div class="dropdown">
															    <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Choose Action
															    <span class="caret"></span></button>
															    <ul class="dropdown-menu">
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Date Sheet</a>
															      	</li>
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-result-cards?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-edit"></i> 
																		Update Date Sheet
																		</a>
															      	</li>
															      	<li>
															      		<button class="btn btn-success btn-xs" name="result_announced"><i class="fa fa-eye"></i> Announce Result</button>
															      	</li>
															    </ul>
															</div>

															<!-- <a class="btn btn-info btn-xs" href="./update-datesheet?examcatID=<?php //echo $examCateogryId;?>&classID=<?php //echo $classId;?>""><i class="fa fa-edit"></i> 
																	Update Date Sheet
																	</a> -->
															<input type="hidden" name="_csrf" value="<?php Yii::$app->request->getCsrfToken() ?>">
									                        <input type="hidden" name="cat_id" value="<?php echo $examCateogryId; ?>">
									                        <input type="hidden" name="class_id" value="<?php echo $classId; ?>">
									                        <input type="hidden" name="examType" value="<?php echo $examType; ?>">
						                          		</td>
						                          	</tr>
						                          	<?php } } ?>
					                            </tbody>
					                        </table>
					                    	</form>
					                	</div>
					                </div>
					            </div>
					            <!-- prepare result pan close here -->

					            <!-- result announce pan start here -->
					            <div class="tab-pane" id="result">
					              	<div class="row">
					                	<div class="col-md-6">
					                		<p><i class="fa fa-info-circle"></i> Announced Result Information</p>
					                	</div>
					                </div>
					                <div class="row">
					                	<div class="col-md-12">
					                		<?php if ($countResultAnnouncedSchedules == 0) { ?>
											<p style="text-align: center;font-weight:bold;">No Schedule available yet...!!!!</p>
					                        <?php }else{ ?>
					                        <table class="table table-striped table-hover table-responsive">
						                        <thead>
						                            <tr>
						                              	<th>Sr.#</th>
						                              	<th>Class</th>
						                              	<th>Exam Type</th>
						                              	<th>Action</th>
						                          	</tr>
						                        </thead>
					                            <tbody>
						                          	<?php for ($i=0; $i <$countResultAnnouncedSchedules ; $i++) { 
						                          		$classId = $ResultAnnouncedSchedules[$i]['class_id'];
						                          		$examType = $ResultAnnouncedSchedules[$i]['exam_type'];
						                          		$startYear = $ResultAnnouncedSchedules[$i]['YEAR(exam_start_date)'];
						                          		$endYear = $ResultAnnouncedSchedules[$i]['YEAR(exam_end_date)'];
						                          		$className = Yii::$app->db->createCommand("
														SELECT class_name FROM std_class_name WHERE class_name_id = '$classId'
															")->queryAll(); ?>
						                          	<tr>
						                          		<td><?php echo $i+1; ?></td>
						                          		<td><?php echo $className[0]['class_name'];?></td>
					                          			<td><?php $className[0]['class_name']." "; 
							                          		if($examType == "Supply"){
						                          				echo "<span class='label label-primary'>".$examType."</span>";
						                          			} else {
						                          				echo "<span class='label label-success'>".$examType."</span>";
						                          			}?>
					                          			</td>
						                          		<td>
						                          			<div class="dropdown">
															    <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Choose Action
															    <span class="caret"></span></button>
															    <ul class="dropdown-menu">
															      	<li>
															      		<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-datesheet?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Date Sheet</a>
															      	</li>
															      <!-- <li>
															      	<a style="border-bottom-left-radius:20px;border-top-right-radius:20px;" href="./view-result-cards?examcatID=<?php //echo $examCateogryId;?>&classID=<?php //echo $classId;?>&examType=<?php //echo $examType;?>"><i class="fa fa-edit"></i> 
																	Update Date Sheet
																	</a>
															      </li> -->
															      	<li>
															      		<a class="btn btn-info btn-xs" href="./view-result-cards?examcatID=<?php echo $examCateogryId;?>&classID=<?php echo $classId;?>&examType=<?php echo $examType;?>&startYear=<?php echo $startYear;?>&endYear=<?php echo $endYear;?>"><i class="fa fa-eye"></i> View Result Card</a>
															      	</li>
															    </ul>
															</div>
						                          		</td>
						                          	</tr>
						                          	<?php } } ?>
					                            </tbody>
					                        </table>
					                	</div>
					                </div>
					            </div>
					            <!-- result announce pan close here -->
				            </div>
				            <!-- /.tab-content -->
	          			</div>
	          			<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box box-default -->
			</div>
			<!-- /.col-md-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- container fluid div close -->	
<?php 
	// result announce isset
	if(isset($_POST['result_announced']))
	{
		$cat_id = $_POST['cat_id'];
		$class_id = $_POST['class_id'];
		$examType = $_POST['examType'];

		$resultAnnounced = Yii::$app->db->createCommand("
		SELECT exam_criteria_id FROM exams_criteria WHERE exam_category_id = '$cat_id' AND class_id = '$class_id' AND exam_status = 'Result Prepared' AND exam_type = '$examType'
			")->queryAll();
		if (empty($resultAnnounced)) {
			Yii::$app->session->setFlash('warning', "You can not announce result before result prepared...!");
		} else {
			$transection = Yii::$app->db->beginTransaction();
			try{
				$criteriaId = $resultAnnounced[0]['exam_criteria_id'];
				$statusUpdate = Yii::$app->db->createCommand()->update('exams_criteria', 				[
							'exam_status'			=> 'Result Announced',
							'updated_at'			=> new \yii\db\Expression('NOW()'),
							'updated_by'			=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $criteriaId, 'exam_category_id' => $cat_id, 'class_id' => $class_id, 'exam_status' => "Result Prepared",'exam_type' => $examType]
	                    )->execute();
				if($statusUpdate){
					$transection->commit();
					Yii::$app->session->setFlash('success', "Result announced successfully...!");
				}//closing of try block
			} catch(Exception $e){
				$transection->rollback();
				echo $e;
				Yii::$app->session->setFlash('warning', "Result not announced. Try again!");
			} // closing of transaction handling....
		} //closing of else
	} //if isset close

	// date sheet update isset
	if(isset($_POST['update']))
	{
		// getting exam criteria fields
		$criteriaId 		= $_POST["criteriaId"];
		$exam_category 		= $_POST["exam_category"];
		$headId 			= $_POST["headId"];
		$exam_start_date 	= $_POST["exam_start_date"];
		$exam_end_date 		= $_POST["exam_end_date"];
		$exam_status 		= $_POST["exam_status"];
		$exam_type 			= $_POST["examType"];
		// getting exam schedule fields
		$subarray 			= $_POST["subarray"];
		$date 				= $_POST["date"];
		$exam_start_time 	= $_POST["exam_start_time"];
		$exam_end_time 		= $_POST["exam_end_time"];
		// $fullmarks 		= $_POST["fullmarks"];
		// $passingmarks 	= $_POST["passingmarks"];
		$subjCount 		= $_POST["subjCount"];		
	$transection = Yii::$app->db->beginTransaction();
	try{
		$examCriteriaUpdate = Yii::$app->db->createCommand()->update('exams_criteria', [
						'exam_category_id' 		=> $exam_category,
						'class_id' 	=> $headId ,
						'exam_start_date' 		=> $exam_start_date,
						'exam_end_date'			=> $exam_end_date ,
						'exam_status'			=> $exam_status,
						'exam_type'				=> $exam_type,
						'updated_at'			=> new \yii\db\Expression('NOW()'),
						'updated_by'			=> Yii::$app->user->identity->id,
                        ],
                        ['exam_criteria_id' => $criteriaId]
                    )->execute();
		if ($examCriteriaUpdate) {
			
			for ($i=0; $i <$subjCount ; $i++) {
				$examScheduleUpdate = Yii::$app->db->createCommand()->update('exams_schedule',[
							'date'				=> $date[$i],
							'exam_start_time'		=> $exam_start_time[$i],
							'exam_end_time'			=> $exam_end_time[$i],
							'updated_at'		=> new \yii\db\Expression('NOW()'),
							'updated_by'		=> Yii::$app->user->identity->id,
	                        ],
	                        ['exam_criteria_id' => $criteriaId , 'subject_id' => $subarray[$i],]
	                    )->execute();
					
			} // closing of for loop
			if($examScheduleUpdate){
				$transection->commit();
				Yii::$app->session->setFlash('success', "Exams schedule updated successfully...!");
			}
		} // closing of exam criteria
	//closing of try block
	} catch(Exception $e){
		$transection->rollback();
		echo $e;
		Yii::$app->session->setFlash('warning', "Exam Schedule not updated. Try again!");
	} // closing of transaction handling....
}
// closing of isset
?>
</body>
</html>