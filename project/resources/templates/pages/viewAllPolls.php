
<div class="container" style="margin-top:100px;">
	<div class="media">
    <div class="row">
			
		<?php foreach($polls as $poll): ?>

      <div class="col-lg-3 col-sm-6 col-md-4 pull-left">
        <div class="thumbnail">
          <img data-src="holder.js/300x300" alt="...">
          <div class="caption">
            <h3><?=$poll->title ?></h3>
            <p><?=$poll->question ?></p>
            <p>
              <a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary" role="button">
                Details
              </a>
            </p>
          </div>
        </div>
      </div>

		<?php endforeach; ?>
    </div>
	</div>
</div>