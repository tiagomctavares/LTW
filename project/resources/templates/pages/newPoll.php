<div class="container">
	<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=action_newPoll" method="POST" enctype="multipart/form-data">
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
				  <option value="1">Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
				  <option value="0">Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
				</select>
			</div>
		</div>
		
		<!-- Image -->
		<div class="form-group">
			<label for="image" class="col-lg-2">Image</label>
			<div class=" col-lg-2">
				<input type="file" id="image" name="image">
			</div>
		</div>

		<!--SUBMIT BUTTON-->
		<div class="form-group">
		    <div class="col-lg-12 text-right">
				<button type="submit" class="btn btn-info">Create</button>
		    </div>
		</div>
	</form>
</div>
<?php var_dump($_POST); var_dump($errors); ?>