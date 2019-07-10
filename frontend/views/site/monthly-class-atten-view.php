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
                    
             //$sms = SmsController::sendSMS($to, $message);
             } else {
             $num = str_replace('-', '', $contact[$i]);
                 $to = str_replace('+', '', $num);
                 $absentSMS = Yii::$app->db->createCommand("SELECT sms_template FROM sms WHERE sms_name = 'Absent SMS'")->queryAll();
                 $absentMsg = $absentSMS[0]['sms_template'];
                     $msg = substr($absentMsg,0,16);
                     $msg2 = substr($absentMsg,17);
                     $message = $msg." ".$regNo[$i]." ".$msg2;
                 //$sms = SmsController::sendSMS($to, $message);
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

    $mon = date('Y-m-d');
    $currentMonth = date("Y - F", strtotime($mon));
    $month  = date("m", strtotime($mon));
    $year  = date("Y", strtotime($mon));
    $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);

    $stdInfo = Yii::$app->db->createCommand("SELECT d.std_enroll_detail_std_id, d.std_enroll_detail_std_name FROM std_enrollment_detail as d INNER JOIN std_enrollment_head as h ON d.std_enroll_detail_head_id = h.std_enroll_head_id WHERE branch_id = '$branch_id' AND h.class_name_id = '$classnameid' AND h.session_id = '$sessionid' AND h.section_id = '$sectionid' ")->queryAll();
        $countStd = count($stdInfo);
        
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header label-success">
                <h3 class="box-title">Class Attedance</h3>
                <h3 class="box-title" style="float: right;"><?php echo "Attendance ( ".$currentMonth." )"; ?></h3>
            </div>
            <!-- /.box-header -->
            <table class="table table-hover table-bordered">
                <thead>
                    <tr style="background-color:#008D4C;color:white;">
                        <th>Sr.#</th>
                        <td style="padding:2px 0px 2px 0px;">Name</td>
                         <?php for ($i=1; $i<=$days; $i++) { 
                               $var = $year."-".$month."-".$i;
                               $day  = date('Y-m-d',strtotime($var));
                               $result = date("D", strtotime($day)); ?>
                        <td style="padding:1px 1px;"><?php echo date("d", strtotime($day)); ?><br><?php echo $result; ?></td>
                        <?php  // closing of $days loop
                            } ?>
                        <td>P</td>
                        <td>A</td>
                        <td>L</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for($i=0; $i <$countStd ; $i++){
                        $stdName = $stdInfo[$i]['std_enroll_detail_std_name'];
                        $stdID = $stdInfo[$i]['std_enroll_detail_std_id'];
                        $presentCount = 0;
                        $absentCount = 0;
                        $leaveCount = 0;
                     ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td style="padding:0px ;width: 5px;"><?php echo $stdName; ?></td>
                        <?php for ($j=1; $j <=$days ; $j++) {
                            $var = $year."-".$month."-".$j;
                            $day  = date('Y-m-d',strtotime($var));
                            $result = date("D", strtotime($day));
                           $stdAtten = Yii::$app->db->createCommand("SELECT * FROM std_atten_incharge as i WHERE i.branch_id = '$branch_id' AND i.teacher_id = '$teacherHeadId' AND i.class_name_id = '$classnameid' AND i.session_id = '$sessionid' AND i.section_id = '$sectionid' AND i.std_id = '$stdID' AND i.date = '$day'")->queryAll();
                            
                            if ($result == 'Sun') {
                                 echo "<td class='danger' style='padding:1px 1px;'></td>";
                             } 
                            else if (empty($stdAtten)) {
                                echo "<td style='padding:1px 1px;'></td>";
                            }
                            else{
                                echo "<td style='padding:1px 1px;'>".$stdAtten[0]['attendance']."</td>";
                                if ($stdAtten[0]['attendance'] == 'P') {
                                    $presentCount++;
                                }
                                if ($stdAtten[0]['attendance'] == 'A') {
                                    $absentCount++;
                                }
                                if ($stdAtten[0]['attendance'] == 'L') {
                                    $leaveCount++;
                                }
                            }
                             ?>
                        <?php  // closing of $days loop
                            } ?>
                        <td class="success">
                            <?php echo $presentCount; ?> 
                        </td>
                        <td class="warning">
                            <?php echo $absentCount; ?>
                        </td>
                        <td class="info">
                            <?php echo $leaveCount; ?>
                        </td>
                    </tr>
                <?php // closing of $countStd loop
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php          
// closing of if isset
} else {
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

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<form method="POST" action="monthly-class-atten-view">
			<input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">
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
			<div class="col-md-4">
				<div class="form-group">
					<label><i class="glyphicon glyphicon-calendar"></i> Select Month</label>
					<input type="month" name="att_month" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
				<button type="submit" name="report" class="btn btn-success" style="margin-top:25px;"><i class="glyphicon glyphicon-eye-open"></i> View Report</button>
			</div>
		</form>
	</div>
    <?php   
    if(isset($_POST['report'])){ 
        $mon = $_POST['att_month'];
        $class_head_id = $_POST['class_head_id'];
        $currentMonth = date("Y - F", strtotime($mon));
        $month  = date("m", strtotime($mon));
        $year  = date("Y", strtotime($mon));
        $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);

        $classInfo = Yii::$app->db->createCommand("SELECT class_name_id, session_id, section_id FROM std_enrollment_head WHERE branch_id = '$branch_id' AND std_enroll_head_id = '$class_head_id' ")->queryAll();

        $classnameid = $classInfo[0]["class_name_id"];
        $sessionid = $classInfo[0]["session_id"];
        $sectionid = $classInfo[0]["section_id"];

        //fetching employees
        $branch_id = Yii::$app->user->identity->branch_id;
        $stdInfo = Yii::$app->db->createCommand("SELECT d.std_enroll_detail_std_id, d.std_enroll_detail_std_name FROM std_enrollment_detail as d INNER JOIN std_enrollment_head as h ON d.std_enroll_detail_head_id = h.std_enroll_head_id WHERE branch_id = '$branch_id' AND h.class_name_id = '$classnameid' AND h.session_id = '$sessionid' AND h.section_id = '$sectionid' ")->queryAll();
        $countStd = count($stdInfo);

    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header label-success">
                    <h3 class="box-title">Class Attedance</h3>
                    <h3 class="box-title" style="float: right;"><?php echo "Attendance ( ".$currentMonth." )"; ?></h3>
                </div>
                <!-- /.box-header -->
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr style="background-color:#008D4C;color:white;">
                            <th>Sr.#</th>
                            <td style="padding:2px 0px 2px 0px;">Name</td>
                             <?php for ($i=1; $i<=$days; $i++) { 
                                   $var = $year."-".$month."-".$i;
                                   $day  = date('Y-m-d',strtotime($var));
                                   $result = date("D", strtotime($day)); ?>
                            <td style="padding:1px 1px;"><?php echo date("d", strtotime($day)); ?><br><?php echo $result; ?></td>
                            <?php  // closing of $days loop
                                } ?>
                            <td>P</td>
                            <td>A</td>
                            <td>L</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        for($i=0; $i <$countStd ; $i++){
                            $stdName = $stdInfo[$i]['std_enroll_detail_std_name'];
                            $stdID = $stdInfo[$i]['std_enroll_detail_std_id'];
                            $presentCount = 0;
                            $absentCount = 0;
                            $leaveCount = 0;
                         ?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td style="padding:0px ;width: 5px;"><?php echo $stdName; ?></td>
                            <?php for ($j=1; $j <=$days ; $j++) {
                                $var = $year."-".$month."-".$j;
                                $day  = date('Y-m-d',strtotime($var));
                                $result = date("D", strtotime($day));
                               $stdAtten = Yii::$app->db->createCommand("SELECT * FROM std_atten_incharge as i WHERE i.branch_id = '$branch_id' AND i.teacher_id = '$teacherHeadId' AND i.class_name_id = '$classnameid' AND i.session_id = '$sessionid' AND i.section_id = '$sectionid' AND i.std_id = '$stdID' AND i.date = '$day'")->queryAll();
                                
                                if ($result == 'Sun') {
                                     echo "<td class='danger' style='padding:1px 1px;'></td>";
                                 } 
                                else if (empty($stdAtten)) {
                                    echo "<td style='padding:1px 1px;'></td>";
                                }
                                else{
                                    echo "<td style='padding:1px 1px;'>".$stdAtten[0]['attendance']."</td>";
                                    if ($stdAtten[0]['attendance'] == 'P') {
                                        $presentCount++;
                                    }
                                    if ($stdAtten[0]['attendance'] == 'A') {
                                        $absentCount++;
                                    }
                                    if ($stdAtten[0]['attendance'] == 'L') {
                                        $leaveCount++;
                                    }
                                }
                                 ?>
                            <?php  // closing of $days loop
                                } ?>
                            <td class="success">
                                <?php echo $presentCount; ?> 
                            </td>
                            <td class="warning">
                                <?php echo $absentCount; ?>
                            </td>
                            <td class="info">
                                <?php echo $leaveCount; ?>
                            </td>
                        </tr>
                    <?php // closing of $countStd loop
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php //CLOSING OF if(isset($_POST['report']))
    } ?>
</div>

<?php 
    } // closing of else (empty($teacherId))
} //closing of else ?>
</body>
</html>