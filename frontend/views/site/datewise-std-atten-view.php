<!DOCTYPE html>
<html>
<head>
  <title>View Attendance</title>

</head>
<body>

    <?php 

    if(isset($_POST["submit"])){

        $class_id       = $_GET["class_head_id"];
        $teacher_id     = $_GET["teacher_id"];
        $date           = $_POST["date"];
        $studentId      = $_POST["studentId"];
        $classnameid    = $_POST["classnameid"];
        $sessionid      = $_POST["sessionid"];
        $sectionid      = $_POST["sectionid"];

        $branch_id = Yii::$app->user->identity->branch_id;
        $student = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_name,sed.std_enroll_detail_std_name, sed.std_roll_no
        FROM std_enrollment_detail as sed
        INNER JOIN std_enrollment_head as seh
        ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id
        WHERE sed.std_enroll_detail_head_id = '$class_id' AND sed.std_enroll_detail_std_id = '$studentId' AND seh.branch_id = '$branch_id' ")->queryAll();

?>
<div class="container-fluid">
    <form method="POST" action="mark-attendance">
        <div class="row">
            <div class="col-md-10">
                <input type="hidden" name="class_head_id" value="<?php echo $class_id; ?>">
                <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                <input type="hidden" name="teacherHeadId" value="<?php echo $teacher_id; ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" name="view-attendance" style="float: right; margin-right:2px;background-color:#5CB85C;color: white;padding:3px;border-radius:5px;"><i class="glyphicon glyphicon-backward"></i> Back</button>
            </div>
        </div>
    </form><br>
    <div class="row">
        <div class="col-md-3">
           <div class="box box-danger"style="border-color:#5CB85C;">
               <div class="box-header">
                    <h3 class="text-center" style="font-family: georgia;">Student Attendance</h3><hr style="border-color:#d0f2d0;">
               </div>
               <div class="box-body">
                   <li style="list-style-type: none;">
                        <p class="text-center" style="padding:4px; background-color:#5CB85C; color:white;">Date</p>
                        <p style="background-color:#d0f2d0;color: red;text-align: center;">
                            <u><?php echo $date; ?></u>
                        </p>
                    </li><hr style="border-color:#d0f2d0;"><br>
                    <li style="list-style-type: none;margin-top: -20px;">
                        <b>Class:</b>
                        <p>
                            <?php echo $student[0]['std_enroll_head_name']; ?>
                        </p>
                    </li><br>
               </div>
           </div> 
        </div>
        <div class="col-md-9">
           <div class="box box-danger"style="border-color:#5CB85C;">
               <div class="box-header" style="padding:3px;">
                    <h2 class="text-center text-danger" style="font-family: georgia;color:#5CB85C;">Date Wise View</h2><hr style="border-color:#d0f2d0;">
               </div>
               <div class="box-body">
                   <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="datewise-std-atten-view">
                                <table class="table table-hover">
                                    <thead>
                                        <tr style="background-color:#d0f2d0; ">
                                            <th >Sr #.</th>
                                            <th >Roll #.</th>
                                            <th >Name</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo 1; ?></td>
                                            <td><?php echo $student[0]['std_roll_no']; ?></td>
                                            <td><?php echo $student[0]['std_enroll_detail_std_name'];?></td>
                                            <?php 
                                                $atten = Yii::$app->db->createCommand("SELECT att.attendance FROM std_atten_incharge as att WHERE att.branch_id = '$branch_id' AND att.teacher_id = '$teacher_id' AND att.class_name_id = '$classnameid' AND att.session_id = '$sessionid' AND att.section_id = '$sectionid'AND CAST(date AS DATE) = '$date' AND att.std_id = '$studentId'")->queryAll();
                                                ?>
                                            <td align="center">
                                                <?php 
                                                if(empty($atten)){
                                                    echo 'Not Marked';
                                                } else {
                                                    echo $atten[0]['attendance']; 
                                                }?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
               </div>
           </div> 
        </div>
    </div>
</div>
<?php
//closing of ifisset
    }
?>
</body>
</html>
