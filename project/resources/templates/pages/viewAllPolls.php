<div class="container" id="managePolls">
	<div class="media">
    <div class="row">

      <div class="row filters col-lg-4 col-sm-4 col-xs-12">
        <div class="col-lg-12 filter_options">
        <h4><i class="glyphicon glyphicon-lock"></i> Status</h4>
          <ul class="list-group">
            <li class="list-group-item btn active">
              <a href="#" class="filtersText">Open<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn">
              <a href="#" class="filtersText">Closed<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn">
              <a href="#" class="filtersText">All<span class="badge pull-right">14</span></a>
            </li>
          </ul>
        </div>

        <div class="col-lg-12 filter_options">
        <h4><i class="glyphicon glyphicon-eye-open"></i> Visibility</h4>
          <ul class="list-group">
            <li class="list-group-item btn active">
              <a href="#" class="filtersText">Public<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn">
              <a href="#" class="filtersText">Private<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn">
              <a href="#" class="filtersText">Public/Private<span class="badge pull-right">14</span></a>
            </li>
          </ul>
        </div>

        <div class="col-lg-12 filter_options">
        <h4><i class="glyphicon glyphicon-stats"></i> Vote</h4>
          <ul class="list-group">
            <li class="list-group-item btn">
              <a href="#" class="filtersText">All<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn active">
              <a href="#" class="filtersText">Voted<span class="badge pull-right">14</span></a>
            </li>
            <li class="list-group-item btn">
              <a href="#" class="filtersText">Not Voted<span class="badge pull-right">14</span></a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- SHOW POLLS -->
      <div class="container col-lg-8 col-sm-8 col-xs-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <?php foreach($polls as $poll): ?>
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <?=$poll->title ?>

                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">

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