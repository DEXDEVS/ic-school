<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <?php $branch_id = Yii::$app->user->identity->branch_id; ?>
  <form method="POST" action="monthly-attendance-view">
    <div class="row">
      <div class="col-md-1">
        <div class="form-group">
          <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
        </div>    
      </div>
    </div>
    <div class="row">   
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Class</label>
          <?php $className = Yii::$app->db->createCommand("SELECT class_name_id,class_name FROM std_class_name WHERE branch_id = '$branch_id' AND status = 'Active' ")->queryAll();
            $classCount = count($className); ?>
            <select name="classid" class="form-control" id="classId">
              <option value="">Select Class</option>
          <?php  for ($i=0; $i <$classCount ; $i++) { ?>
            <option value="<?php echo $className[$i]['class_name_id']; ?>"><?php echo $className[$i]['class_name']; ?></option>
          <?php } ?>
           </select>          
        </div>    
      </div>    
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Session</label>
          <select name="sessionid" class="form-control" id="sessionId ">
              <option value="">Select Class</option>
          </select>
          <input type="text" name="sessionid" class="form-control" id="sessionId" required="required">          
        </div>    
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Section</label>
          <input type="text" name="sectionid" class="form-control"  required="required">          
        </div>    
      </div>    
    </div>
    <div class="row">
      <div class="col-md-12">
        <input type="submit" name="save" class="btn btn-success" style="float: right;">
      </div>
    </div>

  </form>



<?php 
        if (isset($_POST["save"])) {
          $classid = $_POST["classnameid"];
          $sessionid = $_POST["sessionid"];
          $sectionid = $_POST["sectionid"];

          $branch_id = Yii::$app->user->identity->branch_id;
          $empCnic = Yii::$app->user->identity->username;
          $empId = Yii::$app->db->createCommand("SELECT emp.emp_id FROM emp_info as emp WHERE emp.emp_cnic = '$empCnic' AND emp.emp_branch_id = '$branch_id'")->queryAll();
          $teacher_id = $empId[0]['emp_id'];
          //Select studnet roll no and name
          $student = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_id, sed.std_enroll_detail_std_id, sed.std_roll_no FROM std_enrollment_detail as sed INNER JOIN std_enrollment_head as seh ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id WHERE seh.class_name_id = '$classid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid' AND seh.branch_id = '$branch_id '")->queryAll();
          $studentLength = count($student);

          // Selected Class Name
          $className = Yii::$app->db->createCommand("SELECT class_name FROM std_class_name WHERE class_name_id = '$classid'")->queryAll();

          $headId = $student[0]['std_enroll_head_id'];
          // get SbjectsCombinationId for selected class
          $subjectComb = Yii::$app->db->createCommand("SELECT s.section_subjects,h.section_id
              FROM std_sections as s
              INNER JOIN std_enrollment_head as h
              ON s.section_id = h.section_id
              WHERE h.std_enroll_head_id = '$headId'")->queryAll();
          $combinationId = $subjectComb[0]['section_subjects'];
          // getting subjectCombination Name
          $combinations = Yii::$app->db->createCommand("
                  SELECT std_subject_name FROM std_subjects WHERE std_subject_id = '$combinationId'
                      ")->queryAll();
          $subComb = $combinations[0]['std_subject_name'];
          $singleSubject = explode(',', $subComb);
          $subjectlength = count($singleSubject);
          $subjectId = array();
          $subjectAlias = array();
          // populate array of subject alias
          foreach ($singleSubject as $key => $subj) {
          $subAls = Yii::$app->db->createCommand("SELECT subject_id, subject_alias FROM subjects WHERE subject_name = '$subj'")->queryAll();
                  
          $subjectId[$key] = $subAls[0]['subject_id'];
          $subjectAlias[$key] = $subAls[0]['subject_alias'];
          }
          $countSubjectids = count($subjectId);

          $dateArray = array();
          $dayArray = array();
          $datesArray = array();
          //get current month name and year and fetching all dates and day names
          $currentMonth =date('F Y');
          $month  = date('m');
          $year  = date('Y');
          $days = cal_days_in_month(CAL_GREGORIAN, $month,$year);
          for($i = 0; $i< $days; $i++){
              $d = $i+1;
             $day  = date('Y-m-'.$d);
             $dayArray[] = date("l", strtotime($day));
             $dateArray[] = date("Y-m-d", strtotime($day));                
          }
          //geting last date of current month
          $lastDateOfMonth = date("Y-m-t", strtotime($currentMonth));
          $lastDate = explode('-', $lastDateOfMonth);
          $lastDate = $lastDate[2];

          $temp = $lastDate / 7;
          if($temp == 4){
              $rowCount = 4;
          } else {
              $rowCount = 5;
          }
          //use for dateArray[]
          $dateCount = 0;
          //creating array for student attendance
          global $attendanceArr;
        
        ?> 

<div class="container-fluid">
	<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header label-success">
                <h3 class="box-title"><?php echo $className[0]['class_name']; ?></h3>
                <h3 class="box-title" style="float: right;"><?php echo "Attendance ( ".$currentMonth." )"; ?></h3>
            </div>
            <!-- /.box-header -->
            <?php for ($row=0; $row <$rowCount ; $row++) {  ?>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered table-striped">
            
                <tr>
                  	<th rowspan="2">Sr<br>#</th>
					<th rowspan="2">Roll<br>#</th>
					<th rowspan="2">Student<br>Name</th>
					<?php 
                    $subjectCount =0;    
                        // print 7 dates in a row
                        for ($date=0; $date < 7 ; $date++) { 
                           if($dateCount < $lastDate){
                               echo "<th colspan='6' style='text-align: center;'>$dateArray[$dateCount]  $dayArray[$dateCount]</th>";    
                               $datesArray[$date] = $dateArray[$dateCount];  
                                $subjectCount++;
                            }
                            //end of if
                            $dateCount++;  
                        }
                        //end of $date loop
					?>
                </tr>
                <tr>
                	<?php 
                    for ($r=0; $r <$subjectCount ; $r++) { 
                        //loop to print subjects
                		for ($s=0; $s <$subjectlength ; $s++) { ?>
						<th style='padding: 1px 1px'><?php echo $subjectAlias[$s]; ?></th>
					<?php	
                        }
                    } 
                	?>
                </tr>

                <?php   //print students
                        for( $std=0; $std<$studentLength; $std++) {  ?>
                            <tr>
                                <td><?php echo $std+1; ?></td>
                                <td><?php echo $student[$std]['std_roll_no']; ?></td>
                                <?php $stdId = $student[$std]['std_enroll_detail_std_id'];
                                      $stdName = Yii::$app->db->createCommand("SELECT std_name FROM std_personal_info  WHERE std_id = '$stdId'")->queryAll(); ?>
                                <td><?php echo $stdName[0]['std_name']; ?></td>

                                <?php 
                                //loop for 1 to 7 dates
                                for ($r=0; $r <$subjectCount ; $r++) {
                                    $date = $datesArray[$r];
                                    for ($s=0; $s <$subjectlength ; $s++) {
                                        $subId = $subjectId[$s]; 
                                        $attendance = Yii::$app->db->createCommand("SELECT CAST(date AS DATE),subject_id,status,student_id FROM std_attendance WHERE class_name_id = '$classid' AND session_id = '$sessionid' AND section_id = '$sectionid' AND CAST(date AS DATE) = '$date' AND subject_id = '$subId' AND teacher_id = '$teacher_id' AND branch_id = '$branch_id'")->queryAll();
                                        $attendanceArr[$s] = $attendance; 
                                        ?> 
                                    <td><?php
                                    if(!empty($attendanceArr[$s][$std]['status'])){
                                        echo $attendanceArr[$s][$std]['status']; 
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                    </td>
                                <?php 
                                          
                                    } //end of $s loop
                                } //end of $r loop ?>   
                        </tr>
                    <?php }//end of $std loop 
                         ?> 
                
              </table>
                    
              
            <?php 
                    }//end of $row loop ?>
            <!-- /.box-body -->
          </div>
          <hr>
        <div class="row">
            <div class="col-md-5">
                <table class="table-bordered table table-condensed">
                    <tr class="label-success">
                        <th colspan="3" class="text-center">Lectures</th>
                    </tr>
                    <tr>
                        <th>Previous Lectures</th>
                        <th>Current Lectures</th>
                        <th>Total Lectures</th>
                    </tr>
                    <tr align="center">
                        <td>24</td>
                        <td>24</td>
                        <td>48</td>
                    </tr>       
                </table>
            </div>
            <div class="col-md-6 col-md-offset-1">
              <table class="table-bordered table table-condensed">
                <tr class="label-success">
                    <th colspan="4" class="text-center">Attendance</th>
                </tr>
                <tr>
                    <th>Previous Percentage</th>
                    <th>Month Attendance</th>
                    <th>Total</th>
                    <th>% Percentage</th>
                </tr>
                <tr align="center">
                    <td>90%</td>
                    <td>- - -</td>
                    <td>- - -</td>
                    <td>- - -</td>
                </tr>       
              </table>
            </div>
        </div>
        <hr>

            </div>
          <!-- /.box -->
        </div>
    </div>
  
</div>
<!-- container-fluid close -->
<?php } //end of ififfet ?>
</body>
</html>
<?php
$url = \yii\helpers\Url::to("std-attendance/fetch-section");

$script = <<< JS
$('#classId').on('change',function(){
   var classId = $('#classId').val();
   $.ajax({
        type:'post',
        data:{class_Id:classId},
        url: "$url",

        success: function(result){
            var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
            $('#sessionId').empty();
            $('#sessionId').append("<option>"+"Select Session"+"</option>");
            for(var i=0; i<jsonResult.length; i++) { 
                options += '<option value="'+jsonResult[i].session_id+'">'+jsonResult[i].session_name+'</option>';
            }
            // Append to the html
            $('#sessionId').append(options);
        }         
    });       
});

$('#sessionId').on('change',function(){
    var sessionId = $('#sessionId').val();
    var classId = $('#classId').val();

    $.ajax({
        type:'post',
        data:{class_Id:classId,session_Id:sessionId},
        url: "$url",

        success: function(result){
        var jsonResult = JSON.parse(result.substring(result.indexOf('['), result.indexOf(']')+1));
            var options = '';
            $('#sectionId').empty();
            $('#sectionId').append("<option>"+"Select Section"+"</option>");
            for(var i=0; i<jsonResult.length; i++) { 
                options += '<option value="'+ jsonResult[i].section_id +'">'+ jsonResult[i].section_name +'</option>';
            }
            // Append to the html
            $('#sectionId').append(options);
        }           
    });       
});

JS;
$this->registerJs($script);
?>
</script>