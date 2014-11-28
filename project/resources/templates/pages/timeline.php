<section id="cd-timeline" class="cd-container">
	<?php foreach($polls as $poll): ?>
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-picture">
			<img src="<?=UPLOAD_URL ?>/<?=$poll->image ?>" alt="Picture">
		</div> 

		<div class="cd-timeline-content">
			<h2><?=$poll->title ?></h2>
			<p><?=$poll->question ?></p>
			<a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary cd-read-more" role="button">Details</a>
		</div>
	</div>
	<?php endforeach; ?>
</section>