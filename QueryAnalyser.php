<?php
class DatabaseExecute {
	function __construct() {}
	function __destruct() {}
}
?>
<html>
	<head>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<style type="text/css">
			.no-radius { border-radius: 0px !important; }
			.form-group { margin-bottom: 5px; }
		</style>
	</head>
	<body>
		<div class='container-fluid text-center'>
			<h3>Query Analyser - <small>Karthik R</small></h3>
			<div class='col-sm-12'>
				<form method='post' action=''>
					<div class='col-sm-9'>
						<textarea class="form-control no-radius" rows="9" placeholder="Query Block "></textarea>
					</div>
					<div class='col-sm-3'>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Host Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Password">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Database Name">
						</div>
						<button type="submit" class="btn btn-primary no-radius col-sm-12 pull-left">Execute</button>
					</div>
				</form>
			</div>
			<div class='col-sm-12'>
				<hr>
			</div>
			<div class='col-sm-12'>
				<div class="table-responsive">
				  <table class="table table-bordered">
				    <tbody>
						<tr>
							<th>test</th>
							<th>test</th>
							<td>test</td>
							<td>test</td>
						</tr>
					</tbody>
				  </table>
				</div>
			</div>
		</div>
	</body>
</html>
