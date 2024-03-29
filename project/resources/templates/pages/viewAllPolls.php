<div class="container" id="managePolls">
	<div class="media">
    <div class="row">
      <div class="row filters col-lg-4 col-sm-4 col-xs-12">
        <div class="col-lg-12">
        <h4><i class="glyphicon glyphicon-lock"></i> Status</h4>
          <ul class="list-group filter_options">
            <li id="open_closed" class="list-group-item btn active">
              <a href="#" class="filtersText">Open & Closed<span class="badge pull-right"><?=$counters['numberPolls'] ?></span></a>
            </li>
            <li id="open" class="list-group-item btn">
              <a href="#" class="filtersText">Open<span class="badge pull-right"><?=$counters['openPolls'] ?></span></a>
            </li>
            <li id="closed" class="list-group-item btn">
              <a href="#" class="filtersText">Closed<span class="badge pull-right"><?=$counters['closedPolls'] ?></span></a>
            </li>
          </ul>
        </div>

        <div class="col-lg-12">
        <h4><i class="glyphicon glyphicon-eye-open"></i> Visibility</h4>
          <ul class="list-group filter_options">
            <li id="public_closed" class="list-group-item btn active">
              <a href="#" class="filtersText">Public/Private<span class="badge pull-right"><?=$counters['numberPolls'] ?></span></a>
            </li>
            <li id="public" class="list-group-item btn">
              <a href="#" class="filtersText">Public<span class="badge pull-right"><?=$counters['publicPolls'] ?></span></a>
            </li>
            <li id="private" class="list-group-item btn">
              <a href="#" class="filtersText">Private<span class="badge pull-right"><?=$counters['privatePolls'] ?></span></a>
            </li>
          </ul>
        </div>

        <div class="col-lg-12">
        <h4><i class="glyphicon glyphicon-stats"></i> Vote</h4>
          <ul class="list-group filter_options">
            <li id="voted_unvoted" class="list-group-item btn active">
              <a href="#" class="filtersText">All<span class="badge pull-right"><?=$counters['numberPolls'] ?></span></a>
            </li>
            <li id="voted" class="list-group-item btn">
              <a href="#" class="filtersText">Voted<span class="badge pull-right"><?=$counters['votedPolls'] ?></span></a>
            </li>
            <li id="unvoted" class="list-group-item btn">
              <a href="#" class="filtersText">Not Voted<span class="badge pull-right"><?=$counters['unvotedPolls'] ?></span></a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- SHOW POLLS -->
      <h4 class="col-lg-8 col-sm-8 col-xs-12"><i class="glyphicon glyphicon-th-list"></i> Polls</h4>
      <div class="container col-lg-8 col-sm-8 col-xs-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php foreach($polls as $key=>$poll): ?>
            <div class="panel panel-default" id="accordion_item">
              <div class="panel-heading col-lg-12" role="tab" id="heading<?=$key ?>">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key ?>" aria-expanded="false" aria-controls="collapse<?=$key ?>">
                    <?=$poll->title ?>   
                    <small class="text-muted pull-right">
                      <i class="glyphicon glyphicon-<?=$poll->isClosed?'lock':''?>"></i>
                      <i class="glyphicon glyphicon-<?=$poll->isPublic?'eye-open':'eye-close'?>"></i>
                      <i class="glyphicon glyphicon-time"></i> 
                      <?=$poll->createDate ?>
                    </small>
                  </a>
                </h4>
              </div>
              <div id="collapse<?=$key ?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="heading<?=$key ?>">
                <div class="panel-body">
                  <?php if($poll->image != ''): ?>
                  <img class="img-responsive pollImage col-lg-6 col-md-6 col-sm-6 col-xs-12" src="<?=UPLOAD_URL ?>/<?=$poll->image ?>" alt="...">
                  <?php endif ?>
                  
                  <div class="container <?=$poll->image != ''?'col-lg-6 col-md-6 col-sm-6 col-xs-12':'col-lg-12'?>">
                    <h4 class="pollQuestion col-lg-12"><?=$poll->question ?></h4>
                    
                    <?php if($poll->isClosed != 0): ?>
                      <p class="text-danger"><i class="glyphicon glyphicon-lock"></i> This poll is closed!</p>
                      
                      <a href="<?=HOME_URL ?>/?page=resultsPoll&poll=<?=$poll->id?>" class="btn thumbnailBtn pull-right" role="button">
                        Results
                      </a>

                      <a href="#" class="btn thumbnailBtn pull-right" role="button" data-toggle="modal" data-target="#deleteModal">
                        Delete
                      </a>
                    <?php else: ?>
                      <a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn thumbnailBtn pull-right" role="button">
                        Vote
                      </a>

                      <a href="<?=HOME_URL ?>/?page=editPoll&poll=<?=$poll->id?>" class="btn thumbnailBtn pull-right" role="button">
                        Edit
                      </a>

                      <a href="<?=HOME_URL ?>/?page=closePoll&poll=<?=$poll->id?>" class="btn thumbnailBtn pull-right" role="button">
                        Close
                      </a>

                      <a href="<?=HOME_URL ?>/?page=resultsPoll&poll=<?=$poll->id?>" class="btn thumbnailBtn pull-right" role="button">
                        Results
                      </a>
                    <?php endif ?>   
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
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

