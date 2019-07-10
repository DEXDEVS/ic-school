
<?php 

if(isset($_POST["take-attendance"])){
    $class_head_id = $_POST['class_head_id'];
    $branch_id = $_POST['branch_id'];
    $teacherHeadId = $_POST['teacherHeadId'];
?>
<div class="container-fluid">
   <div class="row">
    <div class="col-md-3 col-md-offset-9">
        <a href="./attendance-by-incharge" style="float: right;background-color:#008d4c;color: white;padding:3px;border-radius:5px;"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
                                    <label>Select Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success form-control" style="margin-top: 25px;">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                    <b>Take Attendance</b></button>
                                </div> 
                            </div>
                        </div> <!-- .row  -->
                        <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>">
                        <input type="hidden" name="class_head_id" value="<?php echo $class_head_id; ?>">
                        <input type="hidden" name="teacherHeadId" value="<?php echo $teacherHeadId; ?>">
                    </form>
                </div> <!-- .box-body  -->
            </div> <!-- .box-danger  -->
        </div> <!-- .col-md-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<?php
}

if(isset($_POST["submit"])){
    $class_head_id = $_POST['class_head_id'];
    $branch_id = $_POST['branch_id'];
    $date = $_POST['date'];
    $teacherHeadId = $_POST['teacherHeadId'];

    $classDetail = Yii::$app->db->createCommand("SELECT DISTINCT seh.class_name_id, seh.session_id, seh.section_id FROM std_enrollment_head as seh WHERE seh.std_enroll_head_id = '$class_head_id' AND seh.branch_id = '$branch_id'")->queryAll();

    $classnameid = $classDetail[0]['class_name_id'];
    $sessionid = $classDetail[0]['session_id'];
    $sectionid = $classDetail[0]['section_id'];

    $checkAttendance = Yii::$app->db->createCommand("SELECT * FROM std_atten_incharge as att WHERE att.teacher_id = '$teacherHeadId' AND att.class_name_id = '$classnameid' AND att.session_id = '$sessionid' AND att.section_id = '$sectionid' AND CAST(date AS DATE) = '$date' AND att.branch_id = '$branch_id'")->queryAll();
    if(!empty($checkAttendance)){
        Yii::$app->session->setFlash('warning', "You've already taken attendance for this class");
    } else {
        $students = Yii::$app->db->createCommand("SELECT seh.std_enroll_head_name,sed.std_enroll_detail_std_id,sed.std_enroll_detail_std_name, sed.std_roll_no
            FROM std_enrollment_detail as sed
            INNER JOIN std_enrollment_head as seh
            ON seh.std_enroll_head_id = sed.std_enroll_detail_head_id
            WHERE sed.std_enroll_detail_head_id = '$class_head_id' AND seh.branch_id = '$branch_id'")->queryAll();

        $countstd = count($students);

?>
<div class="row container-fluid">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header" style="padding:3px;">
                <h2 class="text-center text-danger" style="font-family: georgia;">Take Attendance</h2><hr style="border-color:#9cd1a6;">
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="monthly-class-atten-view">
                            <table class="table">
                                <thead >
                                    <tr style="background-color:#9cd1a6;">
                                        <th style="">Sr #.</th>
                                        <th style="">Roll #.</th>
                                        <th style="">Name</th>
                                        <th style="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    for ($i=0; $i <$countstd ; $i++) { 
                                     ?>
                                    <tr style="border-bottom:1px solid #9cd1a6 ;">
                                        <td><?php echo $i+1;?></td>
                                        <td><?php echo $students[$i]['std_roll_no']; ?></td>
                                        <td><?php echo $students[$i]['std_enroll_detail_std_name'];?></td>
                                        <td align="left">
                                            <input type="radio" name="std<?php echo $i+1?>" value="P" checked="checked"/> <b  style="color: green">P </b>
                                            <input type="radio" name="std<?php echo $i+1?>" value="A" /> <b style="color: red">A </b>
                                            <input type="radio" name="std<?php echo $i+1?>" value="L" /><b style="color: #F7C564;"> L</b>
                                        </td>
                                    </tr>
                                    <?php 
                                    $stdId = $students[$i]['std_enroll_detail_std_id'];
                                    $stdAttendId[$i] = $stdId;
                                    //closing for loop
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            
                            <?php foreach ($stdAttendId as $value) {
                                    echo '<input type="hidden" name="stdAttendance[]" value="'.$value.'" style="width: 30px">';
                            } ?>
                                
                                <input class="form-control" type="hidden" name="countstd" value="<?php echo $countstd; ?>"> 
                                <input type="hidden" name="branch_id" value="<?php echo $branch_id; ?>" style="width: 30px">
                                <input type="hidden" name="teacherHeadId" value="<?php echo $teacherHeadId; ?>" style="width: 30px">
                                <input type="hidden" name="classnameid" value="<?php echo $classnameid; ?>" style="width: 30px">
                                <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>" style="width: 30px">
                                <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" style="width: 30px">
                                <input type="hidden" name="date" value="<?php echo $date; ?>" style="width: 30px">
                            <br>
                            <button style="float: right;" type="submit" name="save" class="btn btn-success btn-flat btn-xs">
                                <i class="fa fa-sign-in"></i> <b>Take Attendance</b>
                            </button>       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php        
    } // else of (!empty($checkAttendance))
} // if(isset($_POST['submit']))
?>
<?php
if(isset($_POST['view-attendance'])) {
    $class_head_id = $_POST['class_head_id'];
    $branch_id = $_POST['branch_id'];
    $teacherHeadId = $_POST['teacherHeadId'];   

    ?>
    <!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!-- modal link files -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <!-- modal link files -->
<style type="text/css">
    /*
Code snippet by maridlcrmn for Bootsnipp.com
Follow me on Twitter @maridlcrmn
Image credits: unsplash.com, uifaces.com/authorized
Image placeholders: placemi.com
*/


#t-cards {
    padding-top: 80px;
    padding-bottom: 80px;
    background-color: #345;    
}

/********************************/
/*          Panel cards         */
/********************************/
.panel.panel-card {
    position: relative;
    height: 241px;
    border: none;
    overflow: hidden;
}
.panel.panel-card .panel-heading {
    position: relative;
    z-index: 2;
    height: 120px;
    border-bottom-color: #fff;
    overflow: hidden;
    
    -webkit-transition: height 600ms ease-in-out;
            transition: height 600ms ease-in-out;
}
.panel.panel-card .panel-heading img {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 1;
    width: 120%;
    
    -webkit-transform: translate3d(-50%,-50%,0);
            transform: translate3d(-50%,-50%,0);
}
.panel.panel-card .panel-heading button {
    position: absolute;
    top: 10px;
    right: 15px;
    z-index: 3;
}
.panel.panel-card .panel-figure {
    position: absolute;
    top: auto;
    left: 50%;
    z-index: 3;
    width: 70px;
    height: 70px;
    background-color: #fff;
    border-radius: 50%;
    opacity: 1;
    -webkit-box-shadow: 0 0 0 3px #fff;
            box-shadow: 0 0 0 3px #fff;
    
    -webkit-transform: translate3d(-50%,-50%,0);
            transform: translate3d(-50%,-50%,0);
    
    -webkit-transition: opacity 400ms ease-in-out;
            transition: opacity 400ms ease-in-out;
}

.panel.panel-card .panel-body {
    padding-top: 40px;
    padding-bottom: 20px;

    -webkit-transition: padding 400ms ease-in-out;
            transition: padding 400ms ease-in-out;
} 

.panel.panel-card .panel-thumbnails {
    padding: 0 15px 20px;
}
.panel-thumbnails .thumbnail {
    width: 60px;
    max-width: 100%;
    margin: 0 auto;
    background-color: #fff;
} 


.panel.panel-card:hover .panel-heading {
    height: 55px;
    
    -webkit-transition: height 400ms ease-in-out;
            transition: height 400ms ease-in-out;
}
.panel.panel-card:hover .panel-figure {
    opacity: 0;
    
    -webkit-transition: opacity 400ms ease-in-out;
            transition: opacity 400ms ease-in-out;
}
.panel.panel-card:hover .panel-body {
    padding-top: 20px;
    
    -webkit-transition: padding 400ms ease-in-out;
            transition: padding 400ms ease-in-out;
}
body{
        font-family: verdana;
      }
</style>
</head>
<body>
<div class="row">
    <div class="col-md-3 col-md-offset-9">
        <a href="./attendance-by-incharge" style="float: right;background-color:#008d4c;color: white;padding:3px;border-radius:5px;"><i class="glyphicon glyphicon-backward"></i> Back</a>
    </div>
</div><br><!-- .row -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="container-fluid" style="margin-top:5px">
            <div class="box box-danger" style="border-color:#5CB85C;">
                <div class="box-header"style="background-color:#d0f2d0;">      
                    <h2 style="color:#5CB85C;" align="center">Attendance Report</h2>
                </div>
                <div class="box-body">
                    <section id="">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="panel panel-default panel-card">
                                    <div class="panel-heading">
                                        <img src="backend/web/uploads/gray.jpg" />
                                        <!-- <button class="btn btn-primary btn-sm" role="button">Follow</button> -->
                                    </div>
                                    <div class="panel-figure">
                                        <!-- <img style="border:none;" class="img-responsive img-circle" src="backend/web/uploads/class.jpg" /> -->
                                    </div>
                                    <div class="panel-body text-center">
                                        <h4 class="panel-header text-center">Class Attendance</h4>
                                        <small>View Class Wise Attendance</small>
                                    </div>
                                    <div class="panel-thumbnails">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div style="text-align: center;">
                                                    <!-- Trigger the modal with a button -->
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6"> -->
                                                           <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal1<?php echo $teacherHeadId; ?>">Date Wise</button> 
                                                        <!-- </div> -->
                                                        <!-- <div class="col-md-6"> -->
                                                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal2<?php echo $teacherHeadId; ?>">Date Range Wise</button>
                                                        <!-- </div> -->
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="panel panel-default panel-card">
                                    <div class="panel-heading">
                                        <img src="backend/web/uploads/gray.jpg" />
                                        <!-- <button class="btn btn-primary btn-sm" role="button">Follow</button> -->
                                    </div>
                                    <div class="panel-figure">
                                        <!-- <img class="img-responsive img-circle" src="backend/web/uploads/std.png" /> -->
                                    </div>
                                    <div class="panel-body text-center">
                                        <h4 class="panel-header">Student Attendance</h4>
                                        <small>View Student Wise Attendance</small>
                                    </div>
                                    <div class="panel-thumbnails">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div style="text-align: center;">
                                                    <br>
                                                    <!-- <div class="row">
                                                        <div class="col-md-6"> -->
                                                       <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal3<?php echo $teacherHeadId; ?>">Date Wise</button> 
                                                       <!--  </div>
                                                        <div class="col-md-6"> -->
                                                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal4<?php echo $teacherHeadId; ?>">Date Range Wise</button>
                                                    <!--     </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!--Date wise class Modal start -->
<div class="modal fade" id="modal1<?php echo $teacherHeadId; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <p>Attendance Report</p>
                </h4>
            </div>
            <div class="modal-body">
                <div class="conatiner-fluid">
                <br>
                    <div class="box box-danger"  style="border-color:#5CB85C;">
                        <div class="box-header" style="padding:0px;background-color:#d0f2d0;">
                            <h3 class="text-center" style="color:#5CB85C;">Date Wise Class Attendance</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="./datewise-class-atten-view?teacher_id=<?php echo $teacherHeadId ?>&branch_id=<?php echo $branch_id; ?>&class_head_id=<?php echo $class_head_id; ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input class="form-control" data-date-format="dd/mm/yyyy" type="date" name="date" required="">
                                        </div>    
                                    </div><br><br>
                                    <div class="col-md-3">
                                        <div class="form-group"  style="margin-top:3px;">
                                            <button type="submit" name="submit" class="btn btn-success btn-flat form-control" style="margin-top: -25px;">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                            <b>View Attendance</b>
                                            </button>
                                        </div>    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Date wise class Modal close -->

<!--Date Range wise class Modal start -->
<div class="modal fade" id="modal2<?php echo $teacherHeadId; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <p>Attendance Report</p>
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="box" style="border-color:#5CB85C;">
                        <div class="box-header" style="padding:0px;background-color:#d0f2d0;">
                            <h3 class="text-center" style="color:#5CB85C;">Date Range Wise Class Attendance</h3>
                        </div>
                        <div class="box-body">
                           <form method="POST" action="./daterangewise-class-atten-view?teacher_id=<?php echo $teacherHeadId ?>&branch_id=<?php echo $branch_id; ?>&class_head_id=<?php echo $class_head_id; ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                                        </div>    
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                       <label>Start Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" style="color: #3C8DBC"></i>
                                            </div>
                                          <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>End Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" style="color: #3C8DBC"></i>
                                            </div>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div><br>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top:4px;">
                                            <label></label>
                                            <button type="submit" name="submit" class="btn btn-success bt-xs">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                            <b>View Attendance</b></button>
                                        </div>    
                                    </div> 
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--Date Range wise class Modal close -->

<!--Date wise student Modal start -->
  <!-- Modal -->
<div class="modal fade" id="modal3<?php echo $teacherHeadId; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                   <p>Attendance Report</p>
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid"><br>
                    <div class="box" style="border-color:#5CB85C;">
                        <div class="box-header" style="padding:0px;background-color:#d0f2d0;">
                            <h3 class="text-center" style="color:#5CB85C;">Date Wise Student Attendance</h3>
                        </div>
                        <div class="box-body">
                            <form method="POST" action="./datewise-std-atten-view?teacher_id=<?php echo $teacherHeadId ?>&branch_id=<?php echo $branch_id; ?>&class_head_id=<?php echo $class_head_id; ?>">
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
                                            <label>Date</label>
                                            <input class="form-control" data-date-format="dd/mm/yyyy" type="date" name="date" required="">
                                        </div>    
                                    </div>
                                    <?php 
                                        $classDetail = Yii::$app->db->createCommand("SELECT DISTINCT seh.class_name_id, seh.session_id, seh.section_id FROM std_enrollment_head as seh WHERE seh.std_enroll_head_id = '$class_head_id' AND seh.branch_id = '$branch_id'")->queryAll();
                                         $classnameid = $classDetail[0]['class_name_id'];
                                         $sessionid = $classDetail[0]['session_id'];
                                         $sectionid = $classDetail[0]['section_id'];


                                         $students = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_std_id, sed.std_enroll_detail_std_name FROM std_enrollment_detail as sed INNER JOIN std_enrollment_head as seh ON sed.std_enroll_detail_head_id = seh.std_enroll_head_id WHERE seh.class_name_id = '$classnameid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid' ")->queryAll();
                                         $stdCount = count($students);

                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Student</label>
                                            <select class="form-control" name="studentId">
                                                <option value="">Select Student </option>
                                                <?php
                                                for ($i=0; $i <$stdCount ; $i++){
                                                ?>
                                                    <option value="<?php echo $students[$i]["std_enroll_detail_std_id"]; ?>">
                                                            <?php echo $students[$i]["std_enroll_detail_std_name"]; ?> 
                                                    </option>
                                                <?php } ?>
                                            </select>      
                                        </div>    
                                    </div><br>
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top:2px;">
                                            <label></label>
                                            <button type="submit" name="submit" class="btn btn-success form-control" style="margin-top: -25px;">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                            <b>View Attendance</b></button>
                                        </div>    
                                    </div> 
                                    <input type="hidden" name="classnameid" value="<?php echo $classnameid; ?>">
                                    <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>">
                                    <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Date wise student Modal close -->

<!--Date Range wise student Modal start -->
<!-- Modal -->
<div class="modal fade" id="modal4<?php echo $teacherHeadId; ?>" role="dialog">
    <div class="modal-dialog  modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">
                   <p>Attendance Report</p>
              </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid"><br>
                    <div class="box box-danger"style="border-color:#5CB85C;">
                        <div class="box-header" style="padding:0px;background-color:#d0f2d0;">
                            <h3 class="text-center" style="color:#5CB85C;">Date Range Wise Class Attendance</h3>
                        </div>
                        <div class="box-body">
                           <form method="POST" action="./daterangewise-std-atten-view?teacher_id=<?php echo $teacherHeadId ?>&branch_id=<?php echo $branch_id; ?>&class_head_id=<?php echo $class_head_id; ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" name="_csrf" class="form-control" value="<?=Yii::$app->request->getCsrfToken()?>">          
                                        </div>    
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                       <label>Start Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" style="color: #3C8DBC"></i>
                                            </div>
                                          <input type="date" class="form-control" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>End Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar" style="color: #3C8DBC"></i>
                                            </div>
                                            <input type="date" class="form-control" name="end_date">
                                        </div>
                                    </div> 
                                        <?php 
                                        $classDetail = Yii::$app->db->createCommand("SELECT DISTINCT seh.class_name_id, seh.session_id, seh.section_id FROM std_enrollment_head as seh WHERE seh.std_enroll_head_id = '$class_head_id' AND seh.branch_id = '$branch_id'")->queryAll();
                                            $classnameid = $classDetail[0]['class_name_id'];
                                            $sessionid = $classDetail[0]['session_id'];
                                            $sectionid = $classDetail[0]['section_id'];


                                            $students = Yii::$app->db->createCommand("SELECT sed.std_enroll_detail_std_id, sed.std_enroll_detail_std_name FROM std_enrollment_detail as sed INNER JOIN std_enrollment_head as seh ON sed.std_enroll_detail_head_id = seh.std_enroll_head_id WHERE seh.class_name_id = '$classnameid' AND seh.session_id = '$sessionid' AND seh.section_id = '$sectionid' ")->queryAll();
                                            $stdCount = count($students);
                                            ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Student</label>
                                            <select class="form-control" name="studentId">
                                                <option value="">Select Student </option>
                                                <?php
                                                for ($i=0; $i <$stdCount ; $i++){
                                                ?>
                                                    <option value="<?php echo $students[$i]["std_enroll_detail_std_id"]; ?>">
                                                            <?php echo $students[$i]["std_enroll_detail_std_name"]; ?>  
                                                    </option>
                                                <?php } ?> 
                                            </select>      
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label></label>
                                            <button type="submit" name="submit" class="btn btn-success form-control" style="margin-top: -25px;">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>    
                                            <b>View Attendance</b></button>
                                        </div>    
                                    </div>
                                </div> 
                                    <input type="hidden" name="classnameid" value="<?php echo $classnameid; ?>">
                                    <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>">
                                    <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>">
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!--Date Range wise student Modal close -->

</body>
</html>
<?php}
?>
