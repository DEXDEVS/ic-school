<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="./view?catId=<?php echo $examCateogryId;?>" style="float: right;" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-backward"></i> Back</a>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header">
					<h2>Final Term Exam</h2>
					<p>Result Cards</p>
				</div><hr>
				<div class="box-body">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Sr.#</th>
								<th>Class Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>9th</td>
								<td>
									<a href="">
										<button class="btn btn-warning btn-xs">View</button>
									</a>
									<a href="">
										<button class="btn btn-success btn-xs">Announce Result</button>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>