<div class="container">
	<form method="GET" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<input type="hidden" name="id" value= "<?=$polls->id ?>" >
	  	<h1><?=$polls->title ?></h1>
	    <h4><?=$polls->question ?></h4>

	    <?php $sum = 0; ?>
	    <?php foreach ($polls->answers as $answers): ?>
	    	$sum += $answers->votes;
	    <?php endforeach; ?>

		<?php foreach ($polls->answers as $answers): ?>
			<div class="progress">
				<?php $perc = answers->votes/$sum * 100 ?>
				<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?=$perc ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$perc ?>%">
					<span class="sr-only"> <?=$perc ?>% Complete (success)</span>
				</div>
			</div>
	    <?php endforeach; ?>

	    <button>
	    	Vote
	    </button>
    </form>
</div>
