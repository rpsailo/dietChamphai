<?php $success = Session::get('success'); ?>
<?php $usersuccess = Session::get('usersuccess'); ?>
<?php $info = Session::get('info'); ?>
<?php $warning = Session::get('warning'); ?>
<?php $danger = Session::get('danger'); ?>
<?php
    if(Session::has('usersuccess'))
    {
        $profile = Session::get('profileId');
    }
?>

@if(!empty($success))
  <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Success</h4> {{ $success }}
    </div>
@endif
@if(!empty($usersuccess))
	<div class="alert alert-success alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<h4><i class="icon fa fa-check"></i> Success</h4> User activated and sent acknowledgement in the registered mail.
  	</div>
@endif
@if(!empty($info))
	<div class="alert alert-info alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<h4><i class="icon fa fa-info"></i> Information</h4> {{ $info }}
  	</div>
@endif
@if(!empty($warning))
	<div class="alert alert-warning alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<h4><i class="icon fa fa-warning"></i> Warning</h4> {{ $warning }}
  	</div>
@endif
@if(!empty($danger))
	<div class="alert alert-danger alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<h4><i class="icon fa fa-danger"></i> Error</h4> {{ $danger }}
  	</div>
@endif
