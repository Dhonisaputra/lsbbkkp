
				<!-- tab certification -->
		    <div role="tabpanel" class="tab-pane <?php echo ($tab_certification == 'active')? $tab_certification : ''; ?>" id="JPA-009--cert">
		    	<div class="list-group" id="list-group--certification-JPA-009">
        			<div class="list-group-item"> 
	    				<input type="search" class="form-control search" placeholder="Search" id="search--certification-JPA-009"> 
		    		</div> 
        		</div>
        		
        		<!-- back to item -->
	    		<div class="mdl-cell mdl-cell--12-col" style="display:flex; align-items:center; justify-content: space-between; height:50px; ">
	        		<button href="#JECA-004--items" aria-controls="home" role="tab" data-toggle="tab" class="btn-back mdl-button mdl-js-button" onclick="back__jeca_cert()">
						<i class="material-icons">keyboard_arrow_left</i> Back
					</button>
	        		<button href="<?php echo isset($url__tab_certification)? $url__tab_certification : '#JPA-009--items'; ?>" aria-controls="home" role="tab" data-toggle="tab" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="save_certification()">
						<i class="material-icons">add</i> Save Certification 
					</button>
				</div>

		    </div> 
		    <!-- end tab certification -->

		    <!-- tab item -->
		    <div role="tabpanel" class="tab-pane <?php echo ($tab_items == 'active')? $tab_items : ''; ?>" id="JPA-009--items">
		    	<div class="list-group" id="list-group--item-JPA-009">
        			<div class="list-group-item"> 
        				<div class="input-group">
		    				<input type="text" class="form-control input-item" placeholder="input Produk" id="input--item-JPA-009"> 
					      	<span class="input-group-btn">
					        	<button class="btn btn-primary btn-add--brand btn-tambah-item" type="button" onclick="tambah_item(event, 'JPA-009')">Add!</button>
					      	</span>

					    </div><!-- /input-group -->
					    
		    		</div> 
        		</div>
	    		<div class="mdl-cell mdl-cell--12-col" style="display:flex; align-items:center; justify-content: space-between; height:50px;">
	        		<button href="#JECA-004--items" aria-controls="home" role="tab" data-toggle="tab" class="btn-back mdl-button mdl-js-button" onclick="back__jeca_cert()">
						<i class="material-icons">keyboard_arrow_left</i> Back
					</button>
	        		<button href="#JPA-009--cert" aria-controls="home" role="tab" data-toggle="tab" class="btn-back mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
						<i class="material-icons">keyboard_arrow_right</i> Next
					</button>
				</div>
		    </div> 
		    <!-- end tab item -->
		