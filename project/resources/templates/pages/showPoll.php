<div class="col-lg-2 col-md-2 col-sm-2 transpDiv"></div>

<div class="container thumbnail col-lg-8 col-md-8 col-sm-8" id="votePollCont">	
	<form method="POST" class="col-lg-12" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<input type="hidden" name="id" value= "<?=$polls->id ?>" >
		  	<h1><?=$polls->title ?></h1>
		    <h4><?=$polls->question ?></h4>

			<?php foreach ($polls->answers as $answer): ?>
	    		<div class="row">
				  <div class="col-lg-12 ">
				    <div class="input-group">
				      <span class="input-group-addon" id="voteCheckbox">
				        <input class="voteRadioBtn" type="radio" name="answer" value="<?=$answer->id ?>" <?=$answer->id == $polls->userAnswer?"checked='checked'":'' ?>>
				      </span>
				      <p> <?= $answer->answer ?> </p>
				    </div>
				  </div>
				</div>
		    <?php endforeach; ?>
			
			<a type="button" class="thumbnailBtn backBtn" href="<?=HOME_URL ?>/page=<?=$previous_page?>">
		    	<button type="button">Back</button>
		    </a>

		    <button>
		    	Vote
		    </button>
	    </div>
		
		<div class="col-lg-6 col-sm-6 col-xs-12" id="imageCont">
			<?php if($polls->image != ''): ?>
			  <img class="img-responsive pollImage col-lg-12 col-sm-12 col-xs-12" src="<?=UPLOAD_URL ?>/<?=$polls->image ?>" alt="...">
			<?php endif ?>
			<ul id="share-buttons" class="col-lg-12 col-sm-12 col-xs-12">
				<li><!-- Facebook -->
					<a href="http://www.facebook.com/sharer.php?u=<?=HOME_URL ?>" target="_blank" id="share-button-facebook">
						<img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
					</a>
				</li>
				 
				<li><!-- Twitter -->
					<a href="http://twitter.com/share?url=<?=HOME_URL ?>&text=Pool&hashtags=polls" target="_blank">
						<img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
					</a>
				</li>
				 
				<li><!-- Google+ -->
					<a href="https://plus.google.com/share?url=<?=HOME_URL ?>" target="_blank">
						<img src="http://www.simplesharebuttons.com/images/somacro/google.png" alt="Google" />
					</a>
				</li>
				 
				<li><!-- LinkedIn -->
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=HOME_URL ?>" target="_blank">
						<img src="http://www.simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
					</a>
			 	</li>
			</ul>
		</div>
    </form>
</div>

<div class="col-lg-2 col-md-2 col-sm-2 transpDiv"></div>