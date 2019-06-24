<?php 
  	use yii\helpers\Html;	
	$id = Yii::$app->user->identity->id;
	$user = Yii::$app->db->createCommand("SELECT *FROM  user WHERE id = '$id'")->queryAll();
	$branchId = $user[0]['branch_id']; 
	$branchName = Yii::$app->db->createCommand("SELECT branch_name FROM  branches WHERE branch_id = '$branchId'")->queryAll();
?>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container-fluid">
		<div class="well well-sm" style="border-left:2px solid;border-radius:10px;">
		<h4 style="font-weight:bolder;"><i class="glyphicon glyphicon-hand-right"></i> User Profile</h4>
	</div>
	<div class="box box-primary col-md-12">
		<!-- <div class="box-header"></div> -->
		<div class="box-body">
			<table class="table table-hover table-responsive table-striped table-bordered">
				<thead>
					<tr class="bg-navy">
						<th class="text-center">First Name</th>
						<th class="text-center">Last Name</th>
						<th class="text-center">User Name</th>
						<th class="text-center">User Type</th>
						<th class="text-center">Email</th>
						<th class="text-center">Branch</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center"><?php echo $user[0]['first_name']; ?></td>
						<td class="text-center"><?php echo $user[0]['last_name']; ?></td>
						<td class="text-center"><?php echo $user[0]['username']; ?></td>
						<td class="text-center"><?php echo $user[0]['user_type']; ?></td>
						<td class="text-center"><?php echo $user[0]['email']; ?></td>
						<td class="text-center"><?php echo $branchName[0]['branch_name']; ?></td>
						<td class="text-center">
							<?= Html::a(' Update',['update-profile'],['class'=>'btn btn-primary btn-sm fa fa-edit']) ?>
							<?= Html::a(' Reset Password',['../site/request-password-reset','id'=>$id],['class'=>'btn btn-warning btn-sm fa fa-key']) ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	</div>
</body>
</html>