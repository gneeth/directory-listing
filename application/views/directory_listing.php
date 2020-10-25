<!DOCTYPE html>
<html>
<head>
	<title>Directory Listing</title>

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/datatable.css">


</head>
<body>
	<div class="container">
		<h2 style="text-align: center;">Directory Listing<span style="float: right;"><a href="./upload-new-file" class="btn btn-sm btn-success">Upload New Files</a>&emsp;&emsp;<a href="./files-history" class="btn btn-sm btn-success">History</a></span></h2><br/>
		<div class="row">
			<div class="col-12">
				<div id="message"></div>
				<table id="directory_list" class="display" style="width:100%">
			        <thead>
			            <tr>
			                <th>Sl No</th>
			                <th>File Name</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php $j=1; foreach($directory_list as $directory){
			        		$ext = explode('.', $directory->file_name);
			        	?>
			            <tr>
			                <td><?php echo $j;?></td>
			                <td><?php echo $directory->title_name.'.'.$ext[1];?></td>
			                <td><button class="btn btn-sm btn-danger delete_file">Delete</button><input type="hidden" name="uploadid" value="<?php echo $directory->uploadid;?>" /></td>
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
<script src="./assets/js/jquery.validate.min.js"></script>
<script >
	$(document).ready(function() {
	    $('#directory_list').DataTable();


	    $('body').on('click','.delete_file',function(e){
	    	$('#message').html('');
	    	e.preventDefault();
	    	var uploadid = $(this).parent().find('input[name="uploadid"]').val();
	    	$.ajax({
              url: './delete-files',
              type: 'POST',
              dataType:'json',
              data: {'uploadid':uploadid},
              success: function(response) {
              	
              	$('#message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');
              	$('html, body').animate({scrollTop:$('#message').position().top}, 'slow');
                setTimeout(function(){
                    location.reload(); 
                 }, 2000);
              }
          	})
	    })
	});


</script>
	
</body>


</html>