<?php 
    if(isset($_POST['id'])){
        $examCatID = $_GET["id"];	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<!-- back button start -->
	 <ol class="breadcrumb">
      <li><a class="btn btn-primary btn-xs" href="exams-category-view?id=<?php echo $examCatID ;?>"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
	<!-- back button close -->
	<!-- invagilator section start -->
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-header" style="padding: 0px;text-align: center;">
					<h3 style="text-align: center;font-family: georgia;font-size:30px;">
						Invigilators Attendance
					</h3>
					<!-- <p style="font-weight:bold;text-align: center;"><u>Date Sheets</u></p> -->
				</div><hr>
				<div class="row container-fluid">
			        <div class="col-md-12">
                		<form method="POST">
                			<div class="row">
                				<div class="col-md-12">
                					<div class="form-group">
		                				<label>Select Date</label>
		                				<input type="date" name="date" class="form-control">
                					</div>
                				</div>

                				<input type="hidden" name="examCatId" value="<?php echo $examCatID;?>">
                			</div>
                			<div class="row">
                				<div class="col-md-12">
	                				<button class="btn btn-info" type="submit" name="search" > Search </button>
	                			</div>
                			</div>	
                		</form>
			        </div>
			    </div><hr>	
			</div>
		</div>
		<div class="col-md-9">					
            		<?php 
            		if(isset($_POST["search"]))
            		{
            			$date = $_POST['date'];
						$examCatId = $_POST['examCatId'];

						$invigilatorData = Yii::$app->db->createCommand("SELECT
						s.subject_id,r.class_head_id,r.emp_id,r.invigilator_attend
						FROM ((exams_room as r
						INNER JOIN exams_schedule as s
						ON s.exam_schedule_id = r.exam_schedule_id)
						INNER JOIN exams_criteria as c
						ON c.exam_criteria_id = s.exam_criteria_id)
						WHERE c.exam_status = 'Announced'
						AND c.exam_category_id = '$examCatId'
						AND s.date = '$date'")->queryAll();

						$countInvigilatorData = count($invigilatorData);
						print_r($invigilatorData);
            	 	?>
            	 	<div class="box box-primary">
						<div class="box-body">
            	 	<div class="row">
            	 		<div class="col-md-12">
							<form method="POST">
            	 			<table class="table">
            	 				<thead>
            	 					<tr>
            	 						<th>Sr.#</th>
            	 						<th>Class</th>
            	 						<th>Subject</th>
            	 						<th>Invagilator</th>
            	 						<th>Attendance</th>
            	 					</tr>
            	 				</thead>
            	 				<tbody>
            	 					<?php 
            	 					$criteriaArray = array();
            	 					$headIDArray = array();
            	 					$subjectArray = array();
            	 					$empArray = array();
            	 					for ($i=0; $i <$countInvigilatorData ; $i++) {

            	 						$headID = $invigilatorData[$i]['class_head_id'];
            	 						$headIDArray[$i] = $headID;

            	 						$headName = Yii::$app->db->createCommand("
										SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$headID'
											")->queryAll();
            	 						$subjectID = $invigilatorData[$i]['subject_id'];
            	 						$subjectArray[$i] = $subjectID;
            	 						$subjectName = Yii::$app->db->createCommand("
										SELECT subject_name FROM subjects WHERE subject_id = '$subjectID'
											")->queryAll();
            	 						$empID = $invigilatorData[$i]['emp_id'];
            	 						$empArray[$i] = $empID;
            	 						$empName = Yii::$app->db->createCommand("
										SELECT emp_name FROM emp_info WHERE emp_id = '$empID'
											")->queryAll();
            	 					 ?>
            	 					<tr>
            	 						<td><?php echo $i+1; ?></td>
            	 						<td><?php echo $headName[0]['std_enroll_head_name'];  ?></td>
            	 						<td>
            	 							<?php echo $subjectName[0]['subject_name']; ?>
            	 						</td>
            	 						<td>
            	 							<?php echo $empName[0]['emp_name']; ?>
            	 						</td>
            	 						<td>
            	 							<input type="radio" name="emp<?php echo $i+1?>" value="P" checked="checked" /> <b  style="color:green">P </b>
											<input type="radio" name="emp<?php echo $i+1?>" value="A"  /> <b style="color: red">A </b>
											<input type="radio" name="emp<?php echo $i+1?>" value="L" /><b style="color: #F7C564;"> L</b>
            	 						</td>
            	 					</tr>
            	 					<?php } ?>
            	 				</tbody>
            	 			</table>  
            	 			<input type="hidden" name="date" value="<?php echo $date; ?>">
            	 			<?php 
				                  foreach ($classArray as $value) {
				                		//echo '<input type="hidden" name="classArray[]" value="'.$value.'" style="width: 30px">';
				                	}
				                  foreach ($subjectArray as $value) {
				                		//echo '<input type="hidden" name="subjectArray[]" value="'.$value.'" style="width: 30px">';
				                	}
				                  foreach ($empArray as $value) {
				                		//echo '<input type="hidden" name="empArray[]" value="'.$value.'" style="width: 30px">';
				                	} ?>	
            	 			<button type="submit" name="save_attendance" class="btn btn-success btn-xs" style="float: right;">Save Attendance</button>
            	 		</form>
            	 		</div>
            	 	</div>
            	 	</div>
			</div>
            	 	<?php } //end of if isset ?>
		</div>
	</div>
	<!-- invagilator section close -->
</div>
</body>
</html>
<?php } //if isset(id) 
else { ?>
<div class="container-fluid">
    <!-- back button start -->
     <ol class="breadcrumb">
      <li><a class="btn btn-primary btn-xs" href="exams-category-view?id=<?php //echo $examCatID ;?>"><i class="fa fa-backward"></i> Back</a></li>
    </ol>
    <!-- back button close -->
    <!-- invagilator section start -->
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header" style="padding: 0px;text-align: center;">
                    <h3 style="text-align: center;font-family: georgia;font-size:30px;">
                        Invigilators Attendance
                    </h3>
                    <!-- <p style="font-weight:bold;text-align: center;"><u>Date Sheets</u></p> -->
                </div><hr>
                <div class="row container-fluid">
                    <div class="col-md-12">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Category</label> 
                                        <select name="examCatId" class="form-control">
                                        <option value="">Select Category</option>         <?php 
                                        $CategoryName = Yii::$app->db->createCommand("
                                             SELECT * FROM exams_category
                                                 ")->queryAll(); 
                                         print_r($CategoryName);
                                        foreach ($CategoryName as $key => $value) {
                                        ?>
                                         <option value="<?php echo $value['exam_category_id']; ?>"><?php echo $value['category_name']; ?></option>   
                                       
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Date</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="examCatId" value="<?php //echo $examCatID;?>">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-info" type="submit" name="search" > Search </button>
                                </div>
                            </div>  
                        </form>
                    </div>
                </div><hr>  
            </div>
        </div>
        <div class="col-md-9">                  
            <?php 
            if(isset($_POST["search"]))
            {
                $date = $_POST['date'];
                $examCatId = $_POST['examCatId'];

                $invigilatorData = Yii::$app->db->createCommand("SELECT
                s.subject_id,r.class_head_id,r.emp_id,r.invigilator_attend
                FROM ((exams_room as r
                INNER JOIN exams_schedule as s
                ON s.exam_schedule_id = r.exam_schedule_id)
                INNER JOIN exams_criteria as c
                ON c.exam_criteria_id = s.exam_criteria_id)
                WHERE c.exam_status = 'Announced'
                AND c.exam_category_id = '$examCatId'
                AND s.date = '$date'")->queryAll();

                $countInvigilatorData = count($invigilatorData);
                print_r($invigilatorData);
            ?>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sr.#</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Invagilator</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $criteriaArray = array();
                                        $headIDArray = array();
                                        $subjectArray = array();
                                        $empArray = array();
                                        for ($i=0; $i <$countInvigilatorData ; $i++) {

                                            $headID = $invigilatorData[$i]['class_head_id'];
                                            $headIDArray[$i] = $headID;

                                            $headName = Yii::$app->db->createCommand("
                                            SELECT std_enroll_head_name FROM std_enrollment_head WHERE std_enroll_head_id = '$headID'
                                                ")->queryAll();
                                            $subjectID = $invigilatorData[$i]['subject_id'];
                                            $subjectArray[$i] = $subjectID;
                                            $subjectName = Yii::$app->db->createCommand("
                                            SELECT subject_name FROM subjects WHERE subject_id = '$subjectID'
                                                ")->queryAll();
                                            $empID = $invigilatorData[$i]['emp_id'];
                                            $empArray[$i] = $empID;
                                            $empName = Yii::$app->db->createCommand("
                                            SELECT emp_name FROM emp_info WHERE emp_id = '$empID'
                                                ")->queryAll();
                                         ?>
                                        <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $headName[0]['std_enroll_head_name'];  ?></td>
                                            <td>
                                                <?php echo $subjectName[0]['subject_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $empName[0]['emp_name']; ?>
                                            </td>
                                            <td>
                                                <input type="radio" name="emp<?php echo $i+1?>" value="P" checked="checked" /> <b  style="color:green">P </b>
                                                <input type="radio" name="emp<?php echo $i+1?>" value="A"  /> <b style="color: red">A </b>
                                                <input type="radio" name="emp<?php echo $i+1?>" value="L" /><b style="color: #F7C564;"> L</b>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>  
                                <input type="hidden" name="date" value="<?php echo $date; ?>">
                                <?php 
                                      foreach ($classArray as $value) {
                                            //echo '<input type="hidden" name="classArray[]" value="'.$value.'" style="width: 30px">';
                                        }
                                      foreach ($subjectArray as $value) {
                                            //echo '<input type="hidden" name="subjectArray[]" value="'.$value.'" style="width: 30px">';
                                        }
                                      foreach ($empArray as $value) {
                                            //echo '<input type="hidden" name="empArray[]" value="'.$value.'" style="width: 30px">';
                                        } ?>    
                                <button type="submit" name="save_attendance" class="btn btn-success btn-xs" style="float: right;">Save Attendance</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } //end of if isset ?>
        </div>
    </div>
    <!-- invagilator section close -->
</div> 

<?php
}
?>