<?php
$pdo = null;
class DatabaseExecute {
	private $pdo = null;
	public $columns = [];
	public $result = [];
	function __construct($host,$username,$password,$database) {
		try {
		    $this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
		    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();die;
		}
	}
	public static function createObj($host,$username,$password,$database) {
		$obj = new DatabaseExecute($host,$username,$password,$database);
		return $obj;
	}
	public function execute($query_block) {
		try {
		    $stmt = $this->pdo->query($query_block);
			$total_column = $stmt->columnCount();
			for ($counter = 0; $counter < $total_column; $counter ++) {
			    $meta = $stmt->getColumnMeta($counter);
			    $this->columns[] = $meta['name'];
			}
			$stmt = $this->pdo->prepare($query_block);
			$stmt->execute();
			$this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();die;
		}
	}
	function __destruct() {
		$this->pdo = null;
	}
}
if(!empty($_POST)) {
	$pdo = DatabaseExecute::createObj($_REQUEST['host_name'],$_REQUEST['username'],$_REQUEST['password'],$_REQUEST['database']);
	$pdo->execute($_REQUEST['query_block']);
}
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"> -->
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
		<!-- <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css"> -->

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
		<!--<script type="text/javascript" src="//cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>-->

		<style type="text/css">
			.no-radius { border-radius: 0px !important; }
			.form-group { margin-bottom: 5px; }
			.table-container table{ font-size: small !important; }
			.query-block-container {
				position: fixed;
				top: 0px;
				left: 0px;
				bottom: 65%;
				z-index: 1000;
				background: #E7E7E7;
			}
			.answer-block-container {
				position: absolute;
				top: 220px;
				left: 0px;
				max-height: 100%;
			}
		</style>
		<script type="text/javascript">
		$(document).ready(function(){
		    $('.table').DataTable({
		    	"searching": false,
		    	"lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ]
		    });
		    /*var table = $('.table').DataTable();
    		new $.fn.dataTable.FixedHeader( table );*/
		});
		</script>
	</head>
	<body>
		<div class='container-fluid text-center'>
			<div class='col-sm-12 query-block-container'>
				<h4>Query Analyser - <small>Karthik R</small></h4>
				<form method='post' action=''>
					<div class='col-sm-9'>
						<textarea class="form-control no-radius" rows="9" placeholder="Query Block " name="query_block"><?= $_REQUEST['query_block']; ?></textarea>
					</div>
					<div class='col-sm-3'>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Host Name" name="host_name" value="<?= $_REQUEST['host_name']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Username" name="username" value="<?= $_REQUEST['username']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Password" name="password" value="<?= $_REQUEST['password']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control no-radius" placeholder="Database Name" name="database" value="<?= $_REQUEST['database']; ?>">
						</div>
						<button type="submit" class="btn btn-primary no-radius col-sm-12 pull-left">Execute</button>
					</div>
				</form>
			</div>
			<div class='col-sm-12 answer-block-container'>
				<hr>
				<div class="table-responsive table-container">
				  <table class="table table-bordered">
				  	<thead>
				  		<?php
				  			if($pdo != null) {
				  				foreach ($pdo->columns as $key => $value) {
				  				?>
				  					<th><?= $value; ?></th>
				  				<?php
				  				}
				  			}
				  		?>
				  	</thead>
				    <tbody>
						<?php
						if($pdo != null) {
							foreach ($pdo->result as $rowKey => $row) {
								?>
								<tr>
									<?php
									foreach ($row as $columnKey => $column) {
										?>
										<td><?= $column; ?></td>
										<?php
									}
									?>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				  </table>
				</div>
			</div>
		</div>
	</body>
</html>
