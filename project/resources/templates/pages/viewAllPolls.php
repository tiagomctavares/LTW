<div class="container">
	<div class="media">
    <div class="row">
    
    <?php if ($user_action == "user" & sizeof($polls)!=0): ?>
      <div class="container viewPollsHeader col-lg-12">
        <h4>You are now seeing your polls</h4>
      </div>
    <?php elseif ($user_action == "user" & sizeof($polls)==0): ?>
      <div class="container viewPollsHeader col-lg-12">
        <h4>You have not created any poll yet!</h4>
      </div>
    <?php endif; ?>
			<div class="clearfix"></div>
      <div id="masonry_container">
  		<?php foreach($polls as $poll): ?>
        <div class="col-lg-3 col-sm-6 col-xs-12 masonry_item">
          <div class="thumbnail">
            <?php if($poll->image != ''): ?>
            <img class="img-responsive pollImage" src="<?=UPLOAD_URL ?>/<?=$poll->image ?>" alt="...">
            <?php endif ?>

            <div class="caption">
              <h3 class="pollTitle"><?=$poll->title ?></h3>
              <p class="pollQuestion"><?=$poll->question ?></p>
              <?php if($poll->isPublic == 1): ?>
                <p><small class="text-muted"><i class="glyphicon glyphicon-eye-open"></i> Public</small></p>
              <?php else: ?>
                <p><small class="text-muted"><i class="glyphicon glyphicon-eye-close"></i> Private</small></p>
              <?php endif ?>
              <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?=$poll->createDate ?></small></p>
              <p class="text-center">
                <a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary thumbnailBtn" role="button">
                  Vote
                </a>
                
                <?php if ($user_action == "user"): ?>
                <a href="<?=HOME_URL ?>/?page=editPoll&poll=<?=$poll->id?>" class="btn btn-default thumbnailBtn" role="button">
                  Edit
                </a>

                <a href="<?=HOME_URL ?>/?page=closePoll&poll=<?=$poll->id?>" class="btn btn-danger thumbnailBtn" role="button" data-toggle="modal" data-target="#deleteModal">
                  Close
                </a>

                <a href="<?=HOME_URL ?>/?page=resultsPoll&poll=<?=$poll->id?>" class="btn btn-danger thumbnailBtn" role="button">
                  Results
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
</div>



<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" role="dialog" method="get">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-group row" id="alertText">
            <i class="glyphicon glyphicon-warning-sign col-lg-1"></i>
            <p class="warningInfo col-lg-11">Are you sure you want to delete this poll?</p>
        </div>

        <div class="form-group row">
            <div class="col-lg-12 text-right">
                <a href="<?=HOME_URL ?>/?page=deletePoll&poll=<?=$poll->id?>" role="button" class="btn btn-default deleteBTN">Yes</a>
                <a href="#" role="button" class="btn btn-default deleteBTN" data-dismiss="modal">No</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>