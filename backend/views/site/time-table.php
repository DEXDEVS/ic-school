<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="box box-default">
		<div class="box-header">
			<div class="row">
				<div class="col-md-12">
					<h2 class="well well-sm">Time Table Criteria</h2>
				</div>
			</div>
			<div class="row">
				<form method="post" action="time-table">
					<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">
					<div class="col-md-4">
						<div class="form-group">
							<label>Select Class:</label>
							<select name="class_id" class="form-control">
								<option>Select Class</option>
								<?php 
								// getting classes `head name` and `head_id` from `std_enrollment_head`
								$classDetails = Yii::$app->db->createCommand("SELECT std_enroll_head_id,std_enroll_head_name FROM std_enrollment_head ")->queryAll();
								$countClassDetails = count($classDetails);
								for ($i=0; $i <$countClassDetails ; $i++) {
									$classHeadId = $classDetails[$i]['std_enroll_head_id'];
									$classHeadName = $classDetails[$i]['std_enroll_head_name'];
								 ?>
								<option value="<?php echo $classHeadId;?>"><?php echo $classHeadName;  ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label>Select Days:</label>
						<select name="days[]" class="form-control" multiple="">
							<option>Select Days</option>
							<option value="monday">Monday</option>
							<option value="tuesday">Tuesday</option>
							<option value="wednesday">Wednesday</option>
							<option value="thursday">Thursday</option>
							<option value="friday">Friday</option>
							<option value="saturday">Saturday</option>
						</select>
					</div>
					<div class="col-md-4">
						<button style="margin-top:25px;" type="submit" name="get_subjects" class="btn btn-success">Get Subjects</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 

if(isset($_POST['get_subjects'])){ 

	$classId 	= $_POST['class_id'];
	$days 		= $_POST['days'];
	$days = implode(",", $days);
	//print_r($days);

	$classNameId = Yii::$app->db->createCommand("SELECT class_name_id FROM std_enrollment_head WHERE std_enroll_head_id = '$classId' ")->queryAll();
	$classNameID = $classNameId[0]['class_name_id'];
	$className = Yii::$app->db->createCommand("SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$classId' ")->queryAll();
	$classSubjetcs = Yii::$app->db->createCommand("SELECT std_subject_id,std_subject_name FROM std_subjects WHERE class_id = '$classNameID' ")->queryAll();
	$subjects = $classSubjetcs[0]['std_subject_name'];
	$subjectArray = explode(',', $subjects);
	$subjectArrayCount = count($subjectArray);
	//echo $subjectArrayCount;

	?>
	<div class="container-fluid">
		<div class="box box-default">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<h2 class="well well-sm">Time Table Schedule</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<h3 class="well well-sm">
							<span style="background-color:#587899;color:white;padding: 7px;border-radius:50%;">Class :</span> <?php echo $className[0]['std_enroll_head_name']; ?>
						</h3>
					</div>
					<div class="col-md-6">
						<h3 class="well well-sm">
							<span style="background-color:#587899;color:white;padding: 7px;border-radius:50%;">Days :</span> <?php echo $days; ?>
						</h3>
					</div>
				</div>
			 <form action="time-table" method="post">
				<?php 

				for ($j=0; $j <$subjectArrayCount ; $j++) { 
					$subName = $subjectArray[$j];
					$subjectIDs = Yii::$app->db->createCommand("SELECT subject_id FROM subjects WHERE subject_name = '$subName' ")->queryAll();
					$subIdArray[$j] = $subjectIDs[0]['subject_id'];
				?>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p style="background-color:#587899;color:white;padding:10px;border-radius:10px;text-align: center;font-size:20px; ">
							<?php echo $subName; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Start Time</label>
						<input type="time" name="start_time[]" class="form-control">
					</div>
					<div class="col-md-3">
						<label>End Time</label>
						<input type="time" name="end_time[]" class="form-control">
					</div>
					<div class="col-md-3" style="border-right:1px solid;">
						<label>Rooms</label>
						<select name="rooms[]" class="form-control">
							<option>Select Room</option>
							<?php 
							$rooms = Yii::$app->db->createCommand("SELECT room_id,room_name FROM rooms ")->queryAll();
							$countRooms = count($rooms);
							for ($k=0; $k <$countRooms ; $k++) { 
								$roomId 	= $rooms[$k]['room_id'];
								$roomName 	= $rooms[$k]['room_name'];

							 ?>
							<option value="<?php echo $roomId; ?>">
								<?php echo $roomName; ?>
							</option>	
							<<?php } ?>
						</select>
					</div>
					<div class="col-md-3"><br>
						<input type="radio" name="on_off[<?php echo $j;?>]" value="1" checked> ON
						<input type="radio" name="on_off[<?php echo $j;?>]" value="0"> Off
					</div>
				</div>
				<?php } // subject loop close ?>
				<br>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<button style="float:right;" type="submit" name="insert_time_table" class="btn btn-success">Save Time Table</button>
					</div>
				</div>
				<?php 
				foreach ($subIdArray as $key => $value) { ?>
					<input type="hidden" name="subIdArray[]" value="<?php echo $value;?>">
				<?php } ?>
				<input type="hidden" name="classID" value="<?php echo $classId ;?>">
				<input type="hidden" name="days" value="<?php echo $days ;?>">
				<input type="hidden" name="subjectArrayCount" value="<?php echo $subjectArrayCount ;?>">
			</form>
			</div>
		</div>
	</div>
<?php } ?>
<?php 
	if(isset($_POST["insert_time_table"]))
	{
		$start_time 		= $_POST['start_time'];
		$end_time 			= $_POST['end_time'];
		$room 				= $_POST['rooms'];
		$subjectArrayCount	= $_POST['subjectArrayCount'];
		$subIdArray			= $_POST['subIdArray'];

		$classID 		= $_POST['classID'];
		$days 			= $_POST['days'];

		$status = $_POST['on_off'];

		$transection = Yii::$app->db->beginTransaction();
		try {
			$timeTableHead = Yii::$app->db->createCommand()->insert('time_table_head',[
    			'class_id' 		=> $classID,
				'days' 			=> $days,
				'status'		=> 'Active',
				'created_at'	=> new \yii\db\Expression('NOW()'),
				'created_by'	=> Yii::$app->user->identity->id, 
			])->execute();

			if ($timeTableHead) {
				$timeTableHeadId = Yii::$app->db->createCommand("SELECT time_table_h_id
				FROM  time_table_head
				WHERE class_id 		= '$classID' AND
					  days 			= '$days' AND
					  status 		= 'Active'
				")->queryAll();

				$timeTableHId = $timeTableHeadId[0]['time_table_h_id'];
				//echo $timeTableHId;

				for ($n=0; $n <$subjectArrayCount ; $n++) {
					if ($status[$n] == 1) {
						$timeTableDetail = Yii::$app->db->createCommand()->insert('time_table_detail',[
	            			'time_table_h_id' 	=> $timeTableHId,
							'subject_id' 		=> $subIdArray[$n],
							'start_time'		=> $start_time[$n],
							'end_time'			=> $end_time[$n],
							'room'				=> $room[$n],
							'status'			=> $status[$n],
							'created_at'		=> new \yii\db\Expression('NOW()'),
							'created_by'		=> Yii::$app->user->identity->id, 
						])->execute();
					}
				} // closing of for loop
					if ($timeTableDetail) {
					$transection->commit();
					Yii::$app->session->setFlash('success', "Time Table Mamaged successfully...!");
				} // closing `if` of time table detail		
			} // closing `if` of timeTableHead
		} // closing of try
		catch (Exception $e) {
			$transection->rollback();
			echo $e;
			Yii::$app->session->setFlash('warning', "Exam Schedule not managed. Try again!");
		} // closing of catch

	} // closing of insert time tabke isset....
 ?>
</body>
</html>