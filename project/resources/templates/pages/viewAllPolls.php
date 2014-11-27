
<div class="container">
	<div class="media">
    <div class="row">

    <?php if($user_action == "all"): ?>
      <div class="container">
        <h4>You are now seeing all polls</h4>
      </div> 
    <?php elseif($user_action == "search" & sizeof($polls)!=0): ?>
      <div class="container">
        <h4>You are now seeing polls according to "<?= $search_value?>"</h4>
      </div>
    <?php elseif($user_action == "search" & sizeof($polls)==0): ?>
      <div class="container">
        <h4>No results for "<?= $search_value?>"</h4>
      </div>
    <?php elseif ($user_action == "user"): ?>
      <div class="container">
        <h4>You are now seeing your polls</h4>
      </div>
    <?php endif ?>
			
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
              
              <?php if ($user_action == "user"): ?>
              <a href="<?=HOME_URL ?>/?page=editPoll&poll=<?=$poll->id?>" class="btn btn-default" role="button">
                Edit
              </a>
              <?php endif ?>
            </p>
          </div>
        </div>
      </div>

		<?php endforeach; ?>
    </div>
	</div>
</div>