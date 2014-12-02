<div class="container">
	<div class="media">
    <div class="row">

    <?php if($user_action == "all" & sizeof($polls)!=0): ?>
      <div class="container header">
        <h4>You are now seeing all polls</h4>
      </div>
    <?php elseif($user_action == "all" & sizeof($polls)==0): ?>
      <div class="container">
        <h4>There isn't any polls!</h4>
      </div>  
    <?php elseif($user_action == "search" & sizeof($polls)!=0): ?>
      <div class="container">
        <h4>You are now seeing polls according to "<?= $search_value?>"</h4>
      </div>
    <?php elseif($user_action == "search" & sizeof($polls)==0): ?>
      <div class="container">
        <h4>No results for "<?= $search_value?>"!</h4>
      </div>
    <?php elseif ($user_action == "user" & sizeof($polls)!=0): ?>
      <div class="container">
        <h4>You are now seeing your polls</h4>
      </div>
    <?php elseif ($user_action == "user" & sizeof($polls)==0): ?>
      <div class="container">
        <h4>You have not created any poll yet!</h4>
      </div>
    <?php endif; ?>
			
		<?php foreach($polls as $poll): ?>

      <div class="col-lg-3 col-sm-6 col-xs-12 pull-left">
        <div class="thumbnail">
          <img class="img-responsive pollImage" src="<?=UPLOAD_URL ?>/<?=$poll->image ?>" alt="...">

          <div class="caption">
            <h3 class="pollTitle"><?=$poll->title ?></h3>
            <p class="pollQuestion"><?=$poll->question ?></p>
            <p class="text-right">
              <a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary thumbnailBtn" role="button">
                Details
              </a>
              
              <?php if ($user_action == "user"): ?>
              <a href="<?=HOME_URL ?>/?page=editPoll&poll=<?=$poll->id?>" class="btn btn-default thumbnailBtn" role="button">
                Edit
              </a>

              <a href="#" class="btn btn-danger thumbnailBtn" role="button" data-toggle="modal" data-target="#deleteModal">
                Delete
              </a>
              <?php endif; ?>
            </p>
          </div>
        </div>
      </div>

		<?php endforeach; ?>
    </div>
	</div>
</div>



<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" role="dialog" method="get">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-group row">
            <i class="glyphicon glyphicon-warning-sign col-lg-2"></i>
            <p class="warningInfo col-lg-10">Are you sure you want to delete this poll?</p>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 text-right">
                <a href="<?=HOME_URL ?>/?page=deletePoll&poll=<?=$poll->id?>" role="button" class="btn btn-default">Yes</a>
                <a href="#" role="button" class="btn btn-default" data-dismiss="modal">No</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>