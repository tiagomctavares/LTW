<div class="container">
  <div class="row page-header">
    <div class="col-lg-4 center-block">
      <?php if($user_action == "all" & sizeof($polls)!=0): ?>
        <h2 id="timeline">You are now seeing all polls</h2>
      <?php elseif($user_action == "all" & sizeof($polls)==0): ?>
        <h2 id="timeline">There isn't any polls!</h2>
      <?php elseif($user_action == "search" & sizeof($polls)!=0): ?>
        <h2 id="timeline">Results for "<?= $search_value?>"</h2>
      <?php elseif($user_action == "search" & sizeof($polls)==0): ?>
        <h2 id="timeline">No results for "<?= $search_value?>"!</h2>
      <?php endif; ?>
    </div>
  </div>

  <ul class="timeline">
    <?php $index=0; foreach($polls as $poll): ?>
    <?php if($index & 1): ?>
     <li class="timeline-inverted">
    <?php else: ?>
    <li>
    <?php endif ?>
      <div style="<?=$poll->hasVoted?'background-color:green;':''?>" class="timeline-badge"  data-toggle="tooltip" data-placement="top" title="<?=$poll->hasVoted?'You voted this poll':"You didn't voted this poll"?>">
        <i style="<?=!$poll->hasVoted?'color:#fff;':''?>" class="glyphicon glyphicon-<?=$poll->hasVoted?'check':'unchecked' ?>"></i>
      </div>
      
      <div class="timeline-panel">
        <?php if($poll->image != ''): ?>
        <div class="col-lg-6 col-sm-6 col-xs-12 timeline-image">
          <img class="img-responsive" src="<?=UPLOAD_URL ?>/<?=$poll->image ?>" alt="Picture">
        </div>
        <?php endif ?>
        
        <div class="timeline-heading col-lg-6 col-sm-6 col-xs-12">
          <h3 class="timeline-title"><?=$poll->title ?></h3>
          <p class="timeline-question"><?=$poll->question ?></p>
          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?=$poll->createDate ?></small></p>
        </div>
        <?php if($poll->isClosed == 0 ): ?>
        <a href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary thumbnailBtn  col-lg-3 col-sm-4 col-xs-6 pull-right" role="button">
          Vote
        </a>
      <?php else: ?>
        <a href="<?=HOME_URL ?>/?page=resultsPoll&poll=<?=$poll->id?>" class="btn btn-primary thumbnailBtn  col-lg-3 col-sm-4 col-xs-6 pull-right" role="button">
          Results
        </a>
      <?php endif ?>
      </div>
    </li>
    <?php $index++; endforeach; ?>
  </ul>
</div>