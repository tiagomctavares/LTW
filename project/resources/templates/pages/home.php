<div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">
    <?php foreach ($polls as $key => $poll): ?>
      <?php if($key ==5)break; ?>
      <?php if($key == 0): ?>
      <div class="item active">
      <?php else: ?>
      <div class="item">
      <?php endif ?>
        <div class="col-lg-2 col-md-1 col-sm-1 transpDiv"></div>
        <div class="carousel-panel col-lg-8 col-md-10 col-sm-10 col-xs-12">
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
          <a id="voteBtn" href="<?=HOME_URL ?>/?page=showPoll&poll=<?=$poll->id?>" class="btn btn-primary thumbnailBtn  col-lg-2 col-sm-3 col-xs-4" role="button">
            Vote
          </a>
        </div>
        <div class="col-lg-2 col-md-1 col-sm-1 transpDiv"></div>
    </div>
  <?php endforeach ?>
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
    <a class="carousel-control right" href="#this-carousel-id" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
</div><!-- /.carousel -->

<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
<div class="container siteMap col-lg-12">
  <div class="siteMapInf col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <h3 class="siteMapTitle col-lg-12">Create your own polls.</h3>
    <p class="siteMapDescription col-lg-12">You can create as many polls
    you want. You can even make them public or private.</p>
  </div>
  <img src="<?=HOME_URL ?>/img/createPoll.png" alt="..." class="img-responsive siteMapImg col-lg-6 col-md-6 col-sm-12 col-xs-12">
</div>

<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
<div class="container siteMap col-lg-12">
  <img src="<?=HOME_URL ?>/img/managePolls.png" alt="..." class="img-responsive siteMapImg col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="siteMapInf col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <h3 class="siteMapTitle col-lg-12">Manage your polls.</h3>
    <p class="siteMapDescription col-lg-12">You can edit, close,
    delete and see the actual results of your poll.</p>
  </div>
  
</div>

<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
<div class="container siteMap col-lg-12">
  <div class="siteMapInf col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <h3 class="siteMapTitle col-lg-12">Vote in polls. </h3>
    <p class="siteMapDescription col-lg-12">You can give your opinion. In your own polls
    in private pools that you were invited and public polls.</p>
  </div>
  <img src="<?=HOME_URL ?>/img/votePolls.png" alt="..." class="img-responsive siteMapImg  col-lg-6 col-md-6 col-sm-12 col-xs-12">
</div>

<div class="line col-lg-12 col-sm-12 col-xs-12"></div>

<div class="container signUpMsg">
  <h1>What are you waiting for? <a href="<?=HOME_URL ?>/?page=register">Sign Up NOW!</a></h1>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 transpDiv" style="height: 80px;"></div>