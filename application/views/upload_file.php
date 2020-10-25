<!DOCTYPE html>
<html>
<head>
	<title>Upload New Files</title>

	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/datatable.css">
	<style >
		.error{
			color: red;
		}
	</style>

</head>
<body>
	<div class="container">
		<h2 style="text-align: center;">Upload New File</h2> <span style="float: right;"><a href="../directory-listing" class="btn btn-sm btn-success">List of files</a></span><br/>
		<div class="row">
			<div class="col-12">
				<div id="message"></div>
				<form id="upload_new_file">
					<div class="row">
	                  <div class="col-6">
	                    <div class="form-group"><label>Title<span style="color: red;">*</span></label>
	                      <input type="text" class="form-control" id="title" name="title" placeholder="Title" />
	                    </div>
	                  </div>
	              	</div>

	              	<div class="row">
	                  <div class="col-6">
	                    <div class="form-group"><label>Upload Here<span style="color: red;">*</span></label>
	                      <input type="file" class="form-control" id="file" name="file" accept="jpg" />
	                    </div>
	                  </div>
	              	</div>


	              	<div class="row">
	                  <div class="col-6">
	                  	<button class="btn btn-success" id="upload_file" type="submit">Upload</button>
	                  </div>
	                </div>


					
				</form>
				
			</div>
		</div>
	</div>




<script src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="./assets/js/jquery-ui.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/datatable.min.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>

<script >
	
	$("#upload_new_file").validate({
        rules: {  
            title:{
              required:true,
              maxlength:200
            },
            file:{
            	required:true,
            }
        },
        messages:{
        	title:"Enter a title",
        	file:"Upload a file"
        }
    })


    $('input[type="file"]').change(function () {
    	$('#message').html('')
	    var ext = this.value.match(/\.(.+)$/)[1];
	    switch (ext) {
	        case 'txt':
	        case 'doc':
	        case 'docx':
	        case 'pdf':
	        case 'png':
	        case 'jpeg':
	        case 'jpg':
	        case 'gif':
	        	if (this.files[0].size > 2097152) { 
			    	$('#message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Try to upload file less than 2MB!</div>')
			            this.value = '';
		        }
	            break;
	        default:
	            $('#message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>This is not an allowed file type.</div>')
	            this.value = '';
	    }
	    
	});



     	$("#upload_new_file").submit(function(e) {
            e.preventDefault();
            $('#message').html('');
            formData = new FormData(this);
            if($('#upload_new_file').valid())
            {
            	$('#upload_file').prop('disabled', true);
              	$.ajax({
                  url: './upload-files',
                  type: 'POST',
                  dataType:'json',
                  data: formData,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function(response) {
                  	$('#upload_file').prop('disabled', false);
                  	if(response.status == true)
                  	{
                  		$('#message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');
                  		$('#title').val('')
                  		$('#file').val('')
                  	}
                  	else
                  	{
                  		$('#message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.message+'</div>');
                  	}
                  }
              	})
            }
        })



</script>
	
</body>


