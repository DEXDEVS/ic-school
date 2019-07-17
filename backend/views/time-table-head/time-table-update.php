<?php 

	// class Head Id
	$classHeadID = $_GET['classHeadID'];
	//echo $classHeadID;

	// moday schedule `id`
	$dayId = $_GET['dayId'];

	// getting name of schedule day against monday `id`
	$dayName = Yii::$app->db->createCommand("SELECT days
		FROM time_table_head
		WHERE time_table_h_id = '$dayId'")->queryAll();

	$DayDetais = Yii::$app->db->createCommand("SELECT td.subject_id,td.start_time,td.end_time,td.room,td.priority,td.status
		FROM time_table_detail as td
		WHERE td.time_table_h_id = '$dayId'
		AND ( td.status = 1
		OR td.status = 0 )
		ORDER BY td.priority ASC")->queryAll();
	//print_r($DayDetais);
	$countDayDetails = count($DayDetais);

	$breakDetail = Yii::$app->db->createCommand("SELECT td.start_time,td.end_time,td.priority
		FROM time_table_detail as td
		WHERE td.time_table_h_id = '$dayId'
		AND  td.status = 2 ")->queryAll();

	$breakpriority = $breakDetail[0]['priority'];


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
				<h3 class="well well-sm">
					Update: <?php echo $dayName[0]['days']." "."Schedule"; ?>
				</h3>
			</div>
		</div>
		<form method="POST" action="time-table-update?dayId=<?php echo $dayId; ?>&classHeadID=<?php echo $classHeadID; ?>">
			<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">
			<div class="row">
				<div class="col-md-3">
					<div class="box box-default">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<h2 class="well well-sm">Break Time</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Break Start Time</label>
										<input type="time" name="break_start" class="form-control" value="<?php echo $breakDetail[0]['start_time']; ?>">
									</div>
									<div class="form-group">
										<label>Break End Time</label>
										<input type="time" name="break_end" class="form-control" value="<?php echo $breakDetail[0]['end_time']; ?>">
									</div>
									<div class="form-group">
										<label>Priority</label>
										<select name="break_priority" class="form-control">
											<option value="<?php echo $breakpriority; ?>">	
												<?php echo "Priority ".$breakpriority; ?>
											</option>
											<?php 
											$priority = Yii::$app->db->createCommand("SELECT priority FROM time_table_detail WHERE priority != '$breakpriority' ORDER BY priority ASC ")->queryAll();
											$countPri = count($priority);
											for ($p=0; $p <$countPri ; $p++) { 
												$pri = $priority[$p]['priority'];

											 ?>
											<option value="<?php echo $pri; ?>">
												<?php echo "Priority ".$pri; ?>
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
					<div class="box box-default">
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<h2 class="well well-sm">Time Table Schedule</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<?php 
										for ($i=0; $i <$countDayDetails ; $i++) { 
											$subID = $DayDetais[$i]['subject_id'];
											$status =$DayDetais[$i]['status'];
											$subIdArray[$i] = $subID;
											$subName = Yii::$app->db->createCommand("SELECT subject_name
											FROM subjects
											WHERE subject_id = '$subID'")->queryAll();
											$roomID = $DayDetais[$i]['room'];
											$priorityId = $DayDetais[$i]['priority'];
									 ?>
									 <p style="background-color:#587899;color:white;padding:10px;border-radius:10px;text-align: center;font-size:20px; ">
									<?php echo $subName[0]['subject_name']; ?>
									</p>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Select Start Time</label>
												<input type="time" name="start_time[]" class="form-control" value="<?php echo $DayDetais[$i]['start_time'];?>" id="start_time<?php echo $i ?>"
												<?php 
													if ($status==0) {
														echo "disabled=".true;
													}
												?>>
											</div>
											<div class="form-group">
												<label>Select End Time</label>
												<input type="time" name="end_time[]" class="form-control" value="<?php echo $DayDetais[$i]['end_time'];?>" id="end_time<?php echo $i ?>" 
												<?php 
													if ($status==0) {
														echo "disabled=".true;
													}
												?>>
											</div>
										</div>
										<div class="col-md-4" style="border-right:1px solid;">
											<div class="form-group">
												<label>Room</label>
												<select name="room[]" class="form-control" id="room<?php echo $i ?>" 
													<?php 
													if ($status==0) {
														echo "disabled=".true;
													}
												?>>
													>
													<?php 
														$room = Yii::$app->db->createCommand("SELECT room_id,room_name FROM rooms WHERE room_id = '$roomID' ")->queryAll();
														$roomId 	= $room[0]['room_id'];
														$roomName 	= $room[0]['room_name'];

														 ?>
														<option value="<?php echo $roomId; ?>">
														<?php echo $roomName;  ?>
														</option>
													<?php 
														
														$rooms = Yii::$app->db->createCommand("SELECT room_id,room_name FROM rooms WHERE room_id != '$roomID' ")->queryAll();
														$countRooms = count($rooms);
														for ($r=0; $r <$countRooms ; $r++) { 
															$roomId 	= $rooms[$r]['room_id'];
															$roomName 	= $rooms[$r]['room_name'];

														 ?>
														<option value="<?php echo $roomId; ?>">
															<?php echo $roomName;  ?>
														</option>	
														<<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label>Select Priority</label>
												<select name="priority[]" class="form-control" id="priority<?php echo $i ?>">
													<option value="<?php echo $priorityId; ?>">
														<?php echo "Priority ".$priorityId; ?>
													</option>
													<?php 
														$priority = Yii::$app->db->createCommand("SELECT priority FROM time_table_detail WHERE priority != '$priorityId' ORDER BY priority ASC ")->queryAll();
														$countPri = count($priority);
														for ($p=0; $p <$countPri ; $p++) { 
															$pri = $priority[$p]['priority'];

														 ?>
														<option value="<?php echo $pri; ?>">
															<?php echo "Priority ".$pri; ?>
														</option>	
														<<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-4" style="text-align: center;"><br><br><br>
											<input type="radio" name="on_off[<?php echo $i;?>]" value="1"  onclick="on(<?php echo $i;?>)" 
												<?php 
													if ($status==1) {
														echo "checked";
													}
												?>

											> ON
											<input type="radio" name="on_off[<?php echo $i;?>]" value="0" onclick="off(<?php echo $i;?>)" 
											<?php 
													if ($status==0) {
														echo "checked";
													}
												?>

											> Off
										</div>
									</div><br>
									<?php } // closing of for loop ?>
								</div>
							</div>
						</div>
						<?php 
						foreach ($subIdArray as $key => $value) { ?>
							<input type="hidden" name="subIdArray[]" value="<?php echo $value;?>">
						<?php } ?>
						<input type="hidden" name="countDayDetails" value="<?php echo $countDayDetails; ?>">
						<input type="hidden" name="dayId" value="<?php echo $dayId; ?>">
						<input type="hidden" name="classHeadID" value="<?php echo $classHeadID; ?>">
						<div class="row">
							<div class="col-md-12">
								<button style="float:right;" type="submit" name="update_time_table" class="btn btn-success">Update Time Table</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- container fluid close -->
	<?php 
	if(isset($_POST["update_time_table"]))
	{
		$start_time 		= $_POST['start_time'];
		$end_time 			= $_POST['end_time'];
		$room 				= $_POST['room'];
		$countDayDetails	= $_POST['countDayDetails'];
		$subIdArray			= $_POST['subIdArray'];
		$priority = $_POST['priority'];
		$status = $_POST['on_off'];

		$dayId = $_POST['dayId'];
		$classHeadID = $_POST['classHeadID'];

		$break_start = $_POST['break_start'];
		$break_end = $_POST['break_end'];
		$break_priority = $_POST['break_priority'];

		//print_r($status);

		 	$transection = Yii::$app->db->beginTransaction();
		try{
			for ($i=0; $i <$countDayDetails ; $i++) {
				if ($status[$i] == 1) { 
					$timeTableUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
							'start_time' 		=> $start_time[$i],
							'end_time' 			=> $end_time[$i],
							'room' 				=> $room[$i],
							'priority' 			=> $priority[$i],
							'status' 			=> $status[$i],
							'updated_at'		=> new \yii\db\Expression('NOW()'),
							'updated_by'		=> Yii::$app->user->identity->id,
	                        ],
	                        ['time_table_h_id' => $dayId, 'subject_id' => $subIdArray[$i]]
	                    )->execute();
				}
				if ($status[$i] == 0) { 
					$timeTableUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
							'start_time' 		=> '',
							'end_time' 			=> '',
							'room' 				=> '',
							'priority' 			=> $priority[$i],
							'status' 			=> $status[$i],
							'updated_at'		=> new \yii\db\Expression('NOW()'),
							'updated_by'		=> Yii::$app->user->identity->id,
	                        ],
	                        ['time_table_h_id' => $dayId, 'subject_id' => $subIdArray[$i]]
	                    )->execute();
				}
			} //ending of $i loooooooooooooop
			if($timeTableUpdate){
				$timeTablebreakUpdate = Yii::$app->db->createCommand()->update('time_table_detail', [
						'start_time' 		=> $break_start,
						'end_time' 			=> $break_end,
						'room' 				=> '',
						'priority' 			=> $break_priority,
						'status' 			=> 2,
						'updated_at'		=> new \yii\db\Expression('NOW()'),
						'updated_by'		=> Yii::$app->user->identity->id,
                        ],
                        ['time_table_h_id' => $dayId, 'subject_id' => NULL, 'room' => NULL]
                    )->execute();
			}
			if($timeTablebreakUpdate) {
				$transection->commit();
				Yii::$app->session->setFlash('success', "Time Table updated successfully...!");
				//return $this->redirect(['./class-time-table']);
				//header("location: ");
				?>
					<script>
						window.location='./class-time-table';
					</script>
				<?php
			}
			
		//closing of try block
		} catch(Exception $e){
			$transection->rollback();
			echo $e;
			Yii::$app->session->setFlash('warning', "Time Table not updated. Try again!");
		} // closing of transaction handling....
		

} //ending of if isset
?>
</body>
</html>

<script type="text/javascript">
	function on(j){
		$('#start_time'+j). prop("disabled", false);
		$('#end_time'+j). prop("disabled", false);
		$('#room'+j). prop("disabled", false);
		//$('#priority'+j). prop("disabled", false);
	}
	function off(k){

		$('#start_time'+k). prop("disabled", true);
		$('#end_time'+k). prop("disabled", true);
		$('#room'+k). prop("disabled", true);
		//$('#priority'+k). prop("disabled", true);
	}
	
</script>