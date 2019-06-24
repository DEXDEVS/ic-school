<?php  
  // Get `emp_id` from `emp_info` table
  $id = $_GET['id'];
  // Employee Personal Info..... 
  $empInfo = Yii::$app->db->createCommand("SELECT * FROM emp_info WHERE emp_id = '$id'")->queryAll();
  $instituteInfo = Yii::$app->db->createCommand("SELECT institute_name, institute_logo FROM institute")->queryAll();
  // Get `emp_designation_id` from `emp_info` table
  $empDesignation = Yii::$app->db->createCommand("SELECT designation_id FROM emp_designation WHERE emp_id = '$id'")->queryAll();
  $empDesignationId = $empDesignation[0]['designation_id'];
  // Employee `desigantion_name` from `emp_designation` table against `$empDesignationId`
  $emp_designation = Yii::$app->db->createCommand("SELECT * FROM designation WHERE designation_id = '$empDesignationId'")->queryAll();
  $empDesignationName = $emp_designation[0]['designation'];
?>

<!-- ID Card Modal start -->
<?php 
$empID    = $empInfo[0]['emp_reg_no'];
$empName  = $empInfo[0]['emp_name'];
$empfName = $empInfo[0]['emp_father_name'];
$empCnic  = $empInfo[0]['emp_cnic'];
$empPhone = $empInfo[0]['emp_contact_no'];
$empPhoto = $empInfo[0]['emp_photo'];
$empEmail = $empInfo[0]['emp_email'];
$empBarcode = $empInfo[0]['barcode'];
$empBlood = "A +ve";
$instituteName = $instituteInfo[0]['institute_name'];
$instituteLogo = $instituteInfo[0]['institute_logo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ID Card</title>
  <style>
    table#background { 
      /*background: url("images/employee_card.png") no-repeat; */
      background-size: 100%;
      background-color: blue;
    }
    @media print{
      .background_image{
        background: url('images/employee_card.png') no-repeat !important;  
        background-size: 100% !important; 
        height: 900px !important; 
        width: 100% !important;
      }
      .contentTable{
        background: url('<?php echo $empPhoto; ?>') no-repeat !important;
        background-size: 100% !important; 
        height: 120px !important; 
        width: 250px !important;
      }
      h3{
        position: absolute;
        top: 100px;
        left: 150px;
        color: #FFF;
      }
    }
    .background_image{
      background: url('images/employee_card.png') no-repeat;  
      background-size: 100%; 
      height: 900px; 
      width: 100%;
    }
    .contentTable{
      position: absolute;
      top: 360px;
      left: 150px;
      background: url('<?php echo $instituteLogo; ?>') no-repeat;
      background-size: 100%; 
      height: 120px; 
      width: 250px;
      opacity: 0.5;
    }
    th, td {
      padding: 5px;
    }
    h3{
      position: absolute;
      top: 100px;
      left: 150px;
      color: #FFF;
    }
</style>
</head>
<body onafterprint="returnBack()">
<!-- onload="window.print();" -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="background_image">
      <h3><?php echo $instituteName; ?></h3>
      <table class="contentTable" height="120px" width="250px">
        <tr>
          <th colspan="2" class="text-center">
            <h4>Anas Shafqat</h4>
          </th>
        </tr>
        <tr>
          <th>ID:</th>
          <td>EMP-001</td>
        </tr>
        <tr>
          <th>Designation:</th>
          <td>Teacher</td>
        </tr>
        <tr>
          <th>CNIC:</th>
          <td>31303-0437738-9</td>
        </tr>
        <tr>
          <th>Phone No.</th>
          <td>+923317375027</td>
        </tr>
      </table>
    </div>
  </div>
  </div>

</div>


<div class="modal-body employee_card">  

<div class="row">
  <div class="col-md-12">
  <div id="id-card">  
    <img src="images/employee_card.png" width="100%" class="img-responsive" style="position: relative; top: 0; left: 0;">
    <!-- employee photo -->
    <img src="<?php echo $empPhoto; ?>" width="163px" height="163px" style="position: absolute; top: 183px; left: 197px; border-radius: 100px;">
    <!-- employee name -->
  <h3 style="font-family: verdana; position: absolute; top: 335px; left: 180px; color: #110037">
      <?php echo $empName; ?>
    </h3>
    <!-- employee father name -->
    <h5 style="font-family: verdana; position: absolute; top: 300px; right: 420px; color: #110037">
      <?php echo $empfName; ?>
    </h5>
    <!-- employee ID -->
    <h5 style="font-family: verdana; position: absolute; top: 418px; left: 250px; color: #110037">
      <b><?php echo $empID; ?></b>
    </h5>
    <!-- employee designation -->
    <h5 style="font-family: verdana; position: absolute; top: 445px; left: 250px; color: #110037">
      <b><?php echo $empDesignationName; ?></b>
    </h5>
    <!-- employee cnic -->
    <h5 style="font-family: verdana; position: absolute; top: 477px; left: 250px; color: #110037">
      <b><?php echo $empCnic; ?></b>
    </h5>
    <!-- employee phone -->
    <h5 style="font-family: verdana; position: absolute; top: 507px; left: 250px; color: #110037">
      <b><?php echo $empPhone; ?></b>
    </h5>
    <!-- employee phone -->
    <h5 style="font-family: verdana; position: absolute; top: 533px; left: 250px; color: #110037">
      <b><?php echo $empBlood; ?></b>
    </h5>

  <img src="<?php echo $empBarcode; ?>" style="position: absolute; top: 445px; right: 230px;">
  
  </div>
  </div>
</div>
</div>

</body>
</html>
<script>
function returnBack() {
  window.location='emp-info-view?id=<?php echo $id; ?>';
}
</script>