<!DOCTYPE html>
<html>
<head>
	<title>Directory Listing</title>

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/datatable.css">


</head>
<body>
	<div class="container">
		<h2 style="text-align: center;">History</h2> <span style="float: right;"><a href="../directory-listing" class="btn btn-sm btn-success">List of files</a></span><br/>
		<div class="row">
			<div class="col-12">
				<div id="message"></div>
				<table id="directory_list" class="display" style="width:100%">
			        <thead>
			            <tr>
			                <th>Sl No</th>
			                <th>File Name</th>
			                <th>Created on</th>
			                <th>Deleted on</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $j=1; foreach($directory_list as $directory){
			        		$ext = explode('.', $directory->file_name);
			        	?>
			            <tr>
			                <td><?php echo $j;?></td>
			                <td><?php echo $directory->title_name.'.'.$ext[1];?></td>
			                <td><?php echo date('d-m-Y H:i:s',strtotime($directory->createdon));?></td>
			                <td><?php echo ($directory->deletedon == '0000-00-00 00:00:00' ? '-' : date('d-m-Y H:i:s',strtotime($directory->deletedon)));?></td>
			            </tr>
			            <?php $j++;} ?>
			        </tbody>
			    </table>
				
			</div>
		</div>
	</div>


<script src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="./assets/js/jquery-ui.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/datatable.min.js"></script>

<script >
	$(document).ready(function() {
	    $('#directory_list').DataTable();
	});
</script>

</body>


</html>