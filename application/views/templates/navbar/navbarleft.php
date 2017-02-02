
<div class="navbar-system col-lg-3 col-xs-12 col-md-3 col-sm-4 " id="navbar-system--left">
	<div class="navbar-system--heading row list-group-item">
		<div class="heading-item no-border list-item-link--top col-md-9 col-xs-10 col-sm-9 col-lg-9" id="admin-profile">
			<span class="heading-url">Administrator</span>
			<span class="small-url">Profile</span>
		</div>
		<a href="#profile" class="heading-item nav-icon " id="nav-icon"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
	</div>
	<div class="list-group list-group-link row">
		<a href='<?php echo site_url() ?>' class="list-group-item list-item-link">
			<span class="heading-url">Assessment</span>
			<span class="small-url">Setup</span>
		</a>
		<a href='<?php echo site_url('assessment/schedules') ?>' class="list-group-item list-item-link">
			<span class="heading-url">Assessment</span>
			<span class="small-url">Schedule</span>
		</a>
		<a href='<?php echo site_url('company') ?>' class="list-group-item list-item-link">
			<span class="heading-url">Company</span>
			<span class="small-url">Registration</span>
		</a>
		<a href='<?php echo site_url("certification/panel") ?>' class="list-group-item list-item-link">
			<span class="heading-url">Accredited</span>
			<span class="small-url">ISO/SNI Certification</span>
		</a>
		<a href='<?php echo site_url("auditor") ?>' class="list-group-item list-item-link">
			<span class="heading-url">Auditor</span>
			<span class="small-url">Profile</span>
		</a>
		<a href='<?php echo site_url("logout") ?>' class="list-group-item list-item-link">
			<span class="heading-url">Logout</span>
		</a>
	</div>
</div>