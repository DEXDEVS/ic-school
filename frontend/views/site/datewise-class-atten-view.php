<html>
<head></head>
<body>
<?php

        if (isset($_POST['submit'])) {
            $date = $_POST["date"];
        }

       if(isset($_GET["teacher_id"])){ 
        $teacher_id = $_GET["teacher_id"];
        $branch_id = $_GET["branch_id"];
        $class_id = $_GET["class_head_id"];

        $students = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_name,sed.std_enroll_detail_std_id,sed.std_enroll_detail_std_name, sed.std_roll_no
        FROM std_enrollment_detail as sed
        INNER JOIN std_enrollment_head as seh
        ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id
        WHERE sed.std_enroll_detail_head_id = '$class_id' AND seh.branch_id = '$branch_id'")->queryAll();
    
	    $countstd = count($students);

	    $classDetail = Yii::$app->db->createCommand("SELECT DISTINCT seh.class_name_id, seh.session_id, seh.section_id FROM std_enrollment_head as seh INNER JOIN teacher_subject_assign_detail as d ON d.class_id = seh.std_enroll_head_id WHERE d.class_id = '$class_id' AND seh.branch_id = '$branch_id'")->queryAll();
	    $classnameid = $classDetail[0]['class_name_id'];
	    $sessionid = $classDetail[0]['session_id'];
	    $sectionid = $classDetail[0]['section_id'];
    
?>      
<div class="row">
    <div class="col-md-3 col-md-offset-9">
        <a href="./mark-attendance" style="float: right; margin-right:2px;background-color:#5CB85C;color: white;padding:3px;border-radius:5px;"><i class="glyphicon glyphicon-backward"></i> Back</a>
    </div>
</div><br>
<div class="row">
    <div class="col-md-3">
        <div class="box box-danger"style="border-color:#5CB85C;">
            <div class="box-header">
                <h3 class="text-center" style="font-family: georgia;">Class Attendance</h3><hr style="border-color:#d0f2d0;">
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
                        <?php echo $students[0]['std_enroll_head_name']; ?>
                    </p>
                </li><br>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-danger" style="border-color:#5CB85C;">
            <div class="box-header" style="padding:3px;">
                <h2 class="text-center" style="font-family: georgia;color:#5CB85C;">Date Wise</h2><hr style="border-color:#d0f2d0;">
            </div>
            <div class="box-body">
                <div class="row">
        			<div class="col-md-12">
                		<form method="POST" action="datewise-class-atten-view">
                			<table class="table table-hover table-responsive">
                    			<thead>
		                            <tr style="background-color:#d0f2d0; ">
		                                <th>Sr #.</th>
		                                <th >Roll #.</th>
		                                <th >Name</th>
		                                <th>Attendance</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <?php 
		                            for ($i=0; $i <$countstd ; $i++) { 
		                             ?>
		                            <tr>
		                                <td><?php echo $i+1 ?></td>
		                                <td><?php echo $students[$i]['std_roll_no']; ?>
		                                </td>
		                                <td><?php echo $students[$i]['std_enroll_detail_std_name'];?>
		                                </td>
		                                <?php 
		                                    $stdId = $students[$i]['std_enroll_detail_std_id'];
		                                    $atten = Yii::$app->db->createCommand("SELECT att.attendance FROM std_atten_incharge as att WHERE att.branch_id = '$branch_id' AND att.teacher_id = '$teacher_id' AND att.class_name_id = '$classnameid' AND att.session_id = '$sessionid' AND att.section_id = '$sectionid' AND CAST(date AS DATE) = '$date' AND att.std_id = '$stdId'")->queryAll();
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
		                            <?php
		                            //closing for loop
		                            } ?>
		                        </tbody>
                    		</table>
                    	</form>
                
	                </div>
	            </div>
            </div>
        </div>
    </div>
</div>
<?php
//closing of $_POST
}
?> 

</body>
</html>