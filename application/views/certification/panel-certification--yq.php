

	  	<!-- start tab -->
<div class="tab-content">
		
		<!-- tab certification -->
    <div role="tabpanel" class="tab-pane " id="YQ-005--cert">
    	<div class="list-group" id="list-group--certification-YQ-005">
			<div class="list-group-item"> 
				<input type="search" class="form-control search" placeholder="Search" id="search--certification-YQ-005"> 
    		</div> 
		</div>

		<a href="<?php echo isset($url__tab_certification)? $url__tab_certification : '#YQ-005--items'; ?>" aria-controls="home" role="tab" data-toggle="tab" onclick="item()" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			<i class="material-icons">add</i> Save 
		</a>

    </div> 
    <!-- end tab certification -->

    <!-- tab item -->
    <div role="tabpanel" class="tab-pane active" id="YQ-005--items">
    	<div class="list-group" id="list-group--item-YQ-005">
			<div class="list-group-item"> 
				<div class="input-group">
    				<input type="text" class="form-control input-item" placeholder="input Divisi" id="input--item-YQ-005"> 
			      	<span class="input-group-btn">
			        	<button class="btn btn-primary btn-tambah-item" type="button" onclick="tambah_item(event, 'YQ-005')">Add!</button>
			      	</span>
			    </div><!-- /input-group -->
    		</div> 
		</div>

		<a href="#YQ-005--cert" aria-controls="home" role="tab" data-toggle="tab" class="btn-back mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			<i class="material-icons">keyboard_arrow_right</i> Next
		</a>
    </div> 
    <!-- end tab item -->

</div>
<!-- end tab -->