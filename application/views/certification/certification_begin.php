<?php echo $this->load->component('js','js/library.company.js'); ?>

<style type="text/css">
	.mdl-list-group
	{
		width: 100%;
		border-radius: 0px !important;
	}
		.mdl-list-group .list-group-item { border-radius: 0%; }
	.mdl-box-content
	{
		padding: 0px !important;
	}
	.row-selected
    {
        background: #4183D7 !important;
        color: white;
    }
    .panel--tab-certification
    {
    	margin: 1px !important;
    }
    .panel--tab-certification, .panel--tab-certification .panel-heading
    {
    	border-radius: 0% !important;
    }
    .panel--tab-certification .panel-heading
    {
    	cursor: pointer;
    	height: 50px;
    	display: flex;
    	align-items: center;
    	align-content: center;
    	justify-content: space-between;
    }

    .panel-warning{border-color: #1BBC9B;}.panel-warning .panel-heading{background-color: #1BBC9B;border-color: #1BBC9B;color: white;}.panel-warning .panel-body{border-top-color: #1BBC9B !important;}
    .panel-info{border-color: #F27935;}.panel-info .panel-heading{background-color: #F27935;border-color: #F27935;color: white;}.panel-info .panel-body{border-top-color: #F27935 !important;}

    .list-group-certification-item
    {
    	display: flex;
    	align-content:center;
    	justify-content: space-between;
    }
</style>

<form class="helper helper-form" id="form-add-certification" name="form-add-certification" action="<?php echo site_url('company/process/request/certification') ?>" onsubmit="submit_request_assessment(event)" >
	<input type="hidden" name="id_company" value="<?php echo $id_company ?>">

</form>

<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

		<!-- /////////////////////////////////// J P A //////////////////////////////////// -->
	  	<div class="panel panel-primary panel--tab-certification mdl-cell mdl-cell--12-col">
	    	<div class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion-JPA-009" href="#collapse-JPA-009" aria-expanded="false" aria-controls="collapse-JPA-009" id="heading-JPA-009">
	     		<h4 class="panel-title">
	        		<a class="collapsed" role="button" >
	          			<i class="material-icons icons-middle">copyright</i> JPA-009 Certification ( For Products )
	        		</a>
	      		</h4>
	     		<i class="material-icons pull-right icons-tab-sign">add</i>
	    	</div>
		    <div id="collapse-JPA-009" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-JPA-009">
		      	<div class="panel-body">
		        	<div class="panel-body">
	        			<!-- start tab -->
		      			<div class="tab-content">
		      				
		      				<!-- tab certification -->
						    <div role="tabpanel" class="tab-pane" id="JPA-009--cert">
						    	<div class="list-group" id="list-group--certification-JPA-009">
				        			<div class="list-group-item"> 
					    				<input type="search" class="form-control search" placeholder="Search" id="search--certification-JPA-009"> 
						    		</div> 
				        		</div>
				        		
				        		<!-- back to item -->
				        		<a href="#JPA-009--items" aria-controls="home" role="tab" data-toggle="tab" class="sr-only mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
									<i class="material-icons">keyboard_backspace</i> Back
								</a>


								<button  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="item()">
									<i class="material-icons">add</i> Save 
								</button>

						    </div> 
						    <!-- end tab certification -->

						    <!-- tab commodity -->
						    <div role="tabpanel" class="tab-pane" id="JPA-009--commodity">
						    	
				        		<div class="col-md-12">

					        		<div class="list-group" id="list-group--commodity-JPA-009">
					        			<div class="list-group-item"> 
						    				<input type="search" class="form-control search" placeholder="Search" id="search--item-JECA-004"> 
							    		</div> 
					        		</div>

				        		</div>
				        		
				        		<!-- back to item -->
				        		<a href="#JPA-009--items" aria-controls="home" role="tab" data-toggle="tab" class="sr-only mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
									<i class="material-icons">keyboard_backspace</i> Back
								</a>


								<button href="#JPA-009--cert" aria-controls="home" role="tab" data-toggle="tab" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="jpa_commodity_choosen()">
									<i class="material-icons">keyboard_arrow_right</i> Next 
								</button>

						    </div>
						    <!-- end tab commodity -->

						    <!-- tab item -->
						    <div role="tabpanel" class="tab-pane active" id="JPA-009--items">
						    	<div class="list-group" id="list-group--item-JPA-009">
				        			<div class="list-group-item"> 
				        				<div class="input-group">
						    				<input type="text" class="form-control input-item" placeholder="input Produk" id="input--item-JPA-009"> 
									      	<span class="input-group-btn">
									        	<button href="#JPA-009--commodity" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-primary btn-add--brand btn-tambah-item" type="button" onclick="tambah_item_jpa(event, 'JPA-009')">Add!</button>
									      	</span>

									    </div><!-- /input-group -->
									    
						    		</div> 
				        		</div>
				        		<a href="#JPA-009--cert" aria-controls="home" role="tab" data-toggle="tab" class="sr-only btn-back mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
									<i class="material-icons">add</i> Add Certification JPA-009
								</a>
						    </div> 
						    <!-- end tab item -->
						</div>
						<!-- end tab -->

		      		</div>
		      	</div>
		    </div>
	  	</div>
		<!-- /////////////////////////////////// E N D  J P A //////////////////////////////////// -->
		
		<!-- /////////////////////////////////// Y Q //////////////////////////////////// -->


	  	<!-- <div class="panel panel-info panel--tab-certification mdl-cell mdl-cell--12-col">
	    	<div class="panel-heading" data-toggle="collapse" data-parent="#accordion-YQ-005" href="#collapse-YQ-005" aria-expanded="true" aria-controls="collapse-YQ-005" role="tab" id="heading-YQ-005">
	      		<h4 class="panel-title">
	        		<a role="button" >
	          			<i class="material-icons icons-middle">group</i> YQ-005 Certification ( for divisions )
	        		</a>
	      		</h4>
	     		<i class="material-icons pull-right icons-tab-sign">add</i>
	    	</div>
	    	<div id="collapse-YQ-005" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-YQ-005">
	      		<div class="panel-body"> -->
	      			
	      			<!-- start tab -->
	      			<!-- <div class="tab-content"> -->
	      				
	      				<!-- tab certification -->
					    <!-- <div role="tabpanel" class="tab-pane " id="YQ-005--cert">
					    	<div class="list-group" id="list-group--certification-YQ-005">
			        			<div class="list-group-item"> 
				    				<input type="search" class="form-control search" placeholder="Search" id="search--certification-YQ-005"> 
					    		</div> 
			        		</div>

							<a href="#YQ-005--items" aria-controls="home" role="tab" data-toggle="tab" class="sr-only mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
								<i class="material-icons">keyboard_backspace</i> Back 
							</a>

							<button  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="item()">
								<i class="material-icons">add</i> Save 
							</button>

					    </div>  -->
					    <!-- end tab certification -->

					    <!-- tab item -->
					    <!-- <div role="tabpanel" class="tab-pane active" id="YQ-005--items">
					    	<div class="list-group" id="list-group--item-YQ-005">
			        			<div class="list-group-item"> 
			        				<div class="input-group">
					    				<input type="text" class="form-control input-item" placeholder="input Divisi" id="input--item-YQ-005"> 
								      	<span class="input-group-btn">
								        	<button class="btn btn-primary btn-tambah-item" type="button" onclick="tambah_item(event, 'YQ-005')">Add!</button>
								      	</span>
								    </div>
					    		</div> 
			        		</div>

			        		<a href="#YQ-005--cert" aria-controls="home" role="tab" data-toggle="tab" class="sr-only btn-back mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
								<i class="material-icons">add</i> Add Certification YQ-005
							</a>
					    </div>  -->
					    <!-- end tab item -->

					<!-- </div> -->
					<!-- end tab -->

	      		<!-- </div>
	    	</div>
	  	</div> -->
		<!-- /////////////////////////////////// E N D  Y Q //////////////////////////////////// -->


		<!-- /////////////////////////////////// J E C A  //////////////////////////////////// -->
	  	<div class="panel panel-warning panel--tab-certification mdl-cell mdl-cell--12-col">
	    	<div class="panel-heading " role="tab" id="heading-JECA-004" data-toggle="collapse" data-parent="#accordion" href="#collapse-JECA-004" aria-expanded="false" aria-controls="collapse-JECA-004">
	     		<h4 class="panel-title">
	        		<a class="collapsed" role="button" >
	          			 <i class="material-icons icons-middle">public</i> JECA-004 Certification ( for environtments )
	        		</a>
	      		</h4>
	     		<i class="material-icons pull-right icons-tab-sign">add</i>
	    	</div>
		    <div id="collapse-JECA-004" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-JECA-004">
		      	<div class="panel-body">
		        	
		        	<!-- start tab -->
	      			<div class="tab-content">
	      				<!-- tab certification -->
					    <div role="tabpanel" class="tab-pane " id="JECA-004--cert">
					    	<div class="list-group" id="list-group--certification-JECA-004">
			        			<div class="list-group-item"> 
				    				<input type="search" class="form-control search" placeholder="Search" id="search--certification-JECA-004"> 
					    		</div> 
			        		</div>
			        		<a href="#JECA-004--items" aria-controls="home" role="tab" data-toggle="tab" class="sr-only mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
								<i class="material-icons">keyboard_backspace</i> Back
							</a>
							<button  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="item()">
								<i class="material-icons">add</i> Save 
							</button>
					    </div> 
					    <!-- end tab certification -->

					    <!-- tab item -->
					    <div role="tabpanel" class="tab-pane active" id="JECA-004--items">
					    	
					    	<div class="col-md-6">

				        		<div class="list-group" id="list-group--item-JECA-004">
				        			<div class="list-group-item"> 
					    				<input type="search" class="form-control search" placeholder="Search" id="search--item-JECA-004"> 
						    		</div> 
				        		</div>

			        		</div>

			        		<div class="col-md-6">
			        			
			        			<div class="list-group" id="list-group--item-choosen-JECA-004">
				        			
				        		</div>

			        		</div>
			        		<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">			        		
				        		<a href="#JECA-004--cert" aria-controls="home" role="tab" data-toggle="tab" class="sr-only btn-back mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
									<i class="material-icons">add</i> Add Certification JECA-004
								</a>
							</div>
					    </div>

					    <!-- end tab item -->
					</div>
					<!-- end tab -->

		      	</div>
		    </div>
	  	</div>
		<!-- /////////////////////////////////// E N D  J E C A  //////////////////////////////////// -->
	  

	<!-- Colored raised button -->
	<div class="mdl-cell mdl-cell--12-col" style="display:flex; align-items:center; justify-content: center; height:50px;">
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" form="form-add-certification" type="submit">
		  	<i class="material-icons">add</i> Request Assessments
		</button>
	</div>

</div>


<script type="text/javascript">
	var data_assessment = (function(){
		
		var __records_data_request_assessment = {'YQ-005': [], 'JPA-009': [], 'JECA-004': [] };
		var data_draft_item = {}
		
		var o = function(){}
		o.prototype = 
		{
			reset_draft: function()
			{
				data_draft_item = {};
			},

			set_draft: function(draft, value)
			{
				data_draft_item[draft] = value;
			},
			
			get_draft: function(item)
			{
				if(item)
				{
					return data_draft_item[item];
				}
				return data_draft_item;
			},

			tambah_item: function(certification, value, audit_reference)
			{
				var audit = [];

				// check index
				var index = __records_data_request_assessment[certification].map( function(res){ return res.dibrakom } ).indexOf(value);
								
				// if no certification matched with YQ, JPA, JECA
				if ( typeof __records_data_request_assessment[certification] !== 'object' ) { console.error('no certificate type of'+certificate+' exist!'); return false; }

				// console.log(index)
				// if there are same dibrakom in some type.
				if ( index > -1 )
				{
					var index_ref = __records_data_request_assessment[certification][index]['certification'].indexOf(audit_reference);
					
					// if no certification matched in certification array 
					if(index_ref < 0)
					{
						__records_data_request_assessment[certification][index]['certification'] = $.unique( __records_data_request_assessment[certification][index]['certification'].concat(audit_reference) );
						return false
					}

					console.info('data certification '+audit_reference+' has been inserted while ago. not saved!')

				}else
				{
					var data = {dibrakom: value, certification: []}
					
					data.certification = $.unique(data.certification.concat(audit_reference));
					
					// tambahkan id commodity
					data.id_commodity = data_assessment.get_draft().id_commodity;

					__records_data_request_assessment[certification].push(data);
				}
			},

			remove_dibrakom: function(type, dibrakom)
			{
				var index = __records_data_request_assessment[type].map( function(res){ return res.dibrakom } ).indexOf(dibrakom);
				if(index >= 0)
				{				
					__records_data_request_assessment[type].splice(index, 1);
				}

				return (index >= 0)? true : false
			},

			remove_certification: function(type, dibrakom, audit_reference)
			{
				var index = __records_data_request_assessment[type].map( function(res){ return res.dibrakom } ).indexOf(dibrakom);
				index_ref = __records_data_request_assessment[type][index]['certification'].indexOf(audit_reference);
				if( (__records_data_request_assessment[type][index]['certification'].indexOf(audit_reference) >= 0) )
				{
					__records_data_request_assessment[type][index]['certification'].splice(index_ref,1);
				}

				if(__records_data_request_assessment[type][index]['certification'].length < 1)
				{
					this.remove_dibrakom(type, dibrakom);
					return true;
				}else
				{

					return (__records_data_request_assessment[type][index]['certification'].indexOf(audit_reference) < 0)? true : false;
				}
			},

			get_records: function()
			{
				return __records_data_request_assessment;
			},

			reset: function()
			{
				__records_data_request_assessment = {'YQ-005': [], 'JPA-009': [], 'JECA-004': [] };
			}

		}
		return new o();
	})()



	function get_certification(options)
	{

		options = $.extend({filter: undefined}, options)

		$.post(site_url('certification/process/get/list'))
		.done(function(res){
			res = JSON.parse(res);
			
			if(options.filter)
			{
				res = res.filter(function(data){ return data.type == options.filter });
			}

			Tools.write_data({
				records: res,
				target: $(options.target),
				template: '<div class="list-group-item list-group-item-certification" data-filter="::name::"> <div class="checkbox"> <label> <input type="checkbox" class="certification--choose-certification-available" value="::audit_reference::" name="certification[]" form="form-add-certification" data-type="'+options.filter+'" data-assessment="::name::" >  <span>::name::</span> </label </div> </div>'
			});

			Tools.element.filter({
				trigger_using: $(options.target).find('input.search'),
				target: $(options.target).find('.list-group-item-certification')
			})
		})

	}

	function tambah_item_jpa(event, type, value, target)
	{
		var parents = $(event.target).parents('.list-group'),
			input = $(parents).find('input.input-item'),
			value = $(input).val()

		$(input).val('');

		data_assessment.reset_draft();
		data_assessment.set_draft('certification', type);
		data_assessment.set_draft('item', value);
		data_assessment.set_draft('target', parents);
	}

	function tambah_item(event, type, value, target)
	{
		var parents = $(event.target).parents('.list-group'),
			input = $(parents).find('input.input-item'),
			value = $(input).val()

		// item(parents, type, value)

		// $(parents).append('<div class="list-group-item list-group-certification-item list-group-item-certification list-group-item--item-'+type+'"> <div>'+value+' </div> <div class="pull-right">  <button class="mdl-button mdl-js-button" onclick=""> Open </button> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="remove_certification(event, \''+value+'\')"> <i class="material-icons">clear</i> </button> </div> </div>')
		
		$(input).val('');

		$('a[href="#'+type+'--cert"]').tab('show')

		data_assessment.reset_draft();
		data_assessment.set_draft('certification', type);
		data_assessment.set_draft('item', value);
		data_assessment.set_draft('target', parents);

	}

	function item()
	{
		var target = data_assessment.get_draft('target'), type = data_assessment.get_draft('certification'), textitem = data_assessment.get_draft('textitem'), value = data_assessment.get_draft('item');

		var selected_certification = $('#list-group--certification-'+type).find('input[type="checkbox"].certification--choose-certification-available:checked'),
			text = (textitem)?textitem:value;

		if(text == ''){ alert('please fill item'); return false; }
		// if(selected_certification.length < 1) { alert('please select certification that associated with '+type); return false; }
		
		$.each( selected_certification , function(a,b){

			var s_value = parseInt($(b).val() ),
				s_type = $(b).attr('data-type'),
				s_assessment = $(b).attr('data-assessment');

			data_assessment.tambah_item(type, value, s_value )

			$(target).append('<div class="list-group-item list-group-certification-item list-group-item-certification list-group-item--item-'+type+'"> <div>'+text+' <span class="badge" style="float:none">'+s_assessment+'</span> </div> <div class="pull-right">  <button class="mdl-button mdl-js-button" onclick=""> Open </button> <button class="mdl-button mdl-js-button mdl-button--icon" onclick="remove_certification(event, \''+s_type+'\', \''+value+'\','+s_value+')"> <i class="material-icons">clear</i> </button> </div> </div>')
		})

		$('[href="#'+type+'--items"]').tab('show');

	}

	function commodity_choosen(event, type)
	{
		var is_check = $(event.target).is(':checked'),
			value = $(event.target).val(),
			text = $(event.target).siblings('span').text(),
			commodity_name = $(event.target).siblings('span').text();

		$('a[href="#'+type+'--cert"]').tab('show')

		data_assessment.reset_draft();
		data_assessment.set_draft('certification', type);
		// data_assessment.set_draft('item', value);
		data_assessment.set_draft('id_commodity', value);
		data_assessment.set_draft('textitem', text);
		data_assessment.set_draft('target', $('#list-group--item-choosen-JECA-004') );
		// item(, type, value, text)
		
	}

	function jpa_commodity_choosen()
	{
		var value = $('.commodity--choose-item:checked').val();
		data_assessment.set_draft('id_commodity', value);

	}

	function success_remove_JECA(type, dibrakom)
	{
		$('.commodity--choose-item[value="'+dibrakom+'"]').prop('checked',false)
	}

	function remove_certification(event, type, dibrakom, certification)
	{

		success = (typeof success == 'function')? success : function(){}

		if( data_assessment.remove_certification(type, dibrakom, certification) )
		{
			$(event.target).parents('.list-group-item').remove();
			success_remove_JECA(type, dibrakom);
			return ( $(event.target).parents('.list-group-item').length < 1 )? true : false;
		}
	}

	function submit_request_assessment(event)
	{
		event.preventDefault();

		var id_company= $(event.target).find('input[name="id_company"]').val(),
			data = {assessment: data_assessment.get_records(), id_company: id_company},
			action = $(event.target).attr('action');

		if( data.assessment['JECA-004'].length == 0 && data.assessment['YQ-005'].length == 0 && data.assessment['JPA-009'].length == 0 )
		{
			alert('please fill one or more certification');
		}

		$.post(action, data)
		.done(function(response){

			// console.log(response)
			$('.list-group-certification-item').remove()
			data_assessment.reset();
			event.target.reset();
			$('.btn-back').trigger('click');
			$('.collapse').collapse('hide')
		})
	}

    function jeca_item_onchange(event)
    {

    }

	$(function(){
		// fetch_brand();
		get_certification({target: '#list-group--certification-JPA-009', filter:'JPA-009'})
		get_certification({target: '#list-group--certification-YQ-005', filter:'YQ-005'})
		get_certification({target: '#list-group--certification-JECA-004', filter:'JECA-004'})

		// get commodity
		$.post(site_url('commodity/get_commodity') )
		.done(function(res){
			res = JSON.parse(res)
			Tools.write_data({
				records: res,
				target: $('#list-group--item-JECA-004'),
				template: '<div class="list-group-item list-group-item-commodity" data-filter="::commodity_name::"> <div class="checkbox"> <label> <input type="checkbox" class="commodity--choose-item" value="::id_commodity::" name="commodity[]" form="form-add-certification" onchange="commodity_choosen(event, \'JECA-004\')" >  <span>::commodity_name::</span> </label </div> </div>'
			});

			Tools.element.filter({
				trigger_using: $('#list-group--item-JECA-004').find('input.search'),
				target: $('#list-group--item-JECA-004').find('.list-group-item-commodity')
			})

			Tools.write_data({
				records: res,
				target: $('#list-group--commodity-JPA-009'),
				template: '<div class="list-group-item list-group-item-commodity-jpa-009" data-filter="::commodity_name::"> <div class="radio"> <label> <input type="radio" class="commodity--choose-item" value="::id_commodity::" name="commodity" form="form-add-certification" >  <span>::commodity_name::</span> </label </div> </div>'
			});


		});


		///////// colapse //////
		$('.collapse').on('hidden.bs.collapse', function (event) {
			$(event.target).parents('.panel').find('.icons-tab-sign').html('add')
		})
		$('.collapse').on('show.bs.collapse', function (event) {
			$(event.target).parents('.panel').find('.icons-tab-sign').html('remove')
		})

		//... enter tambah item ...// 
		$('.input-item').on('keyup', function(event){
			if( event.keyCode == 13 ) 
			{
				$(event.target).parent().find('.btn-tambah-item').trigger('click');
				return false;
			}
			return;
		})

	})



</script>