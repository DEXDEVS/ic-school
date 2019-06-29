<?php use backend\controllers\SmsController; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 
	$branch_id = Yii::$app->user->identity->branch_id;
	$user_cnic = Yii::$app->user->identity->username;

	$empId = Yii::$app->db->createCommand("SELECT emp.emp_id FROM emp_info as emp WHERE emp.emp_cnic = '$user_cnic'")->queryAll();
    $empId = $empId[0]['emp_id'];

    $teacherId = Yii::$app->db->createCommand("SELECT teacher_subject_assign_head_id FROM teacher_subject_assign_head WHERE teacher_id = '$empId'")->queryAll();

    if(empty($teacherId)){
            Yii::$app->session->setFlash('warning',"Sorry. No class assigned to you..!");
    } else {
        $teacherHeadId = $teacherId[0]['teacher_subject_assign_head_id'];

        $classIds = Yii::$app->db->createCommand("SELECT DISTINCT d.class_id FROM teacher_subject_assign_detail as d WHERE d.teacher_subject_assign_detail_head_id = '$teacherHeadId' AND d.incharge = 1")->queryAll();

        $countClassIds = count($classIds); 

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-md-offset-9">
            <a href="./home" style="float: right;background-color:#008d4c;color: white;padding:3px;border-radius:5px;"><i class="glyphicon glyphicon-backward"></i> Back</a>
        </div>
    </div><br><!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header" style="padding:0px;background-color:#9cd1a6;">
                     <h2 class="text-center text-success">Class Attendance</h2>
                </div>
                <div class="box-body">
                    <form  action = "mark-attendance" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                                </div>    
                            </div>    
                        </div>
                        <div class="row">
                        	<div class="col-md-4">
                                <div class="form-group">
                            		<label>Select Class</label>
                            		<select class="form-control" name="class_head_id">
                    		   			<option value="">Select Class</option>
                    		    		<?php for ($i=0; $i <$countClassIds ; $i++) {
                    		        	$classId = $classIds[$i]['class_id'];
                    			        $CLASSName = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_name,seh.std_enroll_head_id
                    			            FROM std_enrollment_head as seh WHERE seh.std_enroll_head_id = '$classId' AND seh.branch_id = '$branch_id' ")->queryAll(); ?>

                    			        	<option value=<?php echo $CLASSName[0]['std_enroll_head_id']; ?>><?php echo $CLASSName[0]['std_enroll_head_name']; ?></option>

                    					<?php } ?>
                    				</select>
                                </div>
                        	</div>
                        	<div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" name="take-attendance" class="btn btn-success form-control" style="margin-top: 25px;">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                    <b>Take Attendance</b></button>
                                </div> 
                        	</div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" name="view-attendance" class="btn btn-success form-control" style="margin-top: 25px;">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                    <b>View Attendance</b></button>
                                </div> 
                            </div>
                        </div> <!-- .row  -->
                        <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                        <input type="hidden" name="teacherHeadId" value="<?php echo $teacherHeadId; ?>">
                    </form>
                </div> <!-- .box-body  -->
            </div> <!-- .box-danger  -->
        </div> <!-- .col-md-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<?php } ?>
<?php 
if(isset($_POST["save"])){
    $branch_id = $_POST["branch_id"];
    $teacherHeadId = $_POST["teacherHeadId"];
    $classnameid = $_POST["classnameid"];
    $sessionid = $_POST["sessionid"];
    $sectionid = $_POST["sectionid"];
    $date = $_POST["date"];
    $stdAttendId = $_POST["stdAttendance"];
    $countstd = $_POST["countstd"];

    for($i=0; $i<$countstd;$i++){
        $q=$i+1;
        $std = "std".$q;
        $status[$i] = $_POST["$std"];

    }
    
    $transection = Yii::$app->db->beginTransaction();
    try{
        for($i=0; $i<$countstd; $i++){
        $attendance = Yii::$app->db->createCommand()->insert('std_atten_incharge',[
            'branch_id'     => $branch_id,
            'teacher_id'    => $teacherHeadId,
            'class_name_id' => $classnameid,
            'session_id' => $sessionid,
            'section_id' => $sectionid,
            'date'       => $date,
            'std_id'     => $stdAttendId[$i],
            'attendance' => $status[$i],
            'created_at' => new \yii\db\Expression('NOW()'),
            'created_by' => Yii::$app->user->identity->id,  
        ])->execute();
        }
     if($attendance == 1){
            $query = Yii::$app->db->createCommand("SELECT att.std_id, att.attendance 
                 FROM std_atten_incharge as att
                 WHERE att.teacher_id = '$teacherHeadId' 
                 AND att.class_name_id = '$classnameid'
                 AND att.session_id = '$sessionid'
                 AND att.section_id = '$sectionid'
                 AND CAST(date AS DATE) = '$date'
                 AND att.attendance != 'P'")->queryAll();

                $c = count($query);

            for ($i=0; $i < $c ; $i++) { 
                 $stdID = $query[$i]['std_id'];
                 $stdStatus = $query[$i]['attendance'];
                 $stdInfo = Yii::$app->db->createCommand("SELECT std.std_reg_no,std.std_name, std.std_father_name, sg.guardian_contact_no_1
                     FROM std_personal_info as std 
                     INNER JOIN std_guardian_info as sg
                     ON std.std_id = sg.std_id
                     WHERE std.std_id = '$stdID'")->queryAll();
             
             $regNo[$i] = $stdInfo[0]['std_reg_no'];
             $contact[$i] = $stdInfo[0]['guardian_contact_no_1'];
             if ($stdStatus == 'L') {
                 $num = str_replace('-', '', $contact[$i]);
                     $to = str_replace('+', '', $num);
                     $leaveSMS = Yii::$app->db->createCommand("SELECT sms_template FROM sms WHERE sms_name = 'Leave SMS'")->queryAll();
                     $leaveMsg = $leaveSMS[0]['sms_template'];
                     $msg = substr($leaveMsg,0,16);
                     $msg2 = substr($leaveMsg,17);
                     $message = $msg." ".$regNo[$i]." ".$msg2;
                    
             $sms = SmsController::sendSMS($to, $message);
             } else {
             $num = str_replace('-', '', $contact[$i]);
                 $to = str_replace('+', '', $num);
                 $absentSMS = Yii::$app->db->createCommand("SELECT sms_template FROM sms WHERE sms_name = 'Absent Message'")->queryAll();
                 $absentMsg = $absentSMS[0]['sms_template'];
                     $msg = substr($absentMsg,0,16);
                     $msg2 = substr($absentMsg,17);
                     $message = $msg." ".$regNo[$i]." ".$msg2;
                 $sms = SmsController::sendSMS($to, $message);
                 }
            }
        }
        $transection->commit();
        Yii::$app->session->setFlash('success', "Attendance marked successfully...!");
        //return $this->redirect(['view-class-attendance']);
    } catch(Exception $e){
        $transection->rollback();
        echo $e;
        Yii::$app->session->setFlash('warning', "Attendance not marked. Try again!");
    }
            
    // closing of if isset
}
 ?>

</body>
</html>
