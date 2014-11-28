<div class="container">
	<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=newPoll" method="POST">
		<!--TITLE-->	
		<div class="form-group has-feedback">
		    <label for="title" class="col-lg-2">Title</label>
		    <div class="col-lg-10">
		   		<input type="text" class="form-control" id="title" placeholder="Poll Title" name="title" required>
			</div>
		</div>
		
		<!--QUESTION-->  	
		<div class="form-group has-feedback">
		    <label for="question" class="col-lg-2">Question</label>
		    <div class="col-lg-10">
		   		<input type="text" class="form-control" id="question" placeholder="Question" name="question" required>
			</div>
		</div>
		
		<!-- Visability -->
		<div class="form-group">
			<label for="visability" class="col-lg-2">Visability</label>
			<div class=" col-lg-2">
				<select class="form-control" id="visability" name="isPublic">
				  <option>Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
				  <option>Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
				</select>
			</div>
		</div>
		
		<!--IMAGE UPLOAD-->
		<!-- The fileinput-button span is used to style the file input field as button -->
	    <span class="btn btn-success fileinput-button">
	        <i class="glyphicon glyphicon-plus"></i>
	        <span>Select files...</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileupload" type="file" name="image" multiple>
	    </span>
	    <!-- The global progress bar -->
	    <div id="progress" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="files" class="files"></div>

		<!--SUBMIT BUTTON-->
		<div class="form-group">
		    <div class="col-lg-12 text-right">
				<button type="submit" class="btn btn-info">Create</button>
		    </div>
		</div>
	</form>
</div>