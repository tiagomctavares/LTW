<div class="container">
	<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=newPoll" method="POST">
		<div class="form-group has-feedback">
		    <label for="title" class="col-md-2">Title</label>
		    <div class="col-md-10">
		   		<input type="text" class="form-control" id="title" placeholder="Poll Title" name="title">
			</div>
		</div>
		  	
		<div class="form-group has-feedback">
		    <label for="question" class="col-md-2">Question</label>
		    <div class="col-md-10">
		   		<input type="text" class="form-control" id="question" placeholder="Question" name="question">
			</div>
		</div>

		<div class="fileupload fileupload-new" data-provides="fileupload">
			<span class="btn btn-primary btn-file">
				<span class="fileupload-new">Select file</span>
				<!--<span class="fileupload-exists">Change</span>         
				<input type="file" />-->
			</span>
			<span class="fileupload-preview"></span>
			<a href="#" class="close fileupload-exists" data-dismiss="fileupload">×</a>
		</div>

		<div class="form-group">
		    <div class="col-lg-12 text-right">
				<button type="submit" class="btn btn-info">Create</button>
		    </div>
		</div>
	</form>
</div>