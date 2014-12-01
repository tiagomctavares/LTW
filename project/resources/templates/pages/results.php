<div class="container">
	<form method="GET" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<input type="hidden" name="id" value= "<?=$polls->id ?>" >
	  	<h1><?=$polls->title ?></h1>
	    <h4><?=$polls->question ?></h4>

		<?php foreach ($polls->answers as $answers): ?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
					<span class="sr-only">40% Complete (success)</span>
				</div>
			</div>
	    <?php endforeach; ?>

	    <button>
	    	Vote
	    </button>
    </form>
</div>
