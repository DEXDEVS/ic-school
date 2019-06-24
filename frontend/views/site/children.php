<?php 

	$guardianCnic = Yii::$app->user->identity->username;
	$childrenIds = Yii::$app->db->createCommand("SELECT std_id FROM std_guardian_info WHERE guardian_cnic = '$guardianCnic'")->queryAll();
	$countChildrens = count($childrenIds);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
	<?php 
	for ($j=0; $j <$countChildrens ; $j++) { 
		$childrenID = $childrenIds[$j]['std_id'];
	$childrenData = Yii::$app->db->createCommand("SELECT * FROM std_personal_info WHERE std_id = '$childrenID'")->queryAll();
	$childPhoto = $childrenData[0]['std_photo'];
	$std_b_form = $childrenData[0]['std_b_form'];
	 ?>
		<div class="col-md-4">
			<div class="box box-default">
				<div class="box-header">
					<img class="profile-user-img img-responsive img-circle" src="<?php echo './backend/web/'.$childPhoto; ?>">
					<h4 class="text-center">
						<a href="./std-profile?std_b_form=<?php echo $std_b_form; ?>">
						<?php echo $childrenData[0]['std_name']; ?>
						</a>
					</h4>
					<p class="text-center"><?php echo $childrenData[0]['std_reg_no']; ?></p>
					<table class="table">
					<tr>
						<th>Class</th>
						<td>5th</td>
					</tr>
					<tr>
						<th>Roll.#</th>
						<td>
							<a href="#">021</a>
						</td>
					</tr>
					<tr>
						<th>Session</th>
						<td><a href="#">2019-2020</a></td>
					</tr>
					<tr>
						<th>Section</th>
						<td><a href="#">Green</a></td>
					</tr>
					<tr>
						<th>Status</th>
						<td><?php echo $childrenData[0]['status']; ?></td>
					</tr>
					</table>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
</body>
</html>