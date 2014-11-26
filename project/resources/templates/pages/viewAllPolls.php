<div class="container">
	<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=newPoll" method="POST">
		<div class="media">
		<br><br><br>
  			
  			
			<?php foreach($polls as $poll): ?>
				<a class="media-left" href="<?=HOME_URL ?>/?page=showPoll">
  			<div class="media-body">
    			<h4 class="media-heading"><?=$poll->title ?></h4>
    			<p><?=$poll->question ?></p>
  			</div>
  			</a>
  			<br>
  			<?php endforeach; ?>
		</div>
	</form>
</div>

<?php var_dump($polls); ?>

<br><br><br>