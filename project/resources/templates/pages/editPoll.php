<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>

<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" id="editPoll">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12 col-sm-12 col-xs-12">Editing a poll...</h2>
		<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
		
		<div class="col-lg-2 col-sm-1 transpDiv"></div>
		<div class="col-lg-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=action_editPoll" method="POST" enctype="multipart/form-data">
				<!--TITLE-->	
				<div class="form-group has-feedback">
				    <label for="title" class="col-lg-2">Title</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="title" placeholder="<?=$polls->title ?>" value="<?=$polls->title ?>" name="title" required>
					</div>
				</div>
				
				<!--QUESTION-->  	
				<div class="form-group has-feedback">
				    <label for="question" class="col-lg-2">Question</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="question" placeholder="<?=$polls->question ?>" value="<?=$polls->question ?>" name="question" required>
					</div>
				</div>
				
				<!-- Visability -->
				<div class="form-group">
					<label for="visability" class="col-lg-2">Visability</label>
					<div class=" col-lg-4">
						<select class="form-control" id="visability" value="<?=$polls->visability ?>" placeholder="<?=$polls->visability ?>" name="isPublic">
						  <option value="1" selected>Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
						  <option value="0">Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>

						</select>
					</div>
				</div>
				
				<!-- Image -->
				<div class="form-group">
					<label for="image" class="col-lg-2">Image</label>
					<img class="img-responsive pollImage" src="<?=UPLOAD_URL ?>/<?=$polls->image ?>" alt="...">
					<div class=" col-lg-10">
						<input type="file" id="image" name="image" class="form-control">
					</div>
				</div>

				<!-- ANSWERS -->
				<div class="example-row">
					<div class="example example-one" id="answersGroup">
						<h4> Modifies a Answer will reset all answers and votes</h4>
						<label id="answersLabel" for="answers" class="col-lg-2"> Answers </label>
						<div class="col-lg-10">
							<ul class="list-unstyled">
								<?php for($i=0; $i < 2; $i++): 
									$answer = $polls->answers[$i]; ?>
									<li>
										<input type="text" number="$i+1" class="form-control" id="answers" value="<?=$answer->answer ?>" placeholder="<?=$answer->answer ?>" name="answer<?=$i+1 ?>" required>
									</li>
								<?php endfor; ?>

								<?php for($i=2; $i < count($polls->answers); $i++): 
									$answer = $polls->answers[$i]; ?>
									<li>
										<input type="text" number="$i+1" class="form-control" id="answers" value="<?=$answer->answer ?>" placeholder="<?=$answer->answer ?>" name="answer<?=$i+1 ?>">
									</li>
								<?php endfor; ?>
							</ul>
						</div>
						
						<button type="button" class="btn_add">
							Add
						</button>
						<button type="button" class="btn_remove">
							Remove
						</button>
					</div>
				</div>
				<br>
				<!--EDIT BUTTON-->
				<div class="form-group">
				    <div class="col-lg-12 text-right">
						<button type="edit" class="btn btn-info btn_edit">Edit</button>
				    </div>
				</div>
			</form>
		</div>
		<div class="col-lg-2 col-sm-1 transpDiv"></div>
	</div>
</div>

<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>
