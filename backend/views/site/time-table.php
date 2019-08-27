<?php 
use kartik\select2\Select2;
?>
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
				<form method="post" >
					<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">
					<div class="col-md-4">
						<div class="form-group">
							<label>Select Class:</label>
							<select name="class_id" class="form-control" required>
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
						<label>Select Days</label>
			            <?php $data = [ 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', ];
			            echo Select2::widget([
						    'name' => 'days',
						    'value' => '',
						    'data' => $data,
						    'options' => ['multiple' => true, 'placeholder' => 'Select Days ...', 'required' => 'required']
						]);
		            	?>
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

	$classSchedule = Yii::$app->db->createCommand("SELECT * FROM time_table_head WHERE class_id = '$classId' AND days LIKE '%$days%' AND status = 'Active' ")->queryAll();

	if (!empty($classSchedule)) {
		Yii::$app->session->setFlash('warning', "Schedule already Active");
	}else{

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
	<form action="time-table" method="post" id="form_submit">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-dwfault">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<h2 class="well well-sm">Break Time</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Start Time</label>
									<input type="time" name="break_start" class="form-control">
								</div>
								<div class="form-group">
									<label>End Time</label>
									<input type="time" name="break_end" class="form-control">
								</div>
								<div class="form-group">
									<label>Priority</label>
									<select name="break_priority" class="form-control" required="">
										<option value="">Select Priority</option>
										<?php 
										for ($p=0; $p <=$subjectArrayCount ; $p++) { 

										 ?>
										<option value="<?php echo $p+1;?>">
											<?php echo "Priority".($p+1); ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="box box-default" style="padding:10px;">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<h2 class="well well-sm">Time Table Schedule</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<span style="background-color:#587899;color:white;padding: 7px;border-radius:50%;">Class :</span> 
								<h3 class="well well-sm">
									<?php echo $className[0]['std_enroll_head_name']; ?>
								</h3>
							</div>
							<div class="col-md-6">
								<span style="background-color:#587899;color:white;padding: 7px;border-radius:50%;">Days :</span>
								<h3 class="well well-sm">
									 <?php echo $days; ?>
								</h3>
							</div>
						</div>
						<?php 
						for ($j=0; $j <$subjectArrayCount ; $j++) { 

							$priorityarray = array();
							$subName = $subjectArray[$j];
							$subjectIDs = Yii::$app->db->createCommand("SELECT subject_id FROM subjects WHERE subject_name = '$subName' ")->queryAll();
							$subIdArray[$j] = $subjectIDs[0]['subject_id'];

							$teacherName = Yii::$app->db->createCommand("SELECT tsah.teacher_subject_assign_head_name,tsah.teacher_subject_assign_head_id
							FROM teacher_subject_assign_head as tsah
							INNER JOIN teacher_subject_assign_detail as tsad
							ON tsah.teacher_subject_assign_head_id = tsad.teacher_subject_assign_detail_head_id
							WHERE tsad.class_id = '$classId'
							AND tsad.subject_id = '$subIdArray[$j]' ")->queryAll();
							//print_r($teacherName);
							
						if(!empty($teacherName)){
							$teacherHeadId = $teacherName[0]['teacher_subject_assign_head_id'];
							$assignedClasses = Yii::$app->db->createCommand("SELECT tsad.class_id,tsad.subject_id
							FROM teacher_subject_assign_detail as tsad
							WHERE tsad.class_id != '$classId' 
							AND tsad.teacher_subject_assign_detail_head_id = '$teacherHeadId' ")->queryAll();
							//print_r($assignedClasses);

							if (!empty($assignedClasses)) {
								$countassignedClasses = count($assignedClasses);
								
								for ($p=0; $p <$countassignedClasses ; $p++) { 
									$subID = $assignedClasses[$p]['subject_id'];
									$classID = $assignedClasses[$p]['class_id'];

									$assignedLectures = Yii::$app->db->createCommand("SELECT td.priority
									FROM time_table_head as th
									INNER JOIN time_table_detail as td
									ON th.time_table_h_id = td.time_table_h_id
									WHERE th.class_id = '$classID'
									AND td.subject_id = '$subID'
									AND th.days = '$days' ")->queryAll();
									//print_r($assignedLectures);
									if (!empty($assignedLectures)) {
										$priorityarray[$p] = $assignedLectures[0]['priority'];
									}	 
								}
							}
						}
						?>
						<br>
						<div class="row" style="background-color:#587899;color:white;border-radius:10px;text-align: center;font-size:15px;line-height: 2; ">
								<div class="col-sm-7">
									<p >
										Assigned Lectures:
										<?php

										foreach ($priorityarray as $key => $value) {
											echo " ( ".$value." )";
											}
										?>
									</p>
								</div>
								<div class="col-sm-5">
									<?php if (!empty($teacherName)) { ?>
									<p>
										<?php echo $subName." ( ".$teacherName[0]['teacher_subject_assign_head_name']." ) "; 
										?>
									</p>
								<?php } else { ?>
										<p>
										<?php echo $subName; 
										?>
									</p>
								<?php } ?>
								</div>
							</div>
						<div class="row">
							<div class="col-md-4">
								<label>Start Time</label>
								<input type="time" name="start_time[]" class="form-control" id="start_time<?php echo $j;?>">
								<input type="hidden" name="start_time[]" value="<?php echo null; ?>" id="start<?php echo $j;?>" disabled>
								<label>End Time</label>
								<input type="time" name="end_time[]" class="form-control" id="end_time<?php echo $j;?>">
								<input type="hidden" name="end_time[]" value="<?php echo null; ?>" id="end<?php echo $j;?>" disabled>
							</div>
							<div class="col-md-4" style="border-right:1px solid;">
								<label>Rooms</label>
								<select name="rooms[]" class="form-control" id="room<?php echo $j;?>">
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

								<input type="hidden" name="rooms[]" value="<?php echo null; ?>" id="rom<?php echo $j;?>" disabled>
								<label>Priority</label>
								<select name="priority[]" class="form-control" required="" id="priority<?php echo $j;?>">
									<option value="" >Select Priority</option>
									<?php 	

									for ($g=0; $g <=$subjectArrayCount ; $g++) { 
									$pri = $g+1;
									?>
									<option value="<?php echo $pri;?>"><?php echo "Priority ".$pri; ?></option>
									<?php } ?>
								</select>

							</div>
							<div class="col-md-4"><br>
								<input type="radio" name="on_off[<?php echo $j;?>]" value="1" checked onclick="on(<?php echo $j;?>)"> ON
								<input type="radio" name="on_off[<?php echo $j;?>]" value="0" onclick="off(<?php echo $j;?>)" > Off
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
					</div>
				</div>
			</div>
		</div>
	</form>
	</div> 
	<!-- Container fluid close -->
 <?php 
} // closing of else
}  //closing of isset
?>
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

		$break_start = $_POST['break_start'];
		$break_end = $_POST['break_end'];
		$break_priority = $_POST['break_priority'];
		$priority = $_POST['priority'];

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

				for ($n=0; $n <$subjectArrayCount ; $n++) {
					$timeTableDetail = Yii::$app->db->createCommand()->insert('time_table_detail',[
            			'time_table_h_id' 	=> $timeTableHId,
						'subject_id' 		=> $subIdArray[$n],
						'start_time'		=> $start_time[$n],
						'end_time'			=> $end_time[$n],
						'room'				=> $room[$n],
						'priority'			=> $priority[$n],
						'status'			=> $status[$n],
						'created_at'		=> new \yii\db\Expression('NOW()'),
						'created_by'		=> Yii::$app->user->identity->id, 
					])->execute();
				} // closing of for loop
				if (!empty($break_start) && !empty($break_end)) {
					$timeTableDetail = Yii::$app->db->createCommand()->insert('time_table_detail',[
	            			'time_table_h_id' 	=> $timeTableHId,
							'subject_id' 		=> '',
							'start_time'		=> $break_start,
							'end_time'			=> $break_end,
							'room'				=> '',
							'status'			=> 2,
							'priority'			=> $break_priority,
							'created_at'		=> new \yii\db\Expression('NOW()'),
							'created_by'		=> Yii::$app->user->identity->id, 
						])->execute();
				}
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
<script type="text/javascript">
	function on(j){
		$('#start_time'+j). prop("disabled", false);
		$('#end_time'+j). prop("disabled", false);
		$('#room'+j). prop("disabled", false);
		$('#rom'+j). prop("disabled", true);
		 $('#start'+j). prop("disabled", true);
		 $('#end'+j). prop("disabled", true);
		//$('#priority'+j). prop("disabled", false);
	}

	function off(k){
		
		 $('#start_time'+k). prop("disabled", true);
		 $('#end_time'+k). prop("disabled", true);
		 $('#room'+k). prop("disabled", true);
		 $('#rom'+k). prop("disabled", false);
		 $('#start'+k). prop("disabled", false);
		 $('#end'+k). prop("disabled", false);
		 
		 
		 
		 // document.getElementById('#start_time'+k).value = "";
		 // document.getElementById('#start_time'+k).value = "";
		 // document.getElementById('#room'+k).value = "";
		//$('#priority'+k). prop("disabled", true);
	}
</script>	